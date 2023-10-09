<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    public $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $addr  = $this->order->billingAddress;
        return (new MailMessage)
            ->subject("New Order #{$this->order->number} ")
            ->greeting("Hi {$notifiable->name}")
            ->line("a new order #{$this->order->number} created by {$addr->name} ")
            ->action('View order', url('/dashboard'))
            ->line('Thank you for using our application!');
    }



    public function toDatabase(object $notifiable)
    {
        $addr  = $this->order->billingAddress;
        return  [
            'subject' => ("a new order #{$this->order->number}"),
            'icon' => 'fas fa-file mr-2',
            'url' => url('/dashboard'),
            'order_id' => $this->order->id,
        ];
    }

    public function toBroadcast(object $notifiable)
    {
        $addr  = $this->order->billingAddress;
        return  [
            'subject' => ("a new order #{$this->order->number} created by {$addr->name}"),
            'icon' => 'fas fa-file mr-2',
            'url' => url('/dashboard'),
            'order_id' => $this->order->id,

        ];
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
