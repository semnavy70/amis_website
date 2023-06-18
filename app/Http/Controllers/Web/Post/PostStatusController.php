<?php

namespace Vanguard\Http\Controllers\Web\Post;

use Vanguard\Http\Controllers\Controller;
use Vanguard\Http\Requests\Post\PostStatus\CreatePostStatusRequest;
use Vanguard\Http\Requests\Post\PostStatus\UpdatePostStatusRequest;
use Vanguard\Repositories\PostStatus\PostStatusRepository;

class PostStatusController extends Controller
{
    private $postStatus;

    public function __construct(PostStatusRepository $postStatus)
    {
        $this->postStatus = $postStatus;
    }

    public function index()
    {
        $list = $this->postStatus->paginate(10, request()->search);

        $data = [
            'list' => $list,
        ];
        return view('post.status.index', $data);
    }

    public function create()
    {
        $data = [
            'incrementOrder' => $this->postStatus->incrementOrder(),
        ];
        return view('post.status.create', $data);
    }

    public function store(CreatePostStatusRequest $request)
    {
        $this->postStatus->store($request->all());

        return redirect()->route('post-status.index')->withSuccess("បង្កើតស្ថានភាពជោគជ័យ");
    }

    public function edit($id)
    {
        $postStatus = $this->postStatus->single($id);

        $data = [
            'postStatus' => $postStatus,
        ];
        return view('post.status.edit', $data);
    }

    public function update(UpdatePostStatusRequest $request)
    {
        $this->postStatus->update($request->id, $request->all());

        return redirect()->route('post-status.index')->withSuccess("កែប្រែស្ថានភាពជោគជ័យ");
    }

    public function delete($id)
    {
        if ($this->postStatus->countById($id) == 0) {
            $this->postStatus->delete($id);
            return back()->withSuccess("ការលុបជោគជ័យ");
        }

        return back()->withErrors("សូមលុបការបង្ហោះជាមុនសិន");
    }
}
