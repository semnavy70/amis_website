<!DOCTYPE html>
<<<<<<< HEAD
<html lang="<?php echo e(config('app.locale')); ?>" dir="<?php echo e(__('voyager::generic.is_rtl') == 'true' ? 'rtl' : 'ltr'); ?>">
=======
<html lang="<?php echo e(config('app.locale')); ?>" <?php if(config('voyager.multilingual.rtl')): ?> dir="rtl" <?php endif; ?>>
>>>>>>> 788376cdde7e4b98b71125068fe2bc61e5a26670
<head>
    <title><?php echo $__env->yieldContent('page_title', setting('admin.title') . " - " . setting('admin.description')); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"/>
<<<<<<< HEAD
    <meta name="assets-path" content="<?php echo e(route('voyager.voyager_assets')); ?>"/>
=======
>>>>>>> 788376cdde7e4b98b71125068fe2bc61e5a26670

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

    <!-- Favicon -->
<<<<<<< HEAD
    <?php $admin_favicon = Voyager::setting('admin.icon_image', ''); ?>
    <?php if($admin_favicon == ''): ?>
        <link rel="shortcut icon" href="<?php echo e(voyager_asset('images/logo-icon.png')); ?>" type="image/png">
    <?php else: ?>
        <link rel="shortcut icon" href="<?php echo e(Voyager::image($admin_favicon)); ?>" type="image/png">
    <?php endif; ?>
=======
    <link rel="shortcut icon" href="<?php echo e(voyager_asset('images/logo-icon.png')); ?>" type="image/x-icon">
>>>>>>> 788376cdde7e4b98b71125068fe2bc61e5a26670



    <!-- App CSS -->
    <link rel="stylesheet" href="<?php echo e(voyager_asset('css/app.css')); ?>">

    <?php echo $__env->yieldContent('css'); ?>
    <?php if(config('voyager.multilingual.rtl')): ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css">
        <link rel="stylesheet" href="<?php echo e(voyager_asset('css/rtl.css')); ?>">
    <?php endif; ?>

    <!-- Few Dynamic Styles -->
    <style type="text/css">
        .voyager .side-menu .navbar-header {
            background:<?php echo e(config('voyager.primary_color','#22A7F0')); ?>;
            border-color:<?php echo e(config('voyager.primary_color','#22A7F0')); ?>;
        }
        .widget .btn-primary{
            border-color:<?php echo e(config('voyager.primary_color','#22A7F0')); ?>;
        }
        .widget .btn-primary:focus, .widget .btn-primary:hover, .widget .btn-primary:active, .widget .btn-primary.active, .widget .btn-primary:active:focus{
            background:<?php echo e(config('voyager.primary_color','#22A7F0')); ?>;
        }
        .voyager .breadcrumb a{
            color:<?php echo e(config('voyager.primary_color','#22A7F0')); ?>;
        }
    </style>

    <?php if(!empty(config('voyager.additional_css'))): ?><!-- Additional CSS -->
        <?php $__currentLoopData = config('voyager.additional_css'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $css): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><link rel="stylesheet" type="text/css" href="<?php echo e(asset($css)); ?>"><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

    <?php echo $__env->yieldContent('head'); ?>
</head>

<body class="voyager <?php if(isset($dataType) && isset($dataType->slug)): ?><?php echo e($dataType->slug); ?><?php endif; ?>">

<div id="voyager-loader">
    <?php $admin_loader_img = Voyager::setting('admin.loader', ''); ?>
    <?php if($admin_loader_img == ''): ?>
        <img src="<?php echo e(voyager_asset('images/logo-icon.png')); ?>" alt="Voyager Loader">
    <?php else: ?>
        <img src="<?php echo e(Voyager::image($admin_loader_img)); ?>" alt="Voyager Loader">
    <?php endif; ?>
</div>

