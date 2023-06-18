@extends('layouts.app')

@section('page-title', __('Edit advertise'))
@section('page-heading', __('Manage advertise'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('advertise.index') }}" class="text-muted">
            @lang('Advertise')
        </a>
    </li>
    <li class="breadcrumb-item active">
        @lang('Edit advertise')
    </li>
@stop

@section('content')
    @include('partials.messages')
    <form action="{{ route('advertise.update') }}" method="POST" enctype="multipart/form-data" id="advertise-form">
        @csrf
        <input type="hidden" name="id" value="{{ $advertise->id }}">
        <div class="form-group">
            <label for="name">@lang('Name*')</label>
            <input name="name" type="text" class="form-control" id="name" value="{{ old('name') ?? $advertise->name }}">
        </div>
        <div class="form-group">
            <label for="link">@lang('Link*')</label>
            <input name="link" type="url" class="form-control" id="link" value="{{ old('link')  ?? $advertise->link }}">
        </div>
        <div class="form-group">
            <label for="page">@lang('Page*')</label>
            <select name="page" class="form-control" id="page">
                <option>--ជ្រើសរើស--</option>
                @foreach($advertisePage as $page)
                    <option
                        value="{{ $page->slug }}" {{ $advertise->page == $page->slug ? 'selected' : '' }}>{{ $page->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="blog">@lang('Blog*')</label>
            <select name="blog" class="form-control" id="blog">
                <option>--ជ្រើសរើស--</option>
                @foreach($advertiseBlog as $blog)
                    <option
                        value="{{ $blog->slug }}" {{ $advertise->blog == $blog->slug ? 'selected' : '' }}>{{ $blog->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="is_active">@lang('Status*')</label>
            <select name="is_active" class="form-control" id="is_active">
                <option value="1" {{ $advertise->is_active == 1 ? 'selected' : '' }}>បង្ហាញ</option>
                <option value="0" {{ $advertise->is_active == 0 ? 'selected' : '' }}>មិនបង្ហាញ</option>
            </select>
        </div>
        <div class="form-group">
            <label for="order">@lang('Order')</label>
            <input name="order" type="number" class="form-control" id="order"
                   value="{{ old('order') ?? $advertise->order }}">
        </div>
        <div class="form-group text-center mt-4 {{ $advertise->image ? '' : 'd-none' }}">
            <img id="image_preview" src="{{ getFileCDN($advertise->image) }}" alt="image" width="600">
        </div>
        <div class="form-group">
            <label for="image">@lang('PC advertise picture')</label>
            <div class="custom-file">
                <input name="image" type="file" class="custom-file-input" id="image" lang="km" accept="image/*"
                       value="{{ old('image') ?? $advertise->image }}">
                <label class="custom-file-label" for="image"></label>
            </div>
        </div>
        <div class="form-group text-center mt-4 {{ $advertise->image ? '' : 'd-none' }}">
            <img id="image_tablet_preview" src="{{ getFileCDN($advertise->image_tablet) }}" alt="image_tablet"
                 width="600">
        </div>
        <div class="form-group">
            <label for="image_tablet">@lang('Tablet advertise picture')</label>
            <div class="custom-file">
                <input name="image_tablet" type="file" class="custom-file-input" id="image_tablet" lang="km"
                       accept="image/*" value="{{ old('image_tablet') ?? $advertise->image_tablet }}">
                <label class="custom-file-label" for="image_tablet"></label>
            </div>
        </div>
        <div class="form-group text-center mt-4 {{ $advertise->image ? '' : 'd-none' }}">
            <img id="image_mobile_preview" src="{{ getFileCDN($advertise->image_mobile) }}" alt="image_mobile"
                 width="600">
        </div>
        <div class="form-group">
            <label for="image_mobile">@lang('Mobile advertise picture')</label>
            <div class="custom-file">
                <input name="image_mobile" type="file" class="custom-file-input" id="image_mobile" lang="km"
                       accept="image/*" value="{{ old('image_mobile') ?? $advertise->image_mobile }}">
                <label class="custom-file-label" for="image_mobile"></label>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-8"></div>
            <div class="col-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary w-100">
                    @lang('Save')
                </button>
            </div>
        </div>
    </form>
@stop

@section('scripts')
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Advertise\Advertise\UpdateAdvertiseRequest','#advertise-form') !!}

    <script>
        $("#image").change(function () {
            displayPreviewImage(this, "#image_preview");
        });
        $("#image_tablet").change(function () {
            displayPreviewImage(this, "#image_tablet_preview");
        });
        $("#image_mobile").change(function () {
            displayPreviewImage(this, "#image_mobile_preview");
        });
    </script>
@stop

