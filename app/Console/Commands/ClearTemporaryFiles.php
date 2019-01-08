<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ClearTemporaryFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tmp_files:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes all temporary files created by app';

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
        $invoices = Storage::files('public/tmp/invoices');
        $confirmations = Storage::files('public/tmp/confirmations');
        $lists = Storage::files('public/tmp/lists');

        $files = array_merge($invoices, $confirmations, $lists);

        Storage::delete($files);

        error_log('Deleted all temporary files');
    }
}
