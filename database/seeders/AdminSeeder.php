<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'created_at' => now()->toDateString(),
            'updated_at' => now()->toDateString()
        ]);

        $admin->assignRole('Admin');

        $other = User::create([
            'name' => 'User 1',
            'email' => 'anonymous@example.org',
            'password' => Hash::make('example'),
            'created_at' => now()->toDateString(),
            'updated_at' => now()->toDateString()
        ]);

        $other->assignRole('Other');
    }
}
