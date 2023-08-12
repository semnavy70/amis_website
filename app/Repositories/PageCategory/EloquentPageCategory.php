<?php

namespace Vanguard\Repositories\PageCategory;

use Illuminate\Support\Facades\DB;
use Vanguard\Page;
use Vanguard\PageCategory;

class EloquentPageCategory implements PageCategoryRepository
{
    public function paginate($paginate, $search = null)
    {
        $pageCategories = DB::table("page_categories as pc")
            ->leftJoin("pages as p", "p.category_id", "=", "pc.id")
            ->select("pc.*", DB::raw("count(p.id) as count_page"))
            ->when($search, function ($query) use ($search) {
                $query->where("pc.name", "LIKE", "%" . $search . "%")
                    ->orwhere('pc.slug', "LIKE", '%' . $search . '%');
            })
            ->groupBy("pc.id")
            ->orderBy('pc.order')
            ->paginate($paginate);

        return $pageCategories;
    }

    public function store(array $data)
    {
        $pageCategory = new PageCategory();
        $pageCategory->name = $data["name"];
        $pageCategory->description = $data["description"];
        $pageCategory->slug = $data["slug"];
        $pageCategory->order = $data["order"];

        $pageCategory->save();

        return $pageCategory;
    }

    public function single($id)
    {
        return PageCategory::find($id);
    }

    public function update($id, $data)
    {
        $pageCategory = PageCategory::find($id);
        $pageCategory->name = $data["name"];
        $pageCategory->description = $data["description"];
//        $pageCategory->slug = $data["slug"];
        $pageCategory->order = $data["order"];
        $pageCategory->save();

        return $pageCategory;
    }

    public function countById($id)
    {
        return Page::where("category_id", $id)->count();
    }

    public function delete($id)
    {
        PageCategory::find($id)->delete();
    }

    public function incrementOrder()
    {
        return (PageCategory::max('order') ?? 0) + 1;
    }
}
