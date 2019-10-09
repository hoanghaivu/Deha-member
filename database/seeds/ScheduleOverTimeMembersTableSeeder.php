<?php

use App\Models\Member;
use App\Models\ScheduleOverTimeMember;
use App\Models\ScheduleOverTime;
use Illuminate\Database\Seeder;

class ScheduleOverTimeMembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ScheduleOverTimeMember::truncate();

        $faker = \Faker\Factory::create();
        $memberIds = Member::select('id')->pluck('id', 'id')->toArray();
        $scheduleOverTimeIds = ScheduleOverTime::select('id')->pluck('id', 'id')->toArray();

        for ($i = 0; $i < 20; $i++) {
            $times = [
                2 => [
                    ['time_begin' => '8:30', 'time_end' => '17:30'],
                    ['time_begin' => '8:30', 'time_end' => '21:30'],
                    ['time_begin' => '8:30', 'time_end' => '12:00'],
                    ['time_begin' => '13:00', 'time_end' => '17:30'],
                ],
                1 => [
                    ['time_begin' => '6:30', 'time_end' => '08:30'],
                    ['time_begin' => '18:00', 'time_end' => '21:30'],
                    ['time_begin' => '18:00', 'time_end' => '20:00'],
                ]
            ];

            $scheduleOverTimeId = array_rand($scheduleOverTimeIds);

            //Get info of schedule over time => date_ot
            $infoScheduleOverTime = ScheduleOverTime::find($scheduleOverTimeId);

            // From date_ot => level
            $level = date('N', strtotime($infoScheduleOverTime->date_ot)) >= 6 ? 2 : 1;

            //Get data time random by level
            $timeByLevel = $times[$level];
            $timeRand = $timeByLevel[array_rand($timeByLevel)];

            $time1 = strtotime($timeRand['time_begin']);
            $time2 = strtotime($timeRand['time_end']);
            $quantityHour = round(abs($time2 - $time1) / 3600,2) * $level;

            ScheduleOverTimeMember::create([
                'member_id' => array_rand($memberIds),
                'schedule_over_time_id' => $scheduleOverTimeId,
                'time_begin' => $timeRand['time_begin'],
                'time_end' => $timeRand['time_end'],
                'level' => $level,
                'quantity_hour' => $quantityHour,
                'memo' => $faker->name,
            ]);
        }
    }
}
