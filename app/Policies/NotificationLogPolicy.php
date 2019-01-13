<?php

namespace App\Policies;

use App\User;
use App\NotificationLog;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotificationLogPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the NotificationLog.
     *
     * @param  \App\User  $user
     * @param  \App\NotificationLog  $notification_log
     * @return mixed
     */
    public function view(User $user, NotificationLog $notification_log)
    {
        return true;
    }

    /**
     * Determine whether the user can create NotificationLogs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the NotificationLog.
     *
     * @param  \App\User  $user
     * @param  \App\NotificationLog  $notification_log
     * @return mixed
     */
    public function update(User $user, NotificationLog $notification_log)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the NotificationLog.
     *
     * @param  \App\User  $user
     * @param  \App\NotificationLog  $notification_log
     * @return mixed
     */
    public function delete(User $user, NotificationLog $notification_log)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the NotificationLog.
     *
     * @param  \App\User  $user
     * @param  \App\NotificationLog  $notification_log
     * @return mixed
     */
    public function restore(User $user, NotificationLog $notification_log)
    {
        return $user->role == 'admin';
    }

    /**
     * Determine whether the user can permanently delete the NotificationLog.
     *
     * @param  \App\User  $user
     * @param  \App\NotificationLog  $notification_log
     * @return mixed
     */
    public function forceDelete(User $user, NotificationLog $notification_log)
    {
        return false;
    }

    /**
     * Determine whether the user can add bookings to NotificationLog..
     *
     * @param  \App\User  $user
     * @param  \App\NotificationLog  $notification_log
     * @return mixed
     */
    public function addBooking(User $user, NotificationLog $notification_log)
    {
        return false;
    }
}
