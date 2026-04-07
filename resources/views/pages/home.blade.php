@extends('layouts.app')
@section('title', 'Palama — ' . __('messages.hero_title'))
@section('meta_description', 'Palama — Find any service in Sri Lanka. AC repair, plumbing, tutors, beauty, vehicle repair, CCTV and 100+ services. Emergency 24/7.')

@section('content')

{{-- Hero --}}
<section style="position:relative; min-height:92vh; display:flex; align-items:center; overflow:hidden;">

    <div style="position:absolute; inset:0; z-index:0;">
        <img src="{{ asset('images/hero.png') }}"
             style="width:100%; height:100%; object-fit:cover; object-position:center;" alt="Sri Lanka"/>
        <div style="position:absolute; inset:0; background:linear-gradient(135deg, rgba(0,0,2,0.63) 0%, rgba(0,16,61,0.575) 50%, rgba(1,2,10,0.548) 100%);"></div>
        <div style="position:absolute; inset:0; background-image:radial-gradient(circle at 20% 50%, rgba(59,130,246,0.15) 0%, transparent 50%), radial-gradient(circle at 80% 20%, rgba(0,200,83,0.1) 0%, transparent 40%);"></div>
    </div>

    <div style="position:absolute; inset:0; z-index:0; overflow:hidden;">
        <div style="position:absolute; width:300px; height:300px; border-radius:50%; background:rgba(59,130,246,0.08); top:-50px; right:10%; animation:float 8s ease-in-out infinite;"></div>
        <div style="position:absolute; width:200px; height:200px; border-radius:50%; background:rgba(0,200,83,0.06); bottom:10%; left:5%; animation:float 6s ease-in-out infinite reverse;"></div>
    </div>

    <div style="position:relative; z-index:1; max-width:1280px; margin:0 auto; padding:80px 24px; width:100%;">
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:60px; align-items:center;" class="show-grid">

            {{-- Left --}}
            <div>
                <div style="display:inline-flex; align-items:center; gap:8px; background:rgba(0,200,83,0.15); border:1px solid rgba(0,200,83,0.35); border-radius:30px; padding:6px 18px; margin-bottom:28px;">
                    <span style="width:8px; height:8px; background:#00C853; border-radius:50%; display:inline-block; box-shadow:0 0 0 3px rgba(0,200,83,0.2);"></span>
                    <span style="color:#69F0AE; font-size:13px; font-weight:700;">{{ $stats['services'] }}+ {{ __('messages.services_available') }}</span>
                </div>

                <h1 style="font-size:54px; font-weight:700; color:white; line-height:1.1; margin-bottom:20px;" class="hero-title">
                    Sri Lanka's<br/>
                    <span style="color:#67E8F9;">{{ __('messages.hero_sub') }}</span><br/>
                    {{ __('messages.hero_title') }}
                </h1>

                <p style="font-size:17px; color:rgba(255,255,255,0.72); margin-bottom:36px; line-height:1.75; max-width:480px;">
                    {{ __('messages.hero_desc') }}
                </p>

                <div style="display:flex; gap:14px; flex-wrap:wrap; margin-bottom:40px;">
                    <a href="{{ route('services.index') }}"
                       style="background:#00C853; color:white; border-radius:14px; padding:16px 32px; font-size:16px; font-weight:700; text-decoration:none; display:inline-flex; align-items:center; gap:8px; transition:all .2s; font-family:'PT Sans',sans-serif;"
                       onmouseover="this.style.background='#009624'; this.style.transform='translateY(-2px)'"
                       onmouseout="this.style.background='#00C853'; this.style.transform='translateY(0)'">
                        <i class="fa-solid fa-magnifying-glass"></i> {{ __('messages.find_services') }}
                    </a>
                    <a href="{{ route('services.create') }}"
                       style="background:rgba(255,255,255,0.12); border:2px solid rgba(255,255,255,0.3); color:white; border-radius:14px; padding:16px 32px; font-size:16px; font-weight:700; text-decoration:none; display:inline-flex; align-items:center; gap:8px; transition:all .2s; font-family:'PT Sans',sans-serif; backdrop-filter:blur(10px);"
                       onmouseover="this.style.background='rgba(255,255,255,0.2)'"
                       onmouseout="this.style.background='rgba(255,255,255,0.12)'">
                        <i class="fa-solid fa-plus"></i> {{ __('messages.post_free') }}
                    </a>
                </div>

                <div style="display:flex; gap:24px; flex-wrap:wrap;">
                    <div style="display:flex; align-items:center; gap:8px;">
                        <i class="fa-solid fa-circle-check" style="color:#00C853; font-size:16px;"></i>
                        <span style="color:rgba(255,255,255,0.75); font-size:14px; font-weight:700;">NIC Verified Providers</span>
                    </div>
                    <div style="display:flex; align-items:center; gap:8px;">
                        <i class="fa-solid fa-circle-check" style="color:#00C853; font-size:16px;"></i>
                        <span style="color:rgba(255,255,255,0.75); font-size:14px; font-weight:700;">24/7 Emergency</span>
                    </div>
                    <div style="display:flex; align-items:center; gap:8px;">
                        <i class="fa-solid fa-circle-check" style="color:#00C853; font-size:16px;"></i>
                        <span style="color:rgba(255,255,255,0.75); font-size:14px; font-weight:700;">Free to Register</span>
                    </div>
                </div>
            </div>

            {{-- Right — Search Card --}}
            <div>
                <div style="background:rgba(255,255,255,0.08); backdrop-filter:blur(20px); -webkit-backdrop-filter:blur(5px); border-radius:24px; padding:32px; box-shadow:0 24px 64px rgba(0,0,0,0.3); border:1px solid rgba(255,255,255,0.18);">

                    <h3 style="font-size:20px; font-weight:700; color:white; margin-bottom:6px;">{{ __('messages.find_service') }}</h3>
                    <p style="font-size:14px; color:rgba(255,255,255,0.65); margin-bottom:24px;">Search from {{ $stats['services'] }}+ services island-wide</p>

                    <form action="{{ route('services.index') }}" method="GET">

                        <div style="margin-bottom:14px;">
                            <label style="display:block; font-size:12px; font-weight:700; color:rgba(255,255,255,0.7); text-transform:uppercase; letter-spacing:.5px; margin-bottom:6px;">{{ __('messages.category') }}</label>
                            <select name="category"
                                    style="width:100%; border:1px solid rgba(255,255,255,0.2); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; font-family:'PT Sans',sans-serif; color:#111827; background:rgba(255,255,255,0.92); cursor:pointer;">
                                <option value="">{{ __('messages.all_categories') }}</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div style="margin-bottom:14px;">
                            <label style="display:block; font-size:12px; font-weight:700; color:rgba(255,255,255,0.7); text-transform:uppercase; letter-spacing:.5px; margin-bottom:6px;">{{ __('messages.district') }}</label>
                            <select name="district"
                                    style="width:100%; border:1px solid rgba(255,255,255,0.2); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; font-family:'PT Sans',sans-serif; color:#111827; background:rgba(255,255,255,0.92); cursor:pointer;">
                                <option value="">{{ __('messages.all_districts') }}</option>
                                @foreach(\App\Models\District::orderBy('name')->get() as $dist)
                                    <option value="{{ $dist->id }}">{{ $dist->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div style="margin-bottom:20px;">
                            <label style="display:block; font-size:12px; font-weight:700; color:rgba(255,255,255,0.7); text-transform:uppercase; letter-spacing:.5px; margin-bottom:6px;">{{ __('messages.what_need') }}</label>
                            <div style="position:relative;">
                                <i class="fa-solid fa-magnifying-glass" style="position:absolute; left:16px; top:50%; transform:translateY(-50%); color:#9CA3AF; font-size:14px; z-index:1;"></i>
                                <input type="text" name="q"
                                       placeholder="e.g. AC repair, plumber, tutor..."
                                       style="width:100%; border:1px solid rgba(255,255,255,0.2); border-radius:12px; padding:12px 16px 12px 44px; font-size:14px; outline:none; font-family:'PT Sans',sans-serif; color:#111827; background:rgba(255,255,255,0.92); box-sizing:border-box;"/>
                            </div>
                        </div>

                        <label style="display:flex; align-items:center; gap:10px; margin-bottom:20px; cursor:pointer; background:rgba(220,38,38,0.15); border-radius:10px; padding:10px 14px; border:1px solid rgba(220,38,38,0.3);">
                            <input type="checkbox" name="emergency" value="1" style="width:16px; height:16px; accent-color:#DC2626;"/>
                            <span style="font-size:13px; font-weight:700; color:#FCA5A5;">{{ __('messages.emergency_only') }}</span>
                        </label>

                        <button type="submit"
                                style="width:100%; background:#00C853; color:white; border:none; border-radius:12px; padding:14px; font-size:16px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif; transition:all .2s; letter-spacing:.3px;"
                                onmouseover="this.style.background='#009624'; this.style.transform='translateY(-1px)'"
                                onmouseout="this.style.background='#00C853'; this.style.transform='translateY(0)'">
                            <i class="fa-solid fa-magnifying-glass"></i> {{ __('messages.search') }}
                        </button>
                    </form>

                    <div style="margin-top:16px; padding-top:16px; border-top:1px solid rgba(255,255,255,0.12);">
                        <div style="font-size:11px; color:rgba(255,255,255,0.5); font-weight:700; margin-bottom:8px; letter-spacing:1px;">{{ __('messages.popular') }}</div>
                        <div style="display:flex; flex-wrap:wrap; gap:6px;">
                            @foreach(['AC Repair','Plumber','Tutor','CCTV','Bridal','Tuk Repair'] as $term)
                            <a href="{{ route('services.index', ['q' => $term]) }}"
                               style="background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); color:rgba(255,255,255,0.85); border-radius:20px; padding:5px 12px; font-size:12px; text-decoration:none; font-weight:700; transition:all .2s;"
                               onmouseover="this.style.background='rgba(0,200,83,0.25)'; this.style.borderColor='rgba(0,200,83,0.5)'; this.style.color='#69F0AE'"
                               onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.borderColor='rgba(255,255,255,0.2)'; this.style.color='rgba(255,255,255,0.85)'">
                                {{ $term }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="position:absolute; bottom:32px; left:50%; transform:translateX(-50%); z-index:1; animation:bounce 2s ease-in-out infinite;">
        <i class="fa-solid fa-chevron-down" style="color:rgba(255,255,255,0.4); font-size:20px;"></i>
    </div>
</section>

<style>
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}
@keyframes bounce {
    0%, 100% { transform: translateX(-50%) translateY(0); }
    50% { transform: translateX(-50%) translateY(8px); }
}
</style>

{{-- Stats Bar --}}
<section style="background:white; padding:0; border-bottom:1px solid #E5E7EB; box-shadow:0 4px 20px rgba(0,0,0,0.06);">
    <div style="max-width:1280px; margin:0 auto; display:grid; grid-template-columns:repeat(4,1fr); text-align:center;" class="stats-grid">
        <div style="padding:24px 16px; border-right:1px solid #F3F4F6;">
            <div style="font-size:30px; font-weight:700; color:#1E3A8A;">{{ number_format($stats['providers']) }}+</div>
            <div style="font-size:13px; color:#6B7280; font-weight:700; margin-top:2px;">{{ __('messages.registered_providers') }}</div>
        </div>
        <div style="padding:24px 16px; border-right:1px solid #F3F4F6;">
            <div style="font-size:30px; font-weight:700; color:#1E3A8A;">{{ number_format($stats['services']) }}+</div>
            <div style="font-size:13px; color:#6B7280; font-weight:700; margin-top:2px;">{{ __('messages.active_services') }}</div>
        </div>
        <div style="padding:24px 16px; border-right:1px solid #F3F4F6;">
            <div style="font-size:30px; font-weight:700; color:#1E3A8A;">25</div>
            <div style="font-size:13px; color:#6B7280; font-weight:700; margin-top:2px;">{{ __('messages.districts_covered') }}</div>
        </div>
        <div style="padding:24px 16px;">
            <div style="font-size:30px; font-weight:700; color:#DC2626;">24/7</div>
            <div style="font-size:13px; color:#6B7280; font-weight:700; margin-top:2px;">{{ __('messages.emergency_support') }}</div>
        </div>
    </div>
</section>

{{-- Categories --}}
<section style="padding:80px 24px; background:#F5F7FA;">
    <div style="max-width:1280px; margin:0 auto;">
        <div style="text-align:center; margin-bottom:48px;">
            <span style="background:#DBEAFE; color:#1E3A8A; font-size:12px; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; padding:6px 18px; border-radius:20px;">{{ __('messages.all_categories_label') }}</span>
            <h2 style="font-size:38px; font-weight:700; color:#111827; margin:16px 0 12px;">{{ __('messages.browse_category') }}</h2>
            <p style="font-size:16px; color:#6B7280; max-width:480px; margin:0 auto;">{{ __('messages.browse_category_desc') }}</p>
        </div>

        <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(145px,1fr)); gap:14px;" class="categories-grid">
            @forelse($categories as $cat)
            <a href="{{ route('services.index', ['category' => $cat->slug]) }}"
               style="background:white; border-radius:16px; border:1.5px solid #E5E7EB; padding:22px 16px; text-align:center; text-decoration:none; display:block; transition:all .25s;"
               onmouseover="this.style.borderColor='#3B82F6'; this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 24px rgba(30,58,138,0.12)'; this.style.background='#F0F7FF'"
               onmouseout="this.style.borderColor='#E5E7EB'; this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.background='white'">
                <div style="width:48px; height:48px; background:#DBEAFE; border-radius:12px; display:flex; align-items:center; justify-content:center; margin:0 auto 12px;">
                    <i class="fa-solid {{ $cat->icon ?? 'fa-wrench' }}" style="color:#1E3A8A; font-size:20px;"></i>
                </div>
                <div style="font-size:12px; font-weight:700; color:#111827; line-height:1.3;">{{ $cat->name }}</div>
            </a>
            @empty
            <p style="text-align:center; color:#9CA3AF; grid-column:1/-1;">No categories yet.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- Featured Services --}}
