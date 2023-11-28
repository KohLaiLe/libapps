@extends('layout.template')
@section('title', 'History')

@section('content')
    <div class="m-5">
        <h1 class="mb-3">History</h1>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>No</th>
                <th>Gambar Buku</th>
                <th>Judul Buku</th>
                <th>Peminjam</th>
                <th>Tanggal Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Tanggal Pengembalian</th>
                <th>Status</th>
                @auth()
                    @if(auth()->user()->role === 'staff')
                        <th>Action</th>
                    @endif
                @endauth
            </tr>
            </thead>
            <tbody>
            @foreach($histories as $index => $history)
                <tr>
                    <th scope="row">{{ ($histories->currentPage() - 1) * $histories->perPage() + $loop->iteration }}</th>
                    <td class="text-center"><img src="{{$history->book->image_url}}" alt="Gambar Buku" style="height: auto; width: 128px"></td>
                    <td class="text-wrap" style="max-width: 200px;">{{$history->book->title}}</td>
                    <td>{{$history->user->first_name.' '.$history->user->last_name}}</td>
                    <td>{{$history->borrow_date}}</td>
                    <td>{{$history->due_date}}</td>
                    <td>{{$history->return_date}}</td>
                    <td>
                        @if($history->status === 'Lost')
                            <span style="color: red;">Lost</span>
                        @elseif($history->status === 'Borrowed')
                            Borrowed
                        @else
                            <span style="color: green;">Returned</span>
                        @endif
                    </td>
                    @auth()
                        @if(auth()->user()->role === 'staff')
                            <td class="text-center">
                                <div class="m-2">
                                    <form method="post" action="{{ route('book_return', $history->id_borrow_book) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-primary btn-block">Return</button>
                                    </form>
                                </div>
                                <div class="m-2">
                                    <form method="post" action="{{ route('book_lost', $history->id_borrow_book) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger btn-block">Lost</button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    @endauth
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $histories->links() }}
    </div>
    <div class="d-flex justify-content-center">
        <p>Showing {{ $histories->firstItem() }} to {{ $histories->lastItem() }} of {{ $histories->total() }} items</p>
    </div>
    <script>
        if({{ Session::has('alert') }}){
            alert('{{ Session::get('alert') }}');
        }
    </script>
@endsection
