@extends('admin.layouts.admin')

@section('title', 'Manage Services')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Services Management</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#serviceModal" id="addServiceBtn">
            <i class="fas fa-plus"></i> Add New Service
        </button>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="servicesTable" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
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

<!-- Service Modal -->
<div class="modal fade" id="serviceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="serviceForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="service_id" id="service_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description *</label>
                        <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <div id="currentImage" class="mt-2"></div>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Service</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#servicesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('admin.services.index') }}",
            type: 'GET',
            data: function(d) {
                d._token = '{{ csrf_token() }}';
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'image', name: 'image', orderable: false, searchable: false},
            {data: 'title', name: 'title'},
            {data: 'description', name: 'description'},
            {data: 'status', name: 'status'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        responsive: true,
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        order: [[0, 'desc']],
        language: {
            processing: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>'
        }
    });
    
    // Reset form when modal closes
    $('#serviceModal').on('hidden.bs.modal', function() {
        $('#serviceForm')[0].reset();
        $('#service_id').val('');
        $('#currentImage').html('');
        $('#modalTitle').text('Add Service');
    });
    
    // Add Service button click
    $('#addServiceBtn').click(function() {
        $('#serviceForm')[0].reset();
        $('#service_id').val('');
        $('#currentImage').html('');
        $('#modalTitle').text('Add Service');
        $('#serviceModal').modal('show');
    });
    
    // Edit Service
    $(document).on('click', '.edit-service', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/admin/services/' + id + '/edit',
            type: 'GET',
            success: function(response) {
                $('#modalTitle').text('Edit Service');
                $('#service_id').val(response.id);
                $('#title').val(response.title);
                $('#description').val(response.description);
                $('#status').val(response.status);
                if(response.image) {
                    $('#currentImage').html('<img src="/' + response.image + '" height="100" class="img-thumbnail">');
                } else {
                    $('#currentImage').html('');
                }
                $('#serviceModal').modal('show');
            },
            error: function(xhr) {
                Swal.fire('Error!', 'Could not load service data', 'error');
            }
        });
    });
    
    // Delete Service
    $(document).on('click', '.delete-service', function() {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/services/' + id,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire('Deleted!', response.message, 'success');
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', 'Could not delete service', 'error');
                    }
                });
            }
        });
    });
    
    // Submit Form
    $('#serviceForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        var id = $('#service_id').val();
        var url = id ? '/admin/services/' + id : '{{ route("admin.services.store") }}';
        
        if(id) {
            formData.append('_method', 'PUT');
        }
        
        // Show loading state
        Swal.fire({
            title: 'Processing...',
            text: 'Please wait',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                Swal.fire('Success!', response.message, 'success');
                $('#serviceModal').modal('hide');
                table.ajax.reload();
            },
            error: function(xhr) {
                Swal.close();
                var errors = xhr.responseJSON?.errors;
                var errorMessage = '';
                if(errors) {
                    $.each(errors, function(key, value) {
                        errorMessage += value[0] + '\n';
                    });
                } else {
                    errorMessage = xhr.responseJSON?.message || 'An error occurred';
                }
                Swal.fire('Error!', errorMessage, 'error');
            }
        });
    });
});
</script>
@endpush
@endsection