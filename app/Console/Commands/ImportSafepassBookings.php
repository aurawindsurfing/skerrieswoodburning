<?php

namespace App\Console\Commands;

use App\Imports\SafepassBookingImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportSafepassBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:safepassbookings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import safepass bookings from file';

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
        $this->call('migrate:fresh', ['--seed' => true]);
        $collection = Excel::import(new SafepassBookingImport, 'import_final.xlsx');
    }
}
