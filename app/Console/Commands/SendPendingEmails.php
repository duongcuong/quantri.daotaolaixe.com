<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Email;
use Illuminate\Support\Facades\Mail;

class SendPendingEmails extends Command
{
    protected $signature = 'send:pending-emails';
    protected $description = 'Gửi các email đang chờ';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $emails = Email::where('status', 'pending')->get();

        foreach ($emails as $email) {
            try {
                $params = json_decode($email->params, true);
                $body = view($email->template, $params)->render();

                Mail::send([], [], function ($message) use ($email, $body) {
                    $message->to($email->to)
                            ->subject($email->subject)
                            ->setBody($body, 'text/html');
                });
                $email->update(['status' => 'sent', 'log' => 'Email sent successfully']);
            } catch (\Exception $e) {
                $email->update(['status' => 'failed', 'log' => $e->getMessage()]);
            }
        }

        $this->info('Pending emails sent.');
    }
}
