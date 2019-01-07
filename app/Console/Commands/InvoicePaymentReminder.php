<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Invoice;
use App\Contact;
use App\Notifications\CompanyInvoiceReminder;

class InvoicePaymentReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:invoice_reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify company accounts payable of unpaid invoices';

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
        
        $unpaid_invoices = Invoice::query()
            ->whereStatus('unpaid')
            ->get();

        $unpaid_invoices = $unpaid_invoices->groupBy('company_id');

        error_log('Trying to notify ' . $company_bookings->count() . ' company contacts');

        foreach ($unpaid_invoices as $company_id => $invoices) {

            $company_contacts = Contact::whereCompanyId($company_id)->get();

                foreach ($company_contacts as $contact) {
                    $contact = ($contact->accounts_payable == 1) ? $contact : false;
                }

            $contact = $contact ?: $company_contacts->first();

            $contact->notify(new CompanyInvoiceReminder($bookings));

        };

    error_log('Send all company notifications');
    }
}
