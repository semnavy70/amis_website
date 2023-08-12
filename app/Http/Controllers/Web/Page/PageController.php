<?php

namespace Vanguard\Http\Controllers\Web\Page;

use Vanguard\Http\Controllers\Controller;
use Vanguard\Http\Requests\Page\CreatePageRequest;
use Vanguard\Http\Requests\Page\UpdatePageRequest;
use Vanguard\Repositories\Pages\PagesRepository;
use Vanguard\Services\Logging\Logger;

class PageController extends Controller
{
    private $page;
    private $logger;

    public function __construct(PagesRepository $page, Logger $logger)
    {
        $this->page = $page;
        $this->logger = $logger;
    }

    public function index()
    {
        $list = $this->page->paginate(10, request()->search);

        $data = [
            'list' => $list,
        ];
        return view('page.page.index', $data);
    }

    public function create()
    {
        $data = [
            'pageCategory' => $this->page->categories(),
            'pageStatus' => $this->page->statuses(),
        ];
        return view('page.page.create', $data);
    }

    public function store(CreatePageRequest $request)
    {
        $this->page->store($request->all());
        return redirect()->route('page.index')->withSuccess("បង្កើតទំព័របានជោគជ័យ");
    }

    public function edit($id)
    {
        $page = $this->page->single($id);
        $data = [
            'page' => $page,
            'pageStatus' => $this->page->statuses(),
            'pageCategory' => $this->page->categories(),
        ];
        return view('page.page.edit', $data);
    }

    public function update(UpdatePageRequest $request)
    {
        $pageId = $request->id;
        $this->page->update($pageId, $request->all());

        return redirect()->route('page.index')->withSuccess("កែប្រែបង្ហោះជោគជ័យ");
    }

    public function delete($id)
    {
        $this->page->delete($id);
        $this->logger->log(__("Delete page"));

        return back()->withSuccess("ការលុបទំព័របានជោគជ័យ");
    }

}
