<nav style="background:var(--primary-dark); position:sticky; top:0; z-index:100; box-shadow:0 2px 20px rgba(10,15,61,0.4);">
    <div style="max-width:1280px; margin:0 auto; padding:0 20px; display:flex; align-items:center; justify-content:space-between; height:64px;">

        {{-- Logo --}}
        <a href="{{ route('home') }}" style="text-decoration:none; display:flex; align-items:center; gap:12px;">
            <img src="{{ asset('images/logo.png') }}" style="height:44px; width:auto;" alt="Palama"/>
            <div>
                <div style="font-family:'PT Sans',sans-serif; font-size:22px; font-weight:700; color:white; line-height:1;">Palama</div>
                <div style="font-family:'PT Sans',sans-serif; font-size:9px; font-weight:700; color:#00C853; letter-spacing:1.5px; line-height:1; margin-top:3px;">SERVICES MARKETPLACE</div>
            </div>
        </a>

        {{-- Desktop Search --}}
        <form action="{{ route('services.index') }}" method="GET" class="nav-search"
              style="flex:1; max-width:400px; margin:0 24px; display:flex; background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.15); border-radius:10px; overflow:hidden;">
            <input type="text" name="q" value="{{ request('q') }}"
                   placeholder="Search services..."
                   style="flex:1; background:transparent; border:none; outline:none; padding:9px 14px; color:white; font-size:14px; font-family:'PT Sans',sans-serif;"/>
            <button type="submit" style="background:var(--primary-light); border:none; padding:0 16px; cursor:pointer; color:white;">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>

        {{-- Desktop Nav --}}
        <div style="display:flex; align-items:center; gap:10px;" class="nav-search">

            <a href="{{ route('services.index') }}" style="color:rgba(255,255,255,0.8); text-decoration:none; font-size:14px; font-weight:700;">Browse</a>
            <a href="{{ route('services.emergency') }}" style="color:#67E8F9; text-decoration:none; font-size:14px; font-weight:700;">🚨 Emergency</a>

            {{-- Language Switcher — always visible --}}
            <div style="display:flex; gap:4px;">
                <a href="{{ route('language.switch', 'en') }}"
                   style="background:{{ app()->getLocale() == 'en' ? '#3B82F6' : 'rgba(255,255,255,0.1)' }}; color:white; border-radius:6px; padding:4px 10px; font-size:12px; font-weight:700; text-decoration:none; border:1px solid rgba(255,255,255,0.2);">
                    EN
                </a>
                <a href="{{ route('language.switch', 'si') }}"
                   style="background:{{ app()->getLocale() == 'si' ? '#3B82F6' : 'rgba(255,255,255,0.1)' }}; color:white; border-radius:6px; padding:4px 10px; font-size:12px; font-weight:700; text-decoration:none; border:1px solid rgba(255,255,255,0.2);">
                    සිං
                </a>
            </div>

            @auth
                <a href="{{ route('services.create') }}"
                   style="background:var(--accent); color:white; border-radius:9px; padding:8px 18px; font-size:14px; font-weight:700; text-decoration:none;">
                    + Post Ad
                </a>
                <a href="{{ route('dashboard') }}"
                   style="background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); color:white; border-radius:9px; padding:8px 16px; font-size:14px; font-weight:700; text-decoration:none;">
                    Dashboard
                </a>
                <a href="{{ route('profile.edit') }}"
                   style="color:rgba(255,255,255,0.7); text-decoration:none; font-size:14px;">
                    👤 {{ auth()->user()->name }}
                </a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none; border:none; color:rgba(255,255,255,0.5); cursor:pointer; font-size:13px; font-family:'PT Sans',sans-serif;">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" style="color:rgba(255,255,255,0.8); text-decoration:none; font-size:14px; font-weight:700;">Login</a>
                <a href="{{ route('register') }}"
                   style="background:var(--accent); color:white; border-radius:9px; padding:8px 18px; font-size:14px; font-weight:700; text-decoration:none;">
                    Register Free
                </a>
            @endauth
        </div>

        {{-- Mobile Hamburger --}}
        <button onclick="toggleMobileMenu()"
                style="background:rgba(255,255,255,0.1); border:none; color:white; border-radius:8px; width:40px; height:40px; cursor:pointer; font-size:16px; display:none; align-items:center; justify-content:center;"
                id="hamburger-btn">
            <i class="fa-solid fa-bars" id="hamburger-icon"></i>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu"
         style="display:none; background:#0d1a4a; border-top:1px solid rgba(255,255,255,0.1); padding:16px 20px;">

        <form action="{{ route('services.index') }}" method="GET"
              style="display:flex; background:rgba(255,255,255,0.08); border-radius:10px; overflow:hidden; margin-bottom:16px;">
            <input type="text" name="q" value="{{ request('q') }}"
                   placeholder="Search services..."
                   style="flex:1; background:transparent; border:none; outline:none; padding:10px 14px; color:white; font-size:14px;"/>
            <button type="submit" style="background:var(--primary-light); border:none; padding:0 14px; cursor:pointer; color:white;">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>

        {{-- Mobile Language Switcher — always visible --}}
        <div style="display:flex; gap:6px; padding:10px 4px; margin-bottom:4px;">
            <a href="{{ route('language.switch', 'en') }}"
               style="background:{{ app()->getLocale() == 'en' ? '#3B82F6' : 'rgba(255,255,255,0.1)' }}; color:white; border-radius:8px; padding:6px 16px; font-size:13px; font-weight:700; text-decoration:none; flex:1; text-align:center;">
                English
            </a>
            <a href="{{ route('language.switch', 'si') }}"
               style="background:{{ app()->getLocale() == 'si' ? '#3B82F6' : 'rgba(255,255,255,0.1)' }}; color:white; border-radius:8px; padding:6px 16px; font-size:13px; font-weight:700; text-decoration:none; flex:1; text-align:center;">
                සිංහල
            </a>
        </div>

        <div style="display:flex; flex-direction:column; gap:2px;">
            <a href="{{ route('home') }}" style="color:rgba(255,255,255,0.85); text-decoration:none; padding:11px 8px; font-size:14px; font-weight:700; border-bottom:1px solid rgba(255,255,255,0.06);">🏠 Home</a>
            <a href="{{ route('services.index') }}" style="color:rgba(255,255,255,0.85); text-decoration:none; padding:11px 8px; font-size:14px; font-weight:700; border-bottom:1px solid rgba(255,255,255,0.06);">🔍 Browse Services</a>
            <a href="{{ route('services.emergency') }}" style="color:#67E8F9; text-decoration:none; padding:11px 8px; font-size:14px; font-weight:700; border-bottom:1px solid rgba(255,255,255,0.06);">🚨 Emergency</a>

            @auth
            <a href="{{ route('services.create') }}" style="color:rgba(255,255,255,0.85); text-decoration:none; padding:11px 8px; font-size:14px; font-weight:700; border-bottom:1px solid rgba(255,255,255,0.06);">➕ Post Ad</a>
            <a href="{{ route('dashboard') }}" style="color:rgba(255,255,255,0.85); text-decoration:none; padding:11px 8px; font-size:14px; font-weight:700; border-bottom:1px solid rgba(255,255,255,0.06);">📊 Dashboard</a>
            <a href="{{ route('profile.edit') }}" style="color:rgba(255,255,255,0.85); text-decoration:none; padding:11px 8px; font-size:14px; font-weight:700; border-bottom:1px solid rgba(255,255,255,0.06);">👤 Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="background:none; border:none; color:rgba(255,255,255,0.5); cursor:pointer; font-size:14px; padding:11px 8px; width:100%; text-align:left; font-family:'PT Sans',sans-serif; font-weight:700;">🚪 Logout</button>
            </form>
            @else
            <a href="{{ route('login') }}" style="color:rgba(255,255,255,0.85); text-decoration:none; padding:11px 8px; font-size:14px; font-weight:700; border-bottom:1px solid rgba(255,255,255,0.06);">🔐 Login</a>
            <a href="{{ route('register') }}" style="color:#69F0AE; text-decoration:none; padding:11px 8px; font-size:14px; font-weight:700;">✨ Register Free</a>
            @endauth
        </div>
    </div>
</nav>

<style>
@media (max-width: 768px) {
    #hamburger-btn { display:flex !important; }
}
</style>

<script>
function toggleMobileMenu() {
    var menu = document.getElementById('mobile-menu');
    var icon = document.getElementById('hamburger-icon');
    if (menu.style.display === 'none') {
        menu.style.display = 'block';
        icon.className = 'fa-solid fa-xmark';
    } else {
        menu.style.display = 'none';
        icon.className = 'fa-solid fa-bars';
    }
}
</script>