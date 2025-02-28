<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Calendar;
use App\Models\Admin;
use App\Models\User;
use App\Models\CourseUser;
use App\Models\Email;
use App\Models\Lead;
use App\Notifications\DailyNotification;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendDailyNotifications extends Command
{
    protected $signature = 'send:daily-notifications';
    protected $description = 'Gửi thông báo hàng ngày vào 4h sáng';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = Carbon::today()->toDateString();

        // Lấy tất cả các lịch trong ngày
        $calendars = Calendar::whereDate('date_start', $today)
            ->orWhere(function ($query) use ($today) {
                $query->whereDate('date_end', $today);
            })
            ->get();
        // Group các lịch theo user_id và admin_id
        $groupedCalendars = $calendars->groupBy(function ($calendar) {
            if ($calendar->user_id) {
                return 'user_' . $calendar->user_id;
            } elseif ($calendar->admin_id) {
                return 'admin_' . $calendar->admin_id;
            } elseif ($calendar->course_user_id) {
                $courseUser = CourseUser::find($calendar->course_user_id);
                return 'user_' . $courseUser->user_id;
            } elseif ($calendar->lead_id) {
                $lead = Lead::find($calendar->lead_id);
                return 'admin_' . $lead->assigned_to;
            } elseif ($calendar->teacher_id) {
                return 'admin_' . $calendar->teacher_id;
            }
        });

        foreach ($groupedCalendars as $key => $calendars) {
            list($type, $id) = explode('_', $key);
            if ($type == 'user') {
                $user = User::find($id);
            } else {
                $user = Admin::find($id);
            }

            if ($user) {
                // Gửi thông báo
                $user->notify(new DailyNotification($calendars));

                // Gửi email
                Email::create([
                    'to' => $user->email,
                    'subject' => 'Thông báo lịch làm việc ' . date('d/m/Y'),
                    'template' => 'emails.daily_notification',
                    'params' => json_encode([
                        'calendars' => $calendars,
                        'user' => $user->name
                    ]),
                    'status' => 'pending'
                ]);
            }
        }

        $this->info('Gửi thông báo hàng ngày thành công.');
    }
}
