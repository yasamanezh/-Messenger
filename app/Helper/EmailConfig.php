<?php

namespace App\Helper;

use Illuminate\Support\Facades\Config;
use App\Repositories\Contract\ISetting;

class EmailConfig
{

    public function emailConfig()
    {
        $siteOption=app()->make(ISetting::class)->first();
        
        if($siteOption->mail_username){
            Config::set('mail.mailers.smtp.username', $siteOption->mail_username);
        }
        if($siteOption->mail_password){
            Config::set('mail.mailers.smtp.password', $siteOption->mail_password);
        }
        if($siteOption->mail_mailer){
            Config::set('mail.mailers.smtp.transport', $siteOption->mail_mailer);
        }else{
            Config::set('mail.mailers.smtp.transport', 'smtp');
        }
        if($siteOption->mail_host){
            Config::set('mail.mailers.smtp.host', $siteOption->mail_host);
        }else{
            Config::set('mail.mailers.smtp.host', 'smtp.mailgun.org');
        }
        if($siteOption->mail_port){
            Config::set('mail.mailers.smtp.port', $siteOption->mail_port);
        }else{
            Config::set('mail.mailers.smtp.port','587');
        }
        if($siteOption->mail_encription){
            Config::set('mail.mailers.smtp.encryption', $siteOption->mail_encription);
        }else{
            Config::set('mail.mailers.smtp.encryption','tls');
        }
    }


}
