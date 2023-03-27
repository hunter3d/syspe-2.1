<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class TicketEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $lang;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $data )
    {
        $this->data = $data;
        $this->lang = App::currentLocale();
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        if ( $this->lang == 'ru') {
            return new Envelope(
                subject: 'MyPE: билет на мероприятие',
            );
        } elseif( $this->lang == 'en' ) {
            return new Envelope(
                subject: 'MyPE Event Ticket',
            );
        } else {
            return new Envelope(
                subject: 'MyPE: квиток на захід',
            );
        }

    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        if ( $this->lang == 'ru') {
            return new Content(
                view: 'email.ticket_ru',
            );
        } elseif ( $this->lang == 'en' ) {
            return new Content(
                view: 'email.ticket_en',
            );
        } else {
            return new Content(
                view: 'email.ticket_uk',
            );
        }

    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [
            Attachment::fromPath(public_path().$this->data['ticket']->file)
                ->as('ticket.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
