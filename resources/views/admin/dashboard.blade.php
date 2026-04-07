@extends('layouts.app')
@section('title', 'Admin Dashboard — SevaSL')

@section('content')
<div style="max-width:1280px; margin:0 auto; padding:40px 24px;">

    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:32px; flex-wrap:wrap; gap:16px;">
        <div>
            <h1 style="font-size:32px; font-weight:700; color:var(--text); margin-bottom:4px;">Admin Dashboard</h1>
            <p style="font-size:15px; color:var(--text-secondary);">Manage services, providers and platform</p>
        </div>
        <span style="background:var(--primary-soft); color:var(--primary); font-size:13px; font-weight:700; padding:6px 16px; border-radius:20px;">
            <i class="fa-solid fa-shield-halved"></i> Admin Panel
        </span>
    </div>

    {{-- Stats --}}
    <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:40px;" class="dash-stats">
        <div style="background:var(--card); border-radius:16px; border:1.5px solid var(--border); padding:20px; text-align:center;">
            <div style="font-size:32px; font-weight:700; color:var(--primary);">{{ $stats['users'] }}</div>
            <div style="font-size:13px; color:var(--text-secondary); margin-top:4px; font-weight:700;">Total Users</div>
        </div>
        <div style="background:var(--card); border-radius:16px; border:1.5px solid var(--border); padding:20px; text-align:center;">
            <div style="font-size:32px; font-weight:700; color:var(--secondary-dark);">{{ $stats['services'] }}</div>
            <div style="font-size:13px; color:var(--text-secondary); margin-top:4px; font-weight:700;">Total Services</div>
        </div>
        <div style="background:var(--card); border-radius:16px; border:1.5px solid var(--border); padding:20px; text-align:center;">
            <div style="font-size:32px; font-weight:700; color:#D97706;">{{ $stats['pending'] }}</div>
            <div style="font-size:13px; color:var(--text-secondary); margin-top:4px; font-weight:700;">Pending</div>
        </div>
        <div style="background:var(--card); border-radius:16px; border:1.5px solid var(--border); padding:20px; text-align:center;">
            <div style="font-size:32px; font-weight:700; color:var(--accent-dark);">{{ $stats['active'] }}</div>
            <div style="font-size:13px; color:var(--text-secondary); margin-top:4px; font-weight:700;">Active</div>
        </div>
    </div>

    {{-- Pending --}}
    @if($pending->count())
    <div style="margin-bottom:40px;">
        <h2 style="font-size:22px; font-weight:700; color:var(--text); margin-bottom:16px;">
            ⏳ Pending Approval
            <span style="background:#FEF3C7; color:#D97706; font-size:14px; padding:3px 10px; border-radius:20px; margin-left:8px;">{{ $pending->count() }}</span>
        </h2>

        @foreach($pending as $service)
        <div style="background:#FFFBEB; border:1.5px solid #FDE68A; border-radius:16px; padding:20px; margin-bottom:12px; display:flex; align-items:flex-start; justify-content:space-between; gap:16px; flex-wrap:wrap;">
            <div style="flex:1; min-width:200px;">
                <div style="font-weight:700; font-size:15px; color:var(--text); margin-bottom:4px;">{{ $service->title }}</div>
                <div style="font-size:13px; color:var(--text-secondary); margin-bottom:8px;">
                    by <strong>{{ $service->user->name }}</strong> · {{ $service->category->name }}
                </div>
                <p style="font-size:13px; color:var(--text-secondary); line-height:1.6;">{{ Str::limit($service->description, 120) }}</p>
            </div>
            <div style="display:flex; gap:8px; flex-shrink:0;">
                <form method="POST" action="{{ route('admin.services.approve', $service) }}">
                    @csrf
                    <button type="submit"
                            style="background:var(--accent-dark); color:white; border:none; border-radius:8px; padding:10px 20px; font-size:13px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif;">
                        ✓ Approve
                    </button>
                </form>
                <form method="POST" action="{{ route('admin.services.reject', $service) }}">
                    @csrf
                    <button type="submit"
                            style="background:#DC2626; color:white; border:none; border-radius:8px; padding:10px 20px; font-size:13px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif;">
                        ✗ Reject
                    </button>
                </form>
                <a href="{{ route('services.show', $service) }}" target="_blank"
                   style="background:var(--primary-soft); color:var(--primary); border-radius:8px; padding:10px 16px; font-size:13px; font-weight:700; text-decoration:none;">
                    View
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div style="background:var(--accent-soft); border:1.5px solid var(--accent-light); border-radius:16px; padding:16px 20px; margin-bottom:32px; color:var(--accent-dark); font-weight:700; font-size:14px;">
        ✅ No pending approvals!
    </div>
    @endif

    {{-- Pending Testimonials --}}
