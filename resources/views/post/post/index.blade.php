@extends('layouts.app')

@section('page-title', __('Post'))
@section('page-heading', __('Manage post'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Post')
    </li>
@stop

@section('content')
    @include('partials.messages')
    <div class="row">
        <div class="col-6">
            <form class="form-inline" action="{{ route('post.index') }}" method="GET">
                <input name="search" class="form-control mr-sm-2 w-75" type="search" placeholder="@lang('Search')"
                    aria-label="Search" value="{{ request()->search }}">
                <button class="btn btn-primary my-2 my-sm-0" type="submit">@lang('Search')</button>
            </form>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <a role="button" class="btn" id="btn-refresh" href="#" onclick="refreshPage()"
                style="background: #ACB5BD;">
                <img id="refresh-btn" src="{{ frontUrl('assets/img/sync.png') }}" alt="Refresh Page">
            </a>
            <a role="button" class="btn btn-primary ml-3" href="{{ route('post.create') }}"><i
                    class="fas fa-plus mr-1"></i>@lang('Create new')</a>
            <a role="button" id="delete-many-btn" class="btn btn-danger ml-3 disabled"
                href="{{ route('post.delete-many') }}" data-toggle="tooltip" data-placement="top" data-method="DELETE"
                data-confirm-title="@lang('ផ្ទៀងផ្ទាត់')" data-confirm-text="@lang('តើអ្នកពិតជាចង់លុបបង្ហោះទាំងនេះមែនទេ?')"
                data-confirm-delete="@lang('យល់ព្រម')">
                <i class="fas fa-trash mr-1"></i>
                @lang('Delete')
            </a>
        </div>
    </div>
    <table class="table table-hover post-table">
        <thead class="thead-light">
            <tr>
                <th scope="col">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check_all">
                        <label class="custom-control-label" for="check_all"></label>
                    </div>
                </th>
                <th scope="col">@lang('Title')</th>
                <th scope="col">@lang('Default picture')</th>
                <th scope="col">@lang('By')</th>
                <th scope="col">@lang('Status')</th>
                <th scope="col">@lang('Create')</th>
                <th scope="col" class="text-center">@lang('Activity')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $item)
                <tr>
                    <th scope="row">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input check-item"
                                id="check-item-{{ $item->id }}" value="{{ $item->id }}">
                            <label class="custom-control-label" for="check-item-{{ $item->id }}"></label>
                        </div>
                    </th>
                    <td class="w-25">{{ $item->title }}</td>
                    <td>
                        <img src="{{ getFileCDN($item->image) }}" alt="" width="140">
                    </td>
                    <td class="text-active-color justify-content-center">{{ $item->by }}</td>
                    <td class="text-gray-500 justify-content-center">{{ $item->status_name }}</td>
                    <td>{{ dmYDate($item->created_at) }}</td>
                    <td class="text-center">
                        <div class="row">
                            <div class="col-12">
                                <a type="button" href="{{ route('post.edit', ['id' => $item->id]) }}"
                                    class="btn btn-sm w-50 text-white mt-1" style="background: #e64a19; margin: 0 5px; ">
                                    @lang('Edit')
                                </a>
                            </div>
                            <div class="col-12">
                                <a type="button" href="{{ route('detail', ['id' => $item->id]) }}" target="_blank"
                                    class="btn text-white btn-sm w-50 mt-1" style="background: #fbc02d; margin: 0 5px;">
                                    @lang("View")
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <x-cb-pagination :pagination="$list"></x-cb-pagination>
@stop

@section('scripts')
    <script>
        let allCheck = $("#check_all");
        let checkItem = $("input.check-item");
        let deleteBtn = $("#delete-many-btn");

        allCheck.on("change", function() {
            const isChecked = $(this)[0]['checked'];
            checkItem.prop("checked", isChecked);
            itemOnChange();
        });

        checkItem.on("change", function() {
            itemOnChange();
        });

        function itemOnChange() {
            let checkedItem = $("input.check-item:checked");
            const isCheckAll = checkedItem.length === Number("{{ count($list) }}");
            allCheck.prop("checked", isCheckAll);

            let checkIds = [];
            checkedItem.map((e) => {
                checkIds[e] = Number(`${checkedItem[e].value}`);
            });

            deleteBtn.data("data-body", checkIds);
            checkDeleteBtn(checkIds);
        }

        function checkDeleteBtn(checkIds) {
            if (!checkIds || checkIds.length === 0) {
                deleteBtn.addClass('disabled');
            } else {
                deleteBtn.removeClass('disabled');
            }
        }
    </script>
@endsection
