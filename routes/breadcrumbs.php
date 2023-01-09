<?php
// Home
Breadcrumbs::register('home', function($breadcrumbs) {
    $temp=App::getLocale()=="kh"?"ទំព័រដើម":"Home";
    $breadcrumbs->push($temp, route('home'));
    
});

// Home > [Page]
Breadcrumbs::register('page', function($breadcrumbs, $slug)
{
    $page = App\Page::where('slug',$slug->slug)->FirstOrFail();
    $breadcrumbs->parent('home');
    $page=$page->translate(App::getLocale());
    $breadcrumbs->push($page->title, route('page', $slug->slug));
});

// Home > [Page]
Breadcrumbs::register('topic', function($breadcrumbs, $cat)
{
    $breadcrumbs->parent('home');
    $cat=$cat->translate(App::getLocale());
    //dd($cat);
    $breadcrumbs->push($cat->name, route('topic', $cat->slug));
});

Breadcrumbs::register('article', function($breadcrumbs, $post)
{
    $cat = App\Category::find($post->category_id);
    $breadcrumbs->parent('topic',$cat);
    // $breadcrumbs->push(shorttitleBox($post->title), route('article', $post->slug));
});

