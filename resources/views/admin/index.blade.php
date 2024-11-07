@extends('layouts.dashboard')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Categories Card Example -->
        <div class="col-xl-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Categories</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$countCategories}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Books Card Example -->
        <div class="col-xl-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Books</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$countBooks}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Content Row -->


    <div class="row">

        <!-- Welcome Message -->
        <div class="col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Welcome to the Dashboard</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <h5 class="card-title">Hello, {{ Auth::user()->name }}!</h5>
                    <p class="card-text">Welcome back to your dashboard. Here you can manage your books, track recent additions, and explore different categories.</p>
                    <p class="card-text">Feel free to navigate through the menu to discover more features. If you need assistance, don’t hesitate to reach out!</p>
                    <p class="card-text"><strong>Today’s Date:</strong> {{ now()->format('l, F j, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Recent Books -->
        <div class="col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Recently Added</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Book</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($books as $book)
                                <tr>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->author }}</td>
                                    <td>{{ $book->category->name }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">No recent books added.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>
<!-- /.container-fluid -->
@endsection

