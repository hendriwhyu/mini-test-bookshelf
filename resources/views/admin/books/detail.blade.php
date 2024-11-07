@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Detail Book</h1>

    <!-- Main Content -->
    <div class="card">
        <div class="card-header py-3 justify-between">
            <h6 class="m-0 font-weight-bold text-primary">Information Book</h6>
        </div>
        <div class="row p-5">
            <!-- Book Cover -->
            <div class="col-md-4 text-center">
                <img src="{{ asset('storage/covers_book/' . $book->cover) }}" alt="Book Cover" class="img-fluid mb-3 rounded">
            </div>

            <!-- Book Details -->
            <div class="col-md-8">
                <h2 class="mb-1">{{$book->title}}</h2>
                <p class="text-muted">by <strong>{{$book->author}}</strong></p>
                <p>{{$book->description}}</p>

                <!-- Book Information Table -->
                <table class="table table-borderless mt-4 text-start">
                    <tbody>
                        <tr>
                            <th>Category</th>
                            <td>{{$book->category->name}}</td>
                        </tr>
                        <tr>
                            <th>Publisher</th>
                            <td>{{$book->publisher}}</td>
                        </tr>
                        <tr>
                            <th>Release Date</th>
                            <td>{{Carbon\Carbon::parse($book->release_date)->format('d F Y')}}</td>
                        </tr>
                        <tr>
                            <th>Year</th>
                            <td>{{Carbon\Carbon::parse($book->release_date)->year}}</td>
                        </tr>
                        <tr>
                            <th>ISBN</th>
                            <td>{{$book->isbn}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
