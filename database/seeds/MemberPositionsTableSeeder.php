<?php

use Illuminate\Database\Seeder;
use App\Models\MemberPosition;
use App\Models\Member;
use App\Models\Position;

class MemberPositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MemberPosition::truncate();

        $faker = \Faker\Factory::create();
        $memberIds = Member::select('id')->pluck('id','id')->toArray();
        $positionIds = Position::select('id')->pluck('id','id')->toArray();


        for ($i = 0; $i < 20; $i++) {
            MemberPosition::create([
                'member_id' => array_rand($memberIds),
                'position_id' => array_rand($positionIds)
            ]);
        }
    }
}
