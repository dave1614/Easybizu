<?php

namespace App\Console;

use App\Functions\UsefulFunctions;
use App\Models\EasySavings;
use App\Models\MlmWeekly;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{

    // public UsefulFunctions $functions;

    // public function __construct()
    // {
    //     $this->functions = new UsefulFunctions();
    // }

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function() {
            $functions = new UsefulFunctions();
            $json_post = '[{"DepartmentId":1,"DepartmentName":"IT"},{"DepartmentId":2,"DepartmentName":"Support"}]';
            $date = date("j M Y");
            $time = date("h:i:sa");
            // $functions->addMinifyAccountWebhookJsonData($json_post, $date, $time);


            $users = MlmWeekly::where('user_id', '!=', 10)->whereDate('week_start', '<=', Carbon::now()->subDays(7))
                ->get('user_id');
            // return $users;
            $json_post = json_encode($users);
            
            if ($users->count() > 0) {
                foreach ($users as $row) {
                    
                    $functions->processUserWeeklyRout($row->user_id);
                }
            }

            $user_savings =  EasySavings::where('disbursed', 0)->get('user_id');
            if ($user_savings->count() > 0) {
                foreach ($user_savings as $row) {
                    $user_id = $row->user_id;
                    $curr_date = date("j M Y");
                    $curr_date_time = date("j M Y h:i:sa");

                    // $curr_date = "27 Jan 2024";
                    // $curr_date_time = "27 Jan 2024 01:30:32pm";
                    $functions->checkIfUsersSavingIsSupposedToBeDoneAndProcess($user_id, $curr_date, $curr_date_time);
                    if ($functions->checkIfUserIsBeToBeDebitedForSavingsToday($user_id, $curr_date, $curr_date_time)) {

                        $saving = EasySavings::where('user_id', $user_id)->where('disbursed', 0)->first();
                        $functions->processAndDebitUserSaving($saving->id, $curr_date, $curr_date_time);
                    }
                }
            }
        })->dailyAt('00:59');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
