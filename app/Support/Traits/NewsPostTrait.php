<?php

namespace Vanguard\Support\Traits;

use Vanguard\Services\Parser\BodyParser;

trait NewsPostTrait
{
    private function mapNewsItem($item): array
    {
        $parser = new BodyParser();

        return [
            'id' => $item->id,
            'title' => $item->title,
            'body' => $parser->parseString(getBodyText($item->body)),
            'image' => $item->image != null ? getFileCDN($item->image) : null,
            'time' => calculateMinutes($item->created_at),
            'by' => $item->by,
            'total_comment' => $item->comment_count,
            'likecount' => $item->like_count,
            'type' => 'news',
            'other' => null,
            'category_id' => $item->category_id,
        ];
    }

}
