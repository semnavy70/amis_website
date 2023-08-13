<?php

namespace Vanguard\Repositories\Document;

use Illuminate\Support\Facades\DB;
use Vanguard\Document;
use Vanguard\DocumentCategory;
use Vanguard\Services\Upload\UploadFileManager;


class EloquentDocument implements DocumentRepository
{
    private $fileManager;
    private $folder;

    public function __construct(UploadFileManager $fileManager)
    {
        $this->fileManager = $fileManager;
        $this->folder = "documents/" . date("Ym");
    }

    public function paginate(int $paginate, $search = null)
    {
        return DB::table('documents as d')
            ->when($search, function ($q) use ($search) {
                $q->where('d.title', "LIKE", "%" . $search . "%");
            })
            ->select('d.*')
            ->orderBy('d.created_at', 'desc')
            ->paginate($paginate);
    }

    public function store(array $data)
    {
        $document = new Document();
        $document->title = $data["title"];
        $document->slug = $data["slug"];
        $document->excerpt = $data["excerpt"];
        $document->body = $this->parseSaveBody($data["body"]);
        $document->seo_title = $data["seo_title"];
        $document->meta_description = $data["meta_description"];
        $document->meta_keywords = $data["meta_keywords"];
//        $document->source = $data["source"];
        $document->status = $data["status"];
        $document->category_id = $data["category_id"];

        if (isset($data["image"])) {
            $document->image = $this->fileManager->uploadFile($data["image"], $this->folder);
        } else {
            $document->image = null;
        }
        $document->by = auth()->user()->id;
        $document->save();

        return $document;
    }

    public function single(int $id)
    {
        $document = Document::find($id);
        $document->body = $this->parseEditBody($document->body);

        return $document;
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
        $document = Document::find($id);
        $document->title = $data["title"];
        $document->slug = $data["slug"];
        $document->excerpt = $data["excerpt"];
        $document->body = $this->parseSaveBody($data["body"]);
        $document->seo_title = $data["seo_title"];
        $document->meta_description = $data["meta_description"];
        $document->meta_keywords = $data["meta_keywords"];
//        $document->source = $data["source"];
        $document->status = $data["status"];
        $document->category_id = $data["category_id"];

        if (isset($data["image"])) {
            if (is_file($data["image"])) {
                $document->image = $this->fileManager->uploadFile($data["image"], $this->folder);
            } else {
                $document->image = null;
            }
        }
        $document->save();
        return $document;
    }

    public function delete(int $id)
    {
        Document::find($id)->delete();
    }

    public function categories()
    {
        return DocumentCategory::orderBy('order')->get();
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
        $oldDocument = Document::find($oldPostId);
        $newDocument = $oldDocument->replicate();
        $newDocument->slug .= "-02";
        $newDocument->status = PostStatusEnum::DRAFT;
        $newDocument->save();

        return $newDocument;
    }
}
