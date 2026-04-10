@extends('layouts.app')
@section('title', 'Admin Dashboard — Palama')

@section('content')
<div style="min-height:100vh; background:#F5F7FA;">

    {{-- Top Header --}}
    <div style="background:linear-gradient(135deg, #0A0F3D 0%, #1E3A8A 100%); padding:32px 24px 80px;">
        <div style="max-width:1280px; margin:0 auto;">
            <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px;">
                <div>
                    <div style="display:flex; align-items:center; gap:10px; margin-bottom:6px;">
                        <div style="width:36px; height:36px; background:rgba(255,255,255,0.15); border-radius:10px; display:flex; align-items:center; justify-content:center;">
                            <i class="fa-solid fa-shield-halved" style="color:white; font-size:16px;"></i>
                        </div>
                        <span style="color:rgba(255,255,255,0.6); font-size:13px; font-weight:700; letter-spacing:1px; text-transform:uppercase;">Admin Panel</span>
                    </div>
                    <h1 style="font-size:30px; font-weight:700; color:white; margin-bottom:4px;">Admin Dashboard</h1>
                    <p style="color:rgba(255,255,255,0.6); font-size:14px;">Welcome back, {{ auth()->user()->name }}</p>
                </div>
                <div style="display:flex; gap:10px; flex-wrap:wrap;">
                    <a href="{{ route('admin.users.index') }}"
                       style="background:rgba(255,255,255,0.12); border:1px solid rgba(255,255,255,0.2); color:white; border-radius:10px; padding:10px 18px; font-size:13px; font-weight:700; text-decoration:none; display:flex; align-items:center; gap:6px; backdrop-filter:blur(10px);">
                        <i class="fa-solid fa-users"></i> Users
                    </a>
                    <a href="{{ route('admin.categories.index') }}"
                       style="background:rgba(255,255,255,0.12); border:1px solid rgba(255,255,255,0.2); color:white; border-radius:10px; padding:10px 18px; font-size:13px; font-weight:700; text-decoration:none; display:flex; align-items:center; gap:6px; backdrop-filter:blur(10px);">
                        <i class="fa-solid fa-grid-2"></i> Categories
                    </a>
                    <a href="{{ route('home') }}"
                       style="background:#00C853; color:white; border-radius:10px; padding:10px 18px; font-size:13px; font-weight:700; text-decoration:none; display:flex; align-items:center; gap:6px;">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i> View Site
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Cards (overlap header) --}}
    <div style="max-width:1280px; margin:-56px auto 0; padding:0 24px;">
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:32px;" class="dash-stats">
            <div style="background:white; border-radius:16px; border:1.5px solid #E5E7EB; padding:24px; box-shadow:0 4px 20px rgba(30,58,138,0.08);">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
                    <div style="width:44px; height:44px; background:#DBEAFE; border-radius:12px; display:flex; align-items:center; justify-content:center;">
                        <i class="fa-solid fa-users" style="color:#1E3A8A; font-size:18px;"></i>
                    </div>
                    <span style="background:#DBEAFE; color:#1E3A8A; font-size:11px; font-weight:700; padding:3px 8px; border-radius:20px;">+12%</span>
                </div>
                <div style="font-size:34px; font-weight:700; color:#111827;">{{ $stats['users'] }}</div>
                <div style="font-size:13px; color:#6B7280; font-weight:700; margin-top:2px;">Total Users</div>
            </div>

            <div style="background:white; border-radius:16px; border:1.5px solid #E5E7EB; padding:24px; box-shadow:0 4px 20px rgba(30,58,138,0.08);">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
                    <div style="width:44px; height:44px; background:#E8F5E9; border-radius:12px; display:flex; align-items:center; justify-content:center;">
                        <i class="fa-solid fa-briefcase" style="color:#009624; font-size:18px;"></i>
                    </div>
                    <span style="background:#E8F5E9; color:#009624; font-size:11px; font-weight:700; padding:3px 8px; border-radius:20px;">+8%</span>
                </div>
                <div style="font-size:34px; font-weight:700; color:#111827;">{{ $stats['services'] }}</div>
                <div style="font-size:13px; color:#6B7280; font-weight:700; margin-top:2px;">Total Services</div>
            </div>

            <div style="background:white; border-radius:16px; border:1.5px solid #E5E7EB; padding:24px; box-shadow:0 4px 20px rgba(30,58,138,0.08);">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
                    <div style="width:44px; height:44px; background:#FEF3C7; border-radius:12px; display:flex; align-items:center; justify-content:center;">
                        <i class="fa-solid fa-clock" style="color:#D97706; font-size:18px;"></i>
                    </div>
                    @if($stats['pending'] > 0)
                    <span style="background:#FEF3C7; color:#D97706; font-size:11px; font-weight:700; padding:3px 8px; border-radius:20px;">Needs action</span>
                    @endif
                </div>
                <div style="font-size:34px; font-weight:700; color:#D97706;">{{ $stats['pending'] }}</div>
                <div style="font-size:13px; color:#6B7280; font-weight:700; margin-top:2px;">Pending Approval</div>
            </div>

            <div style="background:white; border-radius:16px; border:1.5px solid #E5E7EB; padding:24px; box-shadow:0 4px 20px rgba(30,58,138,0.08);">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
                    <div style="width:44px; height:44px; background:#E8F5E9; border-radius:12px; display:flex; align-items:center; justify-content:center;">
                        <i class="fa-solid fa-circle-check" style="color:#009624; font-size:18px;"></i>
                    </div>
                    <span style="background:#E8F5E9; color:#009624; font-size:11px; font-weight:700; padding:3px 8px; border-radius:20px;">Live</span>
                </div>
                <div style="font-size:34px; font-weight:700; color:#009624;">{{ $stats['active'] }}</div>
                <div style="font-size:13px; color:#6B7280; font-weight:700; margin-top:2px;">Active Services</div>
            </div>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
        <div style="background:#E8F5E9; color:#009624; padding:14px 18px; border-radius:12px; font-size:14px; font-weight:700; margin-bottom:24px; display:flex; align-items:center; gap:8px; border:1px solid #A5D6A7;">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
        @endif

        <div style="display:grid; grid-template-columns:2fr 1fr; gap:24px; align-items:start;" class="show-grid">

            {{-- Left Column --}}
            <div>

                {{-- Pending Approval --}}
                @if($pending->count())
                <div style="background:white; border-radius:20px; border:1.5px solid #E5E7EB; overflow:hidden; margin-bottom:24px; box-shadow:0 2px 12px rgba(0,0,0,0.04);">
                    <div style="padding:20px 24px; border-bottom:1px solid #F3F4F6; display:flex; align-items:center; justify-content:space-between;">
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div style="width:10px; height:10px; background:#D97706; border-radius:50%; box-shadow:0 0 0 3px rgba(217,119,6,0.2);"></div>
                            <h2 style="font-size:17px; font-weight:700; color:#111827;">Pending Approval</h2>
                        </div>
                        <span style="background:#FEF3C7; color:#D97706; font-size:12px; font-weight:700; padding:4px 12px; border-radius:20px;">{{ $pending->count() }} waiting</span>
                    </div>

                    @foreach($pending as $service)
                    <div style="padding:18px 24px; border-bottom:1px solid #F9FAFB; display:flex; align-items:flex-start; justify-content:space-between; gap:12px; flex-wrap:wrap;"
                         onmouseover="this.style.background='#FFFBEB'"
                         onmouseout="this.style.background='transparent'">
                        <div style="flex:1; min-width:160px;">
                            <div style="font-weight:700; font-size:14px; color:#111827; margin-bottom:3px;">{{ $service->title }}</div>
                            <div style="font-size:12px; color:#6B7280; margin-bottom:4px;">
                                <i class="fa-solid fa-user" style="font-size:10px; margin-right:3px;"></i>{{ $service->user->name }}
                                <span style="margin:0 4px;">·</span>
                                <i class="fa-solid fa-tag" style="font-size:10px; margin-right:3px;"></i>{{ $service->category->name }}
                            </div>
                            <p style="font-size:12px; color:#9CA3AF; line-height:1.5;">{{ Str::limit($service->description, 80) }}</p>
                        </div>
                        <div style="display:flex; gap:6px; flex-shrink:0;">
                            <form method="POST" action="{{ route('admin.services.approve', $service) }}">
                                @csrf
                                <button type="submit"
                                        style="background:#009624; color:white; border:none; border-radius:8px; padding:8px 14px; font-size:12px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif;">
                                    ✓ Approve
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.services.reject', $service) }}">
                                @csrf
                                <button type="submit"
                                        style="background:#FEE2E2; color:#DC2626; border:none; border-radius:8px; padding:8px 14px; font-size:12px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif;">
                                    ✗ Reject
                                </button>
                            </form>
                            <a href="{{ route('services.show', $service) }}" target="_blank"
                               style="background:#F5F7FA; color:#6B7280; border-radius:8px; padding:8px 12px; font-size:12px; font-weight:700; text-decoration:none; border:1px solid #E5E7EB;">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div style="background:white; border-radius:20px; border:1.5px solid #E5E7EB; padding:20px 24px; margin-bottom:24px; display:flex; align-items:center; gap:12px;">
                    <div style="width:36px; height:36px; background:#E8F5E9; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                        <i class="fa-solid fa-circle-check" style="color:#009624;"></i>
                    </div>
                    <div>
                        <div style="font-weight:700; font-size:14px; color:#111827;">All caught up!</div>
                        <div style="font-size:12px; color:#6B7280;">No pending service approvals</div>
                    </div>
                </div>
                @endif

                {{-- Pending Testimonials --}}
                @if($pendingTestimonials->count())
                <div style="background:white; border-radius:20px; border:1.5px solid #E5E7EB; overflow:hidden; margin-bottom:24px; box-shadow:0 2px 12px rgba(0,0,0,0.04);">
                    <div style="padding:20px 24px; border-bottom:1px solid #F3F4F6; display:flex; align-items:center; justify-content:space-between;">
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div style="width:10px; height:10px; background:#3B82F6; border-radius:50%; box-shadow:0 0 0 3px rgba(59,130,246,0.2);"></div>
                            <h2 style="font-size:17px; font-weight:700; color:#111827;">Pending Testimonials</h2>
                        </div>
                        <span style="background:#DBEAFE; color:#1E3A8A; font-size:12px; font-weight:700; padding:4px 12px; border-radius:20px;">{{ $pendingTestimonials->count() }} new</span>
                    </div>

                    @foreach($pendingTestimonials as $t)
                    <div style="padding:16px 24px; border-bottom:1px solid #F9FAFB;"
                         onmouseover="this.style.background='#F0F9FF'"
                         onmouseout="this.style.background='transparent'">
                        <div style="display:flex; align-items:flex-start; justify-content:space-between; gap:12px; flex-wrap:wrap;">
                            <div style="flex:1; min-width:160px;">
                                <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px;">
                                    <div style="width:32px; height:32px; border-radius:50%; background:#1E3A8A; display:flex; align-items:center; justify-content:center; color:white; font-weight:700; font-size:11px; flex-shrink:0;">
                                        {{ strtoupper(substr($t->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight:700; font-size:13px; color:#111827;">{{ $t->name }}</div>
                                        <div style="font-size:11px; color:#9CA3AF;">{{ $t->location ?? 'No location' }} · {{ $t->created_at->diffForHumans() }}</div>
                                    </div>
                                    <div style="color:#F59E0B; font-size:12px; margin-left:4px;">
                                        @for($i=1; $i<=5; $i++)
                                            <i class="fa-{{ $i <= $t->rating ? 'solid' : 'regular' }} fa-star"></i>
                                        @endfor
                                    </div>
                                </div>
                                <p style="font-size:13px; color:#6B7280; line-height:1.6; font-style:italic; padding-left:40px;">"{{ Str::limit($t->message, 100) }}"</p>
                            </div>
                            <div style="display:flex; gap:6px; flex-shrink:0;">
                                <form method="POST" action="{{ route('admin.testimonials.approve', $t) }}">
                                    @csrf
                                    <button type="submit"
                                            style="background:#009624; color:white; border:none; border-radius:8px; padding:8px 14px; font-size:12px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif;">
                                        ✓ Approve
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.testimonials.delete', $t) }}">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            style="background:#FEE2E2; color:#DC2626; border:none; border-radius:8px; padding:8px 14px; font-size:12px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif;">
                                        ✗ Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- All Services --}}
                <div style="background:white; border-radius:20px; border:1.5px solid #E5E7EB; overflow:hidden; box-shadow:0 2px 12px rgba(0,0,0,0.04);">
                    <div style="padding:20px 24px; border-bottom:1px solid #F3F4F6; display:flex; align-items:center; justify-content:space-between;">
                        <h2 style="font-size:17px; font-weight:700; color:#111827;">All Services</h2>
                        <a href="{{ route('services.index') }}"
                           style="font-size:13px; color:#1E3A8A; font-weight:700; text-decoration:none;">View all →</a>
                    </div>

                    @foreach($services as $service)
                    <div style="padding:14px 24px; border-bottom:1px solid #F9FAFB; display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap; transition:all .15s;"
                         onmouseover="this.style.background='#F5F7FA'"
                         onmouseout="this.style.background='transparent'">
                        <div style="flex:1; min-width:160px;">
                            <div style="font-weight:700; font-size:13px; color:#111827;">{{ $service->title }}</div>
                            <div style="font-size:11px; color:#9CA3AF; margin-top:2px;">{{ $service->user->name }} · {{ $service->category->name }}</div>
                        </div>

                        <div style="display:flex; gap:6px; align-items:center; flex-wrap:wrap;">
                            @if($service->status === 'active')
                                <span style="background:#E8F5E9; color:#009624; font-size:11px; font-weight:700; padding:2px 8px; border-radius:20px;">Active</span>
                            @elseif($service->status === 'pending')
                                <span style="background:#FEF3C7; color:#D97706; font-size:11px; font-weight:700; padding:2px 8px; border-radius:20px;">Pending</span>
                            @else
                                <span style="background:#FEE2E2; color:#DC2626; font-size:11px; font-weight:700; padding:2px 8px; border-radius:20px;">Rejected</span>
                            @endif

                            <form method="POST" action="{{ route('admin.services.feature', $service) }}">
                                @csrf
                                <button type="submit"
                                        style="background:{{ $service->is_featured ? '#FEF3C7' : '#F5F7FA' }}; color:{{ $service->is_featured ? '#D97706' : '#9CA3AF' }}; border:1px solid {{ $service->is_featured ? '#FDE68A' : '#E5E7EB' }}; border-radius:6px; padding:3px 10px; font-size:11px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif;">
                                    ⭐ {{ $service->is_featured ? 'Featured' : 'Feature' }}
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.services.verify', $service) }}">
                                @csrf
                                <button type="submit"
                                        style="background:{{ $service->is_verified ? '#E8F5E9' : '#F5F7FA' }}; color:{{ $service->is_verified ? '#009624' : '#9CA3AF' }}; border:1px solid {{ $service->is_verified ? '#A5D6A7' : '#E5E7EB' }}; border-radius:6px; padding:3px 10px; font-size:11px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif;">
                                    ✓ {{ $service->is_verified ? 'Verified' : 'Verify' }}
                                </button>
                            </form>

                            @if($service->status === 'pending')
                            <form method="POST" action="{{ route('admin.services.approve', $service) }}">
                                @csrf
                                <button type="submit"
                                        style="background:#009624; color:white; border:none; border-radius:6px; padding:3px 10px; font-size:11px; font-weight:700; cursor:pointer; font-family:'PT Sans',sans-serif;">
                                    Approve
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Right Column --}}
            <div>

                {{-- Quick Links --}}
                <div style="background:white; border-radius:20px; border:1.5px solid #E5E7EB; padding:20px; margin-bottom:20px; box-shadow:0 2px 12px rgba(0,0,0,0.04);">
                    <h3 style="font-size:15px; font-weight:700; color:#111827; margin-bottom:16px;">Quick Actions</h3>
                    <div style="display:flex; flex-direction:column; gap:8px;">
                        <a href="{{ route('admin.users.index') }}"
                           style="display:flex; align-items:center; gap:10px; padding:12px 14px; background:#F5F7FA; border-radius:12px; text-decoration:none; color:#111827; transition:all .2s; border:1px solid #E5E7EB;"
                           onmouseover="this.style.background='#DBEAFE'; this.style.borderColor='#93C5FD'"
                           onmouseout="this.style.background='#F5F7FA'; this.style.borderColor='#E5E7EB'">
                            <div style="width:32px; height:32px; background:#DBEAFE; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                                <i class="fa-solid fa-users" style="color:#1E3A8A; font-size:13px;"></i>
                            </div>
                            <div>
                                <div style="font-size:13px; font-weight:700;">Manage Users</div>
                                <div style="font-size:11px; color:#9CA3AF;">Create, edit, delete users</div>
                            </div>
                            <i class="fa-solid fa-chevron-right" style="color:#9CA3AF; font-size:11px; margin-left:auto;"></i>
                        </a>

                        <a href="{{ route('admin.categories.index') }}"
                           style="display:flex; align-items:center; gap:10px; padding:12px 14px; background:#F5F7FA; border-radius:12px; text-decoration:none; color:#111827; transition:all .2s; border:1px solid #E5E7EB;"
                           onmouseover="this.style.background='#E8F5E9'; this.style.borderColor='#A5D6A7'"
                           onmouseout="this.style.background='#F5F7FA'; this.style.borderColor='#E5E7EB'">
                            <div style="width:32px; height:32px; background:#E8F5E9; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                                <i class="fa-solid fa-grid-2" style="color:#009624; font-size:13px;"></i>
                            </div>
                            <div>
                                <div style="font-size:13px; font-weight:700;">Manage Categories</div>
                                <div style="font-size:11px; color:#9CA3AF;">Add or remove categories</div>
                            </div>
                            <i class="fa-solid fa-chevron-right" style="color:#9CA3AF; font-size:11px; margin-left:auto;"></i>
                        </a>

                        <a href="{{ route('services.index') }}"
                           style="display:flex; align-items:center; gap:10px; padding:12px 14px; background:#F5F7FA; border-radius:12px; text-decoration:none; color:#111827; transition:all .2s; border:1px solid #E5E7EB;"
                           onmouseover="this.style.background='#FEF3C7'; this.style.borderColor='#FDE68A'"
                           onmouseout="this.style.background='#F5F7FA'; this.style.borderColor='#E5E7EB'">
                            <div style="width:32px; height:32px; background:#FEF3C7; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                                <i class="fa-solid fa-briefcase" style="color:#D97706; font-size:13px;"></i>
                            </div>
                            <div>
                                <div style="font-size:13px; font-weight:700;">Browse Services</div>
                                <div style="font-size:11px; color:#9CA3AF;">View all listings</div>
                            </div>
                            <i class="fa-solid fa-chevron-right" style="color:#9CA3AF; font-size:11px; margin-left:auto;"></i>
                        </a>

                        <a href="{{ route('services.emergency') }}"
                           style="display:flex; align-items:center; gap:10px; padding:12px 14px; background:#F5F7FA; border-radius:12px; text-decoration:none; color:#111827; transition:all .2s; border:1px solid #E5E7EB;"
                           onmouseover="this.style.background='#FEE2E2'; this.style.borderColor='#FCA5A5'"
                           onmouseout="this.style.background='#F5F7FA'; this.style.borderColor='#E5E7EB'">
                            <div style="width:32px; height:32px; background:#FEE2E2; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                                <i class="fa-solid fa-triangle-exclamation" style="color:#DC2626; font-size:13px;"></i>
                            </div>
                            <div>
                                <div style="font-size:13px; font-weight:700;">Emergency Services</div>
                                <div style="font-size:11px; color:#9CA3AF;">24/7 emergency listings</div>
                            </div>
                            <i class="fa-solid fa-chevron-right" style="color:#9CA3AF; font-size:11px; margin-left:auto;"></i>
                        </a>
                    </div>
                </div>

                {{-- Platform Overview --}}
                <div style="background:white; border-radius:20px; border:1.5px solid #E5E7EB; padding:20px; margin-bottom:20px; box-shadow:0 2px 12px rgba(0,0,0,0.04);">
                    <h3 style="font-size:15px; font-weight:700; color:#111827; margin-bottom:16px;">Platform Overview</h3>
                    <div style="display:flex; flex-direction:column; gap:12px;">
                        <div>
                            <div style="display:flex; justify-content:space-between; margin-bottom:5px;">
                                <span style="font-size:13px; color:#6B7280; font-weight:700;">Services Active</span>
                                <span style="font-size:13px; font-weight:700; color:#111827;">{{ $stats['active'] }}/{{ $stats['services'] }}</span>
                            </div>
                            <div style="background:#F3F4F6; border-radius:10px; height:8px; overflow:hidden;">
                                @php $pct = $stats['services'] > 0 ? round(($stats['active']/$stats['services'])*100) : 0; @endphp
                                <div style="width:{{ $pct }}%; height:100%; background:#009624; border-radius:10px; transition:width .5s;"></div>
                            </div>
                        </div>
                        <div>
                            <div style="display:flex; justify-content:space-between; margin-bottom:5px;">
                                <span style="font-size:13px; color:#6B7280; font-weight:700;">Pending Rate</span>
                                @php $pendPct = $stats['services'] > 0 ? round(($stats['pending']/$stats['services'])*100) : 0; @endphp
                                <span style="font-size:13px; font-weight:700; color:#111827;">{{ $pendPct }}%</span>
                            </div>
                            <div style="background:#F3F4F6; border-radius:10px; height:8px; overflow:hidden;">
                                <div style="width:{{ $pendPct }}%; height:100%; background:#D97706; border-radius:10px;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- System Info --}}
                <div style="background:linear-gradient(135deg, #0A0F3D 0%, #1E3A8A 100%); border-radius:20px; padding:20px;">
                    <h3 style="font-size:15px; font-weight:700; color:white; margin-bottom:16px;">System Info</h3>
                    <div style="display:flex; flex-direction:column; gap:10px;">
                        <div style="display:flex; justify-content:space-between; align-items:center;">
                            <span style="font-size:12px; color:rgba(255,255,255,0.6); font-weight:700;">Laravel</span>
                            <span style="background:rgba(255,255,255,0.1); color:rgba(255,255,255,0.9); font-size:12px; font-weight:700; padding:2px 8px; border-radius:6px;">v12</span>
                        </div>
                        <div style="display:flex; justify-content:space-between; align-items:center;">
                            <span style="font-size:12px; color:rgba(255,255,255,0.6); font-weight:700;">PHP</span>
                            <span style="background:rgba(255,255,255,0.1); color:rgba(255,255,255,0.9); font-size:12px; font-weight:700; padding:2px 8px; border-radius:6px;">{{ PHP_VERSION }}</span>
                        </div>
                        <div style="display:flex; justify-content:space-between; align-items:center;">
                            <span style="font-size:12px; color:rgba(255,255,255,0.6); font-weight:700;">Environment</span>
                            <span style="background:rgba(0,200,83,0.2); color:#69F0AE; font-size:12px; font-weight:700; padding:2px 8px; border-radius:6px;">{{ app()->environment() }}</span>
                        </div>
                        <div style="display:flex; justify-content:space-between; align-items:center;">
                            <span style="font-size:12px; color:rgba(255,255,255,0.6); font-weight:700;">Today</span>
                            <span style="background:rgba(255,255,255,0.1); color:rgba(255,255,255,0.9); font-size:12px; font-weight:700; padding:2px 8px; border-radius:6px;">{{ now()->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="height:48px;"></div>
</div>
@endsection