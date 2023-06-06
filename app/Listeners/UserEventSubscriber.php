<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use App\Services\StatisticModelService;
use Illuminate\Support\Facades\Auth;

class UserEventSubscriber
{
    // use StatisticTrait;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(protected StatisticModelService $statisticModelService)
    {
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */

    public function handleUserLogin($event)
    {
        $this->statisticModelService->createModelStatistic (Auth::user()->role_id, Auth::user()->id, 'login', 'login');
    }

    public function handleUserLogout($event)
    {
        $this->statisticModelService->createModelStatistic(Auth::user()->role_id, Auth::user()->id, 'logout', 'logout');
    }
    public function handleUserRegistered($event)
    {
        $this->statisticModelService->createModelStatistic(Auth::user()->role_id, Auth::user()->id, 'register', 'register');
    }

    public function subscribe($events)
    {
        return [
            Login::class => 'handleUserLogin',
            Logout::class => 'handleUserLogout',
            Registered::class => 'handleUserRegistered',
        ];
    }
}
