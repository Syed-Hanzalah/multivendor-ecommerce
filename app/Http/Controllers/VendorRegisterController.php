<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VendorRegisterController extends Controller
{
    public function create()
    {
        return view('vendor.register');
    }

    public function store(Request $request)
    {
        // CASE 1: Logged-in user → Upgrade to vendor
        if (auth()->check()) {

            $user = auth()->user();

            if ($user->role === 'vendor') {
                return back()->with('error', 'You have already applied as a vendor.');
            }

            $request->validate([
                'password' => 'required|confirmed|min:8',
            ]);

            $user->update([
                'role' => 'vendor',
                'is_approved' => false,
                'password' => Hash::make($request->password), // optional but secure
            ]);

            return redirect('/dashboard')
                ->with('success', 'Vendor application submitted. Await admin approval.');
        }

        // CASE 2: Guest user → Create vendor account
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
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
