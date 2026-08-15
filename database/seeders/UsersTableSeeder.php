<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Administrator',
                'email' => 'admin@kopi.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$w.D.v1MN97GGHW7RFWwMrOP6ncLzkAFuWVdYR/ZHmoQNUBpGbZC/q',
                'role' => 'admin',
                'phone' => '081234567890',
                'remember_token' => NULL,
                'created_at' => '2026-08-15 15:16:45',
                'updated_at' => '2026-08-15 15:16:45',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Customer Test',
                'email' => 'user@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$DLXOZwyqYKNGqmNnHPKPkO0LBj7P4tkrutftX7P.aqAFJMEWGqnCS',
                'role' => 'customer',
                'phone' => '089876543210',
                'remember_token' => NULL,
                'created_at' => '2026-08-15 15:16:45',
                'updated_at' => '2026-08-15 15:16:45',
            ),
        ));
        
        
    }
}