@extends('layout.template')
@section('title', 'Home')

@section('content')
    <div class="m-5">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-5 g-4">
            @foreach($books as $index => $book)
                <div class="col position-relative">
                    <div class="card" style="height: 70vh">
                        <img src="{{$book->image_url}}" alt="" class="card-img-top" style="width: 100%; height: 50%;">
                        <div class="card-body">
                            @php
                                $title = $book->title;
                                $limitedTitle = strlen($title) > 20 ? substr($title, 0, 20) . ' ...' : $title;
                            @endphp
                            @if($book->is_available === 1)
                                <span class="badge bg-success">Available</span>
                            @elseif($book->is_borrowed === 1 && $book->is_lost === 0)
                                <span class="badge bg-warning text-dark">Borrowed</span>
                            @elseif($book->is_borrowed === 1 && $book->is_lost === 1)
                                <span class="badge bg-warning text-dark">Lost</span>
                            @endif
                            <h5 class="card-title">{{$limitedTitle}}</h5>
                            <p class="card-text">{{$book->description}}</p>
                            <a href="{{route('book_detail', $book->id_book)}}" class="text-decoration-none position-absolute bottom-0 start-0 m-3">Detail</a>
                        @auth()
                                @if(auth()->user()->role === 'member')
                                    @if($book->is_available === 0 || $book->is_borrowed === 1 || $book->is_lost === 1)
                                        <button class="btn btn-primary btn-sm position-absolute bottom-0 end-0 m-3" disabled>
                                            Pinjam
                                        </button>
                                    @else
                                        <a href="{{route('borrow_index', $book->id_book)}}"
                                           class="btn btn-primary btn-sm position-absolute bottom-0 end-0 m-3">Pinjam</a>
                                    @endif
                                @else
                                    <a href="{{route('book_edit', $book->id_book)}}"
                                       class="btn btn-primary btn-sm position-absolute bottom-0 end-0 m-3">Edit</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
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
