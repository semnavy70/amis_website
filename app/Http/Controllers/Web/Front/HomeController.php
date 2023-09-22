<?php

namespace Vanguard\Http\Controllers\Web\Front;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Repositories\Front\Home\HomeRepository;
use Vanguard\Support\Traits\HomePageTrait;

class HomeController extends Controller
{
    use HomePageTrait;

    public function __construct(private HomeRepository $home)
    {
    }

    public function index(): \Inertia\Response
    {
        return Inertia::render('Home/Home');
    }

    public function latestProduct()
    {
        return $this->home->latestProduct();
    }

    public function latestProductExport()
    {
        return $this->home->latestProductExport();
    }

    public function categories(): \Illuminate\Support\Collection
    {
        return $this->home->categories();
    }

    public function commodities($categoryCode): \Illuminate\Support\Collection
    {
        return $this->home->commodities($categoryCode);
    }

    public function averagePrice(): array
    {
        return $this->home->averagePrice();
    }

    public function monthly($dataseriesCode, $cultureId): array
    {
        return $this->home->monthly($dataseriesCode, $cultureId);
    }
}
