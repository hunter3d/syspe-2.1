<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class RecoveredMail extends Mailable {
    use Queueable, SerializesModels;

    public $data;
    public $lang;
    public function __construct($data)
    {
        $this->data = $data;
        $this->lang = App::currentLocale();
    }

    public function envelope(): Envelope {
        if ( $this->lang == 'ru') {
            return new Envelope(
                subject: 'MyPE пароль восстановлен',
            );
        } elseif( $this->lang == 'en' ) {
            return new Envelope(
                subject: 'MyPE password recovered',
            );
        } else {
            return new Envelope(
                subject: 'MyPE пароль відновлено',
            );
        }
    }

    public function content(): Content {
        if ( $this->lang == 'ru') {
            return new Content(
                view: 'email.recovered_ru',
            );
        } elseif( $this->lang == 'en' ) {
            return new Content(
                view: 'email.recovered_en',
            );
        } else {
            return new Content(
                view: 'email.recovered_uk',
            );
        }
    }

    public function attachments(): array {
        return [];
    }
}
