<?php $__env->startSection('page-title', __('Create page')); ?>
<?php $__env->startSection('page-heading', __('Manage pages')); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <li class="breadcrumb-item">
        <a href="<?php echo e(route('post.index')); ?>" class="text-muted">
            <?php echo app('translator')->get('Pages'); ?>
        </a>
    </li>
    <li class="breadcrumb-item active">
        <?php echo app('translator')->get('Create page'); ?>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="create-post">
        <form action="<?php echo e(route('page.store')); ?>" method="POST" id="post-form" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-9">
                    <div class="form-group">
                        <label for="title"><?php echo app('translator')->get('Title*'); ?></label>
                        <input name="title" type="text" class="form-control" id="title"
                               onkeyup="convertToSlug(this.value);pasteToCeoTitle(this.value);"
                               value="<?php echo e(old('title')); ?>">
                    </div>
                    <div class="form-group">
                        <label for="slug"><?php echo app('translator')->get('Slug'); ?></label>
                        <input name="slug" type="text" class="form-control" id="slug" value="<?php echo e(old('slug')); ?>">
                    </div>
                    <div class="form-group">
                        <label for="excerpt"><?php echo app('translator')->get('Short Description'); ?></label>
                        <textarea name="excerpt" class="form-control" id="excerpt"
                                  onkeyup="pasteToMateDescription(this.value)" rows="4"><?php echo e(old('excerpt')); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="my-editor"><?php echo app('translator')->get('Description'); ?></label>
                        <textarea name="body" class="form-control" rows="4" id="my-editor"
                                  required><?php echo e(old('body')); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="seo_title"><?php echo app('translator')->get('Title(SEO Title)'); ?></label>
                        <input name="seo_title" type="text" class="form-control" id="seo_title"
                               value="<?php echo e(old('seo_title')); ?>">
                    </div>
                    <div class="form-group">
                        <label for="meta_description"><?php echo app('translator')->get('Short Description(SEO Meta Description)'); ?></label>
                        <input name="meta_description" type="text" class="form-control" id="meta_description"
                               value="<?php echo e(old('meta_description')); ?>">
                    </div>
                    <div class="form-group">
                        <label for="meta_keywords"><?php echo app('translator')->get('Keyword(SEO Meta Keyword)'); ?></label>
                        <input name="meta_keywords" type="text" class="form-control" id="meta_keywords"
                               value="<?php echo e(old('meta_keywords')); ?>">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="source"><?php echo app('translator')->get('Source'); ?></label>
                        <input name="source" type="text" class="form-control" id="source" value="<?php echo e(old('source')); ?>">
                    </div>
                    <div class="form-group">
                        <label for="status"><?php echo app('translator')->get('Status*'); ?></label>
                        <select name="status" class="form-control select-box" id="status">
                            <?php $__currentLoopData = $postStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    <?php echo e(old('status') == $status->slug ? 'selected' : ''); ?> value="<?php echo e($status->slug); ?>"><?php echo e($status->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group text-center mt-4 d-none">
                        <img id="image_preview" class="image_preview" src="#" alt="image" width="300">
                    </div>
                    <div class="form-group">
                        <label for="image"><?php echo app('translator')->get('Default picture'); ?></label>
                        <div class="custom-file">
                            <input name="image" type="file" class="custom-file-input" id="image" lang="km"
                                   value="<?php echo e(old('image')); ?>" accept="image/*">
                            <label class="custom-file-label" for="photo"></label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3"><?php echo app('translator')->get('Create New'); ?></button>
                </div>
            </div>
        </form>
    </div>

    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="fullImage">
        <div id="caption"></div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php echo JsValidator::formRequest('Vanguard\Http\Requests\Page\CreatePageRequest','#post-form'); ?>

    <script src="https://cdn.tiny.cloud/1/lg6h230fe5wxcjpfgs2okfa1v75r1xxl7m3wnyzomdvpc9zi/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script>
        let editor_config = {
            path_absolute: "/",
            selector: 'textarea#my-editor',
            relative_urls: false,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | fullscreen link image media",
            file_picker_callback: function (callback, value, meta) {
                let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                let cmsURL = editor_config.path_absolute + 'admin/filemanager?editor=' + meta.fieldname;
                if (meta.filetype === 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.openUrl({
                    url: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            },
            images_upload_handler: uploadFileEditorHandler,
            height: "700",
        };

        tinymce.init(editor_config);

        function uploadFileEditorHandler(blobInfo, success, failure, progress) {
            let xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '<?php echo e(route('tiny-editor.upload')); ?>');

            xhr.upload.onprogress = function (e) {
                progress(e.loaded / e.total * 100);
            };

            xhr.onload = function () {
                let json;

                if (xhr.status === 403) {
                    failure('HTTP Error: ' + xhr.status, {remove: true});
                    return;
                }

                if (xhr.status < 200 || xhr.status >= 300) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }

                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }

                success(json.location);
            };

            xhr.onerror = function () {
                failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
            };

            formData = new FormData();
            formData.append('_token', '<?php echo e(csrf_token()); ?>');
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        }
    </script>

    <script>
        function pasteToCeoTitle(str) {
            $("#seo_title").val(str);
        }

        function pasteToMateDescription(str) {
            $("#meta_description").val(str);
        }
    </script>

    <script>
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

        @keyframes  zoom {
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

        @media  only screen and (max-width: 700px) {
            .modal-content {
                width: 100%;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/semnavy/Desktop/Data/Amis/SourceCode/amis_website/resources/views/page/create.blade.php ENDPATH**/ ?>