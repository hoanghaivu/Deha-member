<?php

use Illuminate\Database\Seeder;
use App\Models\TeamMember;
use App\Models\Member;
use App\Models\Team;
use App\Models\Position;

class TeamMembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TeamMember::truncate();

        $faker = \Faker\Factory::create();
        $memberIds = Member::select('id')->pluck('id','id')->toArray();
        $teamIds = Team::select('id')->pluck('id','id')->toArray();
        $positionIds = Position::select('id')->pluck('id','id')->toArray();


        for ($i = 0; $i < 20; $i++) {
            TeamMember::create([
                'member_id' => array_rand($memberIds),
                'team_id' => array_rand($teamIds),
                'position_id' => array_rand($positionIds)
            ]);
        }
    }
}
