<?php

namespace App\Listeners;

use App\Device;
use App\Traits\apn;
use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use App\Events\APNFinished;
use App\Events\NewNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PushNewNotification implements ShouldQueue
{
    use apn;
    public $client;
    public $succCounter = 0;
    public $failCounter = 0;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  NewNotification  $event
     * @return void
     */
    public function handle(NewNotification $event)
    {
        $notification = $event->notification;

        // 1. Get the notification
        $title = $notification->title;
        $body = $notification->body;
        $locale = $notification->locale;
        $badge = $notification->badge;
        $sound = $notification->sound;
        $environment = $notification->environment;

        // 2. Filter all devices
        // TODO:
        // - If there are too many devices, we should get the records
        // page by page.
        $devices = Device::where('environment', $environment)
            ->where('locale', $locale)
            ->get();

        // 3. Create a Guzzle client
        $client = new Client([
            'timeout' => 5.0,
            'version' => 2.0,
            'headers' => $this->generateAPNHeader(),
            'base_uri' => $this->generateAPNUri($environment),
            'body' => $this->generateAPNPayload($title, $body, $badge, $sound),
        ]);

        // 4. Push notification for each devices
        $requests = function($devices) use ($client) {
            foreach ($devices as $device) {
                yield function() use ($client, $device) {
                    return $client->postAsync($device->token);
                };
            }
        };

        $pool = new Pool($client, $requests($devices), [
            'concurrency' => 1,
            'fulfilled' => function ($response, $index) {
                $this->succCounter++;
            },
            'rejected' => function ($reason, $index) {
                $this->failCounter++;
            },
        ]);

        $pool->promise()->wait();

        // 5. Trigger the finish event
        event(new APNFinished($notification, $this->succCounter, $this->failCounter));
    }
}
