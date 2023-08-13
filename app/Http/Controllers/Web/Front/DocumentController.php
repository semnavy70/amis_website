<?php

namespace Vanguard\Http\Controllers\Web\Front;

use Inertia\Inertia;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Repositories\Front\Library\LibraryRepository;

class DocumentController extends Controller
{
    private $library;

    public function __construct(LibraryRepository $document)
    {
        $this->library = $document;
    }

    public function index($slug)
    {
        $detail = $this->library->detail($slug);
        if (!$detail) {
            abort(404);
        }

        $categoryId = $detail->id;
        $data = [
            'detail' => $detail,
            'documents' => $this->library->documents($categoryId),
            'categories' => $this->library->categories($categoryId),
        ];
        return Inertia::render('Document/Detail', $data);
    }
}
