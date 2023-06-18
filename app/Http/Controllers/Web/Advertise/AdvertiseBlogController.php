<?php

namespace Vanguard\Http\Controllers\Web\Advertise;

use Vanguard\Http\Controllers\Controller;
use Vanguard\Http\Requests\Advertise\AdvertiseBlog\CreateAdvertiseBlogRequest;
use Vanguard\Http\Requests\Advertise\AdvertiseBlog\UpdateAdvertiseBlogRequest;
use Vanguard\Repositories\AdvertiseBlog\AdvertiseBlogRepository;

class AdvertiseBlogController extends Controller
{
    private $advertiseBlog;

    public function __construct(AdvertiseBlogRepository $advertiseBlog)
    {
        $this->advertiseBlog = $advertiseBlog;
    }

    public function index()
    {
        $list = $this->advertiseBlog->paginate(10, request()->search);

        $data = [
            'list' => $list,
        ];
        return view('advertise.blog.index', $data);
    }

    public function create()
    {
        $data = [
            'incrementOrder' => $this->advertiseBlog->incrementOrder(),
        ];
        return view('advertise.blog.create', $data);
    }

    public function store(CreateAdvertiseBlogRequest $request)
    {
        $this->advertiseBlog->store($request->all());

        return redirect()->route('advertise-blog.index')->withSuccess("បង្កើតប្លុកបានជោគជ័យ");
    }

    public function update(UpdateAdvertiseBlogRequest $request)
    {
        $this->advertiseBlog->update($request->id, $request->all());

        return redirect()->route('advertise-blog.index')->withSuccess("កែប្រែប្លុកបានជោគជ័យ");
    }

    public function edit($id)
    {
        $advertiseBlog = $this->advertiseBlog->single($id);

        $data = [
            'advertiseBlog' => $advertiseBlog,
        ];
        return view('advertise.blog.edit', $data);
    }

    public function delete($id)
    {
        $this->advertiseBlog->delete($id);

        return back()->withSuccess("ការលុបជោគជ័យ");
    }
}
