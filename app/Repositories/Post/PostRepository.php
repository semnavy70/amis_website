<?php

namespace Vanguard\Repositories\Post;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

interface PostRepository
{
    public function paginate(int $paginate, $search = null);

    public function store(array $data);

    public function single(int $id);

    public function update(int $id, array $data);

    public function delete(int $id);

    public function categories();

    public function blogs();

    public function statuses();

    public function duplicate(int $oldPostId);

    public function deleteMany(array $postIds);

    public function count();

    public function countOfNewPostsPerMonth(Carbon $from, Carbon $to);

    public function postApi();

    public function categoryApi($slug);

}
