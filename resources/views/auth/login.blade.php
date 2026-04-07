<x-guest-layout>
<style>
:root {
    --primary-dark:  #0A0F3D;
    --primary:       #1E3A8A;
    --primary-light: #3B82F6;
    --primary-soft:  #DBEAFE;
    --accent:        #00C853;
    --accent-dark:   #009624;
    --accent-soft:   #E8F5E9;
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
<div style="background:white; border-radius:24px; border:1.5px solid #E5E7EB; padding:40px; width:100%; max-width:440px; box-shadow:0 8px 32px rgba(30,58,138,0.08);">

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
        <h1 style="font-size:22px; font-weight:700; color:#111827; margin:20px 0 4px;">{{ __('messages.welcome_back') }}</h1>
        <p style="font-size:14px; color:#6B7280;">{{ __('messages.login_account') }}</p>
    </div>

    @if(session('status'))
    <div style="background:#E8F5E9; color:#009624; padding:12px 16px; border-radius:10px; font-size:14px; margin-bottom:20px; font-weight:700;">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div style="margin-bottom:16px;">
            <label style="display:block; font-size:14px; font-weight:700; color:#111827; margin-bottom:6px;">{{ __('messages.email') }}</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                   style="width:100%; border:1.5px solid #E5E7EB; border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; color:#111827; background:#F5F7FA;"/>
            @error('email')<p style="color:#DC2626; font-size:12px; margin-top:4px;">{{ $message }}</p>@enderror
        </div>

        <div style="margin-bottom:16px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:6px;">
                <label style="font-size:14px; font-weight:700; color:#111827;">{{ __('messages.password') }}</label>
                @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}" style="font-size:13px; color:#3B82F6; text-decoration:none; font-weight:700;">{{ __('messages.forgot_password') }}</a>
                @endif
            </div>
            <input type="password" name="password" required
                   style="width:100%; border:1.5px solid #E5E7EB; border-radius:12px; padding:12px 16px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; background:#F5F7FA;"/>
            @error('password')<p style="color:#DC2626; font-size:12px; margin-top:4px;">{{ $message }}</p>@enderror
        </div>

        <label style="display:flex; align-items:center; gap:8px; margin-bottom:24px; cursor:pointer;">
            <input type="checkbox" name="remember" style="width:16px; height:16px; accent-color:#1E3A8A;"/>
            <span style="font-size:14px; color:#111827;">{{ __('messages.remember_me') }}</span>
        </label>

        <button type="submit"
                style="width:100%; background:#1E3A8A; color:white; border:none; border-radius:12px; padding:14px; font-size:15px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif;">
            <i class="fa-solid fa-right-to-bracket"></i> {{ __('messages.login') }}
        </button>

        <div style="background:#F5F7FA; border-radius:10px; padding:12px 16px; margin-top:16px; text-align:center; border:1.5px solid #E5E7EB;">
            <p style="font-size:12px; color:#6B7280; margin-bottom:4px; font-weight:700;">Admin account</p>
            <p style="font-size:12px; color:#6B7280;">admin@palama.lk · Admin@123</p>
        </div>

        <p style="text-align:center; margin-top:20px; font-size:14px; color:#6B7280;">
            {{ __('messages.no_account') }}
            <a href="{{ route('register') }}" style="color:#1E3A8A; font-weight:700; text-decoration:none;">{{ __('messages.register_free') }}</a>
        </p>
    </form>
</div>
</div>
</x-guest-layout>