@if(!isset($innerLoop))
    <ul class="navbar-nav ml-auto menu_active">
@else
    <div class="dropdown-menu menu_active" aria-labelledby="navbarDropdownMenuLink">
@endif

    @php

        $menu_slug = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $home_active = $menu_slug == '/' ? 'active' : '';

        if (Voyager::translatable($items)) {
            $items = $items->load('translations');
        }

    @endphp

    @foreach ($items as $item)

        @php

            //dd($options->locale);
            $originalItem = $item;
            if (Voyager::translatable($item)) {
                $item = $item->translate($options->locale);
            }

            $listItemClass = [];
            $linkAttributes =  null;
            $styles = null;
            $icon = null;
            $caret = null;

            $href = $item->link();

            // Current page
            if(app_url($href) == url($menu_slug))
            {
                array_push($listItemClass, 'active');
            }

            // Background Color or Color
            
            if (isset($options->color) && $options->color == true) {
                $styles = 'color:'.$item->color;
            }
            if (isset($options->background) && $options->background == true) {
                $styles = 'background-color:'.$item->color;
            }

            // With Children Attributes
            /*if(!$originalItem->children->isEmpty()) {
                // $linkAttributes =  'nav-link dropdown-toggle';
                $linkAttributes =  'class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"';
                $caret = '<span class="sr-only"></span>';

                if(url($item->link()) == url()->current()){
                    $listItemClass = "nav-item dropdown menu_active";
                }else{
                    $listItemClass = "nav-item dropdown menu_active";
                }
            }*/

            $hasChildren = false;
            if(!$item->children->isEmpty())
            {
                foreach($item->children as $child)
                {
                    // $hasChildren = $hasChildren || Auth::user()->can('browse', $child);

                    if(app_url($child->link()) == url($menu_slug))
                    {
                        array_push($listItemClass, 'active');
                    }
                }
                // if (!$hasChildren) {
                //     continue;
                // }

                $linkAttributes ='class="dropdown-toggle nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"';
                array_push($listItemClass, 'nav-item dropdown');
            }
            else
            {
                $linkAttributes =  'href="' . url($href) .'" class="nav-link"';

                // if(!Auth::user()->can('browse', $item)) {
                //     continue;
                // }
            }

            // Set Icon
            if(isset($options->icon) && $options->icon == true){
                $icon = '<i class="' . $item->icon_class . '"></i>';
            }

        @endphp
        @if(!isset($innerLoop))   
            {{--<li class="{{ $listItemClass }} {{ url($menu_slug) == app_url($item->url) ? 'active' : '' }}">
            <a class="nav-link" href="{{ app_url($item->link()) }}" target="{{ $item->target }}" {!! $linkAttributes or 'nav-link' !!}>
                    {!! $icon !!}
                    <span>{{ $item->title }}</span>
                </a>
                @if(!$originalItem->children->isEmpty())
                    @include('share.bootstrap', ['items' => $originalItem->children, 'options' => $options, 'innerLoop' => true])
                @endif
            </li>--}}
            <li class="nav-item {{ implode(" ", $listItemClass) }}">
                <a href="{{ app_url($item->link()) }}" target="{{ $item->target }}" style="{{ $styles }}" {!! $linkAttributes or '' !!}>
                    {!! $icon !!}
                    <span>{{ $item->title }}</span>
                    {!! $caret !!}
                </a>
                @if(!$originalItem->children->isEmpty())
                    @include('share.bootstrap', ['items' => $originalItem->children, 'options' => $options, 'innerLoop' => true])
                @endif
            </li>
            @if($loop->last)
            <li class="nav-item">
                <a class="nav-link icon search" id="search" href="#">
                    <i class="fas fa-search"></i>
                </a>
            </li>
            @endif
        @else
            <a class="dropdown-item" href="{{ app_url($item->link()) }}">
                {!! $icon !!}
                <span>{{ $item->title }}</span>
                
            </a>
            @if(!$originalItem->children->isEmpty())
                @include('share.bootstrap', ['items' => $originalItem->children, 'options' => $options, 'innerLoop' => true])
            @endif
        @endif
    @endforeach

@if(!isset($innerLoop))
    </ul>
@else
    </div>
@endif