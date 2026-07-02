<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AppointmentApprovedNotification extends Notification
{
    use Queueable;

    protected $appointment;

    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        if ($this->appointment->service_type == 'doctor') {

            $providerName = $this->appointment->doctor->name;

            if ($this->appointment->status == 'approved') {

                $title = 'Appointment Approved';
                $message = "Dr. {$providerName} accepted your appointment.";
            } elseif ($this->appointment->status == 'rejected') {

                $title = 'Appointment Rejected';
                $message = "Dr. {$providerName} rejected your appointment.";
            }
        } else {

            $providerName = $this->appointment->lawyer->name;

            if ($this->appointment->status == 'approved') {

                $title = 'Appointment Approved';
                $message = "Lawyer {$providerName} accepted your appointment.";
            } elseif ($this->appointment->status == 'rejected') {

                $title = 'Appointment Rejected';
                $message = "Lawyer {$providerName} rejected your appointment.";
            }
        }

        return [

            'appointment_id' => $this->appointment->id,

            'title' => $title,

            'message' => $message,

            'url' => route('myAppiontments'),

        ];
    }
}
