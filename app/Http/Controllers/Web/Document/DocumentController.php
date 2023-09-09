<?php

namespace Vanguard\Http\Controllers\Web\Document;

use Vanguard\Http\Controllers\Controller;
use Vanguard\Http\Requests\Document\Document\CreateDocumentRequest;
use Vanguard\Http\Requests\Document\Document\UpdateDocumentRequest;
use Vanguard\Repositories\Document\DocumentRepository;
use Vanguard\Services\Logging\Logger;

class DocumentController extends Controller
{
    private $document;
    private $logger;

    public function __construct(DocumentRepository $document, Logger $logger)
    {
        $this->document = $document;
        $this->logger = $logger;
    }

    public function index()
    {
        $list = $this->document->paginate(10, request()->search);

        $data = [
            'list' => $list,
        ];
        return view('document.document.index', $data);
    }

    public function create()
    {
        $data = [
            'documentCategory' => $this->document->categories(),
            'documentType' => $this->document->types(),
        ];
        return view('document.document.create', $data);
    }

    public function store(CreateDocumentRequest $request)
    {
        $this->document->store($request->all());
        return redirect()->route('document.index')->withSuccess("បង្កើតបណ្ណាល័យបានជោគជ័យ");
    }

    public function edit($id)
    {
        $document = $this->document->single($id);
        $data = [
            'document' => $document,
            'documentCategory' => $this->document->categories(),
            'documentType' => $this->document->types(),
        ];
        return view('document.document.edit', $data);
    }

    public function update(UpdateDocumentRequest $request)
    {
        $documentId = $request->id;
        $this->document->update($documentId, $request->all());

        return redirect()->route('document.index')->withSuccess("កែប្រែបណ្ណាល័យជោគជ័យ");
    }

    public function delete($id)
    {
        $this->document->delete($id);
        $this->logger->log(__("Delete document"));

        return back()->withSuccess("ការលុបបណ្ណាល័យបានជោគជ័យ");
    }

}
