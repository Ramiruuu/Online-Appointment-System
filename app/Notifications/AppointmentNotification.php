<?php

namespace App\Notifications;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentNotification extends Notification
{
    use Queueable;

    public Appointment $appointment;
    public string $notificationType;

    public function __construct(Appointment $appointment, string $notificationType = 'booking')
    {
        $this->appointment = $appointment;
        $this->notificationType = $notificationType;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $appointment = $this->appointment;
        $subject = match ($this->notificationType) {
            'cancelled' => 'Your appointment has been cancelled',
            'status' => 'Appointment status updated',
            default => 'Appointment booking confirmation',
        };

        $message = (new MailMessage)
            ->subject($subject)
            ->greeting('Hello '.$notifiable->name.',')
            ->line('Thank you for using our online appointment system.')
            ->line('Service: '.$appointment->service->name)
            ->line('Date & Time: '.$appointment->appointment_date->format('F j, Y g:i A'))
            ->line('Status: '.ucfirst($appointment->status));

        if ($this->notificationType === 'cancelled' && $appointment->cancellation_reason) {
            $message->line('Cancellation reason: '.$appointment->cancellation_reason);
        }

        if ($this->notificationType === 'status' && $appointment->status === 'cancelled' && $appointment->cancellation_reason) {
            $message->line('Cancellation reason: '.$appointment->cancellation_reason);
        }

        $message->action('View Appointments', url(route('appointments.index', [], false)))
            ->line('We appreciate your trust in our service and look forward to helping you stay healthy.');

        return $message;
    }
}
