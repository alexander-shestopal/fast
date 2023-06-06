<?php

namespace App\Listeners;

use App\Services\StatisticModelService;

class UserActionEventSubscriber
{
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

    function handleViewPageBuy(): void
    {
        $this->statisticModelService->createStatisticOfTypeAction('view_buy', 'view_page');
    }

    function handleViewPageDowload(): void
    {
        $this->statisticModelService->createStatisticOfTypeAction('view_download', 'view_page');
    }

    function handleClickPageBuy(): void
    {
        $this->statisticModelService->createStatisticOfTypeAction('click_buy', 'button_click');
    }

    function handleClickPageDownload(): void
    {
        $this->statisticModelService->createStatisticOfTypeAction('click_download', 'button_click');
    }
    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'viewPageBuy',
            'App\Listeners\UserActionEventSubscriber@handleViewPageBuy'
        );

        $events->listen(
            'viewPageDowload',
            'App\Listeners\UserActionEventSubscriber@handleViewPageDowload'
        );

        $events->listen(
            'clickPageBuy',
            'App\Listeners\UserActionEventSubscriber@handleClickPageBuy'
        );

        $events->listen(
            'clickPageDownload',
            'App\Listeners\UserActionEventSubscriber@handleClickPageDownload'
        );
    }
}
