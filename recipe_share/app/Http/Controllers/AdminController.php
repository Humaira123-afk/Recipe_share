<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showLogin() { 
        return view('Admin.adminlogin'); 
    }

    public function showRegister() { 
        return view('Admin.adminregister'); 
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6',
        ]);

        // Naya admin save ho raha hai
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.login')->with('success', 'Admin created!');
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        // Email check ho rahi hai
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            return back()->with('error', 'Email database mein nahi mili!');
        }

        // Password check ho raha hai
        if (!Hash::check($request->password, $admin->password)) {
            return back()->with('error', 'Password galat hai!');
        }

        // Admin guard ke zariye login
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Login fail ho gaya!');
    }

    public function logout() {
        // Admin logout function
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}