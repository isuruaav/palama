@extends('layouts.app')
@section('title', 'User Management — Admin')

@section('content')
<div style="max-width:1280px; margin:0 auto; padding:40px 24px;">

    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:32px; flex-wrap:wrap; gap:16px;">
        <div>
            <h1 style="font-size:32px; font-weight:700; color:var(--text); margin-bottom:4px;">User Management</h1>
            <p style="font-size:15px; color:var(--text-secondary);">Manage all users, roles and permissions</p>
        </div>
        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <a href="{{ route('admin.users.create') }}"
               style="background:var(--accent); color:white; border-radius:10px; padding:10px 20px; font-size:14px; font-weight:700; text-decoration:none; display:flex; align-items:center; gap:6px;">
                <i class="fa-solid fa-plus"></i> Add User
            </a>
            <a href="{{ route('admin.index') }}"
               style="border:1.5px solid var(--border); color:var(--text); border-radius:10px; padding:10px 20px; font-size:14px; font-weight:700; text-decoration:none; background:white;">
                ← Dashboard
            </a>
        </div>
    </div>

    @if(session('success'))
    <div style="background:var(--accent-soft); color:var(--accent-dark); padding:12px 18px; border-radius:10px; font-size:14px; font-weight:700; margin-bottom:24px;">
        ✅ {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div style="background:#FEE2E2; color:#DC2626; padding:12px 18px; border-radius:10px; font-size:14px; font-weight:700; margin-bottom:24px;">
        ❌ {{ session('error') }}
    </div>
    @endif

    {{-- Stats --}}
    <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:32px;" class="dash-stats">
        <div style="background:var(--card); border-radius:16px; border:1.5px solid var(--border); padding:20px; text-align:center;">
            <div style="font-size:30px; font-weight:700; color:var(--primary);">{{ $stats['total'] }}</div>
            <div style="font-size:13px; color:var(--text-secondary); margin-top:4px; font-weight:700;">Total Users</div>
        </div>
        <div style="background:var(--card); border-radius:16px; border:1.5px solid var(--border); padding:20px; text-align:center;">
            <div style="font-size:30px; font-weight:700; color:#DC2626;">{{ $stats['admins'] }}</div>
            <div style="font-size:13px; color:var(--text-secondary); margin-top:4px; font-weight:700;">Admins</div>
        </div>
        <div style="background:var(--card); border-radius:16px; border:1.5px solid var(--border); padding:20px; text-align:center;">
            <div style="font-size:30px; font-weight:700; color:var(--accent-dark);">{{ $stats['providers'] }}</div>
            <div style="font-size:13px; color:var(--text-secondary); margin-top:4px; font-weight:700;">Providers</div>
        </div>
        <div style="background:var(--card); border-radius:16px; border:1.5px solid var(--border); padding:20px; text-align:center;">
            <div style="font-size:30px; font-weight:700; color:var(--primary-light);">{{ $stats['customers'] }}</div>
            <div style="font-size:13px; color:var(--text-secondary); margin-top:4px; font-weight:700;">Customers</div>
        </div>
    </div>

    {{-- Filter --}}
    <form method="GET" style="background:var(--card); border-radius:16px; border:1.5px solid var(--border); padding:20px; margin-bottom:24px; display:flex; gap:12px; flex-wrap:wrap; align-items:flex-end;">
        <div style="flex:2; min-width:200px;">
            <label style="display:block; font-size:12px; font-weight:700; color:var(--text-secondary); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Search</label>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Name or email..."
                   style="width:100%; border:1.5px solid var(--border); border-radius:10px; padding:10px 14px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; color:var(--text); background:var(--bg);"/>
        </div>
        <div style="flex:1; min-width:150px;">
            <label style="display:block; font-size:12px; font-weight:700; color:var(--text-secondary); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Role</label>
            <select name="role" style="width:100%; border:1.5px solid var(--border); border-radius:10px; padding:10px 14px; font-size:14px; outline:none; font-family:'PT Sans',sans-serif; background:var(--bg); color:var(--text);">
                <option value="">All Roles</option>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit"
                style="background:var(--primary); color:white; border:none; border-radius:10px; padding:10px 20px; font-size:14px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif;">
            <i class="fa-solid fa-magnifying-glass"></i> Search
        </button>
        @if(request()->hasAny(['q','role']))
        <a href="{{ route('admin.users.index') }}"
           style="border:1.5px solid var(--border); color:var(--text-secondary); border-radius:10px; padding:10px 16px; font-size:14px; font-weight:700; text-decoration:none; background:white;">
            Clear
        </a>
        @endif
    </form>

    {{-- Users Table --}}
    <div style="background:var(--card); border-radius:16px; border:1.5px solid var(--border); overflow:hidden;">
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:var(--bg); border-bottom:1.5px solid var(--border);">
                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:var(--text-secondary); text-transform:uppercase; letter-spacing:.5px;">User</th>
                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:var(--text-secondary); text-transform:uppercase; letter-spacing:.5px;" class="hide-mobile">Email</th>
                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:var(--text-secondary); text-transform:uppercase; letter-spacing:.5px;">Role</th>
                    <th style="padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:var(--text-secondary); text-transform:uppercase; letter-spacing:.5px;" class="hide-mobile">Joined</th>
                    <th style="padding:14px 20px; text-align:center; font-size:12px; font-weight:700; color:var(--text-secondary); text-transform:uppercase; letter-spacing:.5px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr style="border-bottom:1px solid var(--border); transition:all .2s;"
                    onmouseover="this.style.background='var(--bg)'"
                    onmouseout="this.style.background='transparent'">

                    {{-- User --}}
                    <td style="padding:14px 20px;">
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div style="width:38px; height:38px; border-radius:50%; background:var(--primary); display:flex; align-items:center; justify-content:center; color:white; font-weight:700; font-size:13px; flex-shrink:0;">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            <div>
                                <div style="font-weight:700; font-size:14px; color:var(--text);">{{ $user->name }}</div>
                                <div style="font-size:12px; color:var(--text-secondary);">{{ $user->phone ?? 'No phone' }}</div>
                            </div>
                        </div>
                    </td>

                    {{-- Email --}}
                    <td style="padding:14px 20px;" class="hide-mobile">
                        <span style="font-size:13px; color:var(--text-secondary);">{{ $user->email }}</span>
                    </td>

                    {{-- Role --}}
                    <td style="padding:14px 20px;">
                        @php $role = $user->getRoleNames()->first() ?? 'none'; @endphp
                        <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                            <span style="background:{{ $role === 'admin' ? '#FEE2E2' : ($role === 'provider' ? '#E8F5E9' : '#DBEAFE') }};
                                         color:{{ $role === 'admin' ? '#DC2626' : ($role === 'provider' ? '#009624' : '#1E3A8A') }};
                                         font-size:11px; font-weight:700; padding:3px 10px; border-radius:20px;">
                                {{ ucfirst($role) }}
                            </span>

                            {{-- Quick Role Change --}}
                            <form method="POST" action="{{ route('admin.users.role', $user) }}" style="display:inline;">
                                @csrf
                                <select name="role" onchange="this.form.submit()"
                                        style="border:1px solid var(--border); border-radius:6px; padding:3px 6px; font-size:11px; font-family:'PT Sans',sans-serif; color:var(--text); background:var(--bg); cursor:pointer;"
                                        {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                                    @foreach($roles as $r)
                                        <option value="{{ $r->name }}" {{ $role === $r->name ? 'selected' : '' }}>
                                            {{ ucfirst($r->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </td>

                    {{-- Joined --}}
                    <td style="padding:14px 20px;" class="hide-mobile">
                        <span style="font-size:13px; color:var(--text-secondary);">{{ $user->created_at->format('M d, Y') }}</span>
                    </td>

                    {{-- Actions --}}
                    <td style="padding:14px 20px; text-align:center;">
                        <div style="display:flex; gap:6px; justify-content:center;">
                            <a href="{{ route('admin.users.edit', $user) }}"
                               style="background:var(--primary-soft); color:var(--primary); border-radius:8px; padding:7px 12px; font-size:12px; font-weight:700; text-decoration:none;">
                                ✏️ Edit
                            </a>
                            @if($user->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                  onsubmit="return confirm('Delete {{ $user->name }}?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        style="background:#FEE2E2; color:#DC2626; border:none; border-radius:8px; padding:7px 12px; font-size:12px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif;">
                                    🗑️ Delete
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding:48px; text-align:center; color:var(--text-light); font-size:14px;">
                        No users found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div style="margin-top:24px;">
        {{ $users->links() }}
    </div>
</div>
@endsection