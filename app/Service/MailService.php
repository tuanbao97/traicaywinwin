<?php

namespace App\Service;

interface MailService
{
    public function sendMailResetPassword(string $to, string $linkReset) : bool;
}
