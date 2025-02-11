<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        $user = auth()->guard('admin')->user();
        $notification = $user->notifications()->find($id);
        if ($notification) {
            $notification->markAsRead();
        }

        switch ($notification->type) {
            case 'App\Notifications\TuitionFeeReminder':
                return redirect()->route('admins.course-user.show', $notification->data['course_user_id']);
                break;
        }

        return redirect()->back();
    }

    public function loadMore(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $notifications = $user->notifications()->skip(($request->page - 1) * LIMIT)->take(LIMIT)->get();

        $html = '';
        foreach ($notifications as $notification) {
            $icon = $name = $date = $info = $link = "";
            $data = $notification->data;
            $unreadClass = is_null($notification->read_at) ? 'bg-body' : '';
            switch ($notification->type) {
                case 'App\Notifications\TuitionFeeReminder':
                    $icon = 'bx bx-money';
                    $name = $data["message"];
                    $date = $notification->created_at->diffForHumans();
                    $info = 'Học viên: ' . $data["courseUserName"] . ' - Học phí thiếu: ' . '<strong class="text-danger">'.getMoney($data["remainingFee"]).'</strong>';
                    $link = route('admins.notifications.read', $notification->id);
                    break;
                default:
                    $icon = 'bx bx-send';
                    break;
            }


            $html .= '
                <a class="dropdown-item '.$unreadClass.'" href="'.$link.'">
                    <div class="media align-items-center">
                        <div class="notify bg-light-mehandi text-mehandi"><i class="'.$icon.'"></i>
                        </div>
                        <div class="media-body">
                            <h6 class="msg-name">'.$name.' <span class="msg-time float-right">'.$date.'</span></h6>
                            <p class="msg-info">'.$info.'</p>
                        </div>
                    </div>
                </a>
            ';
        }
        return response()->json(['html' => $html]);
    }
}
