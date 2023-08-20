<?php

namespace Vanguard\Http\Controllers\Web\Front;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Repositories\Front\News\NewsRepository;

class SearchController extends Controller
{
    private $news;

    public function __construct(NewsRepository $news)
    {
        $this->news = $news;
    }


    public function index(Request $request)
    {
        $search = $request->query('search');
        $data = [
            'paginate' => $this->news->paginate($search),
        ];
        return Inertia::render('Search', $data);
    }

}
