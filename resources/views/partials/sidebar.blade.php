<!-- body right -->
<div class="col-md-3">

    <div class="sidebar">
        <div class="related">
            <h5 class="">@lang('translator.related')</h5>
            <div class="line"></div>
            
            @foreach($related as $item)
            @php $item = $item->translate(App::getLocale()); @endphp
            <!-- <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <a href="{{ getLink($item) }}">
                        {{ $item->title }}
                    </a>
                </li>
            </ul> -->
            <div class="list-group">
                <a href="{{ getLink($item) }}" class="list-group-item list-group-item-action">
                <span class="mr-1"><i class="fas fa-angle-double-right"></i></span> {{ $item->title }}
                </a>
            </div>
            @endforeach
        </div>
             
    </div>
</div>