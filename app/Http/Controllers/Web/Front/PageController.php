<?php

namespace Vanguard\Http\Controllers\Web\Front;

use Inertia\Inertia;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Repositories\Front\Page\FrontPageRepository;

class PageController extends Controller
{
    private $page;

    public function __construct(FrontPageRepository $page)
    {
        $this->page = $page;
    }

    public function index($slug)
    {
        $page = $this->page->detail($slug);
        if (!$page) {
            abort(404);
        }
        $data = [
            'page' => $page,
            'related' => $this->page->related($page),
        ];

        return Inertia::render('Page/Detail', $data);
    }
}
