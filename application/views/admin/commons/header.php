 <!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-touch-fullscreen" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
        <title><?php echo $title; ?></title>
        <link rel="icon" type="image/x-icon" href="<?php echo base_url('public/image/res_logo.png'); ?>"/>
        <link rel="icon" href="<?php echo base_url('public/image/logo.png'); ?>" type="image/png" sizes="16x16">
        <link rel='stylesheet' href="<?php echo base_url('public/css/pace.css'); ?>" />
        <!--vendors-->
        <link rel='stylesheet' type='text/css' href='<?php echo base_url('public/css/bootstrap-datepicker.css'); ?>'/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel='stylesheet' href='<?php echo base_url('public/css/time-picker.css'); ?>'/>

        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,600" rel="stylesheet">
        <!--Material Icons-->
        <link rel='stylesheet' type='text/css' href='<?php echo base_url('public/css/materialdesignicons.min.css'); ?>'/>
        <!--Material Icons-->
        <link rel='stylesheet' type='text/css' href='<?php echo base_url('public/css/feather-icons.css'); ?>'/>
        <!--Bootstrap + atmos Admin CSS-->
        <link rel='stylesheet' type='text/css' href='<?php echo base_url('public/css/atmos.min.css'); ?>'/>
        <!-- Additional library for page -->
        <link rel='stylesheet' type='text/css' href='<?php echo base_url('public/css/datatable.css'); ?>'/>
        <link rel='stylesheet' type='text/css' href='<?php echo base_url('public/css/style.css'); ?>'/>
       
    </head>
    <body class="pace-done sidebar-pinned">
        <div class="loader"></div>
        <aside class="admin-sidebar sidebar-show">
            <div class="admin-sidebar-brand">
                <!-- begin sidebar branding-->
                <img class="admin-brand-logo" src="<?php echo base_url('public/image/res_logo.png') ?>" width="40" alt="atmos Logo">
                <!-- end sidebar branding-->
                <div class="ml-auto">
                    <!-- sidebar pin-->
                    <a href="#" class="admin-pin-sidebar btn-ghost btn btn-rounded-circle pinned"></a>
                    <!-- sidebar close for mobile device-->
                    <a href="#" class="admin-close-sidebar"></a>
                </div>
            </div>
            