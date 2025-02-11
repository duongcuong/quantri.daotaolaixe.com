<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

class TuitionFeeReminder extends Notification implements ShouldQueue
{
    use Queueable;

    protected $courseUser;

    public function __construct($courseUser)
    {
        $this->courseUser = $courseUser;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Bạn có một thông báo về học phí.',
            'course_user_id' => $this->courseUser->id,
            'totalFee' => $this->courseUser->tuition_fee,
            'totalPaid' => $this->courseUser->fees->sum('amount'),
            'remainingFee' => $this->courseUser->tuition_fee - $this->courseUser->fees->sum('amount'),
            'courseUserName' => $this->courseUser->user->name,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => 'Bạn có một thông báo về học phí.',
            'course_user_id' => $this->courseUser->id,
            'totalFee' => $this->courseUser->tuition_fee,
            'totalPaid' => $this->courseUser->fees->sum('amount'),
            'remainingFee' => $this->courseUser->tuition_fee - $this->courseUser->fees->sum('amount'),
            'courseUserName' => $this->courseUser->user->name,
        ]);
    }
}
