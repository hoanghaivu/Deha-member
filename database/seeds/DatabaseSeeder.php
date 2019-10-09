<?php

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
        $this->call(DivisionsTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(MembersTableSeeder::class);
        $this->call(PositionsTableSeeder::class);
        $this->call(TeamMembersTableSeeder::class);
        $this->call(MemberPositionsTableSeeder::class);
        $this->call(ScheduleOverTimesTableSeeder::class);
        $this->call(ScheduleOverTimeMembersTableSeeder::class);
    }
}