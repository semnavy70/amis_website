<?php

namespace Vanguard\Http\Controllers\Web\Post;

use Vanguard\Http\Controllers\Controller;
use Vanguard\Repositories\PostLog\PostLogRepository;

class PostLogController extends Controller
{
    private $postLog;

    public function __construct(PostLogRepository $postLog)
    {
        $this->postLog = $postLog;
    }

    public function index($postId)
    {
        $list = $this->postLog->paginate(10, $postId);

        $data = [
            'list' => $list,
        ];
        return view('post.log.index', $data);
    }
}
