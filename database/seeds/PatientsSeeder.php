<?php

use Illuminate\Database\Seeder;

class PatientsSeeder extends Seeder
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
                'address' => $this->faker->address,
                'description' => $this->faker->text,
                'email' => $this->faker->email,
                'institutions_id' => $this->faker->randomNumber(1),
                'user_id' => 1
            ],
            [
                'name' => $this->faker->name,
                'last_name' => $this->faker->lastName,
                'phone' => $this->faker->phoneNumber,
                'photo' => $this->faker->imageUrl(),
                'address' => $this->faker->address,
                'description' => $this->faker->text,
                'email' => $this->faker->email,
                'institutions_id' => $this->faker->randomNumber(1),
                'user_id' => 1
            ],
            [
                'name' => $this->faker->name,
                'last_name' => $this->faker->lastName,
                'phone' => $this->faker->phoneNumber,
                'photo' => $this->faker->imageUrl(),
                'address' => $this->faker->address,
                'description' => $this->faker->text,
                'email' => $this->faker->email,
                'institutions_id' => $this->faker->randomNumber(1),
                'user_id' => 1
            ],
            [
                'name' => $this->faker->name,
                'last_name' => $this->faker->lastName,
                'phone' => $this->faker->phoneNumber,
                'photo' => $this->faker->imageUrl(),
                'address' => $this->faker->address,
                'description' => $this->faker->text,
                'email' => $this->faker->email,
                'institutions_id' => $this->faker->randomNumber(1),
                'user_id' => 1
            ]
        );

        foreach ($tests as $key) {
            DB::table('patients')->insert($key);
        }
    }
}
