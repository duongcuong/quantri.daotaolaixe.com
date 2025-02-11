<?php
namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RecordActionEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $action;
    public $model;

    public function __construct($action, $model)
    {
        $this->action = $action;
        $this->model = $model;
    }
}
