<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class generateStatisticDeathRecord extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db-view:generate';

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
        $daily = "
            CREATE OR REPLACE VIEW death_data_daily AS (
                SELECT 
                    date_format(death_data.deathdate, '%Y-%m-%d') as date,
                    count(death_data.id) as count
                FROM
                    death_data
                GROUP BY date
            )
        ";

        $weekly = "
            CREATE OR REPLACE VIEW death_data_weekly AS (
                SELECT 
                    date_format(death_data.deathdate, '%Y-%m') as date,
                    WEEK(death_data.deathdate) as weekly,
                    count(death_data.id) as count
                FROM
                    death_data
                GROUP BY weekly
            )
        ";

        $monthly = "
            CREATE OR REPLACE VIEW death_data_monthly AS (
                SELECT 
                    date_format(death_data.deathdate, '%Y-%m') as date,
                    count(death_data.id) as count
                FROM
                    death_data
                GROUP BY date
            )
        ";
        // config()->set('database.connections.mysql.strict', false);
        // DB::reconnect();
        DB::statement($daily);
        DB::statement($weekly);
        DB::statement($monthly);
        // config()->set('database.connections.mysql.strict', true);
        // DB::reconnect();

        $this->info('rekap_views (re)created');
        return 0;
    }
}