@if($featured->count())
<section style="padding:0 24px 80px; background:#F5F7FA;">
    <div style="max-width:1280px; margin:0 auto;">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:32px; flex-wrap:wrap; gap:16px;">
            <div>
                <h2 style="font-size:34px; font-weight:700; color:#111827; margin-bottom:6px;">{{ __('messages.featured_providers') }}</h2>
                <p style="font-size:15px; color:#6B7280;">{{ __('messages.featured_desc') }}</p>
            </div>
            <a href="{{ route('services.index') }}"
               style="border:1.5px solid #E5E7EB; color:#111827; border-radius:10px; padding:10px 20px; font-size:14px; font-weight:700; text-decoration:none; background:white; transition:all .2s;"
               onmouseover="this.style.borderColor='#1E3A8A'; this.style.color='#1E3A8A'"
               onmouseout="this.style.borderColor='#E5E7EB'; this.style.color='#111827'">
                {{ __('messages.view_all') }}
            </a>
        </div>
        <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:20px;" class="services-grid">
            @foreach($featured as $service)
                @include('components.service-card', ['service' => $service])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- How it works --}}
<section style="padding:80px 24px; background:white;">
    <div style="max-width:960px; margin:0 auto; text-align:center;">
        <span style="background:#DBEAFE; color:#1E3A8A; font-size:12px; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; padding:6px 18px; border-radius:20px;">{{ __('messages.simple_process') }}</span>
        <h2 style="font-size:38px; font-weight:700; color:#111827; margin:16px 0 48px;">{{ __('messages.how_it_works') }}</h2>

        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:40px; position:relative;" class="stats-grid">
            <div style="position:absolute; top:36px; left:20%; right:20%; height:2px; background:repeating-linear-gradient(90deg,#3B82F6 0,#3B82F6 8px,transparent 8px,transparent 20px);" class="hide-mobile"></div>

            <div style="text-align:center;">
                <div style="width:72px; height:72px; background:#DBEAFE; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 20px; border:3px solid white; box-shadow:0 0 0 4px #DBEAFE;">
                    <i class="fa-solid fa-magnifying-glass" style="font-size:28px; color:#1E3A8A;"></i>
                </div>
                <h3 style="font-size:18px; font-weight:700; color:#111827; margin-bottom:10px;">{{ __('messages.step1_title') }}</h3>
                <p style="font-size:14px; color:#6B7280; line-height:1.7;">{{ __('messages.step1_desc') }}</p>
            </div>

            <div style="text-align:center;">
                <div style="width:72px; height:72px; background:#E8F5E9; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 20px; border:3px solid white; box-shadow:0 0 0 4px #E8F5E9;">
                    <i class="fa-solid fa-calendar-check" style="font-size:28px; color:#00C853;"></i>
                </div>
                <h3 style="font-size:18px; font-weight:700; color:#111827; margin-bottom:10px;">{{ __('messages.step2_title') }}</h3>
                <p style="font-size:14px; color:#6B7280; line-height:1.7;">{{ __('messages.step2_desc') }}</p>
            </div>

            <div style="text-align:center;">
                <div style="width:72px; height:72px; background:#FEF3C7; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 20px; border:3px solid white; box-shadow:0 0 0 4px #FEF3C7;">
                    <i class="fa-solid fa-star" style="font-size:28px; color:#D97706;"></i>
                </div>
                <h3 style="font-size:18px; font-weight:700; color:#111827; margin-bottom:10px;">{{ __('messages.step3_title') }}</h3>
                <p style="font-size:14px; color:#6B7280; line-height:1.7;">{{ __('messages.step3_desc') }}</p>
            </div>
        </div>
    </div>
