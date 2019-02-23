<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Actions\DestructiveAction;
use Laravel\Nova\Fields\ActionFields;

class MergeCompanies extends DestructiveAction
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $name = 'Group Companies';

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {

        $old_companies = $models;
        $company_to_stay = $old_companies->shift();

        foreach ($old_companies as $old_company) {
            $old_company->invoices()->update(['company_id' => $company_to_stay->id]);
            $old_company->bookings()->update(['company_id' => $company_to_stay->id]);
            $old_company->contacts()->update(['company_id' => $company_to_stay->id]);
            $old_company->delete();
        }

        return Action::message('All companies merged to: ' . $company_to_stay->name);

    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
