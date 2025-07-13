<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\PhoneNumber;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(2)->create();

        Card::factory(20)->create();
        // PhoneNumber::factory(6)->create();




    }

}
