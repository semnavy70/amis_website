<?php
namespace Vanguard\Repositories\DocumentCategory;

use Illuminate\Support\Facades\DB;
use Vanguard\Document;
use Vanguard\DocumentCategory;

class EloquentDocumentCategory implements DocumentCategoryRepository
{

    public function paginate($paginate, $search = null)
    {
        $documentCategories = DB::table("document_categories as pc")
            ->leftJoin("documents as p", "p.category_id", "=", "pc.id")
            ->select("pc.*", DB::raw("count(p.id) as count_document"))
            ->when($search, function ($query) use ($search) {
                $query->where("pc.name", "LIKE", "%" . $search . "%")
                    ->orwhere('pc.slug', "LIKE", '%' . $search . '%');
            })
            ->groupBy("pc.id")
            ->orderBy('pc.order')
            ->paginate($paginate);

        return $documentCategories;
    }

    public function store(array $data)
    {
        $documentCategory = new DocumentCategory();
        $documentCategory->name = $data["name"];
        $documentCategory->slug = $data["slug"];
        $documentCategory->order = $data["order"];
        $documentCategory->save();
        return $documentCategory;
    }

    public function single($id)
    {
        return DocumentCategory::find($id);
    }

    public function update($id, $data)
    {
        $documentCategory = DocumentCategory::find($id);
        $documentCategory->name = $data["name"];
//        $documentCategory->slug = $data["slug"];
        $documentCategory->order = $data["order"];
        $documentCategory->save();
        return $documentCategory;
    }

    public function countById($id)
    {
        return Document::where("category_id", $id)->count();
    }

    public function delete($id)
    {
        DocumentCategory::find($id)->delete();
    }

    public function incrementOrder()
    {
        return (DocumentCategory::max('order') ?? 0) + 1;
    }

}
