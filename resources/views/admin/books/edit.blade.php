@extends('layouts.dashboard')

@push('styles')

@endpush

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Create Book</h1>

    <!-- Form Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Book Form</h6>
        </div>
        <div class="card-body">
            <form id="bookForm" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="title">Title Book</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Input title book" value="{{ $book->title }}">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" class="form-control" id="author" name="author" placeholder="Input author name" value="{{ $book->author }}">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group">
                    <label for="year">Year Book</label>
                    <input type="number" class="form-control" id="year" name="year" placeholder="Input year book" value="{{ $book->year }}">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group">
                    <label for="publisher">Publisher</label>
                    <input type="text" class="form-control" id="publisher" name="publisher" placeholder="Input publisher name" value="{{ $book->publisher }}">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select class="form-control" id="category_id" name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Input description...">{{ $book->description }}</textarea>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group">
                    <label for="cover">Cover Book</label>

                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="cover" name="cover">
                        <div class="invalid-feedback"></div>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#bookForm').submit((e) => {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            })

            let formData = new FormData($('#bookForm')[0]);
            formData.append('_method', 'PUT')

            $.ajax({
                type: 'POST',
                url: `/admin/books/{{ $book->id }}`,
                data: formData,
                processData: false,
                contentType: false,
                success: (response) => {
                    if(response.success){
                        Swal.fire({
                            title: "Success!",
                            text: response.message,
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then(() => {
                            window.location.href = "{{ route('books.index') }}";
                        });
                    }
                },
                error: (response) => {
                    console.log(response);
                    if(response.responseJSON.errors){
                        $.each(response.responseJSON.errors, (key, value) => {
                            $(`#${key}`).addClass('is-invalid');
                            $(`#${key}`).next('.invalid-feedback').text(value[0]);
                        })
                    }

                    if(!response.success || response.status == 422){
                        Swal.fire({
                            title: "Error!",
                            text: response.message || response.responseJSON.message,
                            icon: "error",
                            confirmButtonText: "OK"
                        })
                    }
                }
            })
        })
    })
</script>
@endpush
