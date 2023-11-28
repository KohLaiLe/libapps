@extends('layout.template')
@section('title', 'Book')

@section('content')
    <div class="m-5">
        <div class="m-5 d-flex justify-content-between align-items-center">
            <h1 class="mb-3">Management Buku</h1>
            <a href="{{route('book_create')}}" class="btn btn-success">Create Book</a>
        </div>
        @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Gambar Buku</th>
                <th scope="col">Judul Buku</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($books as $index => $book)
                <tr>
                    <th scope="row">{{ ($books->currentPage() - 1) * $books->perPage() + $loop->iteration }}</th>
                    <td><img src="{{$book->image_url}}" alt="Gambar Buku" style="max-width: 100px;"></td>
                    <td>{{$book->title}}</td>
                    <td>{{$book->description}}</td>
                    <td>
                        @if($book->is_lost === 1 && $book->is_borrowed === 1)
                            <span style="color: red;">Lost</span>
                        @elseif($book->is_lost === 0 && $book->is_borrowed === 1)
                            Borrowed
                        @else
                            <span style="color: green;">Available</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('book_edit', $book->id_book) }}" class="btn btn-primary">Edit</a>
                        <form method="POST" action="{{ route('book_delete', $book->id_book) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $books->links() }}
    </div>
    <div class="d-flex justify-content-center">
        <p>Showing {{ $books->firstItem() }} to {{ $books->lastItem() }} of {{ $books->total() }} items</p>
    </div>
    <script>
        if({{ Session::has('alert') }}){
            alert('{{ Session::get('alert') }}');
        }
    </script>
@endsection
