<?php

namespace Database\Seeders;

use App\Models\SuperAdmin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SuperAdmin::create([
            'name' => 'Administrator',
            'dob' => '2000-03-16',
            'gender' => '1',
            'mobile_no' => '8989898989',
            'image'=>'avatar.png',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'address' => 'Balaghat',
        ]);
    }
}