</section>

{{-- Emergency --}}
<section style="background:linear-gradient(135deg, #0A0F3D 0%, #1E3A8A 100%); padding:72px 24px; position:relative; overflow:hidden;">
    <div style="position:absolute; inset:0; background-image:radial-gradient(circle at 80% 50%, rgba(220,38,38,0.15) 0%, transparent 50%);"></div>
    <div style="max-width:900px; margin:0 auto; text-align:center; position:relative; z-index:1;">
        <div style="display:inline-flex; align-items:center; gap:8px; background:rgba(220,38,38,0.15); border:1px solid rgba(220,38,38,0.3); border-radius:30px; padding:6px 18px; margin-bottom:20px;">
            <span style="width:8px; height:8px; background:#DC2626; border-radius:50%; display:inline-block;"></span>
            <span style="color:#FCA5A5; font-size:13px; font-weight:700; letter-spacing:.5px;">24/7 EMERGENCY SERVICES</span>
        </div>
        <h2 style="font-size:40px; font-weight:700; color:white; margin-bottom:16px; line-height:1.2;">
            {{ __('messages.emergency_title') }}<br/>
            <span style="color:#67E8F9;">{{ __('messages.emergency_sub') }}</span>
        </h2>
        <p style="color:rgba(255,255,255,0.65); font-size:16px; margin-bottom:36px; line-height:1.7; max-width:560px; margin-left:auto; margin-right:auto;">
            {{ __('messages.emergency_desc') }}
        </p>
        <div style="display:flex; gap:14px; justify-content:center; flex-wrap:wrap;">
            <a href="{{ route('services.emergency') }}"
               style="background:#DC2626; color:white; border-radius:14px; padding:16px 32px; font-size:16px; font-weight:700; text-decoration:none; display:inline-flex; align-items:center; gap:8px; transition:all .2s;"
               onmouseover="this.style.background='#B91C1C'"
               onmouseout="this.style.background='#DC2626'">
                {{ __('messages.view_emergency') }}
            </a>
            <a href="tel:0094112345678"
               style="background:rgba(255,255,255,0.1); border:2px solid rgba(255,255,255,0.25); color:white; border-radius:14px; padding:16px 32px; font-size:16px; font-weight:700; text-decoration:none; display:inline-flex; align-items:center; gap:8px;"
               onmouseover="this.style.background='rgba(255,255,255,0.2)'"
               onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                📞 +94 11 234 5678
            </a>
        </div>
    </div>
