<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        // $this->call(UsersTableSeeder::class);
        /*for($i=0;$i<50;$i++){
            \DB::table('users')->insert([
                'name' => $faker->firstName,
                'email' => $faker->email,
                'password' => bcrypt('secret'),
                'user_type_id' => $faker->numberBetween($min=1,$max=4),
            ]);
        }*/
    }
}
