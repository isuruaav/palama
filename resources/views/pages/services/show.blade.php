@extends('layouts.app')
@section('title', $service->title . ' — Palama')

@section('content')
<div style="max-width:1100px; margin:0 auto; padding:40px 24px;">

    <div style="font-size:13px; color:var(--text-light); margin-bottom:20px; font-weight:700;">
        <a href="{{ route('home') }}" style="color:var(--text-light); text-decoration:none;">Home</a>
        <span style="margin:0 6px;">›</span>
        <a href="{{ route('services.index') }}" style="color:var(--text-light); text-decoration:none;">{{ __('messages.browse_all') }}</a>
        <span style="margin:0 6px;">›</span>
        <span style="color:var(--text);">{{ Str::limit($service->title, 40) }}</span>
    </div>

    <div style="display:grid; grid-template-columns:1fr 320px; gap:32px;" class="show-grid">

        <div>
            @php $images = $service->getMedia('service-images'); @endphp

            @if($images->count())
            <div style="margin-bottom:28px;">
                <img id="main-image" src="{{ $images->first()->getUrl() }}"
                     style="width:100%; height:340px; object-fit:cover; border-radius:16px; border:1.5px solid var(--border); cursor:pointer; margin-bottom:10px;"
                     onclick="openImage(this.src)"/>
                @if($images->count() > 1)
                <div style="display:flex; gap:8px; flex-wrap:wrap;">
                    @foreach($images as $image)
                    <img src="{{ $image->getUrl() }}"
                         style="width:80px; height:60px; object-fit:cover; border-radius:8px; border:2px solid var(--border); cursor:pointer;"
                         onclick="document.getElementById('main-image').src='{{ $image->getUrl() }}'"
                         onmouseover="this.style.borderColor='var(--primary-light)'"
                         onmouseout="this.style.borderColor='var(--border)'"/>
                    @endforeach
                </div>
                @endif
            </div>
            @else
            <div style="width:100%; height:240px; background:var(--bg); border-radius:16px; border:1.5px solid var(--border); display:flex; align-items:center; justify-content:center; margin-bottom:28px;">
                <div style="text-align:center;">
                    <i class="fa-solid fa-image" style="font-size:48px; color:var(--border); display:block; margin-bottom:8px;"></i>
                    <p style="color:var(--text-light); font-size:13px;">No photos uploaded</p>
                </div>
            </div>
            @endif

            <h1 style="font-size:30px; font-weight:700; color:var(--text); margin-bottom:16px;">{{ $service->title }}</h1>

            <div style="display:flex; gap:8px; flex-wrap:wrap; margin-bottom:20px;">
                <span style="background:var(--primary-soft); color:var(--primary); font-size:12px; font-weight:700; padding:4px 12px; border-radius:20px;">{{ $service->category->name }}</span>
                @if($service->is_verified)
                <span style="background:var(--accent-soft); color:var(--accent-dark); font-size:12px; font-weight:700; padding:4px 12px; border-radius:20px;">✓ {{ __('messages.verified_provider') }}</span>
                @endif
                @if($service->is_emergency)
                <span style="background:#FEE2E2; color:#DC2626; font-size:12px; font-weight:700; padding:4px 12px; border-radius:20px;">🚨 {{ __('messages.available_247') }}</span>
                @endif
            </div>

            <div style="display:flex; align-items:center; gap:8px; margin-bottom:24px; flex-wrap:wrap;">
                <span style="color:#F59E0B; font-size:16px;">
                    @for($i=1; $i<=5; $i++)
                        <i class="fa-{{ $i <= round($service->avg_rating) ? 'solid' : 'regular' }} fa-star"></i>
                    @endfor
                </span>
                <span style="font-weight:700; color:var(--text);">{{ $service->avg_rating }}</span>
                <span style="color:var(--text-light); font-size:14px;">({{ $service->reviews_count }} {{ __('messages.reviews') }})</span>
                <span style="color:var(--text-light); font-size:14px;"><i class="fa-solid fa-eye"></i> {{ $service->views_count }}</span>
            </div>

            <div style="background:var(--card); border-radius:16px; border:1.5px solid var(--border); padding:28px; margin-bottom:24px;">
                <h3 style="font-size:18px; font-weight:700; color:var(--text); margin-bottom:16px;">{{ __('messages.about_service') }}</h3>
                <p style="color:var(--text-secondary); line-height:1.8; font-size:15px;">{{ $service->description }}</p>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-top:20px; padding-top:20px; border-top:1px solid var(--border);">
                    <div style="display:flex; align-items:center; gap:10px;">
                        <i class="fa-solid fa-location-dot" style="color:var(--primary-light);"></i>
                        <span style="font-size:14px; color:var(--text-secondary); font-weight:700;">{{ $service->location_text }}, {{ $service->district->name }}</span>
                    </div>
                    @if($service->available_hours)
                    <div style="display:flex; align-items:center; gap:10px;">
                        <i class="fa-solid fa-clock" style="color:#0369A1;"></i>
                        <span style="font-size:14px; color:var(--text-secondary); font-weight:700;">{{ $service->available_hours }}</span>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Reviews --}}
            <div style="background:var(--card); border-radius:16px; border:1.5px solid var(--border); padding:28px;">
                <h3 style="font-size:18px; font-weight:700; color:var(--text); margin-bottom:20px;">{{ __('messages.reviews') }} ({{ $service->reviews_count }})</h3>

                @auth
                    @if(auth()->id() !== $service->user_id)
                    <div style="background:var(--bg); border-radius:14px; border:1.5px solid var(--border); padding:20px; margin-bottom:24px;">
                        <h4 style="font-size:15px; font-weight:700; color:var(--text); margin-bottom:16px;">{{ __('messages.write_review') }}</h4>

                        @if(session('error'))
                        <div style="background:#FEE2E2; color:#DC2626; padding:10px 14px; border-radius:8px; font-size:13px; margin-bottom:12px; font-weight:700;">{{ session('error') }}</div>
                        @endif

                        <form method="POST" action="{{ route('reviews.store') }}">
                            @csrf
                            <input type="hidden" name="service_id" value="{{ $service->id }}"/>

                            <div style="margin-bottom:16px;">
                                <label style="display:block; font-size:13px; font-weight:700; color:var(--text); margin-bottom:8px;">{{ __('messages.your_rating') }}</label>
                                <div style="display:flex; gap:8px;" id="star-container">
                                    @for($i=1; $i<=5; $i++)
                                    <i class="fa-regular fa-star" data-rating="{{ $i }}"
                                       onclick="setRating({{ $i }})"
                                       onmouseover="hoverRating({{ $i }})"
                                       onmouseout="resetHover()"
                                       style="font-size:28px; color:var(--border); cursor:pointer;"></i>
                                    @endfor
                                </div>
                                <input type="hidden" name="rating" id="rating-input" value=""/>
                                @error('rating')<p style="color:#DC2626; font-size:12px; margin-top:4px;">{{ $message }}</p>@enderror
                            </div>

                            <div style="margin-bottom:16px;">
                                <label style="display:block; font-size:13px; font-weight:700; color:var(--text); margin-bottom:6px;">{{ __('messages.your_experience') }}</label>
                                <textarea name="comment" rows="3" placeholder="Share your experience..."
                                          style="width:100%; border:1.5px solid var(--border); border-radius:10px; padding:10px 14px; font-size:14px; outline:none; resize:vertical; box-sizing:border-box; font-family:'PT Sans',sans-serif; color:var(--text); background:var(--card);">{{ old('comment') }}</textarea>
                            </div>

                            <button type="submit"
                                    style="background:var(--primary); color:white; border:none; border-radius:10px; padding:10px 24px; font-size:14px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif;">
                                <i class="fa-solid fa-star"></i> {{ __('messages.submit_review') }}
                            </button>
                        </form>
                    </div>
                    @endif
                @else
                <div style="background:var(--bg); border-radius:12px; padding:16px; text-align:center; margin-bottom:24px; border:1.5px solid var(--border);">
                    <p style="font-size:14px; color:var(--text-secondary);">
                        <a href="{{ route('login') }}" style="color:var(--primary); font-weight:700; text-decoration:none;">{{ __('messages.login') }}</a> to write a review
                    </p>
                </div>
                @endauth

                @forelse($service->reviews as $review)
                <div style="border-bottom:1px solid var(--border); padding-bottom:16px; margin-bottom:16px;">
                    <div style="display:flex; align-items:center; gap:10px; margin-bottom:8px;">
                        <div style="width:38px; height:38px; border-radius:50%; background:var(--primary); display:flex; align-items:center; justify-content:center; color:white; font-weight:700; font-size:13px; flex-shrink:0;">
                            {{ strtoupper(substr($review->user->name, 0, 2)) }}
                        </div>
                        <div>
                            <div style="font-weight:700; font-size:14px; color:var(--text);">{{ $review->user->name }}</div>
                            <div style="color:#F59E0B; font-size:13px;">
                                @for($i=1; $i<=5; $i++)
                                    <i class="fa-{{ $i <= $review->rating ? 'solid' : 'regular' }} fa-star"></i>
                                @endfor
                                <span style="color:var(--text-light); font-size:12px; margin-left:4px;">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                    @if($review->comment)
                    <p style="font-size:14px; color:var(--text-secondary); line-height:1.6; margin-left:48px;">{{ $review->comment }}</p>
                    @endif
                </div>
                @empty
                <p style="color:var(--text-light); font-size:14px;">{{ __('messages.no_reviews') }}</p>
                @endforelse
            </div>
        </div>

        {{-- Sidebar --}}
        <div style="position:sticky; top:90px; height:fit-content;" class="show-sidebar">
            <div style="background:var(--card); border-radius:20px; border:1.5px solid var(--border); padding:28px; box-shadow:0 4px 20px rgba(30,58,138,0.08);">

                <div style="display:flex; align-items:center; gap:12px; margin-bottom:20px; padding-bottom:20px; border-bottom:1px solid var(--border);">
                    <div style="width:52px; height:52px; border-radius:50%; background:var(--primary); display:flex; align-items:center; justify-content:center; color:white; font-weight:700; font-size:18px;">
                        {{ strtoupper(substr($service->user->name, 0, 2)) }}
                    </div>
                    <div>
                        <div style="font-weight:700; font-size:16px; color:var(--text);">{{ $service->user->name }}</div>
                        <div style="font-size:13px; color:var(--text-secondary);">Service Provider</div>
                    </div>
                </div>

                <div style="margin-bottom:20px; padding-bottom:20px; border-bottom:1px solid var(--border);">
                    <div style="font-size:12px; color:var(--text-light); font-weight:700; text-transform:uppercase;">{{ __('messages.starting_from') }}</div>
                    <div style="font-size:30px; font-weight:700; color:var(--primary); margin-top:4px;">Rs. {{ number_format($service->price_from ?? 0) }}</div>
                </div>

                <div style="display:flex; flex-direction:column; gap:10px;">
                    <a href="tel:{{ $service->phone }}"
                       style="background:var(--primary); color:white; border-radius:12px; padding:14px; text-align:center; font-size:15px; font-weight:700; text-decoration:none; display:block; transition:all .2s;"
                       onmouseover="this.style.background='var(--primary-dark)'"
                       onmouseout="this.style.background='var(--primary)'">
                        <i class="fa-solid fa-phone"></i> {{ __('messages.call_now') }} — {{ $service->phone }}
                    </a>

                    @if($service->whatsapp)
                    <a href="https://wa.me/94{{ ltrim($service->whatsapp, '0') }}?text={{ urlencode('Hi, I found your service on Palama: ' . $service->title) }}"
                       target="_blank"
                       style="background:#25D366; color:white; border-radius:12px; padding:14px; text-align:center; font-size:15px; font-weight:700; text-decoration:none; display:block;">
                        <i class="fa-brands fa-whatsapp"></i> {{ __('messages.whatsapp') }}
                    </a>
                    @endif

                    <a href="{{ route('services.index') }}"
                       style="background:var(--bg); color:var(--text); border-radius:12px; padding:12px; text-align:center; font-size:14px; font-weight:700; text-decoration:none; display:block; border:1.5px solid var(--border);">
                        ← {{ __('messages.back_services') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@if($related->count())
<div style="background:var(--bg); padding:48px 24px;">
    <div style="max-width:1100px; margin:0 auto;">
        <h2 style="font-size:26px; font-weight:700; color:var(--text); margin-bottom:24px;">Similar Services</h2>
        <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:20px;" class="services-grid">
            @foreach($related as $rel)
                @include('components.service-card', ['service' => $rel])
            @endforeach
        </div>
    </div>
</div>
@endif

<div id="img-modal" onclick="this.style.display='none'"
     style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.92); z-index:9999; align-items:center; justify-content:center; cursor:pointer;">
    <img id="modal-img" style="max-width:90%; max-height:90vh; border-radius:12px;"/>
</div>

<script>
var currentRating = 0;

function setRating(rating) {
    currentRating = rating;
    document.getElementById('rating-input').value = rating;
    updateStars(rating);
}

function hoverRating(rating) { updateStars(rating); }
function resetHover() { updateStars(currentRating); }

function updateStars(rating) {
    document.querySelectorAll('#star-container i').forEach(function(star, index) {
        if (index < rating) {
            star.className = 'fa-solid fa-star';
            star.style.color = '#F59E0B';
        } else {
            star.className = 'fa-regular fa-star';
            star.style.color = 'var(--border)';
        }
    });
}

function openImage(url) {
    document.getElementById('modal-img').src = url;
    document.getElementById('img-modal').style.display = 'flex';
}
</script>
@endsection