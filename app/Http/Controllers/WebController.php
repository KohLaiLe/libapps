<?php

namespace App\Http\Controllers;

use App\Models\MsBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    public function index(){
        $users = Auth::user();
        $books = MsBook::paginate(10);

        return view('home', compact('users', 'books'));
    }
}
