<?php

namespace App\Jobs;

use App\Mail\SubscribeEmail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendSubscribeEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public User $user)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Enviar correos, funcion en Mail/subscribeemanil
        // Mail::to('no-reply@example.net.com')
        Mail::to($this->user->email)
            ->send(new SubscribeEmail('contact@gmail.com', "CONTACTA YAAA", "<h1>CRISTO VIENE</h1><p>Hola a todos</p>"));

    }
}
