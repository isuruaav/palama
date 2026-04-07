@props(['service'])

<div style="background:var(--card); border-radius:20px; border:1.5px solid var(--border); overflow:hidden; transition:all .3s;"
     onmouseover="this.style.boxShadow='0 16px 40px rgba(30,58,138,0.12)'; this.style.transform='translateY(-4px)'; this.style.borderColor='var(--primary-light)'"
     onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'; this.style.borderColor='var(--border)'">

    {{-- Cover Image --}}
    @if($service->getMedia('service-images')->count())
    <img src="{{ $service->getFirstMediaUrl('service-images', 'thumb') }}"
         style="width:100%; height:160px; object-fit:cover;"
         alt="{{ $service->title }}"/>
    @endif

    {{-- Header --}}
    <div style="padding:16px 20px 0; background:var(--primary-soft);">
        @if($service->is_featured)
            <span style="float:right; background:var(--accent-soft); color:var(--accent-dark); font-size:11px; font-weight:700; padding:3px 8px; border-radius:20px;">⭐ Popular</span>
        @endif
        @if($service->is_emergency)
            <span style="float:right; background:#FEE2E2; color:#DC2626; font-size:11px; font-weight:700; padding:3px 8px; border-radius:20px; margin-left:4px;">🚨 24/7</span>
        @endif

        <div style="display:flex; align-items:center; gap:12px; padding-bottom:14px;">
            <div style="width:42px; height:42px; border-radius:50%; background:var(--primary); display:flex; align-items:center; justify-content:center; font-weight:700; color:white; font-size:15px;">
                {{ strtoupper(substr($service->user->name, 0, 2)) }}
            </div>
            <div>
                <div style="font-weight:700; font-size:15px; color:var(--text);">{{ $service->user->name }}</div>
                <div style="font-size:12px; color:var(--text-secondary);">{{ $service->category->name }}</div>
            </div>
        </div>
    </div>

    {{-- Body --}}
    <div style="padding:14px 20px;">
        <div style="font-weight:700; font-size:15px; color:var(--text); margin-bottom:8px;">{{ $service->title }}</div>

        {{-- Rating --}}
        <div style="display:flex; align-items:center; gap:6px; margin-bottom:8px; flex-wrap:wrap;">
            <span style="color:#F59E0B; font-size:13px;">
                @for($i=1; $i<=5; $i++)
                    <i class="fa-{{ $i <= round($service->avg_rating) ? 'solid' : 'regular' }} fa-star"></i>
                @endfor
            </span>
            <span style="font-size:13px; font-weight:700; color:var(--text);">{{ $service->avg_rating }}</span>
            <span style="font-size:12px; color:var(--text-light);">({{ $service->reviews_count }})</span>
            @if($service->is_verified)
                <span style="background:var(--accent-soft); color:var(--accent-dark); font-size:11px; font-weight:700; padding:2px 8px; border-radius:20px;">✓ Verified</span>
            @endif
        </div>

        <div style="font-size:13px; color:var(--text-secondary); margin-bottom:4px;">
            <i class="fa-solid fa-location-dot" style="color:var(--primary-light);"></i>
            {{ $service->location_text }} · {{ $service->district->name }}
        </div>

        <p style="font-size:13px; color:var(--text-secondary); line-height:1.6; margin:10px 0 14px; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
            {{ $service->description }}
        </p>

        <div style="display:flex; align-items:center; justify-content:space-between;">
            <div>
                <div style="font-size:11px; color:var(--text-light);">Starting from</div>
                <div style="font-size:18px; font-weight:700; color:var(--primary); font-family:'PT Sans',sans-serif;">
                    Rs. {{ number_format($service->price_from ?? 0) }}
                </div>
            </div>
            <a href="{{ route('services.show', $service) }}"
               style="background:var(--primary); color:white; border-radius:10px; padding:9px 18px; font-size:13px; font-weight:700; text-decoration:none; transition:all .2s;"
               onmouseover="this.style.background='var(--primary-dark)'"
               onmouseout="this.style.background='var(--primary)'">
                View →
            </a>
        </div>
    </div>
</div>