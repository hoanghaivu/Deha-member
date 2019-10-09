<?php

use Illuminate\Database\Seeder;
use App\Models\Member;
use App\Models\Division;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Member::truncate();
        $faker = \Faker\Factory::create();
        $mobiles = ['0987654321', '09876543211', '0987654567'];
        $divisionIds = Division::select('id')->pluck('id', 'id')->toArray();
        for ($i = 0; $i < 10; $i++)
        {
            Member::create(
                [
                    'division_id' => array_rand($divisionIds),
                    'full_name' => $faker->name,
                    'gender' => array_rand([0, 1]),
                    'birthday' => $faker->date('Y-m-d'),
                    'hometown' => $faker->address,
                    'start_working_date' => $faker->date('Y-m-d'),
                    'deha_mail' => $faker->email,
                    'person_mail' => $faker->email,
                    'mobile' => $mobiles[array_rand($mobiles)],
                    'skype' => $faker->word,
                    'facebook' => $faker->word,
                    'current_accommodation' => $faker->streetAddress,
                    'id_card_member' => $faker->creditCardNumber,
                    'date_issued' => $faker->dateTime,
                    'place_issued' => $faker->city,
                    'marital_status' => array_rand([0, 1]),
                    'education' => $faker->company
                ]
            );
        }
    }
}
