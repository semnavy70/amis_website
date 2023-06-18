<?php

namespace Vanguard\Support\Plugins\Dashboard\Widgets;

use Carbon\Carbon;
use Vanguard\Plugins\Widget;
use Vanguard\Repositories\Post\PostRepository;

class PostHistory extends Widget
{
    public $width = '9';
    protected $permissions = 'post.manage';
    protected $postsPerMonth;
    private $post;

    public function __construct(PostRepository $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('plugins.dashboard.widgets.post-history', [
            'postsPerMonth' => $this->getPostsPerMonth()
        ]);
    }

    private function getPostsPerMonth()
    {
        if ($this->postsPerMonth) {
            return $this->postsPerMonth;
        }

        return $this->postsPerMonth = $this->post->countOfNewPostsPerMonth(
            Carbon::now()->subYear()->startOfMonth(),
            Carbon::now()->endOfMonth()
        );
    }

    public function scripts()
    {
        return view('plugins.dashboard.widgets.post-history-scripts', [
            'postsPerMonth' => $this->getPostsPerMonth()
        ]);
    }
}
