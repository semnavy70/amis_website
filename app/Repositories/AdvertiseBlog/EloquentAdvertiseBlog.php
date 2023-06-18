<?php

namespace Vanguard\Repositories\AdvertiseBlog;

use Illuminate\Support\Facades\DB;
use Vanguard\Advertise;
use Vanguard\AdvertiseBlog;

class EloquentAdvertiseBlog implements AdvertiseBlogRepository
{

    public function paginate($paginate, $search = null)
    {
        return DB::table('advertise_blogs as ab')
            ->leftJoin('advertises as a', 'a.blog', '=', 'ab.slug')
            ->when($search, function ($q) use ($search) {
                $q->where('ab.name', "LIKE", '%' . $search . '%')
                    ->orwhere('ab.slug', "LIKE", '%' . $search . '%');
            })
            ->groupBy('ab.id')
            ->select('ab.*', DB::raw('COUNT(a.id) as count_advertise'))
            ->orderBy('ab.order')
            ->paginate($paginate);
    }

    public function store(array $data)
    {
        $advertiseBlog = new AdvertiseBlog();
        $advertiseBlog->name = $data["name"];
        $advertiseBlog->slug = $data["slug"];
        $advertiseBlog->order = $data["order"];
        $advertiseBlog->save();
        return $advertiseBlog;
    }

    public function single($id)
    {
        return AdvertiseBlog::find($id);
    }

    public function update($id, $data)
    {
        $advertiseBlog = AdvertiseBlog::find($id);
        $advertiseBlog->name = $data["name"];
//        $advertiseBlog->slug = $data["slug"];
        $advertiseBlog->order = $data["order"];
        $advertiseBlog->save();
        return $advertiseBlog;
    }

    public function countBySlug($slug)
    {
        return Advertise::where('blog', $slug)->count();
    }

    public function delete($id)
    {
        AdvertiseBlog::find($id)->delete();
    }

    public function incrementOrder()
    {
        return (AdvertiseBlog::max('order') ?? 0) + 1;
    }
}
