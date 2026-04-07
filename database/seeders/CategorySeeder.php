<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Home & Property',     'slug' => 'home-property',     'icon' => 'fa-house',           'color' => '#E07B00', 'sort_order' => 1],
            ['name' => 'Electrical Works',    'slug' => 'electrical',        'icon' => 'fa-bolt',            'color' => '#CA8A04', 'sort_order' => 2],
            ['name' => 'Plumbing',            'slug' => 'plumbing',          'icon' => 'fa-faucet',          'color' => '#0284C7', 'sort_order' => 3],
            ['name' => 'Vehicle & Transport', 'slug' => 'vehicle-transport', 'icon' => 'fa-car',             'color' => '#D97706', 'sort_order' => 4, 'is_emergency' => true],
            ['name' => 'Beauty & Care',       'slug' => 'beauty-care',       'icon' => 'fa-scissors',        'color' => '#BE185D', 'sort_order' => 5],
            ['name' => 'Events & Occasions',  'slug' => 'events',            'icon' => 'fa-camera',          'color' => '#16A34A', 'sort_order' => 6],
            ['name' => 'Education & Tutoring', 'slug' => 'education',         'icon' => 'fa-graduation-cap',  'color' => '#1D4ED8', 'sort_order' => 7],
            ['name' => 'IT & Digital',        'slug' => 'it-digital',        'icon' => 'fa-laptop',          'color' => '#0E7C7B', 'sort_order' => 8],
            ['name' => 'CCTV & Security',     'slug' => 'cctv-security',     'icon' => 'fa-shield',          'color' => '#7C3AED', 'sort_order' => 9],
            ['name' => 'Cleaning Services',   'slug' => 'cleaning',          'icon' => 'fa-broom',           'color' => '#059669', 'sort_order' => 10],
            ['name' => 'Carpentry & Welding', 'slug' => 'carpentry',         'icon' => 'fa-hammer',          'color' => '#C2410C', 'sort_order' => 11],
            ['name' => 'Mobile & Electronics', 'slug' => 'mobile-electronics', 'icon' => 'fa-mobile',          'color' => '#475569', 'sort_order' => 12],
            ['name' => 'Solar & Generator',   'slug' => 'solar-generator',   'icon' => 'fa-sun',             'color' => '#D97706', 'sort_order' => 13],
            ['name' => 'Pest Control',        'slug' => 'pest-control',      'icon' => 'fa-bug',             'color' => '#A16207', 'sort_order' => 14],
            ['name' => 'Health & Elderly Care', 'slug' => 'health-elderly',   'icon' => 'fa-heart-pulse',     'color' => '#E11D48', 'sort_order' => 15],
            ['name' => 'Agriculture & Outdoor', 'slug' => 'agriculture',      'icon' => 'fa-leaf',            'color' => '#65A30D', 'sort_order' => 16],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}
