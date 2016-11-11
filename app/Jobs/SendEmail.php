<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
class SendEmail implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $exceptionData;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$exceptionData)
    {
        $this->email = $email;
        $this->exceptionData = $exceptionData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = $this->email;
        if ($email) {
            Mail::send('email.system.error',['exceptionData' => $this->exceptionData],function ($message) use($email)
            {
                $message ->to($email)->subject('system error');
            });
        }
    }
}
