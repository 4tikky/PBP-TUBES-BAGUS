<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        // Ambil semua pengguna dengan peran 'user', urutkan dari yang terbaru
        $customers = User::where('role', 'user')->latest()->paginate(15);

        return view('admin.customers.index', compact('customers'));
    }
}