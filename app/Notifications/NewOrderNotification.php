<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewOrderNotification extends Notification
{
    use Queueable;
    private $order, $from, $to, $schedule;
    /**
     * Create a new notification instance.
     */
    public function __construct($order, $from, $to, $schedule)
    {
        $this->order = $order;
        $this->from = $from;
        $this->to = $to;
        $this->schedule = $schedule;
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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'warning',
            'message' => 'Permintaan pemesanan tiket dari ' . auth()->user()->name . ' untuk rute' . $this->from . ' - ' . $this->to . ' pada tanggal ' . Carbon::parse($this->schedule->departure_time)->format('d-m-Y') . ' pukul ' . Carbon::parse($this->schedule->departure_time)->format('H:i'),
        ];
    }
}
