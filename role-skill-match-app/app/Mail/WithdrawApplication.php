<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WithdrawApplication extends Mailable
{
    use Queueable, SerializesModels;

    // build the message.
    public function build()
    {
        return $this->subject('Withdraw Confirmation for Role Listing')
        ->view('withdraw-application')
        ->with([
            'role_name' => $this->data['role_name'],
            'work_arrangement' => $this->data['work_arrangement'],
            'staff_id' => $this->data['staff_id'],
            'application_id' => $this->data['application_id'],
            'application_withdraw_date' => $this->data['application_withdraw_date'],
            'staff_name' => $this->data['staff_name'],
            'staff_email' => $this->data['staff_email'],
        ]);
    }

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data=$data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Withdraw Application',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'withdraw-application',
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
