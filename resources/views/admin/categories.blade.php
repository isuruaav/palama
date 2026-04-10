@extends('layouts.app')
@section('title', 'Categories — Admin')

@section('content')
<div style="max-width:1280px; margin:0 auto; padding:40px 24px;">

    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:32px; flex-wrap:wrap; gap:16px;">
        <div>
            <h1 style="font-size:32px; font-weight:700; color:var(--text); margin-bottom:4px;">Categories</h1>
            <p style="font-size:15px; color:var(--text-secondary);">Manage service categories</p>
        </div>
        <a href="{{ route('admin.index') }}"
           style="border:1.5px solid var(--border); color:var(--text); border-radius:10px; padding:10px 20px; font-size:14px; font-weight:700; text-decoration:none; background:white;">
            ← Admin Dashboard
        </a>
    </div>

    @if(session('success'))
    <div style="background:var(--accent-soft); color:var(--accent-dark); padding:12px 18px; border-radius:10px; font-size:14px; font-weight:700; margin-bottom:24px;">
        ✅ {{ session('success') }}
    </div>
    @endif

    <div style="display:grid; grid-template-columns:1fr 1fr; gap:32px;" class="show-grid">

        {{-- Add Category Form --}}
        <div>
            <div style="background:var(--card); border-radius:20px; border:1.5px solid var(--border); padding:32px;">
                <h2 style="font-size:20px; font-weight:700; color:var(--text); margin-bottom:24px;">
                    <i class="fa-solid fa-plus" style="color:var(--primary-light); margin-right:8px;"></i>Add New Category
                </h2>

                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf

                    <div style="margin-bottom:16px;">
                        <label style="display:block; font-size:13px; font-weight:700; color:var(--text); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Category Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               placeholder="e.g. Home & Property"
                               style="width:100%; border:1.5px solid var(--border); border-radius:10px; padding:11px 14px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; color:var(--text); background:var(--bg);"
                               oninput="autoSlug(this.value)"/>
                        @error('name')<p style="color:#DC2626; font-size:12px; margin-top:4px;">{{ $message }}</p>@enderror
                    </div>

                    <div style="margin-bottom:16px;">
                        <label style="display:block; font-size:13px; font-weight:700; color:var(--text); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Slug *</label>
                        <input type="text" name="slug" id="slug-input" value="{{ old('slug') }}" required
                               placeholder="e.g. home-property"
                               style="width:100%; border:1.5px solid var(--border); border-radius:10px; padding:11px 14px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; color:var(--text); background:var(--bg);"/>
                        @error('slug')<p style="color:#DC2626; font-size:12px; margin-top:4px;">{{ $message }}</p>@enderror
                    </div>

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:16px;">
                        <div>
                            <label style="display:block; font-size:13px; font-weight:700; color:var(--text); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Icon (Font Awesome)</label>
                            <input type="text" name="icon" value="{{ old('icon', 'fa-wrench') }}"
                                   placeholder="e.g. fa-house"
                                   style="width:100%; border:1.5px solid var(--border); border-radius:10px; padding:11px 14px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; color:var(--text); background:var(--bg);"/>
                            <p style="font-size:11px; color:var(--text-light); margin-top:4px;">fontawesome.com/icons</p>
                        </div>
                        <div>
                            <label style="display:block; font-size:13px; font-weight:700; color:var(--text); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Color</label>
                            <div style="display:flex; gap:8px; align-items:center;">
                                <input type="color" name="color" value="{{ old('color', '#1E3A8A') }}"
                                       style="width:48px; height:44px; border:1.5px solid var(--border); border-radius:10px; cursor:pointer; padding:2px;"/>
                                <input type="text" id="color-text" value="{{ old('color', '#1E3A8A') }}"
                                       style="flex:1; border:1.5px solid var(--border); border-radius:10px; padding:11px 14px; font-size:14px; outline:none; font-family:'PT Sans',sans-serif; color:var(--text); background:var(--bg);"/>
                            </div>
                        </div>
                    </div>

                    <div style="margin-bottom:16px;">
                        <label style="display:block; font-size:13px; font-weight:700; color:var(--text); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                               style="width:100%; border:1.5px solid var(--border); border-radius:10px; padding:11px 14px; font-size:14px; outline:none; box-sizing:border-box; font-family:'PT Sans',sans-serif; color:var(--text); background:var(--bg);"/>
                    </div>

                    <label style="display:flex; align-items:center; gap:10px; margin-bottom:20px; cursor:pointer; background:#FEF2F2; border-radius:10px; padding:12px 14px; border:1px solid #FECACA;">
                        <input type="checkbox" name="is_emergency" value="1" style="width:16px; height:16px; accent-color:#DC2626;"/>
                        <span style="font-size:13px; font-weight:700; color:#991B1B;">🚨 Emergency Category</span>
                    </label>

                    {{-- Icon Preview --}}
                    <div style="background:var(--bg); border-radius:10px; padding:14px; text-align:center; margin-bottom:20px; border:1.5px solid var(--border);">
                        <div style="font-size:11px; color:var(--text-light); margin-bottom:8px; font-weight:700;">PREVIEW</div>
                        <div id="icon-preview" style="width:48px; height:48px; background:#DBEAFE; border-radius:12px; display:flex; align-items:center; justify-content:center; margin:0 auto 8px;">
                            <i class="fa-solid fa-wrench" id="preview-icon" style="color:#1E3A8A; font-size:20px;"></i>
                        </div>
                        <div id="preview-name" style="font-size:13px; font-weight:700; color:var(--text);">Category Name</div>
                    </div>

                    <button type="submit"
                            style="width:100%; background:var(--primary); color:white; border:none; border-radius:12px; padding:14px; font-size:15px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif; transition:all .2s;"
                            onmouseover="this.style.background='var(--primary-dark)'"
                            onmouseout="this.style.background='var(--primary)'">
                        <i class="fa-solid fa-plus"></i> Add Category
                    </button>
                </form>
            </div>
        </div>

        {{-- Categories List --}}
        <div>
            <h2 style="font-size:20px; font-weight:700; color:var(--text); margin-bottom:16px;">
                All Categories
                <span style="background:var(--primary-soft); color:var(--primary); font-size:14px; padding:3px 10px; border-radius:20px; margin-left:8px;">{{ $categories->count() }}</span>
            </h2>

            @forelse($categories as $cat)
            <div style="background:var(--card); border:1.5px solid var(--border); border-radius:14px; padding:16px 20px; margin-bottom:10px; display:flex; align-items:center; gap:14px; transition:all .2s;"
                 onmouseover="this.style.borderColor='var(--primary-light)'"
                 onmouseout="this.style.borderColor='var(--border)'">

                {{-- Icon --}}
                <div style="width:44px; height:44px; border-radius:10px; background:{{ $cat->color }}20; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i class="fa-solid {{ $cat->icon ?? 'fa-wrench' }}" style="color:{{ $cat->color ?? '#1E3A8A' }}; font-size:18px;"></i>
                </div>

                {{-- Info --}}
                <div style="flex:1; min-width:0;">
                    <div style="font-weight:700; font-size:14px; color:var(--text);">{{ $cat->name }}</div>
                    <div style="font-size:12px; color:var(--text-secondary); margin-top:2px;">
                        /{{ $cat->slug }} · order: {{ $cat->sort_order }}
                        @if($cat->is_emergency)
                        · <span style="color:#DC2626; font-weight:700;">🚨 Emergency</span>
                        @endif
                    </div>
                </div>

                {{-- Services Count --}}
                <div style="text-align:center; min-width:50px;">
                    <div style="font-size:18px; font-weight:700; color:var(--primary);">{{ $cat->services()->count() }}</div>
                    <div style="font-size:10px; color:var(--text-light); font-weight:700;">services</div>
                </div>

                {{-- Delete --}}
                @if($cat->services()->count() == 0)
                <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}"
                      onsubmit="return confirm('Delete {{ $cat->name }}?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            style="background:#FEE2E2; color:#DC2626; border:none; border-radius:8px; padding:8px 12px; font-size:12px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif;">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
                @else
                <div style="width:36px; height:36px; background:var(--bg); border-radius:8px; display:flex; align-items:center; justify-content:center;" title="Has services — cannot delete">
                    <i class="fa-solid fa-lock" style="color:var(--text-light); font-size:12px;"></i>
                </div>
                @endif
            </div>
            @empty
            <div style="text-align:center; padding:40px; background:var(--bg); border-radius:16px; border:1.5px solid var(--border);">
                <p style="color:var(--text-light); font-size:14px;">No categories yet. Add one!</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<script>
// Auto slug from name
function autoSlug(name) {
    var slug = name.toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .trim();
    document.getElementById('slug-input').value = slug;
    document.getElementById('preview-name').textContent = name || 'Category Name';
}

// Icon preview
document.querySelector('input[name="icon"]').addEventListener('input', function() {
    var icon = document.getElementById('preview-icon');
    icon.className = 'fa-solid ' + this.value;
});

// Color sync
var colorPicker = document.querySelector('input[type="color"]');
var colorText = document.getElementById('color-text');

colorPicker.addEventListener('input', function() {
    colorText.value = this.value;
    document.getElementById('preview-icon').style.color = this.value;
    document.getElementById('icon-preview').style.background = this.value + '20';
});

colorText.addEventListener('input', function() {
    if (/^#[0-9A-Fa-f]{6}$/.test(this.value)) {
        colorPicker.value = this.value;
        document.getElementById('preview-icon').style.color = this.value;
        document.getElementById('icon-preview').style.background = this.value + '20';
    }
});
</script>
@endsection