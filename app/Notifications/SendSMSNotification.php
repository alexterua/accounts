<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Nutnet\LaravelSms\Notifications\NutnetSmsChannel;
use Nutnet\LaravelSms\Notifications\NutnetSmsMessage;

class SendSMSNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function via($notifiable)
    {
        return [NutnetSmsChannel::class];
    }

    public function toNutnetSms($notifiable)
    {
        return new NutnetSmsMessage('текст сообщения');
    }
}
