<?php
namespace App\Listeners;

use App\Events\RecordActionEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class LogRecordAction
{
    public function handle(RecordActionEvent $event)
    {
        activity()
            ->performedOn($event->model)
            ->causedBy(auth()->guard('admin')->user())
            ->withProperties(['action' => $event->action])
            ->log("{$event->action} a record");
    }
}