</section>

{{-- Testimonials --}}
<section style="padding:80px 24px; background:#F5F7FA;">
    <div style="max-width:1280px; margin:0 auto;">
        <div style="display:flex; align-items:flex-end; justify-content:space-between; margin-bottom:48px; flex-wrap:wrap; gap:16px;">
            <div>
                <span style="background:#DBEAFE; color:#1E3A8A; font-size:12px; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; padding:6px 18px; border-radius:20px;">{{ __('messages.testimonials') }}</span>
                <h2 style="font-size:38px; font-weight:700; color:#111827; margin:16px 0 8px;">{{ __('messages.what_say') }}</h2>
                <p style="font-size:15px; color:#6B7280;">Real experiences from our community</p>
            </div>
            @auth
            <button onclick="document.getElementById('testimonial-form').scrollIntoView({behavior:'smooth'})"
                    style="background:#1E3A8A; color:white; border:none; border-radius:12px; padding:12px 24px; font-size:14px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif; display:flex; align-items:center; gap:8px;">
                <i class="fa-solid fa-pen"></i> {{ __('messages.share_experience') }}
            </button>
            @endauth
        </div>

        @if($testimonials->count())
        <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(300px,1fr)); gap:20px; margin-bottom:48px;">
            @foreach($testimonials as $testimonial)
            <div style="background:white; border-radius:20px; padding:28px; border:1.5px solid #E5E7EB; transition:all .25s; position:relative;"
                 onmouseover="this.style.boxShadow='0 8px 32px rgba(30,58,138,0.1)'; this.style.borderColor='#BFDBFE'; this.style.transform='translateY(-3px)'"
                 onmouseout="this.style.boxShadow='none'; this.style.borderColor='#E5E7EB'; this.style.transform='translateY(0)'">
                <div style="position:absolute; top:20px; right:20px; width:32px; height:32px; background:#F0F7FF; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                    <i class="fa-solid fa-quote-right" style="color:#93C5FD; font-size:14px;"></i>
                </div>
                <div style="color:#F59E0B; font-size:15px; margin-bottom:14px;">
                    @for($i=1; $i<=5; $i++)
                        <i class="fa-{{ $i <= $testimonial->rating ? 'solid' : 'regular' }} fa-star"></i>
                    @endfor
                </div>
                <p style="font-size:14px; color:#374151; line-height:1.8; margin-bottom:20px; font-style:italic;">"{{ $testimonial->message }}"</p>
                <div style="display:flex; align-items:center; gap:12px; padding-top:16px; border-top:1px solid #F3F4F6;">
                    <div style="width:42px; height:42px; border-radius:50%; background:#1E3A8A; display:flex; align-items:center; justify-content:center; color:white; font-weight:700; font-size:14px; flex-shrink:0;">
                        {{ strtoupper(substr($testimonial->name, 0, 2)) }}
                    </div>
                    <div>
                        <div style="font-size:14px; font-weight:700; color:#111827;">{{ $testimonial->name }}</div>
                        @if($testimonial->location)
                        <div style="font-size:12px; color:#9CA3AF;"><i class="fa-solid fa-location-dot" style="font-size:10px; margin-right:3px;"></i>{{ $testimonial->location }}</div>
                        @endif
                    </div>
                    <div style="margin-left:auto;">
                        <span style="background:#E8F5E9; color:#009624; font-size:11px; font-weight:700; padding:3px 8px; border-radius:20px;">✓ Verified</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <div id="testimonial-form">
            @auth
            <div style="background:white; border-radius:24px; border:1.5px solid #E5E7EB; padding:40px; max-width:640px; margin:0 auto;">
                <h3 style="font-size:22px; font-weight:700; color:#111827; margin-bottom:6px;">{{ __('messages.share_experience') }}</h3>
                <p style="font-size:14px; color:#6B7280; margin-bottom:24px;">Help others by sharing your Palama experience</p>

                @if(session('testimonial_success'))
                <div style="background:#E8F5E9; color:#009624; padding:14px 18px; border-radius:12px; font-size:14px; font-weight:700; margin-bottom:20px; display:flex; align-items:center; gap:8px;">
                    <i class="fa-solid fa-circle-check"></i> {{ session('testimonial_success') }}
                </div>
                @endif

                @if(session('testimonial_error'))
                <div style="background:#FEE2E2; color:#DC2626; padding:14px 18px; border-radius:12px; font-size:14px; font-weight:700; margin-bottom:20px; display:flex; align-items:center; gap:8px;">
                    <i class="fa-solid fa-circle-exclamation"></i> {{ session('testimonial_error') }}
                </div>
                @endif

                <form method="POST" action="{{ route('testimonials.store') }}">
                    @csrf
                    <div style="margin-bottom:20px;">
                        <label style="display:block; font-size:13px; font-weight:700; color:#374151; margin-bottom:10px; text-transform:uppercase; letter-spacing:.5px;">{{ __('messages.your_rating') }}</label>
                        <div style="display:flex; gap:10px;" id="test-star-container">
                            @for($i=1; $i<=5; $i++)
                            <i class="fa-regular fa-star" data-val="{{ $i }}"
                               onclick="setTestRating({{ $i }})"
                               onmouseover="hoverTestRating({{ $i }})"
                               onmouseout="resetTestHover()"
                               style="font-size:32px; color:#D1D5DB; cursor:pointer; transition:all .15s;"></i>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="test-rating" value="5"/>
                    </div>

                    <div style="margin-bottom:16px;">
                        <label style="display:block; font-size:13px; font-weight:700; color:#374151; margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">{{ __('messages.your_experience') }}</label>
                        <textarea name="message" rows="4"
                                  placeholder="Share your experience with Palama..."
                                  style="width:100%; border:1.5px solid #E5E7EB; border-radius:12px; padding:12px 16px; font-size:14px; outline:none; resize:vertical; box-sizing:border-box; font-family:'PT Sans',sans-serif; color:#111827; background:#F5F7FA; line-height:1.6;">{{ old('message') }}</textarea>
                        @error('message')<p style="color:#DC2626; font-size:12px; margin-top:4px;">{{ $message }}</p>@enderror
                    </div>

                    <div style="margin-bottom:24px;">
                        <label style="display:block; font-size:13px; font-weight:700; color:#374151; margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">{{ __('messages.your_location') }}</label>
                        <input type="text" name="location" value="{{ old('location') }}"
                               placeholder="e.g. Colombo, Kandy, Galle..."
                               style="width:100%; border:1.5px solid #E5E7EB; border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; color:#111827; background:#F5F7FA;"/>
                    </div>

                    <button type="submit"
                            style="width:100%; background:#1E3A8A; color:white; border:none; border-radius:12px; padding:14px; font-size:15px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif; transition:all .2s; display:flex; align-items:center; justify-content:center; gap:8px;"
                            onmouseover="this.style.background='#0A0F3D'"
                            onmouseout="this.style.background='#1E3A8A'">
                        <i class="fa-solid fa-paper-plane"></i> {{ __('messages.submit_testimonial') }}
                    </button>
                </form>
            </div>
            @else
            <div style="background:white; border-radius:20px; border:1.5px solid #E5E7EB; padding:40px; text-align:center; max-width:480px; margin:0 auto;">
                <i class="fa-solid fa-comment-dots" style="font-size:48px; color:#BFDBFE; display:block; margin-bottom:16px;"></i>
                <h3 style="font-size:20px; font-weight:700; color:#111827; margin-bottom:8px;">{{ __('messages.share_experience') }}</h3>
                <p style="font-size:14px; color:#6B7280; margin-bottom:24px; line-height:1.7;">Login to share your Palama experience.</p>
                <a href="{{ route('login') }}"
                   style="background:#1E3A8A; color:white; border-radius:12px; padding:12px 32px; font-size:15px; font-weight:700; text-decoration:none; display:inline-block;">
                    {{ __('messages.login_to_share') }}
                </a>
            </div>
            @endauth
        </div>
    </div>
