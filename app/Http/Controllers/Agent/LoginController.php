<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard.index');
        } else {
            return view('login.index');

        }

    }


    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'phone' => 'required|numeric|digits:10|phone_format',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['phone' => $validatedData['phone'], 'password' => $validatedData['password']])) {
            $user = Auth::user();
            $user->last_seen = new \MongoDB\BSON\UTCDateTime(new \DateTime('now'));
            $user->login_source = 'web';
            $user->save();


            return redirect(route('dashboard.index'));
        } else {
            return back()->with('error', 'رقم الجوال أو كلمة السر خاطئة');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.index'); // Replace 'login' with the route name for your login page
    }


}
