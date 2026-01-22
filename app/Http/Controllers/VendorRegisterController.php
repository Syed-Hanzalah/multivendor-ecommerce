<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class VendorRegisterController extends Controller
{
    public function create()
    {
        return view('vendor.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'vendor',
            'is_approved' => false,
        ]);

        return redirect()->route('login')
            ->with('success', 'Vendor account created. Await admin approval.');
    }
}

