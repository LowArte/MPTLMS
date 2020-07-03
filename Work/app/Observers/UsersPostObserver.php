<?php

namespace App\Observers;

use App\Models\UsersPost;
use Str;

class UsersPostObserver
{
    public function creating(UsersPost $usersPost)
    {
        $usersPost->slug = Str::slug($usersPost->name);
        $usersPost->privilegies = json_encode([
            [
                "id" => 1,
                "icon" => "home",
                "text" => "Главная",
                "menu" => true,
                "component" => [
                    "info" => [
                        "name" => "Домашняя страница",
                        "url" => ""
                    ],
                    "path" => "js/views/homes-f/DefaultHome"
                ],
                "default" => true
            ],
            [
                "id" => uniqid(),
                "icon" => "feedback",
                "text" => "Обратная связь",
                "menu" => true,
                "component" => [
                    "info" => [
                        "name" => "Обратная связь",
                        "url" => "feedback"
                    ],
                    "path" => "js/views/feedback-f/Feedback"
                ],
                "default" => true
            ]
        ]);
    }
    /**
     * Handle the users post "created" event.
     *
     * @param  App\Ьщвуды\UsersPost  $usersPost
     * @return void
     */
    public function created(UsersPost $usersPost)
    {
        //
    }

    /**
     * Handle the users post "updated" event.
     *
     * @param  App\Models\UsersPost  $usersPost
     * @return void
     */
    public function updated(UsersPost $usersPost)
    {
        //
    }

    /**
     * Handle the users post "deleted" event.
     *
     * @param  App\Models\UsersPost  $usersPost
     * @return void
     */
    public function deleted(UsersPost $usersPost)
    {
        //
    }

    /**
     * Handle the users post "restored" event.
     *
     * @param  App\Models\UsersPost  $usersPost
     * @return void
     */
    public function restored(UsersPost $usersPost)
    {
        //
    }

    /**
     * Handle the users post "force deleted" event.
     *
     * @param  App\Models\UsersPost  $usersPost
     * @return void
     */
    public function forceDeleted(UsersPost $usersPost)
    {
        //
    }
}
