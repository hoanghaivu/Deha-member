<?php

use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\Division;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Team::truncate();

        $faker = \Faker\Factory::create();
        $divisionIds = Division::select('id')->pluck('id','id')->toArray();

        for ($i = 0; $i < 20; $i++) {
            Team::create([
                'division_id' => array_rand($divisionIds),
                'team_name' => $faker->name
            ]);
        }
    }
}
