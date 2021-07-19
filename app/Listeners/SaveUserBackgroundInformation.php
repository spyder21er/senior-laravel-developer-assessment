<?php

namespace App\Listeners;

use App\Events\UserSaved;
use App\Services\UserServiceInterface;

class SaveUserBackgroundInformation
{
    /**
     * The user service pattern for this controller.
     *
     * @var App\Services\UserServiceInterface
     */
    protected $user_service;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserServiceInterface $user_service)
    {
        $this->user_service = $user_service;
    }

    /**
     * Handle the event.
     *
     * @param  UserSaved  $event
     * @return void
     */
    public function handle(UserSaved $event)
    {
        $this->user_service->handle($event);
    }
}
