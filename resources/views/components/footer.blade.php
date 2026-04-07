<footer style="background:var(--primary-dark); color:rgba(255,255,255,0.65); padding:56px 24px 24px; margin-top:0;">
    <div style="max-width:1280px; margin:0 auto;">

        <div style="display:grid; grid-template-columns:2fr 1fr 1fr; gap:40px; margin-bottom:48px;" class="footer-grid">

            <div>
                <div style="display:flex; align-items:center; gap:12px; margin-bottom:16px;">
                    <img src="{{ asset('images/logo.png') }}" style="height:40px; width:auto;" alt="Palama"/>
                    <div>
                        <div style="font-family:'PT Sans',sans-serif; font-size:20px; font-weight:700; color:white; line-height:1;">Palama</div>
                        <div style="font-family:'PT Sans',sans-serif; font-size:9px; font-weight:700; color:#00C853; letter-spacing:1.5px; line-height:1; margin-top:3px;">SERVICES MARKETPLACE</div>
                    </div>
                </div>

                <p style="font-size:14px; line-height:1.75; max-width:280px; margin-bottom:16px;">
                    {{ __('messages.footer_desc') }}
                </p>
                <div style="font-size:14px; margin-bottom:16px;">
                    🚨 Emergency: <a href="tel:0094112345678" style="color:var(--accent); font-weight:700; text-decoration:none;">+94 11 234 5678</a>
                </div>
                <div style="display:flex; gap:10px;">
                    <a href="#" style="width:36px; height:36px; background:rgba(255,255,255,0.08); border-radius:8px; display:flex; align-items:center; justify-content:center; color:rgba(255,255,255,0.6); text-decoration:none; font-size:15px;">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="#" style="width:36px; height:36px; background:rgba(255,255,255,0.08); border-radius:8px; display:flex; align-items:center; justify-content:center; color:rgba(255,255,255,0.6); text-decoration:none; font-size:15px;">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="#" style="width:36px; height:36px; background:rgba(255,255,255,0.08); border-radius:8px; display:flex; align-items:center; justify-content:center; color:rgba(255,255,255,0.6); text-decoration:none; font-size:15px;">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                </div>
            </div>

            <div>
                <div style="font-weight:700; color:white; margin-bottom:16px; font-size:15px;">{{ __('messages.services_menu') }}</div>
                <div style="display:flex; flex-direction:column; gap:10px;">
                    <a href="{{ route('services.index') }}" style="color:rgba(255,255,255,0.6); text-decoration:none; font-size:14px;">{{ __('messages.browse_all') }}</a>
                    <a href="{{ route('services.emergency') }}" style="color:rgba(255,255,255,0.6); text-decoration:none; font-size:14px;">{{ __('messages.emergency') }}</a>
                    <a href="{{ route('services.create') }}" style="color:rgba(255,255,255,0.6); text-decoration:none; font-size:14px;">{{ __('messages.post_ad_free') }}</a>
                </div>
            </div>

            <div>
                <div style="font-weight:700; color:white; margin-bottom:16px; font-size:15px;">{{ __('messages.account') }}</div>
                <div style="display:flex; flex-direction:column; gap:10px;">
                    <a href="{{ route('login') }}" style="color:rgba(255,255,255,0.6); text-decoration:none; font-size:14px;">{{ __('messages.login') }}</a>
                    <a href="{{ route('register') }}" style="color:rgba(255,255,255,0.6); text-decoration:none; font-size:14px;">{{ __('messages.register') }}</a>
                    @auth
                    <a href="{{ route('dashboard') }}" style="color:rgba(255,255,255,0.6); text-decoration:none; font-size:14px;">{{ __('messages.dashboard') }}</a>
                    @endauth
                </div>
            </div>
        </div>

        <div style="border-top:1px solid rgba(255,255,255,0.08); padding-top:20px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px;">
            <div style="font-size:13px;">© {{ date('Y') }} Palama (Pvt) Ltd. Sri Lanka.</div>
            <div style="font-size:13px; color:rgba(255,255,255,0.4);">Made with ❤️ for Sri Lanka</div>
        </div>
    </div>

    {{-- WhatsApp Float --}}
    <a href="https://wa.me/94112345678" target="_blank"
       style="position:fixed; bottom:24px; right:24px; background:#25D366; color:white; width:56px; height:56px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:24px; box-shadow:0 4px 20px rgba(0,0,0,0.25); text-decoration:none; z-index:999;">
        <i class="fa-brands fa-whatsapp"></i>
    </a>
</footer>