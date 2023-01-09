@php

    if (Voyager::translatable($items)) {
        $items = $items->load('translations');
    }

@endphp


<div class="dropdown-menu" aria-labelledby="navbarDropdown">
    @foreach ($items as $item)
    
        @php

            $originalItem = $item;
            if (Voyager::translatable($item)) {
                $item = $item->translate($options->locale);
            }
    
        @endphp
    <a class="dropdown-item" href="{{ app_url($item->url) }}" target="{{ $item->target }}">{{ $item->title }}</a>  

   @endforeach
</div>