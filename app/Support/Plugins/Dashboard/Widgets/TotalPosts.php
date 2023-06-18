<?php

namespace Vanguard\Support\Plugins\Dashboard\Widgets;

use Vanguard\Plugins\Widget;
use Vanguard\Repositories\Post\PostRepository;

class TotalPosts extends Widget
{
    public $width = '3';
    protected $permissions = 'post.manage';
    private $post;

    public function __construct(PostRepository $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('plugins.dashboard.widgets.total-posts', [
            'count' => $this->post->count()
        ]);
    }
}
