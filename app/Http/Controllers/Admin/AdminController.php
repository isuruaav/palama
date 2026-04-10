<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use App\Models\Testimonial;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        $pending  = Service::where('status', 'pending')->with(['user', 'category'])->get();
        $services = Service::with(['user', 'category'])->latest()->take(20)->get();

        $stats = [
            'users'    => User::count(),
            'services' => Service::count(),
            'pending'  => Service::where('status', 'pending')->count(),
            'active'   => Service::where('status', 'active')->count(),
        ];

        $pendingTestimonials = Testimonial::where('is_approved', false)
            ->with('user')
            ->latest()
            ->get();

        return view('admin.dashboard', compact(
            'pending',
            'services',
            'stats',
            'pendingTestimonials'
        ));
    }

    // Categories
    public function categories()
    {
        $categories = \App\Models\Category::orderBy('sort_order')->get();
        return view('admin.categories', compact('categories'));
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'name'       => 'required|max:100',
            'slug'       => 'required|unique:categories,slug|max:100',
            'icon'       => 'nullable|max:50',
            'color'      => 'nullable|max:20',
            'sort_order' => 'nullable|integer',
        ]);

        \App\Models\Category::create([
            'name'         => $request->name,
            'slug'         => \Illuminate\Support\Str::slug($request->slug),
            'icon'         => $request->icon ?? 'fa-wrench',
            'color'        => $request->color ?? '#1E3A8A',
            'sort_order'   => $request->sort_order ?? 0,
            'is_emergency' => $request->boolean('is_emergency'),
        ]);

        return back()->with('success', 'Category added!');
    }

    public function categoryDestroy(\App\Models\Category $category)
    {
        $category->delete();
        return back()->with('success', 'Category deleted.');
    }

    public function approve(Service $service)
    {
        $service->update(['status' => 'active']);
        return back()->with('success', 'Service approved!');
    }

    public function reject(Service $service)
    {
        $service->update(['status' => 'rejected']);
        return back()->with('success', 'Service rejected.');
    }

    public function feature(Service $service)
    {
        $service->update(['is_featured' => !$service->is_featured]);
        $msg = $service->is_featured ? 'Service featured!' : 'Service unfeatured.';
        return back()->with('success', $msg);
    }

    public function verify(Service $service)
    {
        $service->update(['is_verified' => !$service->is_verified]);
        $msg = $service->is_verified ? 'Provider verified!' : 'Provider unverified.';
        return back()->with('success', $msg);
    }

    public function approveTestimonial(Testimonial $testimonial)
    {
        $testimonial->update(['is_approved' => true]);
        return back()->with('success', 'Testimonial approved!');
    }

    public function deleteTestimonial(Testimonial $testimonial)
    {
        $testimonial->delete();
        return back()->with('success', 'Testimonial deleted.');
    }
}
