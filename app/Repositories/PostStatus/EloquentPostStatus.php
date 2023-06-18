<?php

namespace Vanguard\Repositories\PostStatus;

use Illuminate\Support\Facades\DB;
use Vanguard\Post;
use Vanguard\PostStatus;

class EloquentPostStatus implements PostStatusRepository
{
    public function paginate($paginate, $search = null)
    {
        return DB::table("post_statuses as ps")
            ->leftJoin("posts as p", "p.status", "=", "ps.slug")
            ->select("ps.*", DB::raw("count(p.id) as count_post"))
            ->when($search, function ($query) use ($search) {
                $query->where("ps.name", "LIKE", "%" . $search . "%")
                    ->orwhere('ps.slug', "LIKE", '%' . $search . '%');
            })
            ->groupBy("ps.id")
            ->paginate($paginate);
    }

    public function store(array $data)
    {
        $postStatus = new PostStatus();
        $postStatus->name = $data["name"];
        $postStatus->slug = $data["slug"];
        $postStatus->order = $data["order"];
        $postStatus->save();
        return $postStatus;
    }

    public function single($id)
    {
        return PostStatus::find($id);
    }

    public function update($id, $data)
    {
        $postStatus = PostStatus::find($id);
        $postStatus->name = $data["name"];
//        $postStatus->slug = $data["slug"];
        $postStatus->order = $data["order"];
        $postStatus->save();
        return $postStatus;
    }

    public function countById($id)
    {
        return Post::where("status", $id)->count();
    }

    public function delete($id)
    {
        PostStatus::find($id)->delete();
    }

    public function incrementOrder()
    {
        return (PostStatus::max('order') ?? 0) + 1;
    }
}
