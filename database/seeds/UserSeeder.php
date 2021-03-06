<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
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
                'email' => 'admin@admin.com',
                'avatar' => $this->faker->imageUrl(),
                'level' => 'admin',
                'password' => bcrypt('12345678'),
                'user_id' => 1,
                'zone' => 'madrid'
            ],
            [
                'name' => $this->faker->name,
                'email' => 'manager@mail.com',
                'avatar' => $this->faker->imageUrl(),
                'password' => bcrypt('12345678'),
                'level' => 'manager',
                'user_id' => 1,
                'zone' => 'madrid'
            ],
            [
                'name' => $this->faker->name,
                'email' => $this->faker->email,
                'avatar' => $this->faker->imageUrl(),
                'password' => bcrypt('12345678'),
                'user_id' => 1,
                'zone' => 'barcelona'
            ],
            [
                'name' => $this->faker->name,
                'email' => $this->faker->email,
                'avatar' => $this->faker->imageUrl(),
                'password' => bcrypt('12345678'),
                'user_id' => 1,
                'zone' => 'madrid'
            ]
        );

        foreach ($tests as $key) {
            DB::table('users')->insert($key);
        }

    }
}
