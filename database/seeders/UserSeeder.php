<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('users')->insert(['name' => 'IAW',
        'email' => 'admin@iaw.com',
        'email_verified_at' => now(),
        'password' => Hash::make('admin123'),
        'remember_token' => Str::random(10),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        ]);

        User::factory()->count(5)->create();
        foreach ($users as $user) {
            $user->assignRole('Moderador');
        }

        // Se le asigna el rol de administrador
        $user = User::where('email', 'admin@iaw.com')->first();
        $user->assignRole('Administrador');

    }
}
