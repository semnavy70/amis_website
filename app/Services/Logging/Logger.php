<?php

namespace Vanguard\Services\Logging;

use Illuminate\Contracts\Auth\Factory;
use Illuminate\Http\Request;
use Vanguard\Repositories\Activity\ActivityRepository;

class Logger
{
    protected $user = null;
    private $request;
    private $auth;
    private $activities;

    public function __construct(Request $request, Factory $auth, ActivityRepository $activities)
    {
        $this->request = $request;
        $this->auth = $auth;
        $this->activities = $activities;
    }

    public function log($description)
    {
        return $this->activities->log([
            'description' => $description,
            'user_id' => $this->getUserId(),
            'ip_address' => $this->request->ip(),
            'user_agent' => $this->getUserAgent()
        ]);
    }

    private function getUserId()
    {
        if ($this->user) {
            return $this->user->id;
        }

        return $this->auth->guard()->id();
    }

    private function getUserAgent()
    {
        return substr((string)$this->request->header('User-Agent'), 0, 500);
    }

    public function setUser($user)
    {
        $this->user = $user;
    }
}
