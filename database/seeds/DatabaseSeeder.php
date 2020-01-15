<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    private $to_truncate_tables = [
      'lessons'
    ];
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Empty Lessons Table
        //\App\Lesson::truncate();

        //Ignore Foreign Key Check
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        //Empty DB Tables
        foreach ($this->to_truncate_tables as $table){
            DB::table($table)->truncate();
        }

        //Reset Foreign Key Check
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->call(LessonsTableSeeder::class);
    }
}
