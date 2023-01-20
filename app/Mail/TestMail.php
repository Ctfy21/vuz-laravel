<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Article;
use App\Models\Comment;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $article;
    protected $comment;
    public function __construct(Article $article, Comment $comment)
    {
        $this->article = $article;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('mailgun@sandbox5919cef43cc942ad976f97a040f8a1e6.mailgun.org')
                    ->to('skileev123@gmail.com')
                    ->with(['article' => $this->article, 'comment' => $this->comment])
                    ->view('mail/send');
    }
}
