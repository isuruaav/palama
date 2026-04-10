@extends('layouts.app')
@section('title', 'Edit User — Admin')

@section('content')
<div style="max-width:640px; margin:0 auto; padding:40px 24px;">

    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:32px;">
        <div>
            <h1 style="font-size:30px; font-weight:700; color:var(--text); margin-bottom:4px;">Edit User</h1>
            <p style="font-size:15px; color:var(--text-secondary);">{{ $user->name }}</p>
        </div>
        <a href="{{ route('admin.users.index') }}"
           style="border:1.5px solid var(--border); color:var(--text); border-radius:10px; padding:10px 20px; font-size:14px; font-weight:700; text-decoration:none; background:white;">
            ← Back
        </a>
    </div>

    @if(session('success'))
    <div style="background:var(--accent-soft); color:var(--accent-dark); padding:12px 18px; border-radius:10px; font-size:14px; font-weight:700; margin-bottom:20px;">
        ✅ {{ session('success') }}
    </div>
    @endif

    <div style="background:var(--card); border-radius:20px; border:1.5px solid var(--border); padding:36px;">

        {{-- User Avatar --}}
        <div style="text-align:center; margin-bottom:28px; padding-bottom:28px; border-bottom:1px solid var(--border);">
            <div style="width:72px; height:72px; border-radius:50%; background:var(--primary); display:flex; align-items:center; justify-content:center; color:white; font-weight:700; font-size:24px; margin:0 auto 12px;">
                {{ strtoupper(substr($user->name, 0, 2)) }}
            </div>
            <div style="font-size:13px; color:var(--text-secondary);">Member since {{ $user->created_at->format('M Y') }}</div>
            <div style="margin-top:8px;">
                <span style="background:{{ $userRole === 'admin' ? '#FEE2E2' : ($userRole === 'provider' ? '#E8F5E9' : '#DBEAFE') }};
                             color:{{ $userRole === 'admin' ? '#DC2626' : ($userRole === 'provider' ? '#009624' : '#1E3A8A') }};
                             font-size:12px; font-weight:700; padding:4px 12px; border-radius:20px;">
                    {{ ucfirst($userRole) }}
                </span>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf @method('PUT')

            <div style="margin-bottom:16px;">
                <label style="display:block; font-size:13px; font-weight:700; color:var(--text); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Full Name *</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                       style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; color:var(--text); background:var(--bg);"/>
                @error('name')<p style="color:#DC2626; font-size:12px; margin-top:4px;">{{ $message }}</p>@enderror
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block; font-size:13px; font-weight:700; color:var(--text); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Email *</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                       style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; color:var(--text); background:var(--bg);"/>
                @error('email')<p style="color:#DC2626; font-size:12px; margin-top:4px;">{{ $message }}</p>@enderror
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block; font-size:13px; font-weight:700; color:var(--text); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="07X XXXXXXX"
                       style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; color:var(--text); background:var(--bg);"/>
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block; font-size:13px; font-weight:700; color:var(--text); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Role *</label>
                <select name="role" required style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; background:var(--bg); color:var(--text);"
                        {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ $userRole === $role->name ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
                @if($user->id === auth()->id())
                <p style="font-size:12px; color:var(--text-light); margin-top:4px;">⚠️ Cannot change your own role</p>
                @endif
            </div>

            {{-- Password (optional) --}}
            <div style="background:var(--bg); border-radius:12px; padding:20px; border:1.5px solid var(--border); margin-bottom:24px;">
                <div style="font-size:13px; font-weight:700; color:var(--text); margin-bottom:12px; text-transform:uppercase; letter-spacing:.5px;">
                    Change Password <span style="color:var(--text-light); font-weight:400;">(optional)</span>
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div>
                        <input type="password" name="password" placeholder="New password"
                               style="width:100%; border:1.5px solid var(--border); border-radius:10px; padding:10px 14px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; background:var(--card);"/>
                    </div>
                    <div>
                        <input type="password" name="password_confirmation" placeholder="Confirm password"
                               style="width:100%; border:1.5px solid var(--border); border-radius:10px; padding:10px 14px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; background:var(--card);"/>
                    </div>
                </div>
            </div>

            <div style="display:flex; gap:12px;">
                <button type="submit"
                        style="flex:1; background:var(--primary); color:white; border:none; border-radius:12px; padding:14px; font-size:15px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif; transition:all .2s;"
                        onmouseover="this.style.background='var(--primary-dark)'"
                        onmouseout="this.style.background='var(--primary)'">
                    💾 Save Changes
                </button>
                <a href="{{ route('admin.users.index') }}"
                   style="flex:1; background:var(--bg); color:var(--text); border-radius:12px; padding:14px; font-size:15px; font-weight:700; text-decoration:none; text-align:center; display:block; border:1.5px solid var(--border);">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection