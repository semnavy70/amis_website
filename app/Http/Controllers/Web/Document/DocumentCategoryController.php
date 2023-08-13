<?php

namespace Vanguard\Http\Controllers\Web\Document;

use Vanguard\Http\Controllers\Controller;
use Vanguard\Http\Requests\Document\DocumentCategory\CreateDocumentCategoryRequest;
use Vanguard\Http\Requests\Document\DocumentCategory\UpdateDocumentCategoryRequest;
use Vanguard\Repositories\DocumentCategory\DocumentCategoryRepository;

class DocumentCategoryController extends Controller
{

    private $documentCategory;

    public function __construct(DocumentCategoryRepository $documentCategory)
    {
        $this->documentCategory = $documentCategory;
    }

    public function index()
    {
        $list = $this->documentCategory->paginate(10, request()->search);
        $data = [
            "list" => $list
        ];

        return view('document.category.index', $data);
    }

    public function create()
    {
        $data = [
            'incrementOrder' => $this->documentCategory->incrementOrder(),
        ];
        return view('document.category.create', $data);
    }

    public function store(CreateDocumentCategoryRequest $request)
    {
        $this->documentCategory->store($request->all());
        return redirect()->route("document-category.index")->withSuccess("បង្កើតប្រភេទជោគជ័យ");
    }

    public function edit($id)
    {
        $documentCategory = $this->documentCategory->single($id);

        $data = [
            "documentCategory" => $documentCategory
        ];
        return view('document.category.edit', $data);
    }

    public function update(UpdateDocumentCategoryRequest $request)
    {
        $this->documentCategory->update($request->id, $request->all());

        return redirect()->route("document-category.index")->withSuccess("កែប្រែប្រភេទជោគជ័យ");
    }

    public function delete($id)
    {
        if ($this->documentCategory->countById($id) == 0) {
            $this->documentCategory->delete($id);
            return back()->withSuccess("ការលុបជោគជ័យ");
        }

        return back()->withErrors("សូមលុបការបង្ហោះជាមុនសិន");
    }
}
