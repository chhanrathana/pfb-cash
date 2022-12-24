<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo $__env->yieldContent('title','ប្រព័ន្ធគ្រប់គ្រងប្រាក់កម្ចី'); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/customs.css')); ?>">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/coreui-chartjs.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/select2.min.css')); ?>" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo e(asset('css/toast.style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/toast.style.min.css')); ?>">
    <link rel="stylesheet" href="/css/print.css">
    <link href='http://fonts.googleapis.com/css?family=Oxygen:400,300' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
          rel="stylesheet">

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <?php echo $__env->yieldContent('css'); ?>
</head>

<body class="c-app">
<?php echo $__env->make('includes.sound', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <img class="c-sidebar-brand-full" width="300" height="55" src="<?php echo e(asset('img/logo.png')); ?>" alt="Loan">
        <img class="c-sidebar-brand-minimized" width="50" height="50" src="<?php echo e(asset('img/logo.png')); ?>" alt="Loan">
    </div>
    <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
            data-class="c-sidebar-minimized"></button>
</div>

<div class="c-wrapper c-fixed-components">
    <header class="c-header c-header-light c-header-fixed c-header-with-subheader">

        <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar"
                data-class="c-sidebar-show">
            <svg class="c-icon c-icon-lg">
                <use xlink:href="/coreui/icons/sprites/free.svg#cil-menu"></use>
            </svg>
        </button>
        <a class="c-header-brand d-lg-none" href="#">
            <img width="180" height="50" src="<?php echo e(asset('img/logo.png')); ?>" alt="Loan">
        </a>

        <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar"
                data-class="c-sidebar-lg-show" responsive="true">
            <svg class="c-icon c-icon-lg">
                <use xlink:href="/coreui/icons/sprites/free.svg#cil-menu"></use>
            </svg>
        </button>

        

        <ul class="c-header-nav ml-auto mr-4">
            <li class="c-header-nav-item dropdown">
                <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false">
                    <div class="c-avatar">
                        <img class="c-avatar-img" src="<?php echo e(asset('storage/'.auth()->user()->avatar)); ?>"
                             alt="<?php echo e(auth()->user()->name ?? 'user'); ?>" id="userAvatar">
                    </div>
                </a>
                <?php echo $__env->make('layouts.profilebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </li>
        </ul>

        <?php echo $__env->make('layouts.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </header>
    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div class="fade-in">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
        </main>

        <footer class="c-footer">

        </footer>
    </div>
</div>
<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('coreui/coreui/dist/js/coreui.bundle.min.js')); ?>"></script>
<!--[if IE]><!-->
<script src="<?php echo e(asset('coreui/icons/js/svgxuse.min.js')); ?>"></script>

<script src="<?php echo e(asset('js/jquery.inputmask.bundle.js')); ?>"></script>
<script src="<?php echo e(asset('js/toast.script.js')); ?>"></script>
<script src="<?php echo e(asset('js/customs.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/geolocation.js')); ?>"></script>

<?php echo $__env->yieldContent('script'); ?>
</body>
</html>
<?php /**PATH E:\Project\SDT\PFB CASH\Source Code\resources\views/layouts/app.blade.php ENDPATH**/ ?>