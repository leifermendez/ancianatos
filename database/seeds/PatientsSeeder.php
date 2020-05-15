<?php

use Illuminate\Database\Seeder;

class PatientsSeeder extends Seeder
{
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
            ],
            [
                'name' => $this->faker->name,
                'last_name' => $this->faker->lastName,
                'phone' => $this->faker->phoneNumber,
                'photo' => $this->faker->imageUrl(),
                'address' => $this->faker->address,
                'description' => $this->faker->text,
                'email' => $this->faker->email,
            ],
            [
                'name' => $this->faker->name,
                'last_name' => $this->faker->lastName,
                'phone' => $this->faker->phoneNumber,
                'photo' => $this->faker->imageUrl(),
                'address' => $this->faker->address,
                'description' => $this->faker->text,
                'email' => $this->faker->email,
            ],
            [
                'name' => $this->faker->name,
                'last_name' => $this->faker->lastName,
                'phone' => $this->faker->phoneNumber,
                'photo' => $this->faker->imageUrl(),
                'address' => $this->faker->address,
                'description' => $this->faker->text,
                'email' => $this->faker->email,
            ]
        );

        foreach ($tests as $key) {
            DB::table('patients')->insert($key);
        }
    }
}
