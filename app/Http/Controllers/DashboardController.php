<?php

namespace App\Http\Controllers;

use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $myServices = Service::where('user_id', $user->id)
            ->with(['category', 'district'])
            ->latest()
            ->get();

        $stats = [
            'total'   => $myServices->count(),
            'active'  => $myServices->where('status', 'active')->count(),
            'pending' => $myServices->where('status', 'pending')->count(),
            'views'   => $myServices->sum('views_count'),
        ];

        return view('pages.dashboard.index', compact('myServices', 'stats'));
    }
}