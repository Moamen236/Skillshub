<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class role_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'superadmin'
        ]);

        Role::create([
            'name' => 'admin'
        ]);

        Role::create([
            'name' => 'student'
        ]);
    }
}