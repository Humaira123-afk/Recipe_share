<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
{
    \App\Models\Admin::updateOrCreate(
        ['email' => 'humaira@gmail.com'], // Check karega agar ye email hai
        [
            'name' => 'Super Admin',
            'password' => bcrypt('@abc.123'),
        ]
    );
    \App\Models\Admin::updateOrCreate(
        ['email' => 'test@gmail.com'], // Check karega agar ye email hai
        [
            'name' => 'Testing Admin',
            'password' => bcrypt('@xyz.123'),
        ]
    );
}

}
