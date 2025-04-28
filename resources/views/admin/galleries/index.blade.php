<x-app-layout>
    {{-- Title --}}
    <x-slot name="title">Gallery</x-slot>

    {{-- Header Style --}}
    <x-slot name="headerstyle">
        {{-- Datatable css --}}
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    </x-slot>

    {{-- Page Content --}}
    <div class="flex flex-col gap-4">
        <div class="container-fluid">
            <div class="card p-6">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="m-0">Gallery Images</h4>
                        <a href="{{ route('galleries.create') }}" class="btn btn-primary">Add New Image</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="galleryTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <!-- Datatable script-->
        <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                var table = $('#galleryTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('galleries.index') }}",
                    columns: [
                        { data: 'title', name: 'title' },
                        {
                            data: 'image',
                            name: 'image',
                            render: function(data) {
                                return `<img src="${data}" alt="Gallery Image" class="img-thumbnail" style="max-height: 50px;">`;
                            }
                        },
                        { data: 'description', name: 'description' },
                        { data: 'order', name: 'order' },
                        {
                            data: 'active',
                            name: 'active',
                            render: function(data) {
                                return data ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
                            }
                        },
                        {
                            data: 'id',
                            name: 'actions',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return `
                                    <a href="/galleries/${data}/edit" class="btn btn-sm btn-primary">Edit</a>
                                    <button class="btn btn-sm btn-danger delete-btn" data-id="${data}">Delete</button>
                                `;
                            }
                        }
                    ]
                });

                // Delete Gallery
                $('#galleryTable').on('click', '.delete-btn', function() {
                    var id = $(this).data('id');
                    if (confirm('Are you sure you want to delete this gallery image?')) {
                        $.ajax({
                            url: "{{ route('galleries.index') }}/" + id,
                            type: "DELETE",
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                table.ajax.reload();
                                toastr.success('Gallery image deleted successfully');
                            },
                            error: function(xhr) {
                                toastr.error('Error deleting gallery image');
                            }
                        });
                    }
                });
            });
        </script>
    </x-slot>
</x-app-layout>
