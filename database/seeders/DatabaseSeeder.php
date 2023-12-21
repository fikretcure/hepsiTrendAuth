<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Master Admin'
        ]);

        Role::create([
            'name' => 'Customer'
        ]);

        Role::create([
            'name' => 'Expert'
        ]);

        User::create([
            'name' => 'Fikret',
            'email' => 'career@fikretcure.dev',
            'password' => md5('Ht2023!')
        ])->roles()->attach(1);

        User::create([
            'name' => 'Emre',
            'email' => 'info@fikretcure.dev',
            'password' => md5('Ht2023!')
        ])->roles()->attach(2);

        User::create([
            'name' => 'Orhan',
            'email' => 'fikretcure@gmail.com',
            'password' => md5('Ht2023!')
        ])->roles()->attach(3);
    }
}
