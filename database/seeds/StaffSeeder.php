<?php

use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    private $faker;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = $faker = Faker\Factory::create();
        $tests = array(
            [
                'name' => $this->faker->name,
                'last_name' => $this->faker->lastName,
                'phone' => $this->faker->phoneNumber,
                'photo' => $this->faker->imageUrl(),
                'address' => $this->faker->sentence,
                'description' => $this->faker->sentence,
                'email' => $this->faker->email,
                'user_id' => $this->faker->randomNumber(1)
            ],
            [
                'name' => $this->faker->name,
                'last_name' => $this->faker->lastName,
                'phone' => $this->faker->phoneNumber,
                'photo' => $this->faker->imageUrl(),
                'address' => $this->faker->sentence,
                'description' => $this->faker->sentence,
                'email' => $this->faker->email,
                'user_id' => $this->faker->randomNumber(1)
            ],
            [
                'name' => $this->faker->name,
                'last_name' => $this->faker->lastName,
                'phone' => $this->faker->phoneNumber,
                'photo' => $this->faker->imageUrl(),
                'address' => $this->faker->sentence,
                'description' => $this->faker->sentence,
                'email' => $this->faker->email,
                'user_id' => $this->faker->randomNumber(1)
            ],
            [
                'name' => $this->faker->name,
                'last_name' => $this->faker->lastName,
                'phone' => $this->faker->phoneNumber,
                'photo' => $this->faker->imageUrl(),
                'address' => $this->faker->sentence,
                'description' => $this->faker->sentence,
                'email' => $this->faker->email,
                'user_id' => $this->faker->randomNumber(1)
            ]
        );

        foreach ($tests as $key) {
            DB::table('staff')->insert($key);
        }
    }
}
