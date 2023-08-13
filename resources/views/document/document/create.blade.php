@extends('layouts.app')

@section('document-title', __('Create document'))
@section('document-heading', __('Manage documents'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('post.index') }}" class="text-muted">
            @lang('Documents')
        </a>
    </li>
    <li class="breadcrumb-item active">
        @lang('Create document')
    </li>
@stop

@section('content')
    @include('partials.messages')
    <div class="create-post">
        <form action="{{ route('document.store') }}" method="POST" id="post-form" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-7">
                    <div class="form-group">
                        <label for="title">@lang('Title*')</label>
                        <input name="title" type="text" class="form-control" id="title"
                               value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                        <label for="excerpt">@lang('Description')</label>
                        <textarea name="description" class="form-control" id="excerpt" rows="4">
                            {{ old('decription') }}
                        </textarea>
                    </div>
                </div>
                <div class="col-5">

                    <div class="form-group">
                        <label for="category_id">@lang('Category*')</label>
                        <select name="category_id" class="form-control" id="category_id">
                            <option value="">--ជ្រើសរើស--</option>
                            @foreach($documentCategory as $category)
                                <option
                                    {{ old('category_id') === $category->id ? 'selected' : '' }} value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="type">@lang('Document*')</label>
                        <select name="type" class="form-control" id="type">
                            @foreach($documentType as $type)
                                <option {{ old('type') === $type['key'] ? 'selected' : '' }} value="{{ $type['key'] }}">
                                    {{ $type['value'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" id="pdfType">
                        <label for="image">@lang('PDF')</label>
                        <div class="custom-file">
                            <input name="source" type="file" class="custom-file-input" id="source" lang="km"
                                   value="{{old('source')}}" accept="application/pdf"/>
                            <label class="custom-file-label" for="source"></label>
                        </div>
                    </div>

                    <div class="form-group" id="videoType">
                        <label for="source">@lang('Video*')</label>
                        <input name="source" type="text" class="form-control" id="source"
                               value="{{ old('source') }}"/>
                    </div>


                    <button type="submit" class="btn btn-primary w-100 mt-3">@lang('Create New')</button>
                </div>
            </div>
        </form>
    </div>
@stop

@section('scripts')
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Document\Document\CreateDocumentRequest','#post-form') !!}

    <script>
        $(document).ready(function () {
            const el = $("#type");
            const selectedDiv = el.val();
            toggleType(selectedDiv);

            function toggleType(type) {
                if (type === 'pdf') {
                    showDiv(`pdfType`);
                    hideDiv(`videoType`);
                } else {
                    showDiv(`videoType`);
                    hideDiv(`pdfType`);
                }
            }

            function showDiv(name) {
                $(`#${name}`).show();
            }

            function hideDiv(name) {
                $(`#${name}`).hide();
            }

            el.on('change', function () {
                const selectedDiv = $(this).val();
                toggleType(selectedDiv);
            });
        });

    </script>
@endsection
