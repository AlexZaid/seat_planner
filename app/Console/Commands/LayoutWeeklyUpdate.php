<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class LayoutWeeklyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'LayoutWeekly:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {   
        // DB::table('ly_assignations_comparison')->truncate();
        // DB::unprepared("INSERT INTO ly_assignations_comparison SELECT * FROM ly_assignations");
        // DB::unprepared("INSERT INTO ly_assignations_historical SELECT * FROM ly_assignations");
        // DB::table('ly_assignations_comparison')->insert('INSERT INTO `ly_assignations_copy` SELECT * FROM `ly_assignations`;',[DB::raw('SELECT * FROM ly_assignations')]);
        // DB::table('ly_assignations_comparison')->truncate();
        // DB::raw('INSERT INTO ly_assignations_comparison SELECT * FROM ly_assignations');
        // DB::raw("INSERT INTO `ly_assignations_historical` SELECT * FROM `ly_assignations`");
        info('called every minute');
        return 0;
    }
}
