<?php

namespace Vanguard\Http\Controllers\Web\Post;

use Vanguard\Http\Controllers\Controller;
use Vanguard\Http\Requests\Post\PostBlog\CreatePostBlogRequest;
use Vanguard\Http\Requests\Post\PostBlog\UpdatePostBlogRequest;
use Vanguard\Repositories\PostBlog\PostBlogRepository;

class PostBlogController extends Controller
{
    private $postBlog;

    public function __construct(PostBlogRepository $postBlog)
    {
        $this->postBlog = $postBlog;
    }

    public function index()
    {
        $list = $this->postBlog->paginate(10, request()->search);

        $data = [
            'list' => $list,
        ];
        return view('post.blog.index', $data);
    }

    public function create()
    {
        $data = [
            'incrementOrder' => $this->postBlog->incrementOrder(),
        ];
        return view('post.blog.create', $data);
    }

    public function edit($id)
    {
        $postBlog = $this->postBlog->single($id);

        $data = [
            'postBlog' => $postBlog,
        ];
        return view('post.blog.edit', $data);
    }

    public function store(CreatePostBlogRequest $request)
    {
        $this->postBlog->store($request->all());

        return redirect()->route('post-blog.index')->withSuccess("បង្កើតប្លុកជោគជ័យ");
    }

    public function update(UpdatePostBlogRequest $request)
    {
        $this->postBlog->update($request->id, $request->all());

        return redirect()->route('post-blog.index')->withSuccess("កែប្រែប្លុកជោគជ័យ");
    }

    public function delete($id)
    {
        if ($this->postBlog->countById($id) == 0) {
            $this->postBlog->delete($id);
            return back()->withSuccess("ការលុបជោគជ័យ");
        }

        return back()->withErrors("សូមលុបការបង្ហោះជាមុនសិន");
    }

}
