<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediaSeeder extends Seeder
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
                'small' => $this->faker->imageUrl($width = 200, $height = 200),
                'large' => $this->faker->imageUrl($width = 600, $height = 600),
                'medium' => $this->faker->imageUrl($width = 1200, $height = 1200),
                'user_id' => $this->faker->randomNumber(1)
            ],
            [
                'small' => $this->faker->imageUrl($width = 200, $height = 200),
                'large' => $this->faker->imageUrl($width = 600, $height = 600),
                'medium' => $this->faker->imageUrl($width = 1200, $height = 1200),
                'user_id' => $this->faker->randomNumber(1)
            ],
            [
                'small' => $this->faker->imageUrl($width = 200, $height = 200),
                'large' => $this->faker->imageUrl($width = 600, $height = 600),
                'medium' => $this->faker->imageUrl($width = 1200, $height = 1200),
                'user_id' => $this->faker->randomNumber(1)
            ]
        );

        foreach ($tests as $key) {
            DB::table('media')->insert($key);
        }
    }
}
