@extends('layouts.app')
@section('title', 'Browse Services — SevaSL')

@section('content')
<div style="max-width:1280px; margin:0 auto; padding:40px 24px;">

    <div style="margin-bottom:28px;">
        <h1 style="font-size:32px; font-weight:700; color:var(--text); margin-bottom:6px;">Browse Services</h1>
        <p style="font-size:15px; color:var(--text-secondary);">{{ $services->total() }} services found across Sri Lanka</p>
    </div>

    <div style="display:grid; grid-template-columns:280px 1fr; gap:32px;" class="index-grid">

        {{-- Sidebar Filter --}}
        <div>
            <form method="GET" action="{{ route('services.index') }}"
                  style="background:var(--card); border-radius:20px; border:1.5px solid var(--border); padding:24px; position:sticky; top:90px;" class="filter-sticky">

                <h3 style="font-size:17px; font-weight:700; color:var(--text); margin-bottom:20px;">
                    <i class="fa-solid fa-sliders" style="color:var(--primary-light); margin-right:8px;"></i>Filter Services
                </h3>

                <label style="display:block; font-size:13px; font-weight:700; color:var(--text); margin-bottom:6px;">Keyword</label>
                <input type="text" name="q" value="{{ request('q') }}"
                       placeholder="AC repair, tutor..."
                       style="width:100%; border:1.5px solid var(--border); border-radius:10px; padding:10px 14px; font-size:14px; outline:none; margin-bottom:16px; box-sizing:border-box; font-family:'PT Sans',sans-serif; color:var(--text); background:var(--bg);"/>

                <label style="display:block; font-size:13px; font-weight:700; color:var(--text); margin-bottom:6px;">Category</label>
                <select name="category"
                        style="width:100%; border:1.5px solid var(--border); border-radius:10px; padding:10px 14px; font-size:14px; outline:none; margin-bottom:16px; box-sizing:border-box; font-family:'PT Sans',sans-serif; color:var(--text); background:var(--bg);">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>

                <label style="display:block; font-size:13px; font-weight:700; color:var(--text); margin-bottom:6px;">District</label>
                <select name="district"
                        style="width:100%; border:1.5px solid var(--border); border-radius:10px; padding:10px 14px; font-size:14px; outline:none; margin-bottom:16px; box-sizing:border-box; font-family:'PT Sans',sans-serif; color:var(--text); background:var(--bg);">
                    <option value="">All Districts</option>
                    @foreach($districts as $dist)
                        <option value="{{ $dist->id }}" {{ request('district') == $dist->id ? 'selected' : '' }}>
                            {{ $dist->name }}
                        </option>
                    @endforeach
                </select>

                <label style="display:flex; align-items:center; gap:8px; margin-bottom:20px; cursor:pointer; background:var(--bg); border-radius:10px; padding:10px 14px; border:1.5px solid var(--border);">
                    <input type="checkbox" name="emergency" value="1" {{ request('emergency') ? 'checked' : '' }}
                           style="width:16px; height:16px; accent-color:#DC2626;"/>
                    <span style="font-size:14px; color:var(--text); font-weight:700;">🚨 Emergency Only</span>
                </label>

                <button type="submit"
                        style="width:100%; background:var(--primary); color:white; border:none; border-radius:10px; padding:12px; font-size:14px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif; transition:all .2s;"
                        onmouseover="this.style.background='var(--primary-dark)'"
                        onmouseout="this.style.background='var(--primary)'">
                    <i class="fa-solid fa-magnifying-glass"></i> Search
                </button>

                @if(request()->hasAny(['q','category','district','emergency']))
                <a href="{{ route('services.index') }}"
                   style="display:block; text-align:center; margin-top:10px; font-size:13px; color:var(--text-light); text-decoration:none; font-weight:700;">
                    ✕ Clear filters
                </a>
                @endif
            </form>
        </div>

        {{-- Results --}}
        <div>
            @if($services->count())
                <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:20px;" class="services-grid">
                    @foreach($services as $service)
                        @include('components.service-card', ['service' => $service])
                    @endforeach
                </div>
                <div style="margin-top:32px;">
                    {{ $services->links() }}
                </div>
            @else
                <div style="text-align:center; padding:80px 24px; background:var(--card); border-radius:20px; border:1.5px solid var(--border);">
                    <i class="fa-solid fa-magnifying-glass" style="font-size:48px; color:var(--border); margin-bottom:16px; display:block;"></i>
                    <h3 style="font-size:20px; font-weight:700; color:var(--text); margin-bottom:8px;">No services found</h3>
                    <p style="color:var(--text-light); font-size:14px; margin-bottom:20px;">Try different keywords or clear filters</p>
                    <a href="{{ route('services.index') }}"
                       style="background:var(--primary); color:white; border-radius:10px; padding:10px 24px; font-size:14px; font-weight:700; text-decoration:none;">
                        Clear Filters
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection