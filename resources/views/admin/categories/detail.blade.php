@extends('layouts.dashboard')

@push('styles')
    <link href={{asset("vendor/datatables/dataTables.bootstrap4.min.css")}} rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid ">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Detail Categories</h1>

    <!-- Main Content -->
    <div class="card mb-5">
        <div class="card-header bg-primary text-white">
            <h6 class="m-0 font-weight-bold">Information Category</h6>
        </div>
        <div class="card-body">
            <h5 class="font-weight-bold">{{ $category->name }}</h5>
            <p class="text-muted">{{ $category->description }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header py-3 justify-between">
            <h6 class="m-0 font-weight-bold text-primary">List Book</h6>
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
                        @forelse ( $category->books as $book )
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ Carbon\Carbon::parse($book->release_date)->year }}</td>
                            <td>
                                <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-secondary shadow-sm gap-2"><i
                                        class="fas fa-eye"></i></a>
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
@endpush
