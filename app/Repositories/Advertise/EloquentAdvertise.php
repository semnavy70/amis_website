<?php

namespace Vanguard\Repositories\Advertise;

use Illuminate\Support\Facades\DB;
use Vanguard\Advertise;
use Vanguard\AdvertiseBlog;
use Vanguard\AdvertisePage;
use Vanguard\Services\Upload\UploadFileManager;

class EloquentAdvertise implements AdvertiseRepository
{
    private $fileManager;

    public function __construct(UploadFileManager $fileManager)
    {
        $this->fileManager = $fileManager;
    }

    public function paginate($paginate, $search = null)
    {
        return DB::table('advertises as a')
            ->leftJoin('advertise_pages as ap', 'ap.slug', '=', 'a.page')
            ->leftJoin('advertise_blogs as ab', 'ab.slug', '=', 'a.blog')
            ->leftJoin('advertise_logs as ag', 'ag.advertise_id', '=', 'a.id')
            ->when($search, function ($q) use ($search) {
                $q->where('a.name', "LIKE", '%' . $search . '%')
                    ->orWhere('a.page', "LIKE", '%' . $search . '%')
                    ->orWhere('ap.name', "LIKE", '%' . $search . '%')
                    ->orWhere('ap.slug', "LIKE", '%' . $search . '%')
                    ->orWhere('ab.name', "LIKE", '%' . $search . '%')
                    ->orWhere('ab.slug', "LIKE", '%' . $search . '%')
                    ->orWhere('a.blog', "LIKE", '%' . $search . '%')
                    ->orWhere('a.link', "LIKE", '%' . $search . '%');
            })
            ->select(
                'a.*',
                DB::raw('Max(ap.name) as page_name'),
                DB::raw('Max(ab.name) as blog_name'),
                DB::raw('COUNT(ag.id) as click_count')
            )
            ->groupBy(['a.id'])
            ->paginate($paginate);
    }

    public function store(array $data)
    {
        $advertise = new Advertise();
        $advertise->name = $data["name"];
        $advertise->link = $data["link"];
        $advertise->order = $data["order"];
        $advertise->blog = $data["blog"];
        $advertise->page = $data["page"];
        $advertise->is_active = $data["is_active"];
        $advertise->image = $this->fileManager->uploadFile($data["image"]);
        if (isset($data["image_mobile"])) {
            if (is_file($data["image_mobile"])) {
                $advertise->image_mobile = $this->fileManager->uploadFile($data["image_mobile"]);
            }
        }
        if (isset($data["image_tablet"])) {
            if (is_file($data["image_tablet"])) {
                $advertise->image_tablet = $this->fileManager->uploadFile($data["image_tablet"]);
            }
        }
        $advertise->save();

        return $advertise;
    }

    public function single($id)
    {
        return Advertise::find($id);
    }

    public function update($id, $data)
    {
        $advertise = Advertise::find($id);
        $advertise->name = $data["name"];
        $advertise->link = $data["link"];
        $advertise->order = $data["order"];
        $advertise->blog = $data["blog"];
        $advertise->page = $data["page"];
        $advertise->is_active = $data["is_active"];
        if (isset($data["image"])) {
            if (is_file($data["image"])) {
                $advertise->image = $this->fileManager->uploadFile($data["image"]);
            }
        }
        if (isset($data["image_mobile"])) {
            if (is_file($data["image_mobile"])) {
                $advertise->image_mobile = $this->fileManager->uploadFile($data["image_mobile"]);
            }
        }
        if (isset($data["image_tablet"])) {
            if (is_file($data["image_tablet"])) {
                $advertise->image_tablet = $this->fileManager->uploadFile($data["image_tablet"]);
            }
        }
        $advertise->save();

        return $advertise;
    }

    public function delete($id)
    {
        Advertise::find($id)->delete();
    }

    public function incrementOrder()
    {
        return (Advertise::max('order') ?? 0) + 1;
    }

    public function pages()
    {
        return AdvertisePage::orderBy('order')->get();
    }

    public function blogs()
    {
        return AdvertiseBlog::orderBy('order')->get();
    }

    public function count()
    {
        return Advertise::count();
    }
}
