<?php

namespace Vanguard\Repositories\Pages;

use Illuminate\Support\Facades\DB;
use Vanguard\Page;
use Vanguard\PageCategory;
use Vanguard\PostStatus;
use Vanguard\Services\Upload\UploadFileManager;
use Vanguard\Support\Enum\PostStatusEnum;

class EloquentPages implements PagesRepository
{
    private $fileManager;
    private $folder;

    public function __construct(UploadFileManager $fileManager)
    {
        $this->fileManager = $fileManager;
        $this->folder = "pages/" . date("Ym");
    }

    public function paginate(int $paginate, $search = null)
    {
        return DB::table('pages as p')
            ->leftJoin('users as u', 'p.by', '=', 'u.id')
            ->leftJoin('post_statuses as ps', 'ps.slug', '=', 'p.status')
            ->leftJoin('page_categories as pc', 'pc.id', '=', 'p.category_id')
            ->when($search, function ($q) use ($search) {
                $q->where('p.title', "LIKE", "%" . $search . "%")
                    ->orWhere('p.slug', "LIKE", "%" . $search . "%")
                    ->orWhere('p.status', "LIKE", "%" . $search . "%")
                    ->orWhere('p.body', "LIKE", "%" . $search . "%")
                    ->orWhere('p.excerpt', "LIKE", "%" . $search . "%")
                    ->orWhere('p.meta_keywords', "LIKE", "%" . $search . "%")
                    ->orWhere('p.source', "LIKE", "%" . $search . "%")
                    ->orWhere('u.username', "LIKE", "%" . $search . "%")
                    ->orWhere('u.first_name', "LIKE", "%" . $search . "%")
                    ->orWhere('u.last_name', "LIKE", "%" . $search . "%");
            })
            ->select([
                'p.id as id',
                'p.title as title',
                'p.slug as slug',
                'p.created_at as created_at',
                "u.last_name as by",
                "ps.name as status_name",
                "pc.name as category_name",
                ])
            ->orderBy('p.created_at', 'desc')
            ->paginate($paginate);
    }

    public function store(array $data)
    {
        $page = new Page();
        $page->title = $data["title"];
        $page->slug = $data["slug"];
        $page->excerpt = $data["excerpt"];
        $page->body = $this->parseSaveBody($data["body"]);
        $page->seo_title = $data["seo_title"];
        $page->meta_description = $data["meta_description"];
        $page->meta_keywords = $data["meta_keywords"];
//        $page->source = $data["source"];
        $page->status = $data["status"];
        $page->category_id = $data["category_id"];

        $page->image = null;
//        if (isset($data["image"])) {
//            $page->image = $this->fileManager->uploadFile($data["image"], $this->folder);
//        } else {
//            $page->image = null;
//        }

        $page->by = auth()->user()->id;
        $page->save();

        return $page;
    }

    public function single(int $id)
    {
        $page = Page::find($id);
        $page->body = $this->parseEditBody($page->body);

        return $page;
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

    public function update(int $id, array $data)
    {
        $page = Page::find($id);
        $page->title = $data["title"];
        $page->slug = $data["slug"];
        $page->excerpt = $data["excerpt"];
        $page->body = $this->parseSaveBody($data["body"]);
        $page->seo_title = $data["seo_title"];
        $page->meta_description = $data["meta_description"];
        $page->meta_keywords = $data["meta_keywords"];
//        $page->source = $data["source"];
        $page->status = $data["status"];
        $page->category_id = $data["category_id"];

        $page->image = null;
//        if (isset($data["image"])) {
//            if (is_file($data["image"])) {
//                $page->image = $this->fileManager->uploadFile($data["image"], $this->folder);
//            } else {
//                $page->image = null;
//            }
//        }

        $page->save();
        return $page;
    }

    public function delete(int $id)
    {
        Page::find($id)->delete();
    }

    public function statuses()
    {
        return PostStatus::orderBy('order')->get();

    }

    public function categories()
    {
        return PageCategory::orderBy('order')->get();
    }


    public function deleteMany(array $postIds)
    {
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

    public function duplicate(int $oldPostId)
    {
        $oldPage = Page::find($oldPostId);
        $newPage = $oldPage->replicate();
        $newPage->slug .= "-02";
        $newPage->status = PostStatusEnum::DRAFT;
        $newPage->save();

        return $newPage;
    }

}
