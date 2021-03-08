<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class PasswordResetRequest extends Notification
{
    use Queueable;

   /**
    * Create a new notification instance.
    *
    * @return void
    */
    public function __construct($token)
    {
        $this->token = $token;
    }
    /**
    * Get the notification's delivery channels.
    *
    * @param  mixed  $notifiable
    * @return array
    */
    public function via($notifiable)
    {
        return ['mail'];
    }
     /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
     public function toMail($notifiable)
     {
        $url = 'https://adolescent.nnsop.org/reset_password?reset_token='.$this->token;
        // $url = url('/api/password/find/'.$this->token);
        return (new MailMessage)
            ->subject('পাসওয়ার্ড পুনরায় সেট করার অনুরোধ')
            ->greeting('হ্যালো!')
            ->line('আপনি এই ইমেলটি পাচ্ছেন কারণ আমরা আপনার অ্যাকাউন্টের জন্য একটি পাসওয়ার্ড পুনরায় সেট করার অনুরোধ পেয়েছি। ')
            ->action('পাসওয়ার্ড রিসেট', url($url))
            ->line('আপনি যদি পাসওয়ার্ড পুনরায় সেট করার অনুরোধ না করেন তবে আর কোনও পদক্ষেপের প্রয়োজন নেই।');
    }
    /**
    * Get the array representation of the notification.
    *
    * @param  mixed  $notifiable
    * @return array
    */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
