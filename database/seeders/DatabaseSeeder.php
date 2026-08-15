<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Extra;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemExtra;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        
        Schema::disableForeignKeyConstraints();
        OrderItemExtra::truncate();
        OrderItem::truncate();
        Order::truncate();
        Product::truncate();
        Category::truncate();
        Extra::truncate();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        // 2. Buat User (Admin & Customer)
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@kopi.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
        ]);

        User::create([
            'name' => 'Customer Test',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone' => '089876543210',            
        ]);

        // 3. Buat Extras / Topping
        Extra::insert([
            ['name' => 'Extra Shot', 'price' => 5000, 'is_available' => true, 'category' => 'Coffee', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Oat Milk', 'price' => 8000, 'is_available' => true, 'category' => 'Coffee', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Caramel Sauce', 'price' => 3000, 'is_available' => true, 'category' => 'Coffee', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Vanilla Syrup', 'price' => 3000, 'is_available' => true, 'category' => 'Coffee', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cream Cheese', 'price' => 5000, 'is_available' => true, 'category' => 'Coffee', 'created_at' => now(), 'updated_at' => now()],
            
            // Snack Toppings
            ['name' => 'Saus Sambal', 'price' => 0, 'is_available' => true, 'category' => 'Snack', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Saus Tomat', 'price' => 0, 'is_available' => true, 'category' => 'Snack', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mayones', 'price' => 3000, 'is_available' => true, 'category' => 'Snack', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bumbu Pedas', 'price' => 2000, 'is_available' => true, 'category' => 'Snack', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 4. Data Master Menu
        $menuData = [
            'Signature Coffee' => [
                ['name' => 'Salted Creme Brulee', 'price' => 28000],
                ['name' => 'No Name', 'price' => 28000],
                ['name' => 'Terserah Kopi Susu', 'price' => 27000],
                ['name' => 'Sekedar Kopi Susu', 'price' => 25000],
                ['name' => 'Kopi Susu Biasa Aja', 'price' => 25000],
                ['name' => 'Irish Coffee', 'price' => 25000],
                ['name' => 'Ngaspal', 'price' => 25000],
                ['name' => 'Matcha Caramel', 'price' => 20000],
                ['name' => 'Vanilla Caramel', 'price' => 20000],
                ['name' => 'Taro Caramel', 'price' => 20000],
            ],
            'Coffee' => [
                ['name' => 'Americano Hot', 'price' => 15000],
                ['name' => 'Americano Cold', 'price' => 18000],
                ['name' => 'Sanger Hot', 'price' => 15000],
                ['name' => 'Sanger Cold', 'price' => 18000],
                ['name' => 'Coffee Chocolate Hot', 'price' => 15000],
                ['name' => 'Coffee Chocolate Cold', 'price' => 18000],
                ['name' => 'Coffee Milo Hot', 'price' => 20000],
                ['name' => 'Coffee Milo Cold', 'price' => 23000],
                ['name' => 'Caramel Macchiato Hot', 'price' => 23000],
                ['name' => 'Caramel Macchiato Cold', 'price' => 25000],
                ['name' => 'Sebatas Kopi Susu Hot', 'price' => 22000],
                ['name' => 'Sebatas Kopi Susu Cold', 'price' => 25000],
                ['name' => 'White Chocolate Coffee Hot', 'price' => 23000],
                ['name' => 'White Chocolate Coffee Cold', 'price' => 25000],
            ],
            'Es Coffee' => [
                ['name' => 'Es Kopi Regal', 'price' => 18000],
                ['name' => 'Es Kopi Strawberry', 'price' => 22000],
                ['name' => 'Es Kopi Caramel', 'price' => 22000],
                ['name' => 'Es Kopi Vanilla', 'price' => 22000],
                ['name' => 'Es Kopi Taro', 'price' => 22000],
                ['name' => 'Es Kopi Red Velvet', 'price' => 22000],
                ['name' => 'Es Kopi Matcha', 'price' => 22000],
                ['name' => 'Es Kopi Kocok', 'price' => 18000],
                ['name' => 'Es Kopi Gula Aren', 'price' => 22000],
            ],
            'Latte' => [
                ['name' => 'Milo Latte Hot', 'price' => 13000],
                ['name' => 'Milo Latte Cold', 'price' => 15000],
                ['name' => 'Strawberry Latte Hot', 'price' => 13000],
                ['name' => 'Strawberry Latte Cold', 'price' => 15000],
                ['name' => 'Matcha Latte Hot', 'price' => 13000],
                ['name' => 'Matcha Latte Cold', 'price' => 15000],
                ['name' => 'Vanilla Latte Hot', 'price' => 13000],
                ['name' => 'Vanilla Latte Cold', 'price' => 15000],
                ['name' => 'Caramel Latte Hot', 'price' => 13000],
                ['name' => 'Caramel Latte Cold', 'price' => 15000],
                ['name' => 'Taro Latte Hot', 'price' => 13000],
                ['name' => 'Taro Latte Cold', 'price' => 15000],
                ['name' => 'Irish Latte Hot', 'price' => 17000],
                ['name' => 'Irish Latte Cold', 'price' => 20000],
            ],
            'Teh' => [
                ['name' => 'Teh Vanilla Hot', 'price' => 13000],
                ['name' => 'Teh Vanilla Cold', 'price' => 15000],
                ['name' => 'Teh Lemon Hot', 'price' => 13000],
                ['name' => 'Teh Lemon Cold', 'price' => 15000],
                ['name' => 'Teh Matcha Hot', 'price' => 13000],
                ['name' => 'Teh Matcha Cold', 'price' => 15000],
                ['name' => 'Teh Apple Hot', 'price' => 13000],
                ['name' => 'Teh Apple Cold', 'price' => 15000],
                ['name' => 'Teh Irish Hot', 'price' => 15000],
                ['name' => 'Teh Irish Cold', 'price' => 17000],
            ],
            'Milkshake' => [
                ['name' => 'Milkshake Milo', 'price' => 15000],
                ['name' => 'Milkshake Strawberry', 'price' => 15000],
                ['name' => 'Milkshake Matcha', 'price' => 15000],
                ['name' => 'Milkshake Vanilla', 'price' => 15000],
                ['name' => 'Milkshake Chocolate', 'price' => 15000],
                ['name' => 'Milkshake Caramel', 'price' => 15000],
                ['name' => 'Milkshake Red Velvet', 'price' => 15000],
                ['name' => 'Milkshake Taro', 'price' => 15000],
            ],
            'Mocktail' => [
                ['name' => 'Mocktail Calamansi', 'price' => 20000],
                ['name' => 'Mocktail Iecy', 'price' => 20000],
                ['name' => 'Mocktail Blueberry', 'price' => 20000],
                ['name' => 'Mocktail Mangga', 'price' => 20000],
                ['name' => 'Mocktail Orange', 'price' => 20000],
            ],
            'Es Mint' => [
                ['name' => 'Es Lemon Mint', 'price' => 23000],
                ['name' => 'Es Chocolate Mint', 'price' => 23000],
                ['name' => 'Es White Chocolate Mint', 'price' => 23000],
            ],
            'Snack' => [
                ['name' => 'Kentang Goreng', 'price' => 18000],
                ['name' => 'Tempe Goreng', 'price' => 15000],
                ['name' => 'Nugget', 'price' => 18000],
                ['name' => 'Nasi Goreng', 'price' => 18000],
                ['name' => 'Nasi Telur', 'price' => 15000],
                ['name' => 'Indomie Goreng', 'price' => 15000],
                ['name' => 'Indomie Kuah', 'price' => 18000],
            ],
        ];

        // 5. Loop untuk Insert ke Database
        foreach ($menuData as $categoryName => $products) {
            // Buat Kategori
            // Untuk gambar kategori, kita pakai slug dasar saja
            $category = Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
                'image' => 'categories/'.Str::slug($categoryName) . '.png',
            ]);

            foreach ($products as $product) {
                // LOGIKA UNTUK GAMBAR:
                // 1. Buat Slug dasar (contoh: "americano-hot")
                $slug = ($product['name']);
                $imageName = str_replace([' Hot', ' Cold'], '', $slug) . '.png';

                Product::create([
                    'category_id' => $category->id,
                    'name' => $product['name'],
                    'slug' => $slug,
                    'description' => 'Nikmati kesegaran ' . $product['name'] . ' khas Sebatas Kopi.',
                    'price' => $product['price'],
                    'stock' => 100,
                    'image' => 'products/'.$imageName, 
                    'is_available' => true,
                ]);
            }
        }
    }
}
