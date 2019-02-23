<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Actions\DestructiveAction;
use Laravel\Nova\Fields\ActionFields;

class GroupVenues extends DestructiveAction
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

        $old_venues = $models;
        $venue_to_stay = $old_venues->shift();

        foreach ($old_venues as $old_venue) {
            $old_venue->courses()->update(['venue_id' => $venue_to_stay->id]);
            $old_venue->course_dates()->update(['venue_id' => $venue_to_stay->id]);
            $old_venue->delete();
        }

        return Action::message('Venues merged to: ' . $venue_to_stay->name);

    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            // Text::make('New name', 'name'),
        ];
    }
}
