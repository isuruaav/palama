@extends('layouts.app')
@section('title', 'Edit Service — SevaSL')

@section('content')
<div style="max-width:720px; margin:0 auto; padding:48px 24px;">

    <div style="margin-bottom:32px;">
        <h1 style="font-size:34px; font-weight:700; color:var(--text); margin-bottom:8px;">Edit Service</h1>
        <p style="color:var(--text-secondary); font-size:15px;">Update your service details</p>
    </div>

    <form method="POST" action="{{ route('services.update', $service) }}"
          style="background:var(--card); border-radius:20px; border:1.5px solid var(--border); padding:36px;">
        @csrf
        @method('PUT')

        <div style="margin-bottom:20px;">
            <label style="display:block; font-size:14px; font-weight:700; color:var(--text); margin-bottom:8px;">Service Title *</label>
            <input type="text" name="title" value="{{ old('title', $service->title) }}" required
                   style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; color:var(--text); background:var(--bg);"/>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:20px;">
            <div>
                <label style="display:block; font-size:14px; font-weight:700; color:var(--text); margin-bottom:8px;">Category *</label>
                <select name="category_id" style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; background:var(--bg); color:var(--text);">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $service->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="display:block; font-size:14px; font-weight:700; color:var(--text); margin-bottom:8px;">District *</label>
                <select name="district_id" style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; background:var(--bg); color:var(--text);">
                    @foreach($districts as $dist)
                        <option value="{{ $dist->id }}" {{ $service->district_id == $dist->id ? 'selected' : '' }}>{{ $dist->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div style="margin-bottom:20px;">
            <label style="display:block; font-size:14px; font-weight:700; color:var(--text); margin-bottom:8px;">Description *</label>
            <textarea name="description" rows="5"
                      style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; resize:vertical; font-family:'PT Sans',sans-serif; color:var(--text); background:var(--bg);">{{ old('description', $service->description) }}</textarea>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:20px;">
            <div>
                <label style="display:block; font-size:14px; font-weight:700; color:var(--text); margin-bottom:8px;">Starting Price (Rs.)</label>
                <input type="number" name="price_from" value="{{ old('price_from', $service->price_from) }}"
                       style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; background:var(--bg); color:var(--text);"/>
            </div>
            <div>
                <label style="display:block; font-size:14px; font-weight:700; color:var(--text); margin-bottom:8px;">Phone *</label>
                <input type="text" name="phone" value="{{ old('phone', $service->phone) }}"
                       style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; background:var(--bg); color:var(--text);"/>
            </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:20px;">
            <div>
                <label style="display:block; font-size:14px; font-weight:700; color:var(--text); margin-bottom:8px;">WhatsApp</label>
                <input type="text" name="whatsapp" value="{{ old('whatsapp', $service->whatsapp) }}"
                       style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; background:var(--bg); color:var(--text);"/>
            </div>
            <div>
                <label style="display:block; font-size:14px; font-weight:700; color:var(--text); margin-bottom:8px;">Location</label>
                <input type="text" name="location_text" value="{{ old('location_text', $service->location_text) }}"
                       style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; background:var(--bg); color:var(--text);"/>
            </div>
        </div>

        <div style="margin-bottom:20px;">
            <label style="display:block; font-size:14px; font-weight:700; color:var(--text); margin-bottom:8px;">Available Hours</label>
            <input type="text" name="available_hours" value="{{ old('available_hours', $service->available_hours) }}"
                   placeholder="e.g. Mon–Sat 8am–6pm"
                   style="width:100%; border:1.5px solid var(--border); border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; background:var(--bg); color:var(--text);"/>
        </div>

        <label style="display:flex; align-items:center; gap:12px; background:#FEF2F2; border:1.5px solid #FECACA; border-radius:12px; padding:16px; margin-bottom:28px; cursor:pointer;">
            <input type="checkbox" name="is_emergency" value="1" {{ $service->is_emergency ? 'checked' : '' }}
                   style="width:18px; height:18px; accent-color:#DC2626;"/>
            <div>
                <div style="font-weight:700; color:#991B1B; font-size:14px;">🚨 24/7 Emergency Service</div>
                <div style="font-size:12px; color:#DC2626; margin-top:2px;">Customers can contact you anytime</div>
            </div>
        </label>

        <div style="display:flex; gap:12px;">
            <button type="submit"
                    style="flex:1; background:var(--primary); color:white; border:none; border-radius:12px; padding:14px; font-size:15px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif; transition:all .2s;"
                    onmouseover="this.style.background='var(--primary-dark)'"
                    onmouseout="this.style.background='var(--primary)'">
                💾 Save Changes
            </button>
            <a href="{{ route('services.my') }}"
               style="flex:1; background:var(--bg); color:var(--text); border-radius:12px; padding:14px; font-size:15px; font-weight:700; text-decoration:none; text-align:center; display:block; border:1.5px solid var(--border);">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection