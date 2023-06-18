<div class="card widget" onclick="gotoPage('{{ route('advertise.index') }}')">
    <div class="card-body">
        <div class="row">
            <div class="p-3 text-info flex-1">
                <i class="fab fa-adversal fa-3x"></i>
            </div>

            <div class="pr-3">
                <h2 class="text-right">{{ number_format($count) }}</h2>
                <div class="text-muted">@lang('Advertise')</div>
            </div>
        </div>
    </div>
</div>
