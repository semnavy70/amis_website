<?php

namespace Vanguard\Repositories\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Vanguard\Post;
use Vanguard\PostBlog;
use Vanguard\PostCategory;
use Vanguard\PostStatus;
use Vanguard\Services\Upload\UploadFileManager;
use Vanguard\Support\Enum\PostBlogEnum;
use Vanguard\Support\Enum\PostStatusEnum;

class EloquentPost implements PostRepository
{
    private $fileManager;
    private $folder;

    public function __construct(UploadFileManager $fileManager)
    {
        $this->fileManager = $fileManager;
        $this->folder = "post/" . date("Ym");
    }

    public function paginate(int $paginate, $search = null)
    {
        return DB::table('posts as p')
            ->leftJoin('users as u', 'p.by', '=', 'u.id')
            ->leftJoin('post_statuses as ps', 'ps.slug', '=', 'p.status')
            ->when($search, function ($q) use ($search) {
                $q->where('p.title', "LIKE", "%" . $search . "%")
                    ->orWhere('p.slug', "LIKE", "%" . $search . "%")
                    ->orWhere('p.status', "LIKE", "%" . $search . "%")
                    ->orWhere('p.blog', "LIKE", "%" . $search . "%")
                    ->orWhere('p.body', "LIKE", "%" . $search . "%")
                    ->orWhere('p.excerpt', "LIKE", "%" . $search . "%")
                    ->orWhere('p.meta_keywords', "LIKE", "%" . $search . "%")
                    ->orWhere('p.source', "LIKE", "%" . $search . "%")
                    ->orWhere('u.first_name', "LIKE", "%" . $search . "%")
                    ->orWhere('u.last_name', "LIKE", "%" . $search . "%");
            })
            ->select('p.*', "u.last_name as by", "ps.name as status_name")
            ->orderBy('p.created_at', 'desc')
            ->paginate($paginate);
    }

    public function single(int $id)
    {
        $post = Post::find($id);
        $post->body = $this->parseEditBody($post->body);

        return $post;
    }

    private function parseEditBody($text)
    {
        $enterLine = "<p>&nbsp;</p>";
        $enterLength = strlen($enterLine);

        if (strlen($text) < $enterLength) {
            return $text;
        }

        $result = $text;
        $enterLineText = substr($text, 0, $enterLength);

        if ($enterLineText === $enterLine) {
            $result = substr($text, $enterLength);
        }

        return $result;
    }

    public function store(array $data)
    {
        $post = new Post();
        $post->title = $data["title"];
        $post->slug = $data["slug"];
        $post->category_id = $data["category_id"];
        $post->excerpt = $data["excerpt"];
        $post->body = $this->parseSaveBody($data["body"]);
        $post->seo_title = $data["seo_title"];
        $post->meta_description = $data["meta_description"];
        $post->meta_keywords = $data["meta_keywords"];
        $post->source = $data["source"];
        $post->status = $data["status"];
        $post->image = $this->fileManager->uploadFile($data["image"], $this->folder);
        $post->by = auth()->user()->id;
        $post->is_popular = $data['is_popular'];

        $post->save();
        return $post;
    }

    private function parseSaveBody($text)
    {
        $enterLine = "<p>&nbsp;</p>";
        $enterLength = strlen($enterLine);

        if (strlen($text) < $enterLength) {
            return $enterLine . $text;
        }

        $result = $text;
        $enterLineText = substr($text, 0, $enterLength);

        if ($enterLineText !== $enterLine) {
            $result = $enterLine . $result;
        }

        return $result;
    }

