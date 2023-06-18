@if ($pagination->lastPage() > 1)
    <nav aria-label="Blog pagination">
        <ul class="pagination justify-content-end">
            <li class="page-item {{ ($pagination->currentPage() == 1) ? ' disabled' : '' }}">
                <a class="page-link" href="{{ getPaginateUrl($pagination->currentPage() - 1) }}">@lang('Previous')</a>
            </li>
            @php
                $interval = isset($interval) ? abs(intval($interval)) : 3 ;
                $from = $pagination->currentPage() - $interval;
                if($from < 1){
                    $from = 1;
                }

                $to = $pagination->currentPage() + $interval;
                if($to > $pagination->lastPage()){
                    $to = $pagination->lastPage();
                }
                $ranges = range($from, $to);
            @endphp
            @foreach($ranges as $i)
                <li class="page-item {{ ($pagination->currentPage() == $i) ? ' active' : '' }}">
                    <a class="page-link" href="{{ getPaginateUrl($i) }}">{{ $i }}</a>
                </li>
            @endforeach
            <li class="page-item {{ ($pagination->currentPage() == $pagination->lastPage()) ? ' disabled' : '' }}">
                <a class="page-link" href="{{ getPaginateUrl($pagination->currentPage()+1) }}">@lang('Next')</a>
            </li>
        </ul>
    </nav>
@endif
