@extends('layouts.dashboard')

@push('styles')
    <!-- Custom styles for this page -->
    <link href={{asset("vendor/datatables/dataTables.bootstrap4.min.css")}} rel="stylesheet">
@endpush

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between my-3">
        <h1 class="h3 mb-2 text-gray-800">Categories</h1>
        <a href="{{ route('categories.create') }}" class="ml-auto align-content-center d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50 mr-2"></i> Create</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 justify-between">
            <h6 class="m-0 font-weight-bold text-primary">Categories Book</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ( $categories as $category )
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->created_at }}</td>
                            <td>{{ $category->updated_at }}</td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary shadow-sm gap-2"><i
                                    class="fas fa-pencil-alt"></i></a>
                                <button class="btn btn-sm btn-danger" data-id="{{ $category->id }}"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection

@push('scripts')
     <!-- Page level plugins -->
     <script src={{asset("vendor/datatables/jquery.dataTables.min.js")}}></script>
     <script src={{asset("vendor/datatables/dataTables.bootstrap4.min.js")}}></script>

     <!-- Page level custom scripts -->
     <script src={{asset("js/demo/datatables-demo.js")}}></script>
     <script>
        $(document).ready(function () {
           $('.btn-danger').click((e) => {
               e.preventDefault();
               let categoryId = $('.btn-danger').attr("data-id");

               Swal.fire({
                   title: 'Are you sure?',
                   text: "You won't be able to revert this!",
                   icon: 'warning',
                   showCancelButton: true,
                   confirmButtonColor: '#3085d6',
                   cancelButtonColor: '#d33',
                   confirmButtonText: 'Yes, delete it!'
               }).then((result) => {
                   if (result.isConfirmed) {
                       $.ajaxSetup({
                           headers: {
                               'X-CSRF-TOKEN': "{{ csrf_token() }}"
                           }
                       })

                       $.ajax({
                           type: 'DELETE',
                           url: `/admin/categories/${categoryId}`,
                           success: (response) => {
                               if(response.success){
                                   Swal.fire({
                                       title: "Success!",
                                       text: response.message,
                                       icon: "success",
                                       confirmButtonText: "OK"
                                   }).then(() => {
                                       location.reload();
                                   }).catch(() => {
                                       $('.alert').removeClass('d-none');
                                       $('.alert').addClass('alert-danger');
                                       $('.alert').text(response.message);
                                   });
                               }
                           }
                       })
                   }
               })
           })
        });
    </script>
@endpush
