<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(10)->create();

        /* \App\Models\User::factory()->create([
             'name' => 'asd',
             'email' => 'asd@asd.com',
             'password' => 'asdasd'
         ]);*/

        // \App\Models\Movie::factory(10)->create();

    }
}
