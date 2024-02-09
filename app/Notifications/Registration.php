<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Registration extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $user;
    protected $password;
    public function __construct($user,$password)
    {
        //
        $this->user = $user;
        $this->password = $password;
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
        return (new MailMessage)
                ->greeting('Good Day!')
                ->subject('Account Creation')
                ->line('Your account has been successfully created by the administrator. To generate your QR Code, please click the link below and enter the provided credentials.')
                ->line('Email : '.$this->user->email)
                ->line('Password : '.$this->password)
                ->line('Please click the button provided for faster transaction')
                ->action('E-Pass Access', url('/'))
                ->line('Thank you for using our application!');
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
