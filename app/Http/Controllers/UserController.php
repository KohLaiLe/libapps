<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Carbon\Carbon;

class UserController extends Controller
{
    public function login_index(Request $request){
        $email = $request->cookie('email');
        return view('auth.login', compact('email'));
    }

    public function login(Request $request)
    {
        $credential = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credential, $request->input('remember'))) {
            return redirect()->back()->withErrors('Account not found.');
        }

        if ($request->has('remember')) {
            $expired_time = 60 * 2;
            Cookie::queue('email', $request->email, $expired_time);
        }

        return redirect()->route('index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login_index');
    }

    public function register_index(){
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'first_name' => 'required|max:25|regex:/^[a-zA-Z]+$/u',
            'last_name' => 'required|max:25|regex:/^[a-zA-Z]+$/u',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'string', Password::min(8)->letters()->numbers()],
        ]);

        if ($validator->fails()) {
            Session::flashInput($request->all());
            return redirect()->back()->withErrors($validator);
        }

        $user = new User();
        $user->user_in = $request->input('first_name')." ".$request->input('last_name');
        $user->date_in = Carbon::now('Asia/Jakarta');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->address = $request->input('address');
        $user->phone_number = $request->input('phone');
        $user->image_url = $request->input('image_url');
        $user->save();

        return redirect()->route('login_index')->with('success', 'Your account has been registered!');
    }
}
