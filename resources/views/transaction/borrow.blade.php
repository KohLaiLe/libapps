@extends('layout.template')
@section('title', 'Borrow')

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

                <!-- Form Peminjaman -->
                <form action="{{route('borrow', $book->id_book)}}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label>Jangka Waktu Pinjam</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="duration" id="1_day" value="1">
                            <label class="form-check-label" for="1_day">1 Hari</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="duration" id="7_days" value="7">
                            <label class="form-check-label" for="7_days">7 Hari</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="duration" id="14_days" value="14">
                            <label class="form-check-label" for="14_days">14 Hari</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Pinjam Buku</button>
                </form>
            </div>
        </div>
    </div>
@endsection
