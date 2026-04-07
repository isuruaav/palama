<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;

class SitemapController extends Controller
{
    public function index()
    {
        $services   = Service::active()->latest()->get();
        $categories = Category::all();

        return response()->view('sitemap', compact('services', 'categories'))
                         ->header('Content-Type', 'application/xml');
    }
}