    public function update(int $id, array $data)
    {
        $post = Post::find($id);
        $post->title = $data["title"];
        $post->slug = $data["slug"];
        $post->category_id = $data["category_id"];
        $post->excerpt = $data["excerpt"];
        $post->body = $this->parseSaveBody($data["body"]);
        $post->seo_title = $data["seo_title"];
        $post->meta_description = $data["meta_description"];
        $post->meta_keywords = $data["meta_keywords"];
        $post->source = $data["source"];
        $post->status = $data["status"];
        if (isset($data["image"])) {
            if (is_file($data["image"])) {
                $post->image = $this->fileManager->uploadFile($data["image"], $this->folder);
            }
        }
        $post->is_popular = $data['is_popular'];

        $post->save();
        return $post;
    }

    public function categories()
    {
        return PostCategory::orderBy('order')->get();
    }

    public function blogs()
    {
        return PostBlog::orderBy('order')->get();
    }

    public function statuses()
    {
        return PostStatus::orderBy('order')->get();
    }

    public function duplicate(int $oldPostId)
    {
        $oldPost = Post::find($oldPostId);
        $newPost = $oldPost->replicate();
        $newPost->slug .= "-02";
        $newPost->status = PostStatusEnum::DRAFT;
        $newPost->save();

        return $newPost;
    }

    public function deleteMany(array $postIds)
    {
        Post::whereIn('id', $postIds)->delete();
    }

    public function delete(int $id)
    {
        Post::find($id)->delete();
    }

    public function count()
    {
        return Post::count();
    }

    public function countOfNewPostsPerMonth(Carbon $from, Carbon $to)
    {
        $result = Post::whereBetween('created_at', [$from, $to])
            ->orderBy('created_at')
            ->get(['created_at'])
            ->groupBy(function ($user) {
                return $user->created_at->format("Y_n");
            });

        $counts = [];

        while ($from->lt($to)) {
            $key = $from->format("Y_n");

            $counts[$this->parseDate($key)] = count($result->get($key, []));

            $from->addMonth();
        }

        return $counts;
    }

    private function parseDate($yearMonth)
    {
        list($year, $month) = explode("_", $yearMonth);

        $month = __("app.months.{$month}");
        $month = getKhmerMonth($month);

        return "{$month} {$year}";
    }

    public function postApi()
    {
        $paginate = DB::table('posts as p')
            ->leftJoin('users as u', 'p.by', '=', 'u.id')
            ->leftJoin('post_categories as pc', 'pc.id', '=', 'p.category_id')
            ->select(
                'p.*',
                "u.first_name as first_name",
                "u.last_name as last_name",
                "pc.name as name",
                "pc.slug as category_slug",
            )
            ->where(['p.status' => PostStatusEnum::PUBLISHED])
            ->where(['p.blog' => PostBlogEnum::NORMAL])
            ->orderBy('p.created_at', 'DESC')
            ->paginate(10);

        return $paginate;
    }

    public function searchApi($search = null)
    {
        $paginate = DB::table('posts as p')
            ->leftJoin('users as u', 'p.by', '=', 'u.id')
            ->leftJoin('post_categories as pc', 'pc.id', '=', 'p.category_id')
            ->select(
                'p.*',
                "u.first_name as first_name",
                "u.last_name as last_name",
                "pc.name as name",
            )
            ->where('p.title', 'like', "%" . $search . "%")
            ->where(['p.status' => PostStatusEnum::PUBLISHED])
            ->orderBy('p.created_at', 'DESC')
            ->paginate(10);

        return $paginate;
    }

    public function categoryApi($slug)
    {
        $category = PostCategory::where('slug', $slug)->firstorfail();

        return DB::table('posts as p')
            ->leftJoin('users as u', 'p.by', '=', 'u.id')
            ->leftJoin('post_categories as pc', 'pc.id', '=', 'p.category_id')
            ->select(
                'p.*',
                "u.first_name as first_name",
                "u.last_name as last_name",
                "pc.name as name"
            )
            ->where(['p.category_id' => $category->id, 'p.blog' => PostBlogEnum::NORMAL])
            ->where(['p.status' => PostStatusEnum::PUBLISHED])
            ->orderBy('p.created_at', 'DESC')
            ->paginate(10);
    }

}
