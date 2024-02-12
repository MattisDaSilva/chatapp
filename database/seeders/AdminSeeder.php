<?php

namespace Database\Seeders;

use App\Models\User;
use Bouncer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create(["name"=>"admin", "email" => "admin@gmail.com", "password"=> "IAmTheReal@dmin789"]);

        Bouncer::allow('admin')->to('delete-messages');
        Bouncer::assign('admin')->to($admin);

    }
}
