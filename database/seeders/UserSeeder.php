<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'Esraa' ,
            'email'=>'esraa@gmail.com' ,
            'password'=>Hash::make('0100100100') ,
            'phone_number'=>'01001001000'
        ]) ;
    }
}
