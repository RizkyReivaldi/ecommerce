<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Elektronik',
                'slug' => 'elektronik',
                'description' => 'Perangkat electronik seperti smartphone, laptop, dan gadget lainnya',
                'is_active' => true,
            ],
            [
                'name' => 'Fashion Pria',
                'slug' => 'fashion_pria',
                'description' => 'Pakaian, sepatu, dan aksesoris',
                'is_active' => true,
            ],
            [
                'name' => 'Fashion Wanita',
                'slug' => 'fashion_wanita',
                'description' => 'Pakaian, sepatu, dan aksesoris',
                'is_active' => true,
            ],
            [
                'name' => 'Makanan & Minuman',
                'slug' => 'makanan-minuman',
                'description' => 'Berbagai makanan ringan, minuman, dan bahan makanan',
                'is_active' => true,
            ],
            [
                'name' => 'Kesehatan & Kecantikan',
                'slug' => 'kesehatan-kencantikan',
                'description' => 'Produk kesehatan, skin, dan kosmetik',
                'is_active' => true,
            ],
            [
                'name' => 'Rumah Tangga',
                'slug' => 'rumah-tangga',
                'description' => 'Peralatan rumah tangga dan dokorasi',
                'is_active' => true,
            ],

        ];

        foreach ($categories as $category) {
                Category::create($category);
        }

        $this->command->info('✅ categories seeded successfully');
    }
}
