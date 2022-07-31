<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 5; $i++) {
            DB::table('teams')->insert([
                'name' => Str::random(10),
               'logoURL' => Str::random(12),
            ]);
//            Teams::create([
//                'name' => $faker->sentence,
//                'logoURL' => $faker->paragraph,
//            ]);
        }
    }
}
