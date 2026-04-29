@extends('admin.layouts.admin')

@section('title', 'Contact Inquiries')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Contact Inquiries</h2>
        <button class="btn btn-danger" id="bulkDeleteBtn" style="display: none;">
            <i class="fas fa-trash"></i> Delete Selected
        </button>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="contactsTable" width="100%">
                    <thead>
                        <tr>
                            <th width="50"><input type="checkbox" id="selectAll"></th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be loaded via AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- View Contact Modal -->
<div class="modal fade" id="viewContactModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Contact Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="contactDetails">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="replyEmailBtn">
                    <i class="fas fa-reply"></i> Reply via Email
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#contactsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('admin.contacts.index') }}",
            type: 'GET'
        },
        columns: [
            {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'message', name: 'message'},
            {data: 'status', name: 'status'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        responsive: true,
        pageLength: 10,
        order: [[7, 'desc']],
        language: {
            processing: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>'
        }
    });
    
    // Variable to store current contact email
    var currentContactEmail = '';
    
    // Select All
    $('#selectAll').change(function() {
        $('.contact-checkbox').prop('checked', $(this).prop('checked'));
        toggleBulkDeleteBtn();
    });
    
    // Toggle bulk delete button
    $(document).on('change', '.contact-checkbox', function() {
        toggleBulkDeleteBtn();
    });
    
    function toggleBulkDeleteBtn() {
        var checked = $('.contact-checkbox:checked').length;
        if(checked > 0) {
            $('#bulkDeleteBtn').show();
        } else {
            $('#bulkDeleteBtn').hide();
        }
    }
    
    // View Contact
    $(document).on('click', '.view-contact', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/admin/contacts/' + id,
            type: 'GET',
            success: function(data) {
                currentContactEmail = data.email;
                var html = `
                    <div class="contact-details">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Name:</th>
                                <td><strong>${data.name}</strong></td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>${data.email}</td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td>${data.phone}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td><span class="badge bg-${data.status == 'unread' ? 'danger' : 'success'}">${data.status.toUpperCase()}</span></td>
                            </tr>
                            <tr>
                                <th>Date:</th>
                                <td>${new Date(data.created_at).toLocaleString()}</td>
                            </tr>
                            <tr>
                                <th>Message:</th>
                                <td><p class="mt-2">${data.message.replace(/\n/g, '<br>')}</p></td>
                            </tr>
                        </table>
                    </div>
                `;
                $('#contactDetails').html(html);
                $('#viewContactModal').modal('show');
                table.ajax.reload(); // Refresh to update status
            },
            error: function(xhr) {
                Swal.fire('Error!', 'Could not load contact details', 'error');
            }
        });
    });
    
    // Reply via Email
    $('#replyEmailBtn').click(function() {
        if (currentContactEmail) {
            window.location.href = 'mailto:' + currentContactEmail;
        }
    });
    
    // Delete Contact
    $(document).on('click', '.delete-contact', function() {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "This will permanently delete the inquiry!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/contacts/' + id,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire('Deleted!', response.message, 'success');
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', 'Could not delete inquiry', 'error');
                    }
                });
            }
        });
    });
    
    // Bulk Delete
    $('#bulkDeleteBtn').click(function() {
        var ids = [];
        $('.contact-checkbox:checked').each(function() {
            ids.push($(this).val());
        });
        
        if(ids.length === 0) {
            Swal.fire('Warning', 'Please select items to delete', 'warning');
            return;
        }
        
        Swal.fire({
            title: 'Delete Selected?',
            text: `You are about to delete ${ids.length} inquiries. This cannot be undone!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete them!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("admin.contacts.bulk-delete") }}',
                    type: 'DELETE',
                    data: {
                        ids: ids,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire('Deleted!', response.message, 'success');
                        table.ajax.reload();
                        $('#selectAll').prop('checked', false);
                        $('#bulkDeleteBtn').hide();
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', 'Could not delete selected inquiries', 'error');
                    }
                });
            }
        });
    });
});
</script>
@endpush
@endsection