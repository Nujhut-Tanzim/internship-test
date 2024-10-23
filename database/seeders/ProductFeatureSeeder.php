<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = Product::create([
            'name' => 'Sample Product',
            'image' => 'download.jfif',
        ]);


        $features = [
            ['feature_name' => 'Feature 1'],
            ['feature_name' => 'Feature 2'],
            ['feature_name' => 'Feature 3'],
        ];

        foreach ($features as $feature) {
            $product->features()->create($feature);
        }
    }
}
