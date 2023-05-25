<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddFatura extends Notification
{
    use Queueable;
    private $fatura_id;

    /**
     * Create a new notification instance.
     */
    public function __construct($fatura_id)
    {
       // $this->fatura_id = $fatura_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)

    {
  /*
        $url = 'http://127.0.0.1:8000/faturalar_details/'.$this->fatura_id;

        return (new MailMessage)
                    ->subject('Yeni fatura hakkında bilgilendirme')
                    ->line('Yeni fatura hakkında bilgilendirme')
                    ->action('Faturayı göster', $url)
                    ->line('E-tahsilet kullandığınız için teşekkür ederiz');  */
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
