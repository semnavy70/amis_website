<?php

namespace Vanguard\Listeners\Login;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Vanguard\Events\User\LoggedIn;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Services\Logging\Logger;

class UpdateLastLoginTimestamp
{
    private $users;
    private $guard;
    private $logger;

    public function __construct(UserRepository $users, Guard $guard, Logger $logger)
    {
        $this->users = $users;
        $this->guard = $guard;
        $this->logger = $logger;
    }

    public function handle(LoggedIn $event)
    {
        $this->users->update(
            $this->guard->id(),
            ['last_login' => Carbon::now()]
        );
        $this->logger->log(__("Log In"));
    }
}
