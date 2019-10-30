<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin= User::create([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'username'=>'admin',
            'password'=>bcrypt('admin'),
        ]);
        $superadmin->assignRole('super-admin');
        
        
    }
}