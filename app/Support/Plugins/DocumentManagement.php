<?php

namespace Vanguard\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class DocumentManagement extends Plugin
{
    public function sidebar()
    {
        $document = Item::create(__('Document'))
            ->route('document.index')
            ->active("admin/document/*")
            ->permissions('documents.manage');

        $category = Item::create(__('Document category'))
            ->route('document-category.index')
            ->active("admin/document-category/*")
            ->permissions('document-category.manage');

        return Item::create(__('Manage Document'))
            ->href('#document-management-dropdown')
            ->icon('far fa-clipboard')
            ->active("admin/document*")
            ->permissions(['documents.manage'])
            ->addChildren([
                $document,
                $category,
            ]);
    }
}
