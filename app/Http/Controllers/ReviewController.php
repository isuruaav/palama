<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Service;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'nullable|max:500',
        ]);

        // Already reviewed check
        $already = Review::where('service_id', $request->service_id)
                         ->where('user_id', auth()->id())
                         ->exists();

        if ($already) {
            return back()->with('error', 'You have already reviewed this service.');
        }

        Review::create([
            'service_id' => $request->service_id,
            'user_id'    => auth()->id(),
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ]);

        // Update avg_rating
        $service = Service::find($request->service_id);
        $service->update([
            'avg_rating'    => round($service->reviews()->avg('rating'), 1),
            'reviews_count' => $service->reviews()->count(),
        ]);

        return back()->with('success', 'Review submitted! Thank you.');
    }
}