@extends('layouts.app')

@section('page-title', __('Create Slide'))
@section('page-heading', __('Manage Slide'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('slide.index') }}" class="text-muted">
            @lang('Slide')
        </a>
    </li>
    <li class="breadcrumb-item active">
        @lang('Create Slide')
    </li>
@stop

@section('content')
    @include('partials.messages')
    <form action="{{route("slide.store")}}" method="POST" id="slide-form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">@lang('Name')</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old("name")}}">
        </div>
        <div class="form-group text-center mt-4 d-none">
            <img id="image_preview" class="image_preview" src="#" alt="image" width="300">
        </div>
        <div class="form-group">
            <label for="image">@lang('Image')*</label>
            <div class="custom-file">
                <input name="image" type="file" class="custom-file-input" id="image" lang="km" value="{{old('image')}}" accept="image/*">
                <label class="custom-file-label" for="photo"></label>
            </div>
        </div>
        <div class="form-group">
            <label for="order">@lang('Order')</label>
            <input type="number" class="form-control" id="order" name="order"
                   value="{{old("order")}}">
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
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Slide\CreateSlideRequest','#slide-form') !!}
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
