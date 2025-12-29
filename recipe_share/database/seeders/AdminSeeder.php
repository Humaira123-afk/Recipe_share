<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
{
    \App\Models\Admin::updateOrCreate(
        ['email' => 'humaira@gmail.com'], 
        [
            'name' => 'Super Admin',
            'password' => bcrypt('@abc.123'),
        ]
    );
    \App\Models\Admin::updateOrCreate(
        ['email' => 'test@gmail.com'], 
        [
            'name' => 'Testing Admin',
            'password' => bcrypt('@xyz.123'),
        ]
    );

     \App\Models\Admin::updateOrCreate(
        ['email' => 'new@gmail.com'], 
        [
            'name' => 'new Admin',
            'password' => bcrypt('@new.123'),
        ]
    );
}

}
