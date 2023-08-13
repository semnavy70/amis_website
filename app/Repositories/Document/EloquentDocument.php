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
                $q->where('d.title', "LIKE", "%" . $search . "%")
                    ->orWhere('d.description', "LIKE", "%" . $search . "%");
            })
            ->select('d.*')
            ->orderBy('d.created_at', 'desc')
            ->paginate($paginate);
    }

    public function store(array $data)
    {
        $document = new Document();
        $document->title = $data["title"];
        $document->description = $this->parseSaveBody($data["description"]);
        $document->category_id = $data["category_id"];
        $document->type = $data["type"];

        if (is_file($data["source"])) {
            $document->source = $this->fileManager->uploadFile($data["source"], $this->folder);
        } else {
            $document->source = $data["source"];
        }

        $document->save();

        return $document;
    }

    public function single(int $id)
    {
        $document = Document::find($id);
        $document->description = $this->parseEditBody($document->description);

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
        $document->description = $this->parseSaveBody($data["description"]);
        $document->category_id = $data["category_id"];
        $document->type = $data["type"];

        if (isset($data["source"])) {
            if (is_file($data["source"])) {
                $document->source = $this->fileManager->uploadFile($data["source"], $this->folder);
            } else {
                $document->source = $data["source"];
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

    public function types()
    {
        return [
            [
                'key' => 'pdf',
                'value' => 'PDF',
            ],
            [
                'key' => 'video',
                'value' => 'វីដេអូ',
            ],
        ];
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

        $newDocument->save();

        return $newDocument;
    }
}
