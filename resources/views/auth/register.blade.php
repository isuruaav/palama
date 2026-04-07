<x-guest-layout>
<style>
:root {
    --primary-dark:  #0A0F3D;
    --primary:       #1E3A8A;
    --primary-light: #3B82F6;
    --primary-soft:  #DBEAFE;
    --accent:        #00C853;
    --bg:            #F5F7FA;
    --card:          #FFFFFF;
    --border:        #E5E7EB;
    --text:          #111827;
    --text-secondary:#6B7280;
    --text-light:    #9CA3AF;
}
</style>

<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&family=Noto+Sans+Sinhala:wght@400;700&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<div style="min-height:100vh; background:#F5F7FA; display:flex; align-items:center; justify-content:center; padding:24px; font-family:{{ session('locale') == 'si' ? '\'Noto Sans Sinhala\'' : '\'PT Sans\'' }},sans-serif;">
<div style="background:white; border-radius:24px; border:1.5px solid #E5E7EB; padding:40px; width:100%; max-width:480px; box-shadow:0 8px 32px rgba(30,58,138,0.08);">

    {{-- Language Switcher --}}
    <div style="display:flex; justify-content:flex-end; gap:6px; margin-bottom:20px;">
        <a href="{{ route('language.switch', 'en') }}"
           style="background:{{ session('locale', 'en') == 'en' ? '#3B82F6' : '#E5E7EB' }}; color:{{ session('locale', 'en') == 'en' ? 'white' : '#6B7280' }}; border-radius:6px; padding:4px 10px; font-size:12px; font-weight:700; text-decoration:none;">
            EN
        </a>
        <a href="{{ route('language.switch', 'si') }}"
           style="background:{{ session('locale') == 'si' ? '#3B82F6' : '#E5E7EB' }}; color:{{ session('locale') == 'si' ? 'white' : '#6B7280' }}; border-radius:6px; padding:4px 10px; font-size:12px; font-weight:700; text-decoration:none;">
            සිං
        </a>
    </div>

    {{-- Logo --}}
    <div style="text-align:center; margin-bottom:32px;">
        <a href="{{ route('home') }}" style="text-decoration:none; display:inline-flex; align-items:center; gap:12px; justify-content:center;">
            <img src="{{ asset('images/logo_b.png') }}" style="height:48px; width:auto;" alt="Palama"/>
            <div style="text-align:left;">
                <div style="font-family:'PT Sans',sans-serif; font-size:22px; font-weight:700; color:#111827; line-height:1;">Palama</div>
                <div style="font-family:'PT Sans',sans-serif; font-size:9px; font-weight:700; color:#00C853; letter-spacing:1.5px; margin-top:3px;">SERVICES MARKETPLACE</div>
            </div>
        </a>
        <h1 style="font-size:22px; font-weight:700; color:#111827; margin:20px 0 4px;">{{ __('messages.create_account') }}</h1>
        <p style="font-size:14px; color:#6B7280;">{{ __('messages.join_thousands') }}</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Account Type --}}
        <div style="margin-bottom:20px;">
            <label style="display:block; font-size:14px; font-weight:700; color:#111827; margin-bottom:10px;">{{ __('messages.i_want_to') }}</label>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px;">
                <div id="btn-customer" onclick="selectType('customer')"
                     style="border:2px solid #1E3A8A; background:#DBEAFE; border-radius:12px; padding:14px; text-align:center; cursor:pointer;">
                    <input type="radio" name="account_type" value="customer" id="radio-customer" checked style="display:none;"/>
                    <i class="fa-solid fa-magnifying-glass" style="font-size:20px; color:#1E3A8A; display:block; margin-bottom:6px;"></i>
                    <div style="font-weight:700; font-size:13px; color:#111827;">{{ __('messages.find_services_btn') }}</div>
                    <div style="font-size:11px; color:#6B7280;">{{ __('messages.customer') }}</div>
                </div>
                <div id="btn-provider" onclick="selectType('provider')"
                     style="border:2px solid #E5E7EB; background:white; border-radius:12px; padding:14px; text-align:center; cursor:pointer;">
                    <input type="radio" name="account_type" value="provider" id="radio-provider" style="display:none;"/>
                    <i class="fa-solid fa-briefcase" style="font-size:20px; color:#9CA3AF; display:block; margin-bottom:6px;"></i>
                    <div style="font-weight:700; font-size:13px; color:#111827;">{{ __('messages.offer_services') }}</div>
                    <div style="font-size:11px; color:#6B7280;">{{ __('messages.provider') }}</div>
                </div>
            </div>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block; font-size:14px; font-weight:700; color:#111827; margin-bottom:6px;">{{ __('messages.full_name') }}</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   style="width:100%; border:1.5px solid #E5E7EB; border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; color:#111827; background:#F5F7FA;"/>
            @error('name')<p style="color:#DC2626; font-size:12px; margin-top:4px;">{{ $message }}</p>@enderror
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block; font-size:14px; font-weight:700; color:#111827; margin-bottom:6px;">{{ __('messages.email') }}</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   style="width:100%; border:1.5px solid #E5E7EB; border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; color:#111827; background:#F5F7FA;"/>
            @error('email')<p style="color:#DC2626; font-size:12px; margin-top:4px;">{{ $message }}</p>@enderror
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block; font-size:14px; font-weight:700; color:#111827; margin-bottom:6px;">{{ __('messages.phone') }}</label>
            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="07X XXXXXXX"
                   style="width:100%; border:1.5px solid #E5E7EB; border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; color:#111827; background:#F5F7FA;"/>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block; font-size:14px; font-weight:700; color:#111827; margin-bottom:6px;">{{ __('messages.password') }}</label>
            <input type="password" name="password" required
                   style="width:100%; border:1.5px solid #E5E7EB; border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; background:#F5F7FA;"/>
            @error('password')<p style="color:#DC2626; font-size:12px; margin-top:4px;">{{ $message }}</p>@enderror
        </div>

        <div style="margin-bottom:24px;">
            <label style="display:block; font-size:14px; font-weight:700; color:#111827; margin-bottom:6px;">{{ __('messages.confirm_password') }}</label>
            <input type="password" name="password_confirmation" required
                   style="width:100%; border:1.5px solid #E5E7EB; border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; background:#F5F7FA;"/>
        </div>

        <button type="submit"
                style="width:100%; background:#1E3A8A; color:white; border:none; border-radius:12px; padding:14px; font-size:15px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif;">
            {{ __('messages.register_free') }}
        </button>

        <p style="text-align:center; margin-top:20px; font-size:14px; color:#6B7280;">
            {{ __('messages.already_account') }}
            <a href="{{ route('login') }}" style="color:#1E3A8A; font-weight:700; text-decoration:none;">{{ __('messages.login') }}</a>
        </p>
    </form>
</div>
</div>

<script>
function selectType(type) {
    document.getElementById('btn-customer').style.border = '2px solid #E5E7EB';
    document.getElementById('btn-customer').style.background = 'white';
    document.getElementById('btn-customer').querySelector('i').style.color = '#9CA3AF';

    document.getElementById('btn-provider').style.border = '2px solid #E5E7EB';
    document.getElementById('btn-provider').style.background = 'white';
    document.getElementById('btn-provider').querySelector('i').style.color = '#9CA3AF';

    document.getElementById('btn-' + type).style.border = '2px solid #1E3A8A';
    document.getElementById('btn-' + type).style.background = '#DBEAFE';
    document.getElementById('btn-' + type).querySelector('i').style.color = '#1E3A8A';

    document.getElementById('radio-' + type).checked = true;
}
</script>
</x-guest-layout>