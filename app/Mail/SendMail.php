<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Repositories\Contract\ISetting;
use App\Helper\facade\EmailConfig;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $option,$URL,$message,$name;
    public function __construct($email)
    {
      EmailConfig::emailConfig();
      
        $this->URL=\Illuminate\Support\Facades\URL::to('/');
        $this->option=app()->make(ISetting::class)->first();
        $this->message=$email;
        $this->name = $this->option->customTranslate('en')->title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.send_mail')->subject('order success !');
    }
}
