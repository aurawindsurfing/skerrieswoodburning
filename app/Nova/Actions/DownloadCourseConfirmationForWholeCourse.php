<?php

namespace App\Nova\Actions;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DownloadCourseConfirmationForWholeCourse extends Action
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

        $data = [
            'bookings' => $model->bookings()->get(),
        ];

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('letters.course_confirmation', $data);
        $id = uniqid();
        $pdf->save('storage/tmp/confirmations/confirmation_letter_'. $id .'.pdf');
        
        return Action::download(
            url(Storage::url('tmp/confirmations/confirmation_letter_'. $id .'.pdf')),
            'confirmation_letter_id_' . $id . '.pdf'
        );

    }

    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name()
    {
        return ('Download Confirmations');
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
