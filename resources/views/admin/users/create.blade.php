@extends('layouts.app')
@section('title', 'Create User — Admin')

@section('content')
<div style="max-width:640px; margin:0 auto; padding:40px 24px;">

    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:32px;">
        <div>
            <h1 style="font-size:30px; font-weight:700; color:var(--text); margin-bottom:4px;">Create User</h1>
            <p style="font-size:15px; color:var(--text-secondary);">Add a new user to Palama</p>
        </div>
        <a href="{{ route('admin.users.index') }}"
           style="border:1.5px solid var(--border); color:var(--text); border-radius:10px; padding:10px 20px; font-size:14px; font-weight:700; text-decoration:none; background:white;">
            ← Back
        </a>
    </div>

    <div style="background:var(--card); border-radius:20px; border:1.5px solid var(--border); padding:36px;">

        @if($errors->any())
        <div style="background:#FEE2E2; color:#DC2626; padding:14px 18px; border-radius:10px; font-size:14px; margin-bottom:20px;">
            @foreach($errors->all() as $error)
                <div>❌ {{ $error }}</div>
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div style="margin-bottom:16px;">
                <label style="display:block; font-size:13px; font-weight:700; color:var(--text); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Full Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; color:var(--text); background:var(--bg);"/>
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block; font-size:13px; font-weight:700; color:var(--text); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Email *</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; color:var(--text); background:var(--bg);"/>
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block; font-size:13px; font-weight:700; color:var(--text); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="07X XXXXXXX"
                       style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; color:var(--text); background:var(--bg);"/>
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block; font-size:13px; font-weight:700; color:var(--text); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Role *</label>
                <select name="role" required style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; background:var(--bg); color:var(--text);">
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:24px;">
                <div>
                    <label style="display:block; font-size:13px; font-weight:700; color:var(--text); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Password *</label>
                    <input type="password" name="password" required
                           style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; background:var(--bg);"/>
                </div>
                <div>
                    <label style="display:block; font-size:13px; font-weight:700; color:var(--text); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Confirm Password *</label>
                    <input type="password" name="password_confirmation" required
                           style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; background:var(--bg);"/>
                </div>
            </div>

            <button type="submit"
                    style="width:100%; background:var(--primary); color:white; border:none; border-radius:12px; padding:14px; font-size:15px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif; transition:all .2s;"
                    onmouseover="this.style.background='var(--primary-dark)'"
                    onmouseout="this.style.background='var(--primary)'">
                <i class="fa-solid fa-user-plus"></i> Create User
            </button>
        </form>
    </div>
</div>
@endsection