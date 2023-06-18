<?php

namespace Vanguard\Support\Traits;

trait VideoTrait
{
    private function mapVideoItem($item): array
    {
        return [
            'id' => $item->id,
            'title' => $item->title,
            'image' => $item->image != null ? getFileCDN($item->image) : null,
            'time' => calculateMinutes($item->created_at),
            'video_link' => $item->video_link,
        ];
    }

}