@if($pendingTestimonials->count())
<div style="margin-bottom:40px;">
    <h2 style="font-size:22px; font-weight:700; color:var(--text); margin-bottom:16px;">
        💬 Pending Testimonials
        <span style="background:#FEF3C7; color:#D97706; font-size:14px; padding:3px 10px; border-radius:20px; margin-left:8px;">{{ $pendingTestimonials->count() }}</span>
    </h2>

    @foreach($pendingTestimonials as $t)
    <div style="background:#F0F9FF; border:1.5px solid #BAE6FD; border-radius:16px; padding:20px; margin-bottom:12px; display:flex; align-items:flex-start; justify-content:space-between; gap:16px; flex-wrap:wrap;">
        <div style="flex:1; min-width:200px;">
            <div style="display:flex; align-items:center; gap:10px; margin-bottom:8px;">
                <div style="width:36px; height:36px; border-radius:50%; background:var(--primary); display:flex; align-items:center; justify-content:center; color:white; font-weight:700; font-size:13px;">
                    {{ strtoupper(substr($t->name, 0, 2)) }}
                </div>
                <div>
                    <div style="font-weight:700; font-size:14px; color:var(--text);">{{ $t->name }}</div>
                    <div style="font-size:12px; color:var(--text-secondary);">{{ $t->location ?? 'No location' }} · {{ $t->created_at->diffForHumans() }}</div>
                </div>
                <div style="color:#F59E0B; font-size:13px; margin-left:8px;">
                    @for($i=1; $i<=5; $i++)
                        <i class="fa-{{ $i <= $t->rating ? 'solid' : 'regular' }} fa-star"></i>
                    @endfor
                </div>
            </div>
            <p style="font-size:14px; color:var(--text-secondary); line-height:1.65; font-style:italic;">"{{ $t->message }}"</p>
        </div>
        <div style="display:flex; gap:8px; flex-shrink:0;">
            <form method="POST" action="{{ route('admin.testimonials.approve', $t) }}">
                @csrf
                <button type="submit"
                        style="background:var(--accent-dark); color:white; border:none; border-radius:8px; padding:10px 20px; font-size:13px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif;">
                    ✓ Approve
                </button>
            </form>
            <form method="POST" action="{{ route('admin.testimonials.delete', $t) }}">
                @csrf @method('DELETE')
                <button type="submit"
                        style="background:#DC2626; color:white; border:none; border-radius:8px; padding:10px 16px; font-size:13px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif;">
                    ✗ Delete
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endif

    {{-- All Services --}}
    <h2 style="font-size:22px; font-weight:700; color:var(--text); margin-bottom:16px;">All Services</h2>

    @foreach($services as $service)
    <div style="background:var(--card); border:1.5px solid var(--border); border-radius:12px; padding:16px 20px; margin-bottom:10px; display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap; transition:all .2s;"
         onmouseover="this.style.borderColor='var(--primary-light)'"
         onmouseout="this.style.borderColor='var(--border)'">
        <div style="flex:1; min-width:180px;">
            <div style="font-weight:700; font-size:14px; color:var(--text);">{{ $service->title }}</div>
            <div style="font-size:12px; color:var(--text-secondary); margin-top:2px;">{{ $service->user->name }} · {{ $service->category->name }}</div>
        </div>

        <div style="display:flex; gap:6px; align-items:center; flex-wrap:wrap;">
            {{-- Status --}}
            @if($service->status === 'active')
                <span style="background:var(--accent-soft); color:var(--accent-dark); font-size:11px; font-weight:700; padding:3px 10px; border-radius:20px;">Active</span>
            @elseif($service->status === 'pending')
                <span style="background:#FEF3C7; color:#D97706; font-size:11px; font-weight:700; padding:3px 10px; border-radius:20px;">Pending</span>
            @else
                <span style="background:#FEE2E2; color:#DC2626; font-size:11px; font-weight:700; padding:3px 10px; border-radius:20px;">Rejected</span>
            @endif

            {{-- Featured --}}
            <form method="POST" action="{{ route('admin.services.feature', $service) }}">
                @csrf
                <button type="submit"
                        style="background:{{ $service->is_featured ? '#FEF3C7' : 'var(--bg)' }}; color:{{ $service->is_featured ? '#D97706' : 'var(--text-light)' }}; border:1.5px solid {{ $service->is_featured ? '#FDE68A' : 'var(--border)' }}; border-radius:8px; padding:4px 12px; font-size:11px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif;">
                    ⭐ {{ $service->is_featured ? 'Featured' : 'Feature' }}
                </button>
            </form>

            {{-- Verify --}}
            <form method="POST" action="{{ route('admin.services.verify', $service) }}">
                @csrf
                <button type="submit"
                        style="background:{{ $service->is_verified ? 'var(--accent-soft)' : 'var(--bg)' }}; color:{{ $service->is_verified ? 'var(--accent-dark)' : 'var(--text-light)' }}; border:1.5px solid {{ $service->is_verified ? 'var(--accent-light)' : 'var(--border)' }}; border-radius:8px; padding:4px 12px; font-size:11px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif;">
                    ✓ {{ $service->is_verified ? 'Verified' : 'Verify' }}
                </button>
            </form>

            {{-- Approve if pending --}}
            @if($service->status === 'pending')
            <form method="POST" action="{{ route('admin.services.approve', $service) }}">
                @csrf
                <button type="submit"
                        style="background:var(--accent-dark); color:white; border:none; border-radius:8px; padding:4px 12px; font-size:11px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif;">
                    Approve
                </button>
            </form>
            @endif
        </div>
    </div>
    @endforeach
</div>
@endsection