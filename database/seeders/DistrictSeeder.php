<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\District;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        $districts = [
            'Colombo', 'Gampaha', 'Kalutara',
            'Kandy', 'Matale', 'Nuwara Eliya',
            'Galle', 'Matara', 'Hambantota',
            'Jaffna', 'Kilinochchi', 'Mannar', 'Vavuniya', 'Mullaitivu',
            'Batticaloa', 'Ampara', 'Trincomalee',
            'Kurunegala', 'Puttalam',
            'Anuradhapura', 'Polonnaruwa',
            'Badulla', 'Monaragala',
            'Ratnapura', 'Kegalle',
        ];

        foreach ($districts as $name) {
            District::create(['name' => $name]);
        }
    }
}