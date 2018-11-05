<?php

namespace App\Console;

use Illuminate\Http\Request;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class CreateWorkflowController extends Controller
{
    protected $commands = [
        \App\Console\Commands\Inspire::class,
    ];

    public static function initWorkflowDB(){
      if(!empty($_POST['name'])){
        $name = $_POST['name'];
        $name_id = strtolower(str_replace(" ", "_", $name));
        DB::table('workflows')->insert( array(
          'name' => $name,
          'name_id' => $name_id,
          'triggerBy' => "Cron"
        ));
        $schedule = app(Schedule::class);
        $schedule->command('test:test')->everyMinute();
        echo '<meta http-equiv="refresh" content="0;url=/workflows/new?s=200&n='.$name.'" />';
      }else{
        echo '<meta http-equiv="refresh" content="0;url=/workflows/new?s=500" />';
      }
    }

}
