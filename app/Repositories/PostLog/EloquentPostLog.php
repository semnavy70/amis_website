<?php

namespace Vanguard\Repositories\PostLog;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Vanguard\PostLog;

class EloquentPostLog implements PostLogRepository
{

    public function logUpdater($postId): PostLog
    {
        date_default_timezone_set("Asia/Phnom_Penh");
        $postLog = new PostLog();
        $postLog->post_id = $postId;
        $postLog->updated_by = auth()->user()->id;
        $postLog->save();

        return $postLog;
    }

    public function paginate($paginate, $postId): LengthAwarePaginator
    {
        return DB::table('post_logs as pl')
            ->join('users as u', 'u.id', '=', 'pl.updated_by')
            ->where(['pl.post_id' => $postId])
            ->select('pl.*', "u.last_name as updated_by")
            ->orderBy('pl.updated_by', 'desc')
            ->paginate($paginate);
    }
}
