<?php

namespace Database\Seeders;

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
        $admin = new \App\Models\User;
        $admin->name = 'Admin';
        $admin->email = 'admin@mail.com';
        $admin->password = \Hash::make('admin123');
        $admin->level = 'admin';
        $admin->save();
    }
}
