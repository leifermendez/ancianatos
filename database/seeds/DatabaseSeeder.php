<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserSeeder::class);
         $this->call(InstitutionsSeeder::class);
         $this->call(PatientsSeeder::class);
         $this->call(StaffSeeder::class);
         $this->call(MediaSeeder::class);
         $this->call(FormsSeeder::class);
    }
}
