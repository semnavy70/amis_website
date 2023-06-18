<?php

namespace Vanguard\Repositories\AdvertisePage;

use Illuminate\Support\Facades\DB;
use Vanguard\Advertise;
use Vanguard\AdvertisePage;

class EloquentAdvertisePage implements AdvertisePageRepository
{
    public function paginate($paginate, $search = null)
    {
        return DB::table('advertise_pages as ap')
            ->leftJoin('advertises as a', 'a.page', '=', 'ap.slug')
            ->when($search, function ($q) use ($search) {
                $q->where('ap.name', "LIKE", '%' . $search . '%')
                    ->orwhere('ab.slug', "LIKE", '%' . $search . '%');
            })
            ->groupBy('ap.id')
            ->select('ap.*', DB::raw('COUNT(a.id) as count_advertise'))
            ->orderBy('ap.order')
            ->paginate($paginate);
    }

    public function store(array $data)
    {
        $advertisePage = new AdvertisePage();
        $advertisePage->name = $data["name"];
        $advertisePage->slug = $data["slug"];
        $advertisePage->order = $data["order"];
        $advertisePage->save();
        return $advertisePage;
    }

    public function single($id)
    {
        return AdvertisePage::find($id);
    }

    public function update($id, $data)
    {
        $advertisePage = AdvertisePage::find($id);
        $advertisePage->name = $data["name"];
//        $advertisePage->slug = $data["slug"];
        $advertisePage->order = $data["order"];
        $advertisePage->save();
        return $advertisePage;
    }

    public function countBySlug($slug)
    {
        return Advertise::where('page', $slug)->count();
    }

    public function delete($id)
    {
        AdvertisePage::find($id)->delete();
    }

    public function incrementOrder()
    {
        return (AdvertisePage::max('order') ?? 0) + 1;
    }
}
