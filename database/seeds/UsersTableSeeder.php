<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Dev YSM',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('languages')->insert([
            'title' => 'Arabic',
            'code' => 'ar',
            'is_rtl' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('languages')->insert([
            'title' => 'English',
            'code' => 'en',
            'is_rtl' => false,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('tags')->insert([
            'title' => 'Mobile App',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('tags')->insert([
            'title' => 'Website',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('technologies')->insert([
            'title' => 'Vuejs',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('technologies')->insert([
            'title' => 'Android',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('technologies')->insert([
            'title' => 'Flutter',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('technologies')->insert([
            'title' => 'Angular',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
