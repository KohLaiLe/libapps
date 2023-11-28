@extends('layout.template')
@section('title', 'Book Detail')

@section('content')
    <div class="m-5">
        <div class="row">
            <div class="col-md-4 d-flex justify-content-center">
                <!-- Foto Buku -->
                <img src="{{$book->image_url}}" alt="Foto Buku" class="img-fluid" style="max-width: 100%; height: auto; width: 256px">
            </div>
            <div class="col-md-8">
                <!-- Informasi Buku -->
                <span class="badge bg-success">Available</span>
                <h3>{{$book->title}}</h3>
                <p><strong>Author:</strong> {{$book->author}}</p>
                <p><strong>ISBN:</strong> {{$book->isbn}}</p>
                <p><strong>Deskripsi:</strong> {{$book->description}}</p>
                <p><strong>Kategori:</strong> {{$book->category}}</p>
                <a href="{{route('index')}}" class="btn btn-secondary">Close</a>
            </div>
        </div>
    </div>
@endsection
