@extends('layout.template')
@section('title', 'Edit Book')

@section('content')
    <div class="m-5">
        <div class="container">
            <div class="row">
                <!-- Sisi kiri - Preview Foto -->
                <div class="col-md-6">
                    <div class="mb-3 text-center">
                        <img id="preview" class="img-fluid" src="{{$book->image_url}}" alt="Preview Foto" style="height: auto; width: 256px">
                    </div>
                </div>

                <!-- Sisi kanan - Form Input -->
                <div class="col-md-6">
                    <form action="{{route('book_edit_execute', $book->id_book)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}">
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" class="form-control" id="author" name="author" value="{{$book->author}}">
                        </div>
                        <div class="mb-3">
                            <label for="isbn" class="form-label">ISBN</label>
                            <input type="text" class="form-control" id="isbn" name="isbn" value="{{$book->isbn}}">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" value="{{$book->description}}">
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
                            <input type="text" class="form-control" id="image_url" name="image_url" value="{{$book->image_url}}">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('book_manage') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
