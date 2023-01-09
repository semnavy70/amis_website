@if (count($breadcrumbs))

    <ol class="breadcrumb hidden-xs">
        @foreach ($breadcrumbs as $breadcrumb)
        
            @if ($loop->first)
                <li class="breadcrumb-item completed"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @elseif ($loop->index  == 1)
				<li class="breadcrumb-item active"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $breadcrumb->title }}</a></li>
            @endif
            
        @endforeach
    </ol>

@endif
