<?php

namespace Database\Seeders;

use App\Models\produkM;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'id'=> '1',
            'nama'=> 'galih',
            'username'=> 'admin',
            'password'=>  Hash::make('123'),
            'role'=> 'admin'
        ]);
        // User::create([
        //     'id'=> '2',
        //     'nama'=> 'galih',
        //     'username'=> 'admin1',
        //     'password'=> '123',
        //     'role'=> 'admin',
        // ]);
    }
}
