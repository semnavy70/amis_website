<?php

namespace Vanguard\Repositories\Advertising\advertises;

use DB;
use Vanguard\Advertise;
use Vanguard\Services\Upload\FileUploadManager;


class EloquentAdvertises implements AdvertisesRepository
{
    private  $fileUploadManager;

    public  function __construct(FileUploadManager $fileUploadManager)
    {
        $this->fileUploadManager = $fileUploadManager;
    }


    public function paginate($paginate, $search = null)
    {
        $advertises = DB::table("advertises as a")
            ->select('a.*', DB::raw("COUNT('al.id') as click"))
            ->leftJoin('advertise_logs as al', 'al.advertise_id', '=', 'a.id')
            ->groupBy('a.id')
            ->paginate($paginate);

        return $advertises;
    }

    public function store(array $data)
    {
        $advertises = new Advertise();
        $advertises->name = $data["name"];
        $advertises->link = $data["link"];
        $advertises->page = $data["page"];
        $advertises->blog_no = $data["blog_no"];
        $advertises->image = $this->fileUploadManager->uploadFile($data['image']);
        $advertises->save();

        return $advertises;
    }

    public function single($id)
    {
        return Advertise::find($id);
    }

    public function update($id, $data)
    {
        $advertises =  Advertise::find($id);
        $advertises->name = $data["name"];
        $advertises->link = $data["link"];
        $advertises->page = $data["page"];
        $advertises->blog_no = $data["blog_no"];
        $advertises->save();
        return $advertises;
    }

    public function countById($id)
    {
        // TODO: Implement countById() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