</section>

@push('scripts')
<script>
var testRating = 5;
document.addEventListener('DOMContentLoaded', function() { updateTestStars(5); });
function setTestRating(r) { testRating = r; document.getElementById('test-rating').value = r; updateTestStars(r); }
function hoverTestRating(r) { updateTestStars(r); }
function resetTestHover() { updateTestStars(testRating); }
function updateTestStars(r) {
    document.querySelectorAll('#test-star-container i').forEach(function(star, i) {
        if (i < r) { star.className = 'fa-solid fa-star'; star.style.color = '#F59E0B'; }
        else { star.className = 'fa-regular fa-star'; star.style.color = '#D1D5DB'; }
    });
}
</script>
@endpush

{{-- CTA --}}
<section style="padding:80px 24px; background:white;">
    <div style="max-width:960px; margin:0 auto;">
        <div style="background:linear-gradient(135deg, #0A0F3D 0%, #1E3A8A 100%); border-radius:28px; padding:64px 48px; text-align:center; position:relative; overflow:hidden;" class="cta-grid">
            <div style="position:absolute; inset:0; background:radial-gradient(circle at 10% 50%, rgba(59,130,246,0.2) 0%, transparent 60%), radial-gradient(circle at 90% 30%, rgba(0,200,83,0.1) 0%, transparent 50%);"></div>
            <div style="position:relative; z-index:1;">
                <h2 style="font-size:38px; font-weight:700; color:white; margin-bottom:16px; line-height:1.2;">
                    {{ __('messages.cta_title') }}<br/>
                    <span style="color:#67E8F9;">{{ __('messages.cta_sub') }}</span>
                </h2>
                <p style="color:rgba(255,255,255,0.7); font-size:16px; margin-bottom:32px; line-height:1.7;">
                    Join {{ number_format($stats['providers']) }}+ providers earning money on Palama. Free to register, free to post.
                </p>
                <div style="display:flex; gap:14px; justify-content:center; flex-wrap:wrap;">
                    <a href="{{ route('register') }}"
                       style="background:#00C853; color:white; border-radius:14px; padding:16px 36px; font-size:16px; font-weight:700; text-decoration:none; display:inline-flex; align-items:center; gap:8px; transition:all .2s;"
                       onmouseover="this.style.background='#009624'"
                       onmouseout="this.style.background='#00C853'">
                        {{ __('messages.start_free') }}
                    </a>
                    <a href="{{ route('services.index') }}"
                       style="background:rgba(255,255,255,0.1); border:2px solid rgba(255,255,255,0.25); color:white; border-radius:14px; padding:16px 28px; font-size:16px; font-weight:700; text-decoration:none; display:inline-flex; align-items:center; gap:8px;"
                       onmouseover="this.style.background='rgba(255,255,255,0.2)'"
                       onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                        Browse Services
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection