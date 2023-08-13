<?php

namespace Vanguard\Http\Controllers\Web\Page;

use Vanguard\Http\Controllers\Controller;
use Vanguard\Http\Requests\Page\PageCategory\CreatePageCategoryRequest;
use Vanguard\Http\Requests\Page\PageCategory\UpdatePageCategoryRequest;
use Vanguard\Repositories\PageCategory\PageCategoryRepository;

class PageCategoryController extends Controller
{

    private $pageCategory;

    public function __construct(PageCategoryRepository $pageCategory)
    {
        $this->pageCategory = $pageCategory;
    }

    public function index()
    {
        $list = $this->pageCategory->paginate(10, request()->search);
        $data = [
            "list" => $list
        ];

        return view('page.category.index', $data);
    }

    public function create()
    {
        $data = [
            'incrementOrder' => $this->pageCategory->incrementOrder(),
        ];
        return view('page.category.create', $data);
    }

    public function store(CreatePageCategoryRequest $request)
    {
        $this->pageCategory->store($request->all());
        return redirect()->route("page-category.index")->withSuccess("បង្កើតប្រភេទជោគជ័យ");
    }

    public function edit($id)
    {
        $pageCategory = $this->pageCategory->single($id);

        $data = [
            "pageCategory" => $pageCategory
        ];
        return view('page.category.edit', $data);
    }

    public function update(UpdatePageCategoryRequest $request)
    {
        $this->pageCategory->update($request->id, $request->all());

        return redirect()->route("page-category.index")->withSuccess("កែប្រែប្រភេទជោគជ័យ");
    }

    public function delete($id)
    {
        if ($this->pageCategory->countById($id) == 0) {
            $this->pageCategory->delete($id);
            return back()->withSuccess("ការលុបជោគជ័យ");
        }

        return back()->withErrors("សូមលុបការបង្ហោះជាមុនសិន");
    }
}
