<?php

namespace App\Console\Commands;

use App\Contact;
use App\Invoice;
use App\Mail\CompanyInvoicePaymentReminder;
use App\Notifications\CompanyInvoiceReminder;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class InvoicePaymentReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:unpaid_invoices';

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

        $unpaid_invoices = $unpaid_invoices->filter(function ($invoice) {
            return Carbon::parse($invoice->date)->addDays($invoice->payment_terms) <= Carbon::now();
        });

        $unpaid_invoices_grouped_by_company = $unpaid_invoices->groupBy('company_id');
        error_log('Trying to notify '.$unpaid_invoices_grouped_by_company->count().' companies about unpaid invoices');

        foreach ($unpaid_invoices_grouped_by_company as $company_id => $invoices) {
            $company_contacts = Contact::whereCompanyId($company_id)->get();

            foreach ($company_contacts as $contact) {
                $contact = ($contact->accounts_payable == 1) ? $contact : false;
            }

            $contact = $contact ?: $company_contacts->first();

            $invoiceController = new \App\Http\Controllers\InvoiceController();
            $path = $invoiceController->makePDF($invoices);

            $data = [
                'invoices' => $invoices,
                'path' => $path,
            ];

            Mail::to($contact->email)
            ->send(new CompanyInvoicePaymentReminder($data));
        }

        error_log('Send all company notifications');
    }
}
