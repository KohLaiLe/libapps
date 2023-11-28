<?php

namespace App\Http\Controllers;

use App\Models\MsBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $books = MsBook::where('title', 'like', "%$query%")->get();

        return view('home', compact('books'));
    }

    public function book_detail(Request $request){
        $users = Auth::user();
        $book = MsBook::find($request->id_book);

        return view('book.book_detail', compact('users', 'book'));
    }

    public function book_manage(){
        $user = Auth::user();
        $books = MsBook::paginate(10);

        return view('book.book', compact('user', 'books'));
    }

    public function book_edit(Request $request){
        $user = Auth::user();
        $book = MsBook::find($request->id_book);

        return view('book.book_edit', compact('user', 'book'));
    }

    public function book_edit_execute(Request $request){
        $book = MsBook::find($request->id_book);

        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->isbn = $request->input('isbn');
        $book->description = $request->input('description');
        $book->image_url = $request->input('image_url');
        $book->category = $request->input('category');

        $book->save();

        return redirect()->route('book_edit', $book->id_book)->with('alert', 'Book success edited.');
    }

    public function book_delete(Request $request){
        $book = MsBook::find($request->id_book);

        if($book){
            $book->delete();
            return redirect()->back()->with('success', 'Book has been deleted');
        } else {
            return redirect()->back()->with('error', 'Book not found');
        }
    }

    public function book_create(){
        return view('book.book_create');
    }

    public function book_create_execute(Request $request){
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required|max:13',
            'category' => 'required'
        ]);

        if ($validator->fails()) {
            Session::flashInput($request->all());
            return redirect()->back()->withErrors($validator);
        }

        $user = Auth::user();

        $book = new MsBook();
        $book->user_in = $user->first_name.' '.$user->last_name;
        $book->date_in = now('Asia/Jakarta');
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->isbn = $request->input('isbn');
        $book->description = $request->input('description');
        $book->image_url = $request->input('image_url');
        $book->category = $request->input('category');
        $book->save();

        return redirect()->route('book_manage')->with('success', 'Book has been added');
    }
}
