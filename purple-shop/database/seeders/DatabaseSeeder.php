<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Audio', 'Wearables', 'Gaming', 'Accessories'];

        foreach ($categories as $catName) {
            $category = Category::create([
                'name' => $catName,
                'slug' => Str::slug($catName),
            ]);

            if ($catName === 'Audio') {
                Product::create([
                    'category_id' => $category->id,
                    'name' => 'Apex Pro Wireless ANC',
                    'slug' => 'apex-pro-wireless-anc',
                    'description' => 'Active noise-canceling headphones with spatial audio and 40h battery life.',
                    'price' => 249.00,
                    'is_featured' => true,
                ]);
                Product::create([
                    'category_id' => $category->id,
                    'name' => 'Studio Pulse Earbuds',
                    'slug' => 'studio-pulse-earbuds',
                    'description' => 'Ultra-lightweight true wireless earbuds with deep bass response.',
                    'price' => 129.00,
                    'is_featured' => false,
                ]);
            }

            if ($catName === 'Wearables') {
                Product::create([
                    'category_id' => $category->id,
                    'name' => 'Vortex Smartwatch Ultra',
                    'slug' => 'vortex-smartwatch-ultra',
                    'description' => 'Titanium casing, sapphire crystal display, and bio-tracking sensors.',
                    'price' => 399.00,
                    'is_featured' => true,
                ]);
            }

            if ($catName === 'Gaming') {
                Product::create([
                    'category_id' => $category->id,
                    'name' => 'CyberGrip Mechanical Keyboard',
                    'slug' => 'cybergrip-mechanical-keyboard',
                    'description' => 'Hot-swappable RGB mechanical keyboard with purple custom switches.',
                    'price' => 179.00,
                    'is_featured' => true,
                ]);
            }

            if ($catName === 'Accessories') {
                Product::create([
                    'category_id' => $category->id,
                    'name' => 'MagGlow Wireless Charging Pad',
                    'slug' => 'magglow-wireless-charging-pad',
                    'description' => 'Fast 15W magnetic charger with subtle purple ambient ring lighting.',
                    'price' => 49.00,
                    'is_featured' => false,
                ]);
            }
        }
    }
}