<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Create New User
    public function storeUser(Request $request) {
        $request->validate([
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|min:6',
        ]);
        $data = $request->all();
        $data['is_admin'] = 1;
        // Hash Password
        $data['password'] = bcrypt($data['password']);

        // Create User
        $user = User::create($data);
        // Login
        Auth::login($user);

        return redirect('/homepage')->with('message', 'User created and logged in');
    }

    // Show Register/Create Form
    public function create() {
        return view('signup');
    }

    // Show Login Form
    public function login(){
        return view('login');
    }

    // Logout User
    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');

    }

    // Authenticate Admin
    public function authenticateAdmin(Request $request) 
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt(['email' => $request->email, 'password' => $request->password, 'is_admin'=> 1])) {
            $request->session()->regenerate();

            return redirect()->intended('/homepage');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}
