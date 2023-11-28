@extends('layout.template')
@section('title', 'Edit Book')

@section('content')
    <div class="m-5">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Sisi kanan - Form Input -->
                <div class="col-md-6">
                    <form action="{{route('book_create_execute')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul</label>
                            <input value="{{old('title')}}" type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input value="{{old('author')}}" type="text" class="form-control" id="author" name="author">
                        </div>
                        <div class="mb-3">
                            <label for="isbn" class="form-label">ISBN</label>
                            <input value="{{old('isbn')}}" type="text" class="form-control" id="isbn" name="isbn">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input value="{{old('description')}}" type="text" class="form-control" id="description" name="description">
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" name="category">
                                <option selected disabled>Select Category</option>
                                <option value="fiction">Fiction</option>
                                <option value="language">Language</option>
                                <option value="science">Science</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image_url" class="form-label">Image URL</label>
                            <input value="{{old('image_url')}}" type="text" class="form-control" id="image_url" name="image_url">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Create</button>
                            <a href="{{ route('book_manage') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                    @if($errors->any())
                        <div class="alert alert-danger p-3">
                            <ul>
                                @foreach($errors->all() as $error_data)
                                    <li>{{ $error_data }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
