<?php

namespace Vanguard\Http\Controllers\Web\Post;

use Vanguard\Http\Controllers\Controller;
use Vanguard\Http\Requests\Post\Post\CreatePostRequest;
use Vanguard\Http\Requests\Post\Post\UpdatePostRequest;
use Vanguard\Repositories\Post\PostRepository;
use Vanguard\Repositories\PostLog\PostLogRepository;
use Vanguard\Services\Logging\Logger;

class PostController extends Controller
{
    private $post;
    private $postLog;
    private $logger;

    public function __construct(PostRepository $post, PostLogRepository $postLog, Logger $logger)
    {
        $this->post = $post;
        $this->postLog = $postLog;
        $this->logger = $logger;
    }

    public function index()
    {
        $list = $this->post->paginate(10, request()->search);

        $data = [
            'list' => $list,
        ];
        return view('post.post.index', $data);
    }

    public function create()
    {
        $data = [
            'postCategory' => $this->post->categories(),
            'postBlog' => $this->post->blogs(),
            'postStatus' => $this->post->statuses(),
        ];
        return view('post.post.create', $data);
    }

    public function edit($id)
    {
        $post = $this->post->single($id);

        $data = [
            'post' => $post,
            'postCategory' => $this->post->categories(),
            'postBlog' => $this->post->blogs(),
            'postStatus' => $this->post->statuses(),
        ];
        return view('post.post.edit', $data);
    }

    public function store(CreatePostRequest $request)
    {
        $this->post->store($request->all());
        return redirect()->route('post.index')->withSuccess("បង្តើតអត្ថបទបានជោគជ័យ");
    }

    public function update(UpdatePostRequest $request)
    {
        $postId = $request->id;
        $this->post->update($postId, $request->all());
        $this->postLog->logUpdater($postId);

        return redirect()->route('post.index')->withSuccess("កែប្រែអត្ថបទបានជោគជ័យ");
    }

    public function delete($id)
    {
        $this->post->delete($id);
        $this->logger->log(__("Delete post"));

        return back()->withSuccess("លុបអត្ថបទបានជោគជ័យ");
    }

    public function duplicate($id)
    {
        $this->post->duplicate($id);

        return back()->withSuccess("បានចម្លងជោគជ័យ");
    }

    public function deleteMany()
    {
        $dataBody = request()['data-body'];
        if ($dataBody == null) {
            return back()->withErrors('សូមជ្រើសរើសបង្ហោះជាមុនសិន');
        }
        $postIds = explode(',', $dataBody);
        if (count($postIds)) {
            $this->post->deleteMany($postIds);
            $this->logger->log(__("Delete post"));

            return back()->withSuccess("ការលុបជោគជ័យ");
        }

        return back()->withErrors('ផ្ទៀងផ្ទាត់ម្តងទៀត');
    }
}
