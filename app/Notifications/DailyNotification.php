<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

class DailyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $calendars;

    public function __construct($calendars)
    {
        $this->calendars = $calendars;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Bạn có một thông báo về lịch trong ngày',
            'calendars' => $this->calendars->map(function ($calendar) {
                return [
                    'id' => $calendar->id,
                    'name' => $calendar->name,
                    'date_start' => $calendar->date_start,
                    'date_end' => $calendar->date_end,
                    'description' => $calendar->description,
                ];
            }),
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => 'Bạn có một thông báo về lịch trong ngày',
            'calendars' => $this->calendars->map(function ($calendar) {
                return [
                    'id' => $calendar->id,
                    'name' => $calendar->name,
                    'date_start' => $calendar->date_start,
                    'date_end' => $calendar->date_end,
                    'description' => $calendar->description,
                ];
            }),
        ]);
    }
}
