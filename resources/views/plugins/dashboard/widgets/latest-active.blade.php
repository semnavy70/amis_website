<div class="card overflow-hidden">
    <h6 class="card-header d-flex align-items-center justify-content-between" onclick="gotoPage('{{ route('activity.index') }}')">
        @lang('User Activity')

        @if (count($latestActive))
            <small class="float-right">
                <a href="{{ route('activity.index') }}" class="text-secondary">@lang('View All')</a>
            </small>
        @endif
    </h6>
    <div class="card-body p-0">
        @if (count($latestActive))
            <ul class="list-group list-group-flush">
                @foreach ($latestActive as $activity)
                    <li class="list-group-item list-group-item-action px-4 py-3">
                        <a href="{{ route('activity.user',  $activity->user) }}" class="d-flex text-dark no-decoration">
                            <img class="rounded-circle" width="40" height="40"
                                 src="{{ $activity->user->profile_cover }}">
                            <div class="ml-2" style="line-height: 1.2;">
                                <span class="d-block p-0">{{ $activity->user->full_name }}</span>
                                <small class="text-muted">{{ $activity->description }} <span class="text-gray-500">{{ calculateMinutes($activity->created_at) }}</span></small>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-muted text-center">@lang('No records found.')</p>
        @endif
    </div>
</div>
