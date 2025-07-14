<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function getCoursesWithCalendarsByIdentityCard($identity_card)
    {
        $user = \App\Models\User::where('identity_card', $identity_card)->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $courseUsers = \App\Models\CourseUser::with([
            'course',
            'calendars' => function ($query) {
                $query->orderBy('date_start', 'asc');
            },
            'fees' => function ($query) {
                $query->orderBy('payment_date', 'asc');
            }
        ])
            ->where('user_id', $user->id)
            ->where('status', 1)
            ->get();

        $data = $courseUsers->map(function ($courseUser) {
            // Nhóm các lịch theo type
            $groupedCalendars = $courseUser->calendars
                ->map(function ($calendar) {
                    return [
                        'id' => $calendar->id,
                        'date_start' => getDateTimeStamp($calendar->date_start, 'd/m/Y H:i'),
                        'date_end' => getDateTimeStamp($calendar->date_end, 'd/m/Y H:i'),
                        'loai_hoc' => getLoaiHocAll($calendar->loai_hoc),
                        'status' => getStatusCalendarByType($calendar->type, $calendar->status),
                    ];
                })
                ->groupBy(function ($calendar) use ($courseUser) {
                    // Lấy type text cho key nhóm
                    $calendarType = $courseUser->calendars->firstWhere('id', $calendar['id'])->type ?? '';
                    return $calendarType == 'class_schedule' ? 'Lịch học' : getTypeTextCalendar($calendarType);
                });

            // Lịch sử nộp học phí
            $fees = $courseUser->fees->map(function ($fee) {
                return [
                    'id' => $fee->id,
                    'amount' => $fee->amount,
                    'payment_date' => $fee->payment_date,
                    'note' => $fee->note,
                    'admin_id' => $fee->admin_id,
                    'is_received' => $fee->is_received,
                    'type' => getFeeType($fee->type),
                ];
            });

            // Tổng số học phí đã nạp với type = 1
            $total_paid_type_1 = $courseUser->fees->where('type', 1)->sum('amount');
            $total_paid = $courseUser->fees->sum('amount');

            return [
                'course_user_id' => $courseUser->id,
                'course' => [
                    'id' => $courseUser->course->id,
                    'code' => $courseUser->course->code,
                    'rank' => getRankOne($courseUser->course->rank),
                    'tuition_fee' => getMoney($courseUser->tuition_fee),
                    'total_tien_hoc_phi_da_nap' => getMoney($total_paid_type_1),
                    'total_tien_da_nap' => getMoney($total_paid),
                ],
                'calendars_by_type' => $groupedCalendars,
                'fees' => $fees,
            ];
        });

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'dob' => getDateTimeStamp($user->dob, 'd/m/Y'),
                'identity_card' => $user->identity_card,
            ],
            'courses' => $data
        ]);
    }
}
