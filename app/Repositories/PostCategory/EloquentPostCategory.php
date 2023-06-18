<?php

namespace Vanguard\Repositories\PostCategory;

use Illuminate\Support\Facades\DB;
use Vanguard\Post;
use Vanguard\PostCategory;

class EloquentPostCategory implements PostCategoryRepository
{

    public function paginate($paginate, $search = null)
    {
        $postCategories = DB::table("post_categories as pc")
            ->leftJoin("posts as p", "p.category_id", "=", "pc.id")
            ->select("pc.*", DB::raw("count(p.id) as count_post"))
            ->when($search, function ($query) use ($search) {
                $query->where("pc.name", "LIKE", "%" . $search . "%")
                    ->orwhere('pc.slug', "LIKE", '%' . $search . '%');
            })
            ->groupBy("pc.id")
            ->orderBy('pc.order')
            ->paginate($paginate);

        return $postCategories;
    }

    public function store(array $data)
    {
        $postCategory = new PostCategory();
        $postCategory->name = $data["name"];
        $postCategory->slug = $data["slug"];
        $postCategory->order = $data["order"];
        $postCategory->save();
        return $postCategory;
    }

    public function single($id)
    {
        return PostCategory::find($id);
    }

    public function update($id, $data)
    {
        $postCategory = PostCategory::find($id);
        $postCategory->name = $data["name"];
//        $postCategory->slug = $data["slug"];
        $postCategory->order = $data["order"];
        $postCategory->save();
        return $postCategory;
    }

    public function countById($id)
    {
        return Post::where("category_id", $id)->count();
    }

    public function delete($id)
    {
        PostCategory::find($id)->delete();
    }

    public function incrementOrder()
    {
        return (PostCategory::max('order') ?? 0) + 1;
    }
}
