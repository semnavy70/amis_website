<?php

namespace Vanguard\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class PostManagement extends Plugin
{
    public function sidebar()
    {
        $post = Item::create(__('Post'))
            ->route('post.index')
            ->active("admin/post/*")
            ->permissions('post.manage');

        $category = Item::create(__('Post category'))
            ->route('post-category.index')
            ->active("admin/post-category/*")
            ->permissions('post-category.manage');

        $blog = Item::create(__('Blog'))
            ->route('post-blog.index')
            ->active("admin/post-blog/*")
            ->permissions('post-blog.manage');

        $status = Item::create(__('Status'))
            ->route('post-status.index')
            ->active("admin/post-status/*")
            ->permissions('post-status.manage');


        return Item::create(__('Manage post'))
            ->href('#post-management-dropdown')
            ->icon('far fa-newspaper')
            ->active("admin/post*")
            ->permissions(['post.manage'])
            ->addChildren([
                $post,
                $category,
                $blog,
                $status,
            ]);
    }

}
