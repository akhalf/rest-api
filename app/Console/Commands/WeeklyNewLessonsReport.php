<?php

namespace App\Console\Commands;

use App\Lesson;
use Carbon\Carbon;
use Illuminate\Console\Command;

class WeeklyNewLessonsReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Lesson:new:lastweek';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Report of new lessons added last week';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $lastweek_timestamp = Carbon::now()->subDays(7)->timestamp;

        $lessons = Lesson::whereRaw('UNIX_TIMESTAMP(created_at) >=' . $lastweek_timestamp)->get();

        if (count($lessons)){
            $report = '';
            foreach ($lessons as $lesson){
                $report .= $lesson->title . "\n";
            }
            $this->info($report);
        }
        else{
            $this->info('there where no new lessons');
        }


    }
}
