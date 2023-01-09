@if(!isset($innerLoop))


@endif

@php

    if (Voyager::translatable($items)) {
        $items = $items->load('translations');
    }

@endphp

<ul class="navbar-nav mx-auto text-white">


    @foreach ($items as $item)
    
        @php

            $originalItem = $item;
            if (Voyager::translatable($item)) {
                $item = $item->translate($options->locale);
            }
    
            
        @endphp
    

        @if ($loop->first)

            <li class="nav-item mega dropdown">
            <a class="nav-link dropdown-toggle" href="{{ app_url($item->url) }}" target="{{ $item->target }}"  id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                {{ $item->title }}
            </a>
            @if(!$originalItem->children->isEmpty())
                @include('partials.submega', ['items' => $originalItem->children, 'main_mega' => true])
            @endif
            </li>

        @else

            <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{ app_url($item->url) }}" target="{{ $item->target }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        {{ $item->title }}
                    </a>
                    @if(!$originalItem->children->isEmpty())
                        @include('partials.submenu', ['items' => $originalItem->children])
                    @endif  
            </li>
        @endif
    
    @endforeach

    
</ul>