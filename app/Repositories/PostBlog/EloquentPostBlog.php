<?php

namespace Vanguard\Repositories\PostBlog;

use Illuminate\Support\Facades\DB;
use Vanguard\Post;
use Vanguard\PostBlog;

class EloquentPostBlog implements PostBlogRepository
{
    public function paginate(int $paginate, $search = null)
    {
        $postBlogs = DB::table("post_blogs as pb")
            ->leftJoin("posts as p", "p.blog", "=", "pb.slug")
            ->select("pb.*", DB::raw("count(p.id) as count_post"))
            ->when($search, function ($query) use ($search) {
                $query->where("pb.name", "LIKE", "%" . $search . "%")
                    ->orwhere('pb.slug', "LIKE", '%' . $search . '%');
            })
            ->groupBy("pb.id")
            ->paginate($paginate);

        return $postBlogs;
    }

    public function store(array $data)
    {
        $postBlog = new PostBlog();
        $postBlog->name = $data["name"];
        $postBlog->slug = $data["slug"];
        $postBlog->order = $data["order"];
        $postBlog->save();

        return $postBlog;
    }

    public function single(int $id)
    {
        return PostBlog::find($id);
    }

    public function update(int $id, array $data)
    {
        $postBlog = PostBlog::find($id);
        $postBlog->name = $data["name"];
//        $postBlog->slug = $data["slug"];
        $postBlog->order = $data["order"];
        $postBlog->save();

        return $postBlog;
    }

    public function countById($id)
    {
        return Post::where("slug", $id)->count();
    }

    public function delete(int $id)
    {
        PostBlog::find($id)->delete();
    }

    public function incrementOrder()
    {
        return (PostBlog::max('order') ?? 0) + 1;
    }
}
