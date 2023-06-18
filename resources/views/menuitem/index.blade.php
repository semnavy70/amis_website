@extends('layouts.app')

@section('page-title', __('Menus'))
@section('page-heading', __('Manage Menus'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Menus')
    </li>
@stop
@section('content')
    @include('partials.messages')
    <div class="row">
        <div class="col-6">
            <form class="form-inline" action="{{ route('menuitem.index') }}" method="GET">
                <input name="search" class="form-control mr-sm-2 w-75" type="search" placeholder="@lang('Search')"
                       aria-label="Search" value="{{ request()->search }}">
                <button class="btn btn-primary my-2 my-sm-0" type="submit">@lang('Search')</button>
            </form>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <a role="button" class="btn btn-primary ml-3" href="{{ route('menuitem.create') }}"><i
                    class="fas fa-plus mr-1"></i>@lang('Create new')</a>
        </div>
    </div>
    <table class="table table-hover post-table">
        <thead class="thead-light">
        <tr>
            <th scope="col">
                @lang('No')
            </th>
            <th scope="col">@lang('Title')</th>
            <th scope="col">@lang('Activity')</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $item)
            <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>{{ $item->title }}</td>
                <td>
                    <a href="{{ route('menuitem.edit' , ['id' => $item->id]) }}" class="btn btn-sm btn-primary"
                       title="@lang('Edit')"
                       data-toggle="tooltip"
                    >
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="" class="btn btn-sm btn-primary">
                        <i class="fas fa-child"></i>
                    </a>
                    <a class="btn btn-sm btn-danger ml-1"
                       title="@lang('លុបមុឺនុយ')"
                       href="{{ route('menuitem.delete', ['id' => $item->id]) }}"
                       data-toggle="tooltip"
                       data-placement="top"
                       data-method="DELETE"
                       data-confirm-title="@lang('ផ្ទៀងផ្ទាត់')"
                       data-confirm-text="@lang('តើអ្នកពិតជាចង់លុបមែនទេ?')"
                       data-confirm-delete="@lang('យល់ព្រម')"
                    >
                        <i class="fas fa-trash"></i>
                    </a>
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

        allCheck.on("change", function () {
            const isChecked = $(this)[0]['checked'];
            checkItem.prop("checked", isChecked);
            itemOnChange();
        });

        checkItem.on("change", function () {
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
