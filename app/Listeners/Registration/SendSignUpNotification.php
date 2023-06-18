<?php

namespace Vanguard\Listeners\Registration;

use Illuminate\Auth\Events\Registered;
use Mail;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Services\Logging\Logger;

class SendSignUpNotification
{
    private $users;
    private $logger;

    public function __construct(UserRepository $users, Logger $logger)
    {
        $this->users = $users;
        $this->logger = $logger;
    }

    public function handle(Registered $event)
    {
        if (!setting('notifications_signup_email')) {
            return;
        }

        foreach ($this->users->getUsersWithRole('Admin') as $user) {
            Mail::to($user)->send(new \Vanguard\Mail\UserRegistered($event->user));
        }

        $this->logger->log(__("Register User"));
    }
}
