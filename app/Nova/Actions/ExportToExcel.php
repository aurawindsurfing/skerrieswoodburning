<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Maatwebsite\Excel\Facades\Excel;

class ExportToExcel extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {

        $model = $models->first();

        $path = 'tmp/lists/' . 
                    str_replace(' ', '_', $model->course_type->name) . '_' . 
                    $model->date->format('Y-m-d'). '_' . 
                    str_replace(' ', '_', $model->venue->name) . 
                    '_attendees.xlsx';

        Excel::store(new \App\Exports\AttendeeExport($model), 'public/' . $path);

        return Action::download(url($path), uniqid() . '.xlsx');

    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [

        ];
    }

}
