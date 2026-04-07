<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'message'  => 'required|min:20|max:500',
            'rating'   => 'required|integer|min:1|max:5',
            'location' => 'nullable|max:100',
        ]);

        // Check already submitted
        $already = Testimonial::where('user_id', auth()->id())->exists();
        if ($already) {
            return back()->with('testimonial_error', 'You have already submitted a testimonial.');
        }

        Testimonial::create([
            'user_id'  => auth()->id(),
            'name'     => auth()->user()->name,
            'location' => $request->location,
            'message'  => $request->message,
            'rating'   => $request->rating,
            'is_approved' => false,
        ]);

        return back()->with('testimonial_success', 'Thank you! Your testimonial is pending approval.');
    }
}