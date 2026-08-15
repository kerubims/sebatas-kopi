<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ExtrasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('extras')->delete();
        
        \DB::table('extras')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Extra Shot',
                'price' => '5000.00',
                'is_available' => 1,
                'category' => 'Coffee',
                'created_at' => '2026-08-15 15:16:45',
                'updated_at' => '2026-08-15 15:16:45',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Oat Milk',
                'price' => '8000.00',
                'is_available' => 1,
                'category' => 'Coffee',
                'created_at' => '2026-08-15 15:16:45',
                'updated_at' => '2026-08-15 15:16:45',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Caramel Sauce',
                'price' => '3000.00',
                'is_available' => 1,
                'category' => 'Coffee',
                'created_at' => '2026-08-15 15:16:45',
                'updated_at' => '2026-08-15 15:16:45',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Vanilla Syrup',
                'price' => '3000.00',
                'is_available' => 1,
                'category' => 'Coffee',
                'created_at' => '2026-08-15 15:16:45',
                'updated_at' => '2026-08-15 15:16:45',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Cream Cheese',
                'price' => '5000.00',
                'is_available' => 1,
                'category' => 'Coffee',
                'created_at' => '2026-08-15 15:16:45',
                'updated_at' => '2026-08-15 15:16:45',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Saus Sambal',
                'price' => '0.00',
                'is_available' => 1,
                'category' => 'Snack',
                'created_at' => '2026-08-15 15:16:45',
                'updated_at' => '2026-08-15 15:16:45',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Saus Tomat',
                'price' => '0.00',
                'is_available' => 1,
                'category' => 'Snack',
                'created_at' => '2026-08-15 15:16:45',
                'updated_at' => '2026-08-15 15:16:45',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Mayones',
                'price' => '3000.00',
                'is_available' => 1,
                'category' => 'Snack',
                'created_at' => '2026-08-15 15:16:45',
                'updated_at' => '2026-08-15 15:16:45',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Bumbu Pedas',
                'price' => '2000.00',
                'is_available' => 1,
                'category' => 'Snack',
                'created_at' => '2026-08-15 15:16:45',
                'updated_at' => '2026-08-15 15:16:45',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Bawang Goreng',
                'price' => '2000.00',
                'is_available' => 1,
                'category' => 'snack',
                'created_at' => '2026-08-15 17:12:32',
                'updated_at' => '2026-08-15 17:12:32',
            ),
        ));
        
        
    }
}