<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="<?php echo e(url('assets/img/favicon.ico')); ?>" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
        crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(url('assets/css/app.css')); ?>?v=1">
    <link rel="stylesheet" href="<?php echo e(url('assets/css/responsive.css')); ?>">
    <link rel="stylesheet" href=" https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css?ver=4.7.5">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <?php echo $__env->yieldContent('product-css'); ?>
    <?php if(App::getLocale()=='en'): ?>
        <style>
            .menu .navbar .navbar-nav > .nav-item > .nav-link {
                text-transform: uppercase;
                padding: 2px 15px;
                font-weight: 600;
                font-size: 15px;
            }
        </style>
    <?php endif; ?>
    <?php if(Route::getCurrentRoute()->uri()=="bussiness" || Route::getCurrentRoute()->uri()=="en/bussiness"): ?>
        <style>
            header {
                background: #d40000;
                padding: 5px;
                position: relative;
            }
            .menu .navbar .navbar-nav > .nav-item.active {
                background-color: #d40000;
            }
            .detail{
                padding: 20px 20px;
            }
            a {
                color: #707A1A;
            }
        </style>
    <?php endif; ?>
    <?php if(Route::getCurrentRoute()->uri()=="topic/{slug}/{filter?}" || Route::getCurrentRoute()->uri()=="en/topic/{slug}/{filter?}"): ?>
        <style>
            header {
                background: #f60;
                padding: 2px;
                position: relative;
            }
            .menu .navbar .navbar-nav > .nav-item.active {
                background-color: #f60;
            }
        </style>
    <?php endif; ?>
    <?php if(Route::getCurrentRoute()->uri()=="document/{slug}" || Route::getCurrentRoute()->uri()=="en/document/{slug}" ): ?>
        <style>
            header {
                background: #08a;
                padding: 2px;
                position: relative;
            }
            .menu .navbar .navbar-nav > .nav-item.active {
                background-color: #08a;
            }
            .page-body h2{
                font-size: 1.7rem;
            }
        </style>
    <?php endif; ?>
    <?php if(Route::getCurrentRoute()->uri()=="market" || Route::getCurrentRoute()->uri()=="en/market" ): ?>
        <style>
            header {
                background:#4a0;
                padding: 2px;
                position: relative;
            }
            .menu .navbar .navbar-nav > .nav-item.active {
                background-color: #4a0;
            }
            .page-body h2{
                font-size: 1.7rem;
            }
            .detail{
                padding: 20px 20px;
            }
            a {
                color: #707A1A;
            }

        </style>
    <?php endif; ?>
    <title><?php echo $__env->yieldContent('site-title'); ?></title>
</head>

<body>
    <header>
        <div class="lan text-white">
            <a href="<?php echo e(url_switch_lang()); ?>" class="btn btn-lang btn-sm <?php echo e(App::getLocale()=='kh'?'acitve':''); ?>">
                <img src="<?php echo e(url('assets/img/flag-kh.gif')); ?>" alt="Khmer">
            </a>
            |
            <a href="<?php echo e(url_switch_lang('en')); ?>" class="btn btn-lang btn-sm <?php echo e(App::getLocale()=='en'?'acitve':''); ?>">
                <img src="<?php echo e(url('assets/img/flag-en.gif')); ?>" alt="EN">
            </a>
        </div>
    </header>

    <div class="menu sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <!-- <a class="navbar-brand" href="#">Navbar</a> -->
                <a href="<?php echo e(app_url('/')); ?>" class="navbar-brand">
                    <img src="https://amis.maff.gov.kh/assets/img/logo.png" width="74"  alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <?php echo e(menu('front', 'share.bootstrap')); ?>

                </div>
            </nav>
        </div>
    </div>
    <div class="wrapper">
        <!-- Search Box -->
        <form action="<?php echo e(route('home.search')); ?>" method="GET" role="search" style="margin:0px;">
            <div id="searchbox" class="searchbox">
                <i class="magnify fa fa-search" aria-hidden="true"></i>
                <i class="fa fa-times close" id="searchbox-close" aria-hidden="true"></i>
                <input id="search-input" name="search" type="text" placeholder="<?php echo app('translator')->getFromJson('translator.search'); ?>" />
            </div>
        </form>
        <!-- End Search Box -->
        <?php if(isset($list_slide)): ?>
            <?php echo $__env->make('share.slide', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
        <?php echo $__env->yieldContent('content'); ?>
        <footer class="footer">
            <div class="center-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <h5><?php echo app('translator')->getFromJson('translator.other_link'); ?></h5>
                            <div class="line"></div>

                                <?php echo links(); ?>


                        </div>
                        <div class="col-md-3">
                            <h5><?php echo app('translator')->getFromJson('translator.agri_market_info'); ?></h5>
                            <div class="line"></div>
                            <ul>
                                <?php if(isset($agri_info)): ?>
                                <?php $__currentLoopData = $agri_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $item = $item->translate(App::getLocale()); ?>
                                <li>
                                    <a href="<?php echo e(getLink($item)); ?>"><?php echo e($item->title); ?></a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                                <li>
                                    <a href="<?php echo e(route('voyager.products.map')); ?>"><?php echo app('translator')->getFromJson('translator.production'); ?></a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <h5><?php echo app('translator')->getFromJson('translator.agri_market_office'); ?></h5>
                            <div class="line"></div>
                            <ul>
                                <?php if(isset($agri_office)): ?>
                                <?php $__currentLoopData = $agri_office; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $item = $item->translate(App::getLocale()); ?>
                                <li>
                                    <a href="<?php echo e(getLink($item)); ?>"><?php echo e($item->title); ?></a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <h5><?php echo app('translator')->getFromJson('translator.address'); ?></h5>
                            <div class="line"></div>
                            <p>
                                <span>
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                                <?php echo app('translator')->getFromJson('translator.address_desc'); ?>

                            </p>
                            <p>
                                <i class="fas fa-mobile"></i>
                                <a href="tel:+85523 216 060"><?php echo app('translator')->getFromJson('translator.phone'); ?></a>
                            </p>
                            <p>
                                <i class="fas fa-envelope"></i>
                                <a href="<?php echo e(app_url("page/contact-us")); ?>"><?php echo app('translator')->getFromJson('translator.email'); ?></a>
                            </p>
                            <p>
                                <i class="fab fa-facebook-square"></i>
                                <a href="https://www.facebook.com/profile.php?id=100009150599278">AMIS Facebook </a>
                            </p>
                            <p>
                                <i class="fas fa-users"></i>
                                <?php echo app('translator')->getFromJson('translator.all_visitor'); ?> <?php echo e(Counter::allHits()); ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-footer">
                Copyrights © <?=date("Y")?> All Rights Reserved. Powered by
                <a href="https://kravanh.com/" class="text-white" target="_blank">
                    KRAVANH Technology. </a>
            </div>
        </footer>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
        
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>
    
    <script src="<?php echo e(url('assets/js/app.js')); ?>" type="text/javascript"></script>
    <?php echo $__env->yieldContent('product-js'); ?>

    <?php echo $__env->yieldContent('alert'); ?>
    
    <?php echo $__env->yieldContent('chart-js'); ?>

    <?php echo $__env->yieldContent('script'); ?>

</body>

</html>