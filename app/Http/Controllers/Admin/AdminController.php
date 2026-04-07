<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use App\Models\Testimonial;

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
            'pending', 'services', 'stats', 'pendingTestimonials'
        ));
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