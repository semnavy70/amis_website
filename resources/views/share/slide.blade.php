
<div class="slide">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach($list_slide as $items)
                {{-- @php $items = $items->translate(App::getLocale()); @endphp    --}}
                <div class="carousel-item @if($loop->first) active @endif">
                    <img class="d-block w-100" src="{{gcpUrl($items->picture)}}" alt="Agricultural Market Information Service">
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>