<?php

namespace App\Observers;

use App\Models\User;
use App\Modifications\Create\CreateNotificationsModification;
use App\Modifications\Delete\DeleteNotificationsModification;
use Hash;
use Str;

class UserObserver
{
    /**
     * Handle the user "creating" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function creating(User $user)
    {
        //$user->password = Hash::make(Str::random(10));
    }
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $createNotificationsModification = app(CreateNotificationsModification::class);
        $notifications = array('user_id' => $user->id,
        'info' => json_encode(array(['id' => 1,
            'icon' => "warning",
            'title' => "Система безопасности!",
            'subtitle' => "В ваш аккаунт был осуществёл вход с нового устройства!",
            'done' => false])));
        $createNotificationsModification->addNotificationToDatabase($notifications);
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleting(User $user)
    {
        $deleteNotificationsModification = app(DeleteNotificationsModification::class);
        $deleteNotificationsModification->deleteNotificationFromDatabase($user->id);
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
