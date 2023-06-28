<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        User::create([
            'username' => 'superadmin',
            'password' => Hash::make('12345678'),
            'role' => 0,
            'status' => 1,
            'registered_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
