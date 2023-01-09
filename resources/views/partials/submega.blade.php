
@php

    if (Voyager::translatable($items)) {
        $items = $items->load('translations');
    }
@endphp

@if ($main_mega)
<div class="mega dropdown-menu" aria-labelledby="navbarDropdown">
    <div class="row">
        @foreach ($items  as $item)
        @php
            $originalItem = $item;
            if (Voyager::translatable($item)) {
                $item = $item->translate($options->locale);
            }
        @endphp
        <div class="col-lg-4">
            <a class="dropdown-item top-dropdown-item" href="#">{{ $item->title }}</a>
             @if(!$originalItem->children->isEmpty())
                @include('partials.submega', ['items' => $originalItem->children, 'main_mega' => false])
            @endif       
        </div>    
        @endforeach
    <div>
</div>
@elseif(!$main_mega)

 @foreach ($items  as $item)
        @php
            $originalItem = $item;
            if (Voyager::translatable($item)) {
                $item = $item->translate($options->locale);
            }
        @endphp
         <a class="dropdown-item" href="{{ app_url($item->url) }}" target="{{ $item->target }}">{{ $item->title }}</a>


@endforeach

@endif
   