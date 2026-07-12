<?php

namespace App\Service\impl;

use App\Mail\ForgotPasswordEmail;
use App\Service\MailService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailServiceImpl implements MailService
{
    public function sendMailResetPassword(string $to, string $linkReset) : bool {
        try {
            Mail::to($to)->send(new ForgotPasswordEmail(
                $to
                , $linkReset
            ));
            Log::info('Gửi email thành công.');
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}
