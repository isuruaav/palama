@extends('layouts.app')
@section('title', 'My Profile — SevaSL')

@section('content')
<div style="max-width:600px; margin:0 auto; padding:48px 24px;">

    <div style="margin-bottom:32px;">
        <h1 style="font-size:32px; font-weight:700; color:var(--text); margin-bottom:4px;">My Profile</h1>
        <p style="font-size:15px; color:var(--text-secondary);">Manage your account information</p>
    </div>

    <div style="background:var(--card); border-radius:20px; border:1.5px solid var(--border); padding:36px; box-shadow:0 4px 20px rgba(30,58,138,0.06);">

        {{-- Avatar --}}
        <div style="text-align:center; margin-bottom:28px; padding-bottom:28px; border-bottom:1px solid var(--border);">
            <div style="width:80px; height:80px; border-radius:50%; background:var(--primary); display:flex; align-items:center; justify-content:center; color:white; font-weight:700; font-size:28px; font-family:'PT Sans',sans-serif; margin:0 auto 12px;">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>
            <div style="font-weight:700; font-size:18px; color:var(--text); margin-bottom:4px;">{{ auth()->user()->name }}</div>
            <div style="font-size:14px; color:var(--text-secondary); margin-bottom:10px;">{{ auth()->user()->email }}</div>
            <div style="display:flex; gap:6px; justify-content:center; flex-wrap:wrap;">
                @foreach(auth()->user()->getRoleNames() as $role)
                <span style="background:var(--primary-soft); color:var(--primary); font-size:12px; font-weight:700; padding:3px 12px; border-radius:20px;">
                    {{ ucfirst($role) }}
                </span>
                @endforeach
            </div>
        </div>

        @if(session('success'))
        <div style="background:var(--accent-soft); color:var(--accent-dark); padding:12px 16px; border-radius:10px; font-size:14px; margin-bottom:20px; font-weight:700;">
            ✅ {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div style="margin-bottom:16px;">
                <label style="display:block; font-size:14px; font-weight:700; color:var(--text); margin-bottom:8px;">Full Name</label>
                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                       style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; color:var(--text); background:var(--bg);"/>
                @error('name')<p style="color:#DC2626; font-size:12px; margin-top:4px;">{{ $message }}</p>@enderror
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block; font-size:14px; font-weight:700; color:var(--text); margin-bottom:8px;">Email</label>
                <input type="email" value="{{ auth()->user()->email }}" disabled
                       style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; background:var(--bg); color:var(--text-light); box-sizing:border-box;"/>
                <p style="font-size:12px; color:var(--text-light); margin-top:4px;">Email cannot be changed</p>
            </div>

            <div style="margin-bottom:24px;">
                <label style="display:block; font-size:14px; font-weight:700; color:var(--text); margin-bottom:8px;">Phone Number</label>
                <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                       placeholder="07X XXXXXXX"
                       style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; color:var(--text); background:var(--bg);"/>
            </div>

            <button type="submit"
                    style="width:100%; background:var(--primary); color:white; border:none; border-radius:12px; padding:14px; font-size:15px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif; transition:all .2s;"
                    onmouseover="this.style.background='var(--primary-dark)'"
                    onmouseout="this.style.background='var(--primary)'">
                💾 Save Profile
            </button>
        </form>
    </div>

    {{-- Quick Links --}}
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-top:20px;">
        <a href="{{ route('dashboard') }}"
           style="background:var(--card); border:1.5px solid var(--border); border-radius:12px; padding:14px; text-align:center; text-decoration:none; color:var(--text); font-weight:700; font-size:14px; transition:all .2s;"
           onmouseover="this.style.borderColor='var(--primary-light)'"
           onmouseout="this.style.borderColor='var(--border)'">
            📊 Dashboard
        </a>
        <a href="{{ route('services.my') }}"
           style="background:var(--card); border:1.5px solid var(--border); border-radius:12px; padding:14px; text-align:center; text-decoration:none; color:var(--text); font-weight:700; font-size:14px; transition:all .2s;"
           onmouseover="this.style.borderColor='var(--primary-light)'"
           onmouseout="this.style.borderColor='var(--border)'">
            🗂️ My Services
        </a>
    </div>
</div>
@endsection