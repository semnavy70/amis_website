<?php

namespace Vanguard\Repositories\PostLog;

interface PostLogRepository
{
    public function logUpdater($postId);

    public function paginate($paginate, $postId);

}
