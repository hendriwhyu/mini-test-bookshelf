@extends('layouts.dashboard')

@push('styles')
    <link href={{asset("vendor/datatables/dataTables.bootstrap4.min.css")}} rel="stylesheet">
@endpush

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between my-3">
        <h1 class="h3 mb-2 text-gray-800">Books</h1>
        <a href="{{ route('books.create') }}" class="ml-auto align-content-center d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm gap-2"><i
                class="fas fa-plus fa-sm text-white-50 mr-2"></i> Create</a>
    </div>

    <div class="alert d-none" role="alert"></div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 justify-between">
            <h6 class="m-0 font-weight-bold text-primary">Table Books</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Year</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ( $books as $book )
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ Carbon\Carbon::parse($book->release_date)->year }}</td>
                            <td>
                                <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-secondary shadow-sm gap-2"><i
                                        class="fas fa-eye"></i></a>
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-primary shadow-sm gap-2"><i
                                        class="fas fa-pencil-alt"></i></a>
                                <button class="btn btn-sm btn-danger shadow-sm gap-2" data-id="{{ $book->id }}"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
     <!-- Page level plugins -->
     <script src={{asset("vendor/datatables/jquery.dataTables.min.js")}}></script>
     <script src={{asset("vendor/datatables/dataTables.bootstrap4.min.js")}}></script>

     <!-- Page level custom scripts -->
     <script src={{asset("js/demo/datatables-demo.js")}}></script>

     <script>
         $(document).ready(function () {
            $('.btn-danger').click(function(e) {
                e.preventDefault();

                let bookId = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    reverseButtons: true,
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
                            url: `/admin/books/${bookId}`,
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
