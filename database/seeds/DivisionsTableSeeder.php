<?php

use Illuminate\Database\Seeder;
use App\Models\Division;

class DivisionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Division::truncate();
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 10; $i++)
        {
            Division::create(
                [
                    'division_name' => $faker->name
                ]
            );
        }
    }
}
