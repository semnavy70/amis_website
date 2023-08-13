<?php

namespace Vanguard\Repositories\Slide;

use Illuminate\Support\Facades\DB;
use Vanguard\Slide;

class EloquentSlide implements SlideRepository
{

    public function paginate($paginate, $search = null)
    {
        $slides = Slide::orderBy('order',"asc")
            ->paginate($paginate);

        return $slides;
    }

    public function store(array $data)
    {
        $slide = new Slide();
        $slide->name = $data["name"];
        $slide->image = $data["image"];
        $slide->order = $data["order"];
        $slide->save();
        return $slide;
    }

    public function single($id)
    {
        return Slide::find($id);
    }

    public function update($id, $data)
    {
        $slide = Slide::find($id);
        $slide->name = $data["name"];
        if($data["image"]){
            $slide->image = $data["image"];
        }
        $slide->order = $data["order"];
        $slide->save();
        return $slide;
    }

    public function delete($id)
    {
        Slide::find($id)->delete();
    }

}
