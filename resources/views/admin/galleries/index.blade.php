@extends('admin.layouts.admin')

@section('title', 'Manage Gallery')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Gallery Management</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#galleryModal">
            <i class="fas fa-plus"></i> Add New Image
        </button>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="galleryTable" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Finish Type</th>
                            <th>Description</th>
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

<!-- Gallery Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="galleryModalTitle">Add Gallery Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="galleryForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="gallery_id" id="gallery_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Title *</label>
                        <input type="text" class="form-control" name="title" id="gallery_title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" class="form-control" name="category" id="gallery_category" placeholder="e.g., Media Walls, Venetian Plaster">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Finish Type</label>
                        <select class="form-control" name="finish_type" id="gallery_finish_type">
                            <option value="">Select finish</option>
                            <option value="gold">Gold</option>
                            <option value="silver">Silver</option>
                            <option value="brown">Brown</option>
                            <option value="marble">Marble</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="gallery_description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image *</label>
                        <input type="file" class="form-control" name="image" id="gallery_image" accept="image/*">
                        <div id="currentGalleryImage" class="mt-2"></div>
                        <small class="text-muted">Max 5MB. Allowed formats: JPG, PNG, GIF</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Image</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Image Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="viewContent">
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#galleryTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('admin.galleries.index') }}",
            type: 'GET'
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'image', name: 'image', orderable: false, searchable: false},
            {data: 'title', name: 'title'},
            {data: 'category', name: 'category'},
            {data: 'finish_type', name: 'finish_type'},
            {data: 'description', name: 'description'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        responsive: true,
        pageLength: 10,
        order: [[0, 'desc']]
    });
    
    // Reset form when modal closes
    $('#galleryModal').on('hidden.bs.modal', function() {
        $('#galleryForm')[0].reset();
        $('#gallery_id').val('');
        $('#currentGalleryImage').html('');
        $('#galleryModalTitle').text('Add Gallery Image');
    });
    
    // View Gallery Item
    $(document).on('click', '.view-btn', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/admin/galleries/' + id,
            type: 'GET',
            success: function(data) {
                var html = `
                    <div class="text-center">
                        <img src="/${data.image}" class="img-fluid mb-3" style="max-height: 400px; border-radius: 10px;">
                        <h4>${data.title}</h4>
                        <p><strong>Category:</strong> ${data.category || 'N/A'}</p>
                        <p><strong>Finish Type:</strong> ${data.finish_type ? data.finish_type.toUpperCase() : 'N/A'}</p>
                        <p><strong>Description:</strong></p>
                        <p class="text-muted">${data.description || 'No description provided'}</p>
                        <small class="text-muted">Added on: ${new Date(data.created_at).toLocaleDateString()}</small>
                    </div>
                `;
                $('#viewContent').html(html);
            }
        });
    });
    
    // Edit Gallery
    $(document).on('click', '.edit-gallery', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/admin/galleries/' + id + '/edit',
            type: 'GET',
            success: function(data) {
                $('#galleryModalTitle').text('Edit Gallery Image');
                $('#gallery_id').val(data.id);
                $('#gallery_title').val(data.title);
                $('#gallery_category').val(data.category);
                $('#gallery_finish_type').val(data.finish_type);
                $('#gallery_description').val(data.description);
                if(data.image) {
                    $('#currentGalleryImage').html('<img src="/' + data.image + '" height="100" class="img-thumbnail"><br><small class="text-muted">Current image</small>');
                }
                $('#galleryModal').modal('show');
            },
            error: function(xhr) {
                Swal.fire('Error!', 'Could not load gallery data', 'error');
            }
        });
    });
    
    // Delete Gallery Item
    $(document).on('click', '.delete-gallery', function() {
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
                    url: '/admin/galleries/' + id,
                    type: 'DELETE',
                    data: {_token: $('meta[name="csrf-token"]').attr('content')},
                    success: function(response) {
                        Swal.fire('Deleted!', response.message, 'success');
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', 'Could not delete image', 'error');
                    }
                });
            }
        });
    });
    
    // Submit Gallery Form
    $('#galleryForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        var id = $('#gallery_id').val();
        var url = id ? '/admin/galleries/' + id : '{{ route("admin.galleries.store") }}';
        
        if(id) {
            formData.append('_method', 'PUT');
        }
        
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
                $('#galleryModal').modal('hide');
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