<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitutionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $faker;

    public function run()
    {
        $this->faker = $faker = Faker\Factory::create();
        $tests = array(
            [
                'name' => $this->faker->name,
                'address' => $this->faker->address,
                'description' => $this->faker->address,
                'phone' => $this->faker->phoneNumber,
                'date' => $this->faker->date(),
                'user_id' => $this->faker->randomNumber(1)
            ],
            [
                'name' => $this->faker->name,
                'address' => $this->faker->address,
                'description' => $this->faker->address,
                'phone' => $this->faker->phoneNumber,
                'date' => $this->faker->date(),
                'user_id' => $this->faker->randomNumber(1)
            ],
            [
                'name' => $this->faker->name,
                'address' => $this->faker->address,
                'description' => $this->faker->address,
                'phone' => $this->faker->phoneNumber,
                'date' => $this->faker->date(),
                'user_id' => $this->faker->randomNumber(1)
            ]
        );

        foreach ($tests as $key) {
            DB::table('institutions')->insert($key);
        }
    }
}
