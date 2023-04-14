<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        Admin::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123')
        ]);

        Admin::create([
            'name' => 'dummy',
            'email' => 'dummy@admin.com',
            'password' => Hash::make('123')
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Category::create(['name' => 'Beverage']);
        Category::create(['name' => 'Noodles']);
        Category::create(['name' => 'Condiments']);
        Category::create(['name' => 'Meats & Sidedishes']);
        Category::create(['name' => 'Ice cream']);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
