<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $byName = Category::pluck('id', 'name'); // ['Sembako'=>1, ...]
        $samples = [
            ['name' => 'Beras 5kg',           'price' => 120000, 'stock' => 50, 'category' => 'Sembako'],
            ['name' => 'Minyak Goreng 1L',    'price' => 18000,  'stock' => 80, 'category' => 'Sembako'],
            ['name' => 'Gula Pasir 1kg',      'price' => 15000,  'stock' => 60, 'category' => 'Sembako'],
            ['name' => 'Keripik Singkong',    'price' => 12000,  'stock' => 100,'category' => 'Jajanan'],
            ['name' => 'Kacang Oven 200g',    'price' => 16000,  'stock' => 70, 'category' => 'Jajanan'],
            ['name' => 'Teh Botol 350ml',     'price' => 6000,   'stock' => 200,'category' => 'Minuman'],
            ['name' => 'Air Mineral 600ml',   'price' => 4000,   'stock' => 250,'category' => 'Minuman'],
            ['name' => 'Kopi Bubuk 200g',     'price' => 28000,  'stock' => 40, 'category' => 'Minuman'],
            ['name' => 'Anyaman Bambu',       'price' => 65000,  'stock' => 15, 'category' => 'Kerajinan'],
        ];

        foreach ($samples as $p) {
            $catId = $byName[$p['category']] ?? null;
            if (!$catId) continue;

            Product::firstOrCreate(
                ['name' => $p['name'], 'category_id' => $catId],
                ['price' => $p['price'], 'stock' => $p['stock']]
            );
        }
    }
}