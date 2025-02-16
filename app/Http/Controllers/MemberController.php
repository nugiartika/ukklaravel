<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role','Member')->get();
        return view('cashier.member', compact('users'));
    }

    public function product()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('member.product', compact('products'));
    }

    public function history() {
        $user = Auth::user();
        $history = $user->sales()->with('sale_detail.product')->get();
        return view('member.history', compact('history'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            // 'password' => ['required', 'confirmed'],
            'address' => ['nullable', 'max:255'],
            'phone' => ['nullable','numeric'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            // 'password' => Hash::make($request->password),
            'role' => 'Member',
            'address' => $request->address,
            'phone' => $request->phone,
            'email_verified_at' => now(),
        ]);

        return redirect()->route('member.index')->with('success', 'Member create successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $id],
        'password' => ['nullable', 'confirmed'],
        'address' => ['nullable', 'max:255'],
        'phone' => ['nullable', 'numeric'],
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password ? Hash::make($request->password) : $user->password,
        'address' => $request->address,
        'phone' => $request->phone,
    ]);

    return redirect()->route('member.index')->with('success', 'User berhasil diperbarui!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id); // Cari user berdasarkan ID
        $user->delete(); // Hapus user dari database

        return redirect()->route('member.index')->with('success', 'User berhasil dihapus.');
    }
}
