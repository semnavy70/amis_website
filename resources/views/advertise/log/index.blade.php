@extends('layouts.app')

@section('page-title', __('Advertise log'))
@section('page-heading', __('Manage advertise'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Advertise log')
    </li>
@stop

@section('content')
    @include('partials.messages')
    <div class="form hide-on-print">
        <form action="{{ route('advertise-log.index') }}" method="GET">
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label for="advertise_id">@lang('Advertise')</label>
                        <select name="advertise_id" class="form-control" id="advertise_id">
                            @foreach($advertises as $advertise)
                                <option
                                    {{ $advertise->id == $adsId ? 'selected' : '' }} value="{{ $advertise->id }}">{{ $advertise->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="start_date">@lang('From')</label>
                        <input name="start_date" type="date" class="form-control" id="start_date"
                               value="{{ $startDate }}">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="end_date">@lang('To')</label>
                        <input name="end_date" type="date" class="form-control" id="end_date" value="{{ $endDate }}">
                    </div>
                </div>
                <div class="col-2 align-self-center mt-1 w-100">
                    <button type="submit" class="btn btn-primary">
                        @lang('Search')
                    </button>
                </div>
                @if(count($list) > 0)
                    <div class="col-3 d-flex justify-content-end align-self-center mt-1">
                        <div class="row">
                            <a onclick="print();" class="btn btn-primary"><i class="fas fa-print"></i>
                                @lang('Print')
                            </a>
                            <a href="{{ route('advertise-log.export').'?advertise_id='.$adsId.'&start_date='.$startDate.'&end_date='.$endDate }}"
                               class="btn btn-primary ml-3">
                                <i class="fas fa-download"></i>
                                @lang('Download')
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </form>
    </div>
    <table class="table table-hover advertise-log-table">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">@lang('Datetime')</th>
            <th scope="col">@lang('Total click')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($logs as $item)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ dmYDate($item['date']) }}</td>
                <td>{{ $item['count_advertise'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="hide-on-print">
        <x-cb-pagination :pagination="$list"></x-cb-pagination>
    </div>
@stop
