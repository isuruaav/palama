@extends('layouts.app')
@section('title', 'My Services — SevaSL')

@section('content')
<div style="max-width:1280px; margin:0 auto; padding:40px 24px;">

    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:32px; flex-wrap:wrap; gap:16px;">
        <div>
            <h1 style="font-size:32px; font-weight:700; color:var(--text); margin-bottom:4px;">My Services</h1>
            <p style="font-size:15px; color:var(--text-secondary);">Manage your posted service ads</p>
        </div>
        <a href="{{ route('services.create') }}"
           style="background:var(--accent); color:white; border-radius:12px; padding:12px 24px; font-size:14px; font-weight:700; text-decoration:none; display:flex; align-items:center; gap:8px;">
            <i class="fa-solid fa-plus"></i> Post New Service
        </a>
    </div>

    @forelse($services as $service)
    <div style="background:var(--card); border-radius:16px; border:1.5px solid var(--border); padding:20px; margin-bottom:14px; display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap; transition:all .2s;"
         onmouseover="this.style.borderColor='var(--primary-light)'; this.style.boxShadow='0 4px 16px rgba(30,58,138,0.08)'"
         onmouseout="this.style.borderColor='var(--border)'; this.style.boxShadow='none'">

        <div style="flex:1; min-width:200px;">
            <div style="font-weight:700; font-size:16px; color:var(--text); margin-bottom:4px;">{{ $service->title }}</div>
            <div style="font-size:13px; color:var(--text-secondary);">
                <i class="fa-solid fa-tag" style="color:var(--primary-light); margin-right:4px;"></i>{{ $service->category->name }}
                &nbsp;·&nbsp;
                <i class="fa-solid fa-location-dot" style="color:var(--primary-light); margin-right:4px;"></i>{{ $service->district->name }}
                &nbsp;·&nbsp;
                Rs. {{ number_format($service->price_from ?? 0) }}
            </div>
        </div>

        <div style="text-align:center; min-width:60px;">
            <div style="font-size:11px; color:var(--text-light); font-weight:700; text-transform:uppercase;">Views</div>
            <div style="font-weight:700; color:var(--text); font-size:18px;">{{ $service->views_count }}</div>
        </div>

        <div>
            @if($service->status === 'active')
                <span style="background:var(--accent-soft); color:var(--accent-dark); font-size:12px; font-weight:700; padding:4px 12px; border-radius:20px;">✓ Active</span>
            @elseif($service->status === 'pending')
                <span style="background:#FEF3C7; color:#D97706; font-size:12px; font-weight:700; padding:4px 12px; border-radius:20px;">⏳ Pending</span>
            @else
                <span style="background:#FEE2E2; color:#DC2626; font-size:12px; font-weight:700; padding:4px 12px; border-radius:20px;">✗ Rejected</span>
            @endif
        </div>

        <div style="display:flex; gap:8px;">
            <a href="{{ route('services.edit', $service) }}"
               style="background:var(--primary-soft); color:var(--primary); border-radius:8px; padding:8px 14px; font-size:13px; font-weight:700; text-decoration:none;">
                ✏️ Edit
            </a>
            <a href="{{ route('services.show', $service) }}"
               style="background:var(--bg); color:var(--text); border-radius:8px; padding:8px 14px; font-size:13px; font-weight:700; text-decoration:none; border:1.5px solid var(--border);">
                View
            </a>
            <form method="POST" action="{{ route('services.destroy', $service) }}"
                  onsubmit="return confirm('Delete this service?')">
                @csrf @method('DELETE')
                <button type="submit"
                        style="background:#FEE2E2; color:#DC2626; border:none; border-radius:8px; padding:8px 14px; font-size:13px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif;">
                    Delete
                </button>
            </form>
        </div>
    </div>
    @empty
    <div style="text-align:center; padding:80px; background:var(--card); border-radius:20px; border:1.5px solid var(--border);">
        <i class="fa-solid fa-briefcase" style="font-size:48px; color:var(--border); display:block; margin-bottom:16px;"></i>
        <h3 style="font-size:20px; font-weight:700; color:var(--text); margin-bottom:8px;">No services yet</h3>
        <p style="color:var(--text-light); margin-bottom:20px; font-size:15px;">Post your first service and start getting customers!</p>
        <a href="{{ route('services.create') }}"
           style="background:var(--primary); color:white; border-radius:12px; padding:12px 24px; font-size:14px; font-weight:700; text-decoration:none; display:inline-block;">
            Post Your First Service
        </a>
    </div>
    @endforelse
</div>
@endsection