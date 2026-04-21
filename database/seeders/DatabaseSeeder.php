<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin & User
        User::create([
            'name' => 'Admin System',
            'email' => 'admin@glowup.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Customer Test',
            'email' => 'test@test.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        // 2. Create Categories
        $categories = [
            ['name' => 'Skincare', 'slug' => 'skincare'],
            ['name' => 'Makeup', 'slug' => 'makeup'],
            ['name' => 'Body Care', 'slug' => 'body-care'],
            ['name' => 'Hair Care', 'slug' => 'hair-care'],
            ['name' => 'Fragrance', 'slug' => 'fragrance'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // 3. Create Products
        $products = [
            [
                'category_id' => 1,
                'name' => 'Radiant Glow Vita C Serum',
                'description' => 'Serum Vitamin C dengan persentase optimum untuk mencerahkan kulit kusam, menyamarkan noda hitam, dan meratakan warna kulit. Cepat meresap dan tidak lengket.',
                'keterangan' => 'Ukuran 30ml | Cocok untuk kulit kusam & noda hitam',
                'price' => 150000,
                'discount_price' => null,
                'stock' => 50,
                'brand' => 'GlowUp Naturals',
                'weight' => 150,
                'is_featured' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Hydrating Water Essence Toner',
                'description' => 'Toner dengan tekstur essence yang memberikan hidrasi mendalam dengan kandungan Hyaluronic Acid dan Centella Asiatica.',
                'keterangan' => 'Ukuran 150ml | Kulit kering & sensitif',
                'price' => 120000,
                'discount_price' => 95000,
                'stock' => 100,
                'brand' => 'GlowUp Naturals',
                'weight' => 200,
                'is_featured' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Matte Cover Cushion SPF 50',
                'description' => 'Cushion full coverage dengan hasil akhir velvet matte. Tahan lama hingga 12 jam dan melindungi dari sinar UV.',
                'keterangan' => 'Shade: Natural | Ketahanan 12 Jam',
                'price' => 185000,
                'discount_price' => null,
                'stock' => 30,
                'brand' => 'Flawless Beauty',
                'weight' => 250,
                'is_featured' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Velvet Lip Tint',
                'description' => 'Lip tint dengan tekstur velvet yang lembut dan tidak membuat bibir kering. Warnanya pigmented dan tahan lama dipakai seharian.',
                'keterangan' => 'Shade: Berry Crush | Tidak bikin kering',
                'price' => 89000,
                'discount_price' => 75000,
                'stock' => 80,
                'brand' => 'Flawless Beauty',
                'weight' => 50,
                'is_featured' => false,
            ],
            [
                'category_id' => 3,
                'name' => 'Shea Butter Body Lotion',
                'description' => 'Lotion tubuh dengan kandungan utama 100% pure shea butter untuk melembapkan kulit kering dan mengunci kelembapan selama 24 jam.',
                'keterangan' => 'Ukuran 250ml | Varian Vanilla',
                'price' => 110000,
                'discount_price' => null,
                'stock' => 45,
                'brand' => 'Pure Body',
                'weight' => 300,
                'is_featured' => true,
            ],
            [
                'category_id' => 5,
                'name' => 'Midnight Rose Eau De Parfum',
                'description' => 'Parfum mewah yang memadukan wangi elegan mawar demai dengan sentuhan musk dan vanilla. Tahan hingga 8 jam.',
                'keterangan' => 'Ukuran 50ml | Spray | Tahan 8 Jam',
                'price' => 250000,
                'discount_price' => 199000,
                'stock' => 20,
                'brand' => 'Aura Scents',
                'weight' => 200,
                'is_featured' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Soothing Aloe Vera Gel 99%',
                'description' => 'Gel multifungsi dengan kandungan 99% ekstrak lidah buaya yang dapat menenangkan kulit kemerahan, melembapkan, dan memberikan efek dingin seketika.',
                'keterangan' => 'Ukuran 300ml | Multifungsi Wajah & Tubuh',
                'price' => 75000,
                'discount_price' => 55000,
                'stock' => 150,
                'brand' => 'GlowUp Naturals',
                'weight' => 350,
                'is_featured' => false,
            ],
            [
                'category_id' => 4,
                'name' => 'Argan Oil Hair Serum',
                'description' => 'Serum rambut yang diperkaya dengan Argan Oil asal Maroko untuk memperbaiki rambut rusak, bercabang, dan membuat rambut lebih berkilau tanpa rasa lepek.',
                'keterangan' => 'Ukuran 100ml | Untuk rambut kering & rusak',
                'price' => 135000,
                'discount_price' => null,
                'stock' => 60,
                'brand' => 'Hair Wonder',
                'weight' => 150,
                'is_featured' => false,
            ]
        ];

        foreach ($products as $prod) {
            $prod['slug'] = Str::slug($prod['name']) . '-' . Str::random(5);
            Product::create($prod);
        }

        // 4. Create dummy banner
        Banner::create([
            'title' => 'Glow Up Sale!',
            'subtitle' => 'Diskon Spesial Skincare Hingga 50%',
            'description' => 'Nikmati promo spesial akhir pekan ini. Dapatkan potongan harga untuk semua varian skincare dari GlowUp Naturals dan brand unggulan lainnya. Persediaan terbatas!',
            'button_text' => 'Lihat Promo',
            'button_link' => '/products',
            'order' => 1,
            'is_active' => true,
        ]);
    }
}
