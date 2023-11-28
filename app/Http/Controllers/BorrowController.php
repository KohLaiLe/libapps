<?php

namespace App\Http\Controllers;

use App\Models\MsBook;
use App\Models\TrBorrowBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BorrowController extends Controller
{
    public function borrow_index(Request $request){
        $users = Auth::user();
        $book = MsBook::find($request->id_book);

        return view('transaction.borrow', compact('users', 'book'));
    }

    public function borrow(Request $request){
        $users = Auth::user();
        $book = MsBook::find($request->id_book);

        $duration = $request->input('duration');

        $due_date = ($duration == 1) ? now('Asia/Jakarta')->addDays(1) : (($duration == 7) ? now('Asia/Jakarta')->addDays(7) : (($duration == 14) ? now('Asia/Jakarta')->addDays(14) : null));

        $borrow = new TrBorrowBook();
        $borrow->user_in = $users->first_name.' '.$users->last_name;
        $borrow->date_in = Carbon::now('Asia/Jakarta');
        $borrow->id_user = $users->id_user;
        $borrow->id_book = $book->id_book;
        $borrow->borrow_date = Carbon::now('Asia/Jakarta');
        $borrow->due_date = $due_date;
        $borrow->status = 'Borrowed';

        $borrow->save();

        $book->is_available = 0;
        $book->is_borrowed = 1;

        $book->save();

        return redirect()->route('index')->with('alert', 'Book success borrowed.');
    }
}
