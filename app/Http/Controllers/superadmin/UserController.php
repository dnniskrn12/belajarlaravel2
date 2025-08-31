<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        $roles = Role::all();
        return view('superadmin.user.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('superadmin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users',
            'email' => 'required|email|unique:users',
            'role_id' => 'required|integer',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Generate User Code (USR001, USR002, dst)
        $lastUser = User::orderBy('id', 'desc')->first();
        $nextId = $lastUser ? $lastUser->id + 1 : 1;
        $userCode = 'USR' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        User::create([
            'user_code' => $userCode,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
            'is_blocked' => 0,
            'status' => 'aktif',
        ]);


        return redirect()->route('superadmin.user.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('superadmin.user.edit', compact('user', 'roles'));
    }

  public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:50|unique:users,username,' . $user->id,
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role_id' => 'required|exists:roles,id',
        'password' => 'nullable|string|min:6|confirmed',
        'status' => 'nullable|in:aktif,nonaktif',
    ]);

    $data = $request->only(['name','username','email','role_id','status']);

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return redirect()->route('superadmin.user.index')
        ->with('success','User berhasil diupdate');
}





    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('superadmin.user.index')
            ->with('success', 'User berhasil dihapus');
    }

    public function toggleBlock(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        // Toggle is_blocked
        $user->is_blocked = !$user->is_blocked;
        $user->status = $user->is_blocked ? 'nonaktif' : 'aktif';

        $user->save();

        return response()->json([
            'success' => true,
            'message' => $user->is_blocked ? 'User berhasil diblokir' : 'User berhasil dibuka blokir',
            'is_blocked' => $user->is_blocked
        ]);
    }
}
