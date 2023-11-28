<?php

namespace App\Http\Controllers;

use App\Models\TrBorrowBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function history_index(){
        $user = Auth::user();
        if($user->role === 'staff') {
            $histories = TrBorrowBook::orderBy('date_in', 'desc')->paginate(15);
        } else {
            $histories = TrBorrowBook::where('id_user', $user->id_user)
                ->orderBy('date_in', 'desc')
                ->paginate(15);
        }

        return view('history.history', compact('user', 'histories'));
    }

    public function book_return(Request $request){
        $transaction = TrBorrowBook::find($request->id_borrow_book);
        if(!$transaction) {
            // Handle if transaction is not found
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $transaction->return_date = now('Asia/Jakarta');
        $transaction->status = 'Returned';
        $transaction->save();
        // Update status to Returned
        $transaction->book->update([
            'is_available' => 1,
            'is_borrowed' => 0,
            'is_lost' => 0,
        ]);

        // You can perform any additional actions or redirect as needed
        return redirect()->back()->with('success', 'Book has been returned');
    }

    public function book_lost(Request $request){
        $transaction = TrBorrowBook::find($request->id_borrow_book);
        if(!$transaction) {
            // Handle if transaction is not found
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $transaction->status = 'Lost';
        $transaction->save();
        // Update status to Lost
        $transaction->book->update([
            'is_available' => 0,
            'is_borrowed' => 1,
            'is_lost' => 1,
        ]);

        // You can perform any additional actions or redirect as needed
        return redirect()->back()->with('success', 'Book has been marked as lost');
    }
}
