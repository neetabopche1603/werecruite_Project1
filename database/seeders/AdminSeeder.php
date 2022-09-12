<?php

namespace Database\Seeders;

use App\Models\SuperAdmin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        SuperAdmin::create([
            'name' => 'Administrator',
            'dob' => '2000-03-16' ,
            'gender' => '1',
            // 'highest_education' => 'B.tech',
            'mobile_no' => '8989898989',
            'image'=>'avatar.png',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'address' => 'Balaghat',
        ]);
    }
}

