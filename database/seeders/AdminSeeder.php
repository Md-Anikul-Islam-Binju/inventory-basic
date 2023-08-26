<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'phone' => '01642953542',
            'email' => 'admin@gmail.com',
            'role'=>1,
            'password' => bcrypt('123456'),
        ]);
    }
}
