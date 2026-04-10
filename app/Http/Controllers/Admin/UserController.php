<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('roles')->latest();

        if ($request->filled('q')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', "%{$request->q}%")
                  ->orWhere('email', 'like', "%{$request->q}%");
            });
        }

        if ($request->filled('role')) {
            $query->whereHas('roles', fn($q) => $q->where('name', $request->role));
        }

        $users = $query->paginate(15)->withQueryString();
        $roles = Role::all();
        $stats = [
            'total'     => User::count(),
            'admins'    => User::role('admin')->count(),
            'providers' => User::role('provider')->count(),
            'customers' => User::role('customer')->count(),
        ];

        return view('admin.users.index', compact('users', 'roles', 'stats'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|max:100',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'phone'    => 'nullable',
            'role'     => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'phone'        => $request->phone,
            'account_type' => $request->role === 'admin' ? 'admin' : ($request->role === 'provider' ? 'provider' : 'customer'),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('admin.users.index')
                         ->with('success', 'User created successfully!');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $userRole = $user->getRoleNames()->first();
        return view('admin.users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable',
            'role'  => 'required|exists:roles,name',
        ]);

        $user->update([
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'account_type' => $request->role === 'admin' ? 'admin' : ($request->role === 'provider' ? 'provider' : 'customer'),
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'min:8|confirmed']);
            $user->update(['password' => Hash::make($request->password)]);
        }

        // Role update
        $user->syncRoles([$request->role]);

        return redirect()->route('admin.users.index')
                         ->with('success', 'User updated!');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Cannot delete your own account!');
        }

        $user->delete();
        return back()->with('success', 'User deleted.');
    }

    public function changeRole(Request $request, User $user)
    {
        $request->validate(['role' => 'required|exists:roles,name']);

        $user->syncRoles([$request->role]);
        $user->update([
            'account_type' => $request->role === 'admin' ? 'admin' : ($request->role === 'provider' ? 'provider' : 'customer'),
        ]);

        return back()->with('success', 'Role changed to ' . $request->role . '!');
    }
}