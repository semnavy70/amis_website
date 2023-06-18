<?php

namespace Vanguard\Http\Controllers\Api\Front;

use Exception;
use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Repositories\FrontApi\FrontApiRepository;
use Vanguard\Repositories\Post\PostRepository;

class PostApiController extends Controller
{
    private $post;
    private $api;

    public function __construct(
        PostRepository     $post,
        FrontApiRepository $api
    )
    {
        $this->post = $post;
        $this->api = $api;
    }

    public function list()
    {
        try {
            return $this->post->postApi();

        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function search(Request $request)
    {
        try {
            $search = (string)$request->query('search');
            return $this->post->searchApi($search);

        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function category(Request $request)
    {
        try {
            $slug = (string)$request->query('slug');
            return $this->post->categoryApi($slug);

        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }
}