<?php
<<<<<<< HEAD
if (starts_with(app('VoyagerAuth')->user()->avatar, 'http://') || starts_with(app('VoyagerAuth')->user()->avatar, 'https://')) {
    $user_avatar = app('VoyagerAuth')->user()->avatar;
} else {
    $user_avatar = Voyager::image(app('VoyagerAuth')->user()->avatar);
=======
if (starts_with(Auth::user()->avatar, 'http://') || starts_with(Auth::user()->avatar, 'https://')) {
    $user_avatar = Auth::user()->avatar;
} else {
    $user_avatar = Voyager::image(Auth::user()->avatar);
>>>>>>> 788376cdde7e4b98b71125068fe2bc61e5a26670
}
?>

<div class="app-container">
    <div class="fadetoblack visible-xs"></div>
    <div class="row content-container">
<<<<<<< HEAD
        <?php echo $__env->make('voyager::dashboard.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('voyager::dashboard.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
=======
        <?php echo $__env->make('voyager::dashboard.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('voyager::dashboard.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
>>>>>>> 788376cdde7e4b98b71125068fe2bc61e5a26670
        <script>
            (function(){
                    var appContainer = document.querySelector('.app-container'),
                        sidebar = appContainer.querySelector('.side-menu'),
                        navbar = appContainer.querySelector('nav.navbar.navbar-top'),
                        loader = document.getElementById('voyager-loader'),
                        hamburgerMenu = document.querySelector('.hamburger'),
                        sidebarTransition = sidebar.style.transition,
                        navbarTransition = navbar.style.transition,
                        containerTransition = appContainer.style.transition;

                    sidebar.style.WebkitTransition = sidebar.style.MozTransition = sidebar.style.transition =
                    appContainer.style.WebkitTransition = appContainer.style.MozTransition = appContainer.style.transition =
                    navbar.style.WebkitTransition = navbar.style.MozTransition = navbar.style.transition = 'none';

<<<<<<< HEAD
                    if (window.innerWidth > 768 && window.localStorage && window.localStorage['voyager.stickySidebar'] == 'true') {
=======
                    if (window.localStorage && window.localStorage['voyager.stickySidebar'] == 'true') {
>>>>>>> 788376cdde7e4b98b71125068fe2bc61e5a26670
                        appContainer.className += ' expanded no-animation';
                        loader.style.left = (sidebar.clientWidth/2)+'px';
                        hamburgerMenu.className += ' is-active no-animation';
                    }

                   navbar.style.WebkitTransition = navbar.style.MozTransition = navbar.style.transition = navbarTransition;
                   sidebar.style.WebkitTransition = sidebar.style.MozTransition = sidebar.style.transition = sidebarTransition;
                   appContainer.style.WebkitTransition = appContainer.style.MozTransition = appContainer.style.transition = containerTransition;
            })();
        </script>
        <!-- Main Content -->
        <div class="container-fluid">
            <div class="side-body padding-top">
                <?php echo $__env->yieldContent('page_header'); ?>
                <div id="voyager-notifications"></div>
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>
</div>
<<<<<<< HEAD
<?php echo $__env->make('voyager::partials.app-footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
=======
<?php echo $__env->make('voyager::partials.app-footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
>>>>>>> 788376cdde7e4b98b71125068fe2bc61e5a26670

<!-- Javascript Libs -->


<script type="text/javascript" src="<?php echo e(voyager_asset('js/app.js')); ?>"></script>

<<<<<<< HEAD
=======

>>>>>>> 788376cdde7e4b98b71125068fe2bc61e5a26670
<script>
    <?php if(Session::has('alerts')): ?>
        let alerts = <?php echo json_encode(Session::get('alerts')); ?>;
        helpers.displayAlerts(alerts, toastr);
    <?php endif; ?>

    <?php if(Session::has('message')): ?>

    // TODO: change Controllers to use AlertsMessages trait... then remove this
    var alertType = <?php echo json_encode(Session::get('alert-type', 'info')); ?>;
    var alertMessage = <?php echo json_encode(Session::get('message')); ?>;
    var alerter = toastr[alertType];

    if (alerter) {
        alerter(alertMessage);
    } else {
        toastr.error("toastr alert-type " + alertType + " is unknown");
    }
<<<<<<< HEAD
    <?php endif; ?>
</script>
<?php echo $__env->make('voyager::media.manager', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('javascript'); ?>
<?php echo $__env->yieldPushContent('javascript'); ?>
=======

    <?php endif; ?>
</script>
<?php echo $__env->yieldContent('javascript'); ?>

>>>>>>> 788376cdde7e4b98b71125068fe2bc61e5a26670
<?php if(!empty(config('voyager.additional_js'))): ?><!-- Additional Javascript -->
    <?php $__currentLoopData = config('voyager.additional_js'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $js): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><script type="text/javascript" src="<?php echo e(asset($js)); ?>"></script><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

</body>
</html>
<<<<<<< HEAD
<?php /**PATH /Users/semnavy/Desktop/Data/Amis/SourceCode/amis_website/vendor/tcg/voyager/src/../resources/views/master.blade.php ENDPATH**/ ?>
=======
>>>>>>> 788376cdde7e4b98b71125068fe2bc61e5a26670
