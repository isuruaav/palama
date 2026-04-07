@extends('layouts.app')
@section('title', 'Post Your Service — Palama')

@section('content')
<div style="max-width:720px; margin:0 auto; padding:48px 24px;">

    <div style="margin-bottom:32px;">
        <h1 style="font-size:34px; font-weight:700; color:var(--text); margin-bottom:8px;">{{ __('messages.post_service') }}</h1>
        <p style="color:var(--text-secondary); font-size:15px;">{{ __('messages.post_service_desc') }}</p>
    </div>

    <form method="POST" action="{{ route('services.store') }}" enctype="multipart/form-data"
          style="background:var(--card); border-radius:20px; border:1.5px solid var(--border); padding:36px;">
        @csrf

        <div style="margin-bottom:20px;">
            <label style="display:block; font-size:14px; font-weight:700; color:var(--text); margin-bottom:8px;">{{ __('messages.service_title') }}</label>
            <input type="text" name="title" value="{{ old('title') }}" required
                   placeholder="e.g. AC Repair & Gas Refilling — All Brands"
                   style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; color:var(--text); background:var(--bg);"/>
            @error('title')<p style="color:#DC2626; font-size:12px; margin-top:4px;">{{ $message }}</p>@enderror
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:20px;">
            <div>
                <label style="display:block; font-size:14px; font-weight:700; color:var(--text); margin-bottom:8px;">{{ __('messages.category') }} *</label>
                <select name="category_id" style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; background:var(--bg); color:var(--text);">
                    <option value="">{{ __('messages.all_categories') }}</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id')<p style="color:#DC2626; font-size:12px; margin-top:4px;">{{ $message }}</p>@enderror
            </div>
            <div>
                <label style="display:block; font-size:14px; font-weight:700; color:var(--text); margin-bottom:8px;">{{ __('messages.district') }} *</label>
                <select name="district_id" style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; background:var(--bg); color:var(--text);">
                    <option value="">{{ __('messages.all_districts') }}</option>
                    @foreach($districts as $dist)
                        <option value="{{ $dist->id }}" {{ old('district_id') == $dist->id ? 'selected' : '' }}>{{ $dist->name }}</option>
                    @endforeach
                </select>
                @error('district_id')<p style="color:#DC2626; font-size:12px; margin-top:4px;">{{ $message }}</p>@enderror
            </div>
        </div>

        <div style="margin-bottom:20px;">
            <label style="display:block; font-size:14px; font-weight:700; color:var(--text); margin-bottom:8px;">{{ __('messages.description') }}</label>
            <textarea name="description" rows="5"
                      placeholder="Describe your service in detail — experience, brands you work with, areas you cover..."
                      style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; resize:vertical; font-family:'PT Sans',sans-serif; color:var(--text); background:var(--bg);">{{ old('description') }}</textarea>
            @error('description')<p style="color:#DC2626; font-size:12px; margin-top:4px;">{{ $message }}</p>@enderror
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:20px;">
            <div>
                <label style="display:block; font-size:14px; font-weight:700; color:var(--text); margin-bottom:8px;">{{ __('messages.price_from') }}</label>
                <input type="number" name="price_from" value="{{ old('price_from') }}" placeholder="e.g. 2500"
                       style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; background:var(--bg); color:var(--text);"/>
            </div>
            <div>
                <label style="display:block; font-size:14px; font-weight:700; color:var(--text); margin-bottom:8px;">{{ __('messages.phone') }} *</label>
                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="07X XXXXXXX"
                       style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; background:var(--bg); color:var(--text);"/>
                @error('phone')<p style="color:#DC2626; font-size:12px; margin-top:4px;">{{ $message }}</p>@enderror
            </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:20px;">
            <div>
                <label style="display:block; font-size:14px; font-weight:700; color:var(--text); margin-bottom:8px;">{{ __('messages.whatsapp') }}</label>
                <input type="text" name="whatsapp" value="{{ old('whatsapp') }}" placeholder="07X XXXXXXX"
                       style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; background:var(--bg); color:var(--text);"/>
            </div>
            <div>
                <label style="display:block; font-size:14px; font-weight:700; color:var(--text); margin-bottom:8px;">{{ __('messages.location') }}</label>
                <input type="text" name="location_text" value="{{ old('location_text') }}" placeholder="e.g. Colombo 7"
                       style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; background:var(--bg); color:var(--text);"/>
            </div>
        </div>

        <div style="margin-bottom:20px;">
            <label style="display:block; font-size:14px; font-weight:700; color:var(--text); margin-bottom:8px;">{{ __('messages.available_hours') }}</label>
            <input type="text" name="available_hours" value="{{ old('available_hours') }}" placeholder="e.g. Mon–Sat 8am–6pm"
                   style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; background:var(--bg); color:var(--text);"/>
        </div>

        {{-- Emergency Toggle --}}
        <label style="display:flex; align-items:center; gap:12px; background:#FEF2F2; border:1.5px solid #FECACA; border-radius:12px; padding:16px; margin-bottom:24px; cursor:pointer;">
            <input type="checkbox" name="is_emergency" value="1" {{ old('is_emergency') ? 'checked' : '' }}
                   style="width:18px; height:18px; accent-color:#DC2626;"/>
            <div>
                <div style="font-weight:700; color:#991B1B; font-size:14px;">{{ __('messages.emergency_service') }}</div>
                <div style="font-size:12px; color:#DC2626; margin-top:2px;">Customers can contact you anytime, day or night</div>
            </div>
        </label>

        {{-- Image Upload --}}
        <div style="margin-bottom:28px;">
            <label style="display:block; font-size:14px; font-weight:700; color:var(--text); margin-bottom:8px;">
                {{ __('messages.upload_photos') }}
                <span style="color:var(--text-light); font-weight:400;">(max 6)</span>
            </label>
            <div id="drop-zone" onclick="document.getElementById('images').click()"
                 style="border:2px dashed var(--border); border-radius:16px; padding:40px 24px; text-align:center; cursor:pointer; transition:all .2s; background:var(--bg);"
                 onmouseover="this.style.borderColor='#3B82F6'; this.style.background='#F0F7FF'"
                 onmouseout="this.style.borderColor='var(--border)'; this.style.background='var(--bg)'">
                <i class="fa-solid fa-cloud-arrow-up" style="font-size:36px; color:#3B82F6; display:block; margin-bottom:12px;"></i>
                <p style="font-size:14px; color:var(--text-secondary); margin-bottom:4px; font-weight:700;">Click to upload photos</p>
                <p style="font-size:12px; color:var(--text-light);">JPG, PNG, WebP · Max 3MB each</p>
            </div>
            <input type="file" id="images" name="images[]" multiple accept="image/*" style="display:none;"/>
            <div id="preview-grid" style="display:grid; grid-template-columns:repeat(3,1fr); gap:10px; margin-top:12px;"></div>
        </div>

        <button type="submit"
                style="width:100%; background:#1E3A8A; color:white; border:none; border-radius:14px; padding:16px; font-size:16px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif; transition:all .2s;"
                onmouseover="this.style.background='#0A0F3D'"
                onmouseout="this.style.background='#1E3A8A'">
            {{ __('messages.post_free_btn') }}
        </button>
    </form>
</div>

<script>
document.getElementById('images').addEventListener('change', function() {
    const grid = document.getElementById('preview-grid');
    grid.innerHTML = '';
    [...this.files].slice(0, 6).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            grid.innerHTML += `
                <div style="position:relative;">
                    <img src="${e.target.result}"
                         style="width:100%; aspect-ratio:4/3; object-fit:cover; border-radius:10px; border:1.5px solid var(--border);"/>
                </div>`;
        };
        reader.readAsDataURL(file);
    });
});
</script>
@endsection