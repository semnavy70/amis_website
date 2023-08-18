<?php

namespace Vanguard\Http\Controllers\Web\Page;

use Vanguard\ContactUs;
use Vanguard\Http\Controllers\Controller;

class ContactUsController extends Controller
{

    public function index()
    {
        $list = ContactUs::query()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $data = [
            'list' => $list,
        ];
        return view('page.contact-us.index', $data);
    }

}
