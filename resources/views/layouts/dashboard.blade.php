@extends('layouts.main')

@section('main')
    <!-- Page Wrapper -->
    <div id="wrapper">
        <x-sidebar />
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <x-header />
            <div id="content">
                @yield('content')
            </div>
            <x-footer />
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <x-modal.logout/>
@endsection
