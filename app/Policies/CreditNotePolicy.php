<?php

namespace App\Policies;

use App\User;
use App\CreditNote;
use Illuminate\Auth\Access\HandlesAuthorization;

class CreditNotePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the CreditNote.
     *
     * @param  \App\User  $user
     * @param  \App\CreditNote  $credit_note
     * @return mixed
     */
    public function view(User $user, CreditNote $credit_note)
    {
        return true;
    }

    /**
     * Determine whether the user can create CreditNotes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the CreditNote.
     *
     * @param  \App\User  $user
     * @param  \App\CreditNote  $credit_note
     * @return mixed
     */
    public function update(User $user, CreditNote $credit_note)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the CreditNote.
     *
     * @param  \App\User  $user
     * @param  \App\CreditNote  $credit_note
     * @return mixed
     */
    public function delete(User $user, CreditNote $credit_note)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the CreditNote.
     *
     * @param  \App\User  $user
     * @param  \App\CreditNote  $credit_note
     * @return mixed
     */
    public function restore(User $user, CreditNote $credit_note)
    {
        return $user->role == 'admin';
    }

    /**
     * Determine whether the user can permanently delete the CreditNote.
     *
     * @param  \App\User  $user
     * @param  \App\CreditNote  $credit_note
     * @return mixed
     */
    public function forceDelete(User $user, CreditNote $credit_note)
    {
        return false;
    }

    /**
     * Determine whether the user can add bookings to CreditNote..
     *
     * @param  \App\User  $user
     * @param  \App\CreditNote  $credit_note
     * @return mixed
     */
    public function addBooking(User $user, CreditNote $credit_note)
    {
        return false;
    }
}
