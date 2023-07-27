<?php

namespace App\Http\Controllers\Agent;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {

        $users = User::all();

        return view('login.index');

    }


    public function login(Request $request)
    {
        // Perform form validation if needed
        $validatedData = $request->validate([
            'phone' => 'required|numeric|digits:10|phone_format',
            'password' => 'required|min:6',
        ]);

        // Try to authenticate the user using phone and password
        if (Auth::attempt(['phone' => $validatedData['phone'], 'password' => $validatedData['password']])) {
            // Authentication successful
            // You can perform any additional actions here, like setting up user sessions, etc.

            // For example, if you want to redirect the user after successful authentication
            return redirect(route('dashboard.index'));
        } else {
            // Authentication failed
            // Redirect back with an error message or return a JSON response with an error message
            return back()->with('error', 'رقم الجوال أو كلمة السر خاطئة');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login'); // Replace 'login' with the route name for your login page
    }


}
