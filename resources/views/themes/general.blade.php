@extends('layouts.app')

@section('page-title', __('Themes'))
@section('page-heading', __('Manage Themes'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('ទំព័រមុខ')
    </li>
@stop
@section('content')
    @include('partials.messages')
    <div class="create-post">
        <form action="{{ route('themes.update') }}" method="POST" id="post-form" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <div class="form-group text-center mt-4 {{ $theme && $theme->logo !== null ? '' : 'd-none' }}">
                            @if($theme && $theme->logo !== null)
                                <img id="image_logo" class="image_logo" src="{{ getFileCDN($theme->logo) }}" alt="image" width="300">
                            @endif
                        </div>
                        <label for="logo">@lang('Logo Theme')</label>
                        <div class="custom-file">
                            <input name="logo" type="file" class="custom-file-input" id="logo" lang="km"
                                   value="{{ old('logo', $theme->logo ?? '') }}" accept="image/*">
                            <label class="custom-file-label" for="photo"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="site_name">@lang('Site Name*')</label>
                        <input name="site_name" type="text" class="form-control" id="site_name"
                               value="{{ old('site_name', $theme->site_name ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="site_description">@lang('Site Description')</label>
                        <input name="site_description" type="text" class="form-control" id="site_description"
                               value="{{ old('site_description', $theme->site_description ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="slogan">@lang('Slogan')</label>
                        <input name="slogan" type="text" class="form-control" id="slogan"
                               value="{{ old('slogan', $theme->slogan ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="copyright_name">@lang('Copyright')</label>
                        <input name="copyright_name" type="text" class="form-control" id="copyright_name"
                               value="{{ old('copyright_name', $theme->copyright_name ?? '') }}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="facebook_link">@lang('Facebook Link')</label>
                        <input name="facebook_link" type="text" class="form-control" id="facebook_link"
                               value="{{ old('facebook_link', $theme-> facebook_link ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="youtube_link">@lang('Youtube Link')</label>
                        <input name="youtube_link" type="text" class="form-control" id="youtube_link"
                               value="{{ old('youtube_link', $theme->youtube_link ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="instagram_link">@lang('Instagram Link')</label>
                        <input name="instagram_link" type="text" class="form-control" id="instagram_link"
                               value="{{ old('instagram_link', $theme->instagram_link ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="twitter_link">@lang('Twitter Link')</label>
                        <input name="twitter_link" type="text" class="form-control" id="twitter_link"
                               value="{{ old('twitter_link', $theme->twitter_link ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="linkedin_link">@lang('Linkedin Link')</label>
                        <input name="linkedin_link" type="text" class="form-control" id="linkedin_link"
                               value="{{ old('linkedin_link', $theme->linkedin_link ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="tiktok_link">@lang('Tiktok Link')</label>
                        <input name="tiktok_link" type="text" class="form-control" id="tiktok_link"
                               value="{{ old('tiktok_link', $theme->tiktok_link ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="phone_number">@lang('Phone Number')</label>
                        <input name="phone_number" type="text" class="form-control" id="phone_number"
                               value="{{ old('phone_number', $theme->phone_number ?? '') }}">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">@lang('Save')</button>
                </div>
            </div>
        </form>
    </div>
@stop
@section('scripts')
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Post\Post\CreatePostRequest','#post-form') !!}
    <script src="https://cdn.tiny.cloud/1/vv1wesmik107j4p9a4c52wvxk5gx0vy51hinby7nnyi1y2u4/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script>
        $("#logo").change(function () {
            displayPreviewImage(this, "#image_logo");
        });
        $("#image").change(function () {
            displayPreviewImage(this, "#image_preview");
        });
    </script>

    <script>
        let modal = document.getElementById("myModal");
        let modalImg = document.getElementById("fullImage");

        $('img.image_preview').on('click', (e) => {
            const imageSrc = $(e)[0].target.currentSrc;
            modal.style.display = "block";
            modalImg.src = imageSrc;
        });

        let span = document.getElementsByClassName("close")[0];
        span.onclick = function () {
            modal.style.display = "none";
        }

        modal.onclick = function () {
            modal.style.display = "none";
        }
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

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            padding-top: 150px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.9);
        }

        .modal-content {
            margin: 0 auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        .modal-content, #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {
                -webkit-transform: scale(0)
            }
            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }
            to {
                transform: scale(1)
            }
        }

        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        @media only screen and (max-width: 700px) {
            .modal-content {
                width: 100%;
            }
        }
    </style>
@endsection
