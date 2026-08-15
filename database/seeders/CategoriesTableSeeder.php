<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Signature Coffee',
                'slug' => 'signature-coffee',
                'image' => 'categories/signature-coffee.png',
                'created_at' => '2026-08-15 15:16:45',
                'updated_at' => '2026-08-15 15:16:45',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Coffee',
                'slug' => 'coffee',
                'image' => 'categories/coffee.png',
                'created_at' => '2026-08-15 15:16:45',
                'updated_at' => '2026-08-15 15:16:45',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Es Coffee',
                'slug' => 'es-coffee',
                'image' => 'categories/es-coffee.png',
                'created_at' => '2026-08-15 15:16:45',
                'updated_at' => '2026-08-15 15:16:45',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Latte',
                'slug' => 'latte',
                'image' => 'categories/latte.png',
                'created_at' => '2026-08-15 15:16:45',
                'updated_at' => '2026-08-15 15:16:45',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Teh',
                'slug' => 'teh',
                'image' => 'categories/teh.png',
                'created_at' => '2026-08-15 15:16:46',
                'updated_at' => '2026-08-15 15:16:46',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Milkshake',
                'slug' => 'milkshake',
                'image' => 'categories/milkshake.png',
                'created_at' => '2026-08-15 15:16:46',
                'updated_at' => '2026-08-15 15:16:46',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Mocktail',
                'slug' => 'mocktail',
                'image' => 'categories/mocktail.png',
                'created_at' => '2026-08-15 15:16:46',
                'updated_at' => '2026-08-15 15:16:46',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Es Mint',
                'slug' => 'es-mint',
                'image' => 'categories/es-mint.png',
                'created_at' => '2026-08-15 15:16:46',
                'updated_at' => '2026-08-15 15:16:46',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Snack',
                'slug' => 'snack',
                'image' => 'categories/snack.png',
                'created_at' => '2026-08-15 15:16:46',
                'updated_at' => '2026-08-15 15:16:46',
            ),
        ));
        
        
    }
}