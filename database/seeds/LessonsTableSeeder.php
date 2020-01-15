<?php

use Illuminate\Database\Seeder;

class LessonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker\Factory::create();

       for ($i = 0; $i < 30; $i++){
           \App\Lesson::create([
               'title' => $faker->sentence(5),
               'body' => $faker->sentence(4),
               'is_ready' => $faker->boolean,
           ]);
       }
    }
}
