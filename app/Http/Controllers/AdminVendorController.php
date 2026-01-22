<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class AdminVendorController extends Controller
{
    public function index()
    {
        $vendors = User::where('role', 'vendor')->get();
        return view('admin.vendors.index', compact('vendors'));
    }

    public function approve(User $user)
    {
        $user->update(['is_approved' => true]);
        return back()->with('success', 'Vendor approved successfully');
    }
}
