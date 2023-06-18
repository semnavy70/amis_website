<?php

namespace Vanguard\Http\Controllers\Web\Post;

use Vanguard\Http\Controllers\Controller;
use Vanguard\Http\Requests\Post\PostCategory\CreatePostCategoryRequest;
use Vanguard\Http\Requests\Post\PostCategory\UpdatePostCategoryRequest;
use Vanguard\Repositories\PostCategory\PostCategoryRepository;

class PostCategoryController extends Controller
{

    private $postCategory;

    public function __construct(PostCategoryRepository $postCategory)
    {
        $this->postCategory = $postCategory;
    }

    public function index()
    {
        $list = $this->postCategory->paginate(10, request()->search);
        $data = [
            "list" => $list
        ];

        return view('post.category.index', $data);
    }

    public function create()
    {
        $data = [
            'incrementOrder' => $this->postCategory->incrementOrder(),
        ];
        return view('post.category.create', $data);
    }

    public function store(CreatePostCategoryRequest $request)
    {
        $this->postCategory->store($request->all());
        return redirect()->route("post-category.index")->withSuccess("បង្កើតប្រភេទជោគជ័យ");
    }

    public function edit($id)
    {
        $postCategory = $this->postCategory->single($id);

        $data = [
            "postCategory" => $postCategory
        ];
        return view('post.category.edit', $data);
    }

    public function update(UpdatePostCategoryRequest $request)
    {
        $this->postCategory->update($request->id, $request->all());

        return redirect()->route("post-category.index")->withSuccess("កែប្រែប្រភេទជោគជ័យ");
    }

    public function delete($id)
    {
        if ($this->postCategory->countById($id) == 0) {
            $this->postCategory->delete($id);
            return back()->withSuccess("ការលុបជោគជ័យ");
        }

        return back()->withErrors("សូមលុបការបង្ហោះជាមុនសិន");
    }
}
