<?php

namespace Vanguard\Http\Controllers\Web\Advertise;

use Vanguard\Http\Controllers\Controller;
use Vanguard\Http\Requests\Advertise\AdvertisePage\CreateAdvertisePageRequest;
use Vanguard\Http\Requests\Advertise\AdvertisePage\UpdateAdvertisePageRequest;
use Vanguard\Repositories\AdvertisePage\AdvertisePageRepository;

class AdvertisePageController extends Controller
{
    private $advertisePage;

    public function __construct(AdvertisePageRepository $advertisePage)
    {
        $this->advertisePage = $advertisePage;
    }

    public function index()
    {
        $list = $this->advertisePage->paginate(10, request()->search);

        $data = [
            'list' => $list,
        ];
        return view('advertise.page.index', $data);
    }

    public function create()
    {
        $data = [
            'incrementOrder' => $this->advertisePage->incrementOrder(),
        ];
        return view('advertise.page.create', $data);
    }

    public function store(CreateAdvertisePageRequest $request)
    {
        $this->advertisePage->store($request->all());

        return redirect()->route('advertise-page.index')->withSuccess("បង្កើតទំព័រជោគជ័យ");
    }

    public function update(UpdateAdvertisePageRequest $request)
    {
        $this->advertisePage->update($request->id, $request->all());

        return redirect()->route('advertise-page.index')->withSuccess("កែប្រែទំព័រជោគជ័យ");
    }

    public function edit($id)
    {
        $advertisePage = $this->advertisePage->single($id);

        $data = [
            'advertisePage' => $advertisePage,
        ];
        return view('advertise.page.edit', $data);
    }

    public function delete($id)
    {
        $this->advertisePage->delete($id);

        return back()->withSuccess("ការលុបជោគជ័យ");
    }
}
