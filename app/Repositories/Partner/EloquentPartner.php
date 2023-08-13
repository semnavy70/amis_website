<?php

namespace Vanguard\Repositories\Partner;

use Vanguard\Partner;

class EloquentPartner implements PartnerRepository
{

    public function paginate($paginate, $search = null)
    {
        $partners = Partner::orderBy('order',"asc")
            ->paginate($paginate);

        return $partners;
    }

    public function store(array $data)
    {
        $partner = new Partner();
        $partner->name = $data["name"];
        $partner->image = $data["image"];
        $partner->link = $data["link"];
        $partner->order = $data["order"];
        $partner->save();
        return $partner;
    }

    public function single($id)
    {
        return Partner::find($id);
    }

    public function update($id, $data)
    {
        $partner = Partner::find($id);
        $partner->name = $data["name"];
        $partner->link = $data["link"];
        if($data["image"]){
            $partner->image = $data["image"];
        }
        $partner->order = $data["order"];
        $partner->save();
        return $partner;
    }

    public function delete($id)
    {
        Partner::find($id)->delete();
    }

}
