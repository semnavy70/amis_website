@extends('layouts.app')

@section('page-title', __('Edit Partner'))
@section('page-heading', __('Manage Partner'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('partner.index') }}" class="text-muted">
            @lang('Partner')
        </a>
    </li>
    <li class="breadcrumb-item active">
        @lang('Edit Partner')
    </li>
@stop

@section('content')
    @include('partials.messages')
    <form action="{{route("partner.update")}}" method="POST" id="partner-form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$partner->id}}">
        <div class="form-group">
            <label for="name">@lang('Name')*</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old("name")??$partner->name}}">
        </div>
        <div class="form-group text-center mt-4 {{ $partner->image ? '' : 'd-none' }}">
            <img id="image_preview" class="image_preview" src="{{ getFileCDN($partner->image) }}" alt="image"
                 width="300">
        </div>
        <div class="form-group">
            <label for="image">@lang('Image')*</label>
            <div class="custom-file">
                <input name="image" type="file" class="custom-file-input" id="image" lang="km"
                       value="{{old('image')}}" accept="image/*">
                <label class="custom-file-label" for="photo"></label>
            </div>
        </div>
        <div class="form-group">
            <label for="link">@lang('Link')</label>
            <input type="text" class="form-control" id="link" name="link" value="{{old("link")??$partner->link}}">
        </div>
        <div class="form-group">
            <label for="order">@lang('Order')</label>
            <input type="number" class="form-control" id="order" name="order"
                   value="{{old("order")??$partner->order}}">
        </div>
        <div class="row mb-3">
            <div class="col-8"></div>
            <div class="col-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary w-100">@lang('Save')</button>
            </div>
        </div>
    </form>
@stop

@section('scripts')
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Partner\UpdatePartnerRequest','#partner-form') !!}
    <script>
        $("#image").change(function () {
            displayPreviewImage(this, "#image_preview");
        });
    </script>
    <style>
        .image_preview {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .image_preview:hover {
            opacity: 0.7;
        }
    </style>
@stop

