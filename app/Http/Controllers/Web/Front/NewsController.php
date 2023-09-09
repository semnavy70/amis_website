<?php

namespace Vanguard\Http\Controllers\Web\Front;

use Inertia\Inertia;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Repositories\Front\News\NewsRepository;

class NewsController extends Controller
{
    private $news;

    public function __construct(NewsRepository $news)
    {
        $this->news = $news;
    }

    public function index()
    {
        $data = [
            'paginate' => $this->news->paginate(),
        ];
        return Inertia::render('News/Index', $data);
    }

    public function detail($id)
    {
        $post = $this->news->detail($id);
        $data = [
            'post' => $post,
            'related' => $this->news->related($post),
        ];
        return Inertia::render('News/Detail', $data);
    }
}
