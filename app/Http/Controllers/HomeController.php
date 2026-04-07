<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('sort_order')->get();

        $featured = Service::active()
            ->with(['user', 'category', 'district'])
            ->orderBy('avg_rating', 'desc')
            ->take(6)
            ->get();

        $emergency = Service::active()
            ->emergency()
            ->with(['category', 'district'])
            ->take(4)
            ->get();

        $stats = [
            'providers' => User::where('account_type', 'provider')->count(),
            'services'  => Service::active()->count(),
        ];

        $testimonials = \App\Models\Testimonial::approved()
            ->latest()
            ->take(6)
            ->get();

        return view('pages.home', compact('categories', 'featured', 'emergency', 'stats', 'testimonials'));
    }
}
