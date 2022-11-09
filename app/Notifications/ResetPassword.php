<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Http\RedirectResponse;
use Redirect;

class ResetPassword extends Notification
{
    use Queueable;
    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
        // $token->notify(new WelcomeNotification($token));
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
            ->subject('Reset Password')
            ->line('Kami menerima permintaan Lupa Password anda, Klik tombol Reset Password di bawah untuk diarahkan ke Sistem Lupa Password')
            ->action('Reset Password', url('password/reset', $this->token))
            ->line('Permintaan anda akan kadaluarsa dalam 60 menit ke depan. Lakukan Reset Password anda segera. Setelah anda berhasil Login kembali, Lengkapi Profil Anda pada Menu Profil. Terima Kasih :)');
        // print_r($notifiable);
        // die();
        // return view('login')->with('message','Ubah Hasil Antigen Berhasil');
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
