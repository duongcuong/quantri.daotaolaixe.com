<?php
namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use App\Models\CourseUser;
use App\Models\User;
use App\Notifications\TuitionFeeReminder;
use App\Models\Email;
use Carbon\Carbon;

class CheckTuitionFee extends Command
{
    protected $signature = 'check:tuition-fee';
    protected $description = 'Kiểm tra học phí và gửi thông báo nếu chưa hoàn thành sau 30 ngày';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $courseUsers = CourseUser::with(['fees', 'user', 'teacher', 'sale', 'course'])
            ->whereHas('fees', function ($query) {
                $query->havingRaw('MIN(payment_date) = ?', [Carbon::now()->subDays(NOTIFI_FEE)->toDateString()])
                      ->havingRaw('SUM(amount) < course_users.tuition_fee');
            })
            ->limit(1)
            ->get();

        // Lấy tất cả các user thuộc role admin và super-admin
        $adminUsers = Admin::whereHas('roles', function ($query) {
            $query->whereIn('slug', [ROLE_ADMIN, ROLE_SUPERADMIN]);
        })->get();

        foreach ($courseUsers as $courseUser) {
            $firstPaymentDate = $courseUser->fees->min('payment_date');
            $totalPaid = $courseUser->fees->sum('amount');
            $usersToNotify = [
                ['user' => $courseUser->user, 'template' => 'emails.tuition_fee_reminder_user'],
                ['user' => $courseUser->teacher, 'template' => 'emails.tuition_fee_reminder_teacher'],
                ['user' => $courseUser->sale, 'template' => 'emails.tuition_fee_reminder_sale']
            ];

            foreach ($adminUsers as $adminUser) {
                $usersToNotify[] = ['user' => $adminUser, 'template' => 'emails.tuition_fee_reminder_admin'];
            }

            foreach ($usersToNotify as $notify) {
                $user = $notify['user'];
                $template = $notify['template'];

                $totalPaid = $courseUser->fees->sum('amount');
                $totalFee = $courseUser->tuition_fee;
                $remainingFee = $totalFee - $totalPaid;

                if (!$user->notifications()->where('type', 'TuitionFeeReminder')->where('data->course_user_id', $courseUser->id)->exists()) {
                    $user->notify(new TuitionFeeReminder($courseUser));

                    $params = [
                        'title' => 'Thông báo học phí',
                        'site_url' => url('/'),
                        'userAdmin' => $user->name,
                        'userName' => $courseUser->user->name,
                        'courseName' => $courseUser->course->code,
                        'teacherName' => $courseUser->teacher->name,
                        'saleName' => $courseUser->sale->name,
                        'courseUserId' => $courseUser->id,
                        'totalFee' => $totalFee,
                        'totalPaid' => $totalPaid,
                        'remainingFee' => $remainingFee
                    ];

                    Email::create([
                        'to' => $user->email,
                        'subject' => 'Thông báo học phí',
                        'template' => $template,
                        'params' => json_encode($params),
                        'status' => 'pending'
                    ]);
                }
            }
        }

        $this->info('Check tuition fee completed.');
    }
}
