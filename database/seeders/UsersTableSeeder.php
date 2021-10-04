<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Admin',
            'last_name'  => 'Admin',
            'email'      => 'admin@admin.com',
            'password'   => Hash::make('admin'),
            'role'       => 'admin'
        ]);

        User::create([
            'first_name' => 'Employee',
            'last_name'  => 'Employee',
            'email'      => 'employee@employee.com',
            'password'   => Hash::make('employee'),
            'role'       => 'employee'
        ]);
    }
}
