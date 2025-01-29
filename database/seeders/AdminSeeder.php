<?php

namespace Database\Seeders;

use Illu8minate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = array(
            array(
                'first_name' => 'Yasir',
                'last_name' => 'Naeem',
                'email' => 'yasir.sherwani@gmail.com',
                'password' => Hash::make('123456'),
            ),
            array(
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
            ),
        );

        if(count($admins) > 0) {
            foreach($admins as $admin) {
                Admin::updateOrCreate([
                    'email' => $admin['email']
                ],[
                    'first_name' => $admin['first_name'],
                    'last_name' => $admin['last_name'],
                    'password' => $admin['password']
                ]);
            }
        }
    }
}
