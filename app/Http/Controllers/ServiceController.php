<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\District;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::active()->with(['user', 'category', 'district']);

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->q}%")
                    ->orWhere('description', 'like', "%{$request->q}%");
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }

        if ($request->filled('district')) {
            $query->where('district_id', $request->district);
        }

        if ($request->boolean('emergency')) {
            $query->where('is_emergency', true);
        }

        $services  = $query->orderBy('avg_rating', 'desc')->paginate(12)->withQueryString();
        $categories = Category::orderBy('sort_order')->get();
        $districts  = District::orderBy('name')->get();

        return view('pages.services.index', compact('services', 'categories', 'districts'));
    }

    public function show(Service $service)
    {
        $service->increment('views_count');
        $service->load(['user', 'category', 'district', 'reviews.user']);

        // Related services — same category, exclude current
        $related = Service::active()
            ->where('category_id', $service->category_id)
            ->where('id', '!=', $service->id)
            ->with(['user', 'category', 'district'])
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('pages.services.show', compact('service', 'related'));
    }

    public function emergency()
    {
        $services = Service::active()->emergency()
            ->with(['user', 'category', 'district'])
            ->get();
        return view('pages.services.emergency', compact('services'));
    }

    public function create()
    {
        $categories = Category::orderBy('sort_order')->get();
        $districts  = District::orderBy('name')->get();
        return view('pages.services.create', compact('categories', 'districts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'           => 'required|max:100',
            'category_id'     => 'required|exists:categories,id',
            'district_id'     => 'required|exists:districts,id',
            'description'     => 'required|min:20',
            'phone'           => 'required',
            'price_from'      => 'nullable|numeric|min:0',
            'whatsapp'        => 'nullable',
            'location_text'   => 'nullable',
            'available_hours' => 'nullable',
            'is_emergency'    => 'nullable',
        ]);

        $validated['user_id']     = auth()->id();
        $validated['slug']        = \Illuminate\Support\Str::slug($validated['title'] . '-' . \Illuminate\Support\Str::random(5));
        $validated['status']      = 'pending';
        $validated['is_emergency'] = $request->has('is_emergency') ? true : false;

        $service = Service::create($validated);

        // Image upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $service->addMedia($image)
                    ->toMediaCollection('service-images');
            }
        }

        return redirect()->route('services.my')
            ->with('success', 'Service submitted! Pending admin approval.');
    }

    public function myServices()
    {
        $services = Service::where('user_id', auth()->id())
            ->with(['category', 'district'])
            ->latest()
            ->get();
        return view('pages.services.my', compact('services'));
    }

    public function edit(Service $service)
    {
        $categories = Category::all();
        $districts  = District::all();
        return view('pages.services.edit', compact('service', 'categories', 'districts'));
    }

    public function update(Request $request, Service $service)
    {
        $service->update($request->all());
        return redirect()->route('services.my')->with('success', 'Updated!');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.my')->with('success', 'Deleted!');
    }
}
