@extends('layouts.app')
@section('title', __('messages.emergency') . ' — Palama')

@section('content')

{{-- Hero --}}
<section style="background:linear-gradient(135deg, #7F1D1D 0%, #991B1B 100%); padding:72px 24px; text-align:center; position:relative; overflow:hidden;">
    <div style="position:absolute; inset:0; background:radial-gradient(circle at 30% 50%, rgba(255,255,255,0.05) 0%, transparent 60%);"></div>
    <div style="position:relative; z-index:1; max-width:700px; margin:0 auto;">

        <div style="display:inline-flex; align-items:center; gap:8px; background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); border-radius:30px; padding:6px 18px; margin-bottom:24px;">
            <span style="width:8px; height:8px; background:#FCA5A5; border-radius:50%; display:inline-block; box-shadow:0 0 0 3px rgba(252,165,165,0.3);"></span>
            <span style="color:#FCA5A5; font-size:13px; font-weight:700; letter-spacing:.5px;">LIVE — AVAILABLE RIGHT NOW</span>
        </div>

        <h1 style="font-family:'PT Sans',sans-serif; font-size:44px; font-weight:700; color:white; margin-bottom:16px; line-height:1.15;">
            🚨 {{ __('messages.emergency') }} Services<br/>
            <span style="color:#FCA5A5; font-size:32px;">24/7 — Day & Night</span>
        </h1>

        <p style="color:rgba(255,255,255,0.75); font-size:16px; margin-bottom:32px; line-height:1.7;">
            {{ __('messages.emergency_desc') }}
        </p>

        <div style="display:flex; gap:14px; justify-content:center; flex-wrap:wrap;">
            <a href="tel:0094112345678"
               style="background:white; color:#991B1B; border-radius:14px; padding:16px 32px; font-size:16px; font-weight:700; text-decoration:none; display:inline-flex; align-items:center; gap:8px; transition:all .2s;"
               onmouseover="this.style.background='#FEE2E2'"
               onmouseout="this.style.background='white'">
                <i class="fa-solid fa-phone"></i> +94 11 234 5678
            </a>
            <a href="https://wa.me/94112345678" target="_blank"
               style="background:#25D366; color:white; border-radius:14px; padding:16px 32px; font-size:16px; font-weight:700; text-decoration:none; display:inline-flex; align-items:center; gap:8px;">
                <i class="fa-brands fa-whatsapp"></i> WhatsApp
            </a>
        </div>
    </div>
</section>

{{-- Emergency Types --}}
<section style="background:white; padding:48px 24px; border-bottom:1px solid #E5E7EB;">
    <div style="max-width:1280px; margin:0 auto;">
        <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(180px,1fr)); gap:14px;">

            <div style="background:#FEF2F2; border:1.5px solid #FECACA; border-radius:16px; padding:20px; text-align:center;">
                <i class="fa-solid fa-car" style="font-size:28px; color:#DC2626; margin-bottom:10px; display:block;"></i>
                <div style="font-size:13px; font-weight:700; color:#111827;">Vehicle Breakdown</div>
                <div style="font-size:11px; color:#9CA3AF; margin-top:4px;">Tuk, car, van, lorry</div>
            </div>

            <div style="background:#FEF2F2; border:1.5px solid #FECACA; border-radius:16px; padding:20px; text-align:center;">
                <i class="fa-solid fa-faucet" style="font-size:28px; color:#DC2626; margin-bottom:10px; display:block;"></i>
                <div style="font-size:13px; font-weight:700; color:#111827;">Burst Pipe / Leak</div>
                <div style="font-size:11px; color:#9CA3AF; margin-top:4px;">Emergency plumbing</div>
            </div>

            <div style="background:#FEF2F2; border:1.5px solid #FECACA; border-radius:16px; padding:20px; text-align:center;">
                <i class="fa-solid fa-bolt" style="font-size:28px; color:#DC2626; margin-bottom:10px; display:block;"></i>
                <div style="font-size:13px; font-weight:700; color:#111827;">Power / Electrical</div>
                <div style="font-size:11px; color:#9CA3AF; margin-top:4px;">Emergency electrician</div>
            </div>

            <div style="background:#FEF2F2; border:1.5px solid #FECACA; border-radius:16px; padding:20px; text-align:center;">
                <i class="fa-solid fa-lock" style="font-size:28px; color:#DC2626; margin-bottom:10px; display:block;"></i>
                <div style="font-size:13px; font-weight:700; color:#111827;">Locksmith</div>
                <div style="font-size:11px; color:#9CA3AF; margin-top:4px;">Emergency lock service</div>
            </div>

            <div style="background:#FEF2F2; border:1.5px solid #FECACA; border-radius:16px; padding:20px; text-align:center;">
                <i class="fa-solid fa-house-crack" style="font-size:28px; color:#DC2626; margin-bottom:10px; display:block;"></i>
                <div style="font-size:13px; font-weight:700; color:#111827;">Roof / Flooding</div>
                <div style="font-size:11px; color:#9CA3AF; margin-top:4px;">Water damage repair</div>
            </div>

            <div style="background:#FEF2F2; border:1.5px solid #FECACA; border-radius:16px; padding:20px; text-align:center;">
                <i class="fa-solid fa-wrench" style="font-size:28px; color:#DC2626; margin-bottom:10px; display:block;"></i>
                <div style="font-size:13px; font-weight:700; color:#111827;">Other Emergency</div>
                <div style="font-size:11px; color:#9CA3AF; margin-top:4px;">Call hotline</div>
            </div>

        </div>
    </div>
</section>

{{-- Services List --}}
<div style="max-width:1280px; margin:0 auto; padding:48px 24px;">

    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:32px; flex-wrap:wrap; gap:16px;">
        <div>
            <h2 style="font-size:28px; font-weight:700; color:#111827; margin-bottom:6px;">Available Emergency Providers</h2>
            <p style="font-size:15px; color:#6B7280;">{{ $services->count() }} providers available now</p>
        </div>
        <a href="{{ route('services.index') }}"
           style="border:1.5px solid #E5E7EB; color:#111827; border-radius:10px; padding:10px 20px; font-size:14px; font-weight:700; text-decoration:none; background:white;">
            Browse All Services →
        </a>
    </div>

    @if($services->count())
        <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:20px;">
            @foreach($services as $service)
                @include('components.service-card', ['service' => $service])
            @endforeach
        </div>
    @else
        <div style="text-align:center; padding:80px; background:white; border-radius:20px; border:1.5px solid #E5E7EB;">
            <i class="fa-solid fa-triangle-exclamation" style="font-size:48px; color:#FCA5A5; display:block; margin-bottom:16px;"></i>
            <h3 style="font-size:20px; font-weight:700; color:#111827; margin-bottom:8px;">No emergency services listed yet</h3>
            <p style="color:#9CA3AF; font-size:14px; margin-bottom:20px;">Call our hotline for immediate assistance</p>
            <a href="tel:0094112345678"
               style="background:#DC2626; color:white; border-radius:12px; padding:12px 28px; font-size:15px; font-weight:700; text-decoration:none; display:inline-block;">
                <i class="fa-solid fa-phone"></i> +94 11 234 5678
            </a>
        </div>
    @endif
</div>

@endsection