<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DownloadCourseCertificate extends Action
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
        $data = [
            'bookings' => $models,
        ];

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('letters.course_confirmation_manual_handling', $data);
        $pdf->setOptions(['defaultMediaType' => 'all', 'isFontSubsettingEnabled' => true ]);
        $id = uniqid();
        $pdf->save('storage/tmp/confirmations/course_certificate_'. $id .'.pdf');
        
        return Action::download(
            url(Storage::url('tmp/confirmations/course_certificate_'. $id .'.pdf')),
            'course_certificate_id_' . $id . '.pdf'
        );

    }

     /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name()
    {
        return ('Download Certificate');
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
