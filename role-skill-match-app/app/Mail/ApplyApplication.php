<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplyApplication extends Mailable
{
    use Queueable, SerializesModels;

    // build the message.
    public function build()
    {
        return $this->subject('Apply Application Confirmation')
            ->view('apply-role-email')
            ->with([
                'role_name' => $this->data['role_name'],
                'work_arrangement' => $this->data['work_arrangement'],
                'staff_id' => $this->data['staff_id'],
                'application_id' => $this->data['application_id'],
                'application_apply_date' => $this->data['application_apply_date'],
                'staff_name' => $this->data['staff_name'],
                'staff_email' => $this->data['staff_email'],
            ]);
    }

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Apply Application Confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'apply-role-email',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
