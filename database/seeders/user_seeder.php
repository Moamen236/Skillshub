<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class user_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Moamen Ali',
            'email' => 'moamen@admin.com',
            'password' => Hash::make('12345'),
            'role_id' => 1
        ]);
    }
}