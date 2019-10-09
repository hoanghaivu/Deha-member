<?php

use Illuminate\Database\Seeder;
use App\Models\ScheduleOverTime;
use App\Models\Team;

class ScheduleOverTimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ScheduleOverTime::truncate();

        $faker = \Faker\Factory::create();
        $teamIds = Team::select('id')->pluck('id', 'id')->toArray();

        for ($i = 0; $i < 20; $i++) {
            ScheduleOverTime::create([
                'team_id' => array_rand($teamIds),
                'date_ot' => $faker->dateTimeThisMonth,
                'memo' => $faker->name,
            ]);
        }
    }
}