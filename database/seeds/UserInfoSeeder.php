<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Generator as Faker;
use App\UserInfo;

class UserInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = User::all();
        foreach ($users as $user) {
            UserInfo::create(
                [
                    'user_id' => $user->id,
                    'address' => $faker->address(),
                    'phone' => $faker->phoneNumber(),
                    'birthdate' => $faker->date(),
                ]
            );
        };
    }
}