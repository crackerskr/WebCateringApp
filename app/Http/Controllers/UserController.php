<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    // Web App
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

    // Mobile App
    // Register
    public function register(Request $request)
    {
        $validatedData = Validator::make($request->all(),
            [
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'password' => 'required|min:6',
            ]
        );
    
        if($validatedData->fails()){
            return response()->json([
                'success' => false,
                'message' => $validatedData->messages()
            ]);
        }
        
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['is_admin'] = 0;

        $user = User::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Registration Successfully.',
        ]);    
    }

    // Authenticate User
    public function authenticateUser(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password',
                'data' => $validator->errors()
            ]);
        }

        $credentials = $request->only('email', 'password');    
        
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = Auth::user();
            session(['user_id', $user->id]);
            return response()->json([
                'success' => true,
                'data' => $user,
            ]);
        }
        else{
            return response()->json([
                'success' => false, 
                'message' => 'Invalid email or password'
            ]);
        }
    }

    public function logoutUser(Request $request){
        Session::flush();
        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
    }

    // Show User Profile in Mobile App
    public function showUser(Request $request)
    {
        $userId = $request->session()->get('user_id');
        // use $userId to retrieve user information or do other operations
    }
}
