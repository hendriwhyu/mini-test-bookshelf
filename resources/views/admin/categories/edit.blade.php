@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Create Category</h1>

    <div class="row">
        <div class="col-lg-12">
            <!-- Form Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Category</h6>
                </div>
                <div class="card-body">
                    <form id="categoryForm">
                        @csrf
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Input category name" value="{{ $category->name }}">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4" placeholder="Description...">{{ $category->description }}</textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#categoryForm').submit(function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            })

            $.ajax({
                type: 'PUT',
                url: "/admin/categories/{{ $category->id }}",
                data: {
                    name: $('#name').val(),
                    description: $('#description').val()
                },
                dataType: 'json',
                success: (response) => {
                    if(response.success){
                        Swal.fire({
                            title: "Success!",
                            text: response.message,
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then(() => {
                            window.location.href = "{{ route('categories.index') }}";
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
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: response.message,
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
