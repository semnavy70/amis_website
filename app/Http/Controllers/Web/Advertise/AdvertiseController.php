<?php

namespace Vanguard\Http\Controllers\Web\Advertise;

use Vanguard\Http\Controllers\Controller;
use Vanguard\Http\Requests\Advertise\Advertise\CreateAdvertiseRequest;
use Vanguard\Http\Requests\Advertise\Advertise\UpdateAdvertiseRequest;
use Vanguard\Repositories\Advertise\AdvertiseRepository;

class AdvertiseController extends Controller
{
    private $advertise;

    public function __construct(AdvertiseRepository $advertise)
    {
        $this->advertise = $advertise;
    }

    public function index()
    {
        $list = $this->advertise->paginate(10, request()->search);

        $data = [
            'list' => $list,
        ];
        return view('advertise.advertise.index', $data);
    }

    public function create()
    {
        $data = [
            'advertisePage' => $this->advertise->pages(),
            'advertiseBlog' => $this->advertise->blogs(),
        ];
        return view('advertise.advertise.create', $data);
    }

    public function store(CreateAdvertiseRequest $request)
    {
        $this->advertise->store($request->all());

        return redirect()->route('advertise.index')->withSuccess("បង្កើតពាណិជ្ជកម្មជោគជ័យ");
    }

    public function update(UpdateAdvertiseRequest $request)
    {
        $this->advertise->update($request->id, $request->all());

        return redirect()->route('advertise.index')->withSuccess("កែប្រែពាណិជ្ជកម្មជោគជ័យ");
    }

    public function edit($id)
    {
        $advertise = $this->advertise->single($id);

        $data = [
            'advertise' => $advertise,
            'advertisePage' => $this->advertise->pages(),
            'advertiseBlog' => $this->advertise->blogs(),
        ];
        return view('advertise.advertise.edit', $data);
    }

    public function delete($id)
    {
        $this->advertise->delete($id);

        return back()->withSuccess("ការលុបជោគជ័យ");
    }
}
