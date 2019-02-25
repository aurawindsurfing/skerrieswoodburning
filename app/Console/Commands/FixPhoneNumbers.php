<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FixPhoneNumbers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tool:fixphonenumbers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fixes missing phone zeros and stuff';

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
        //
    }
}
