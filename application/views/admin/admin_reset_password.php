


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
        <link rel="icon" href="<?php echo base_url('public/image/res_logo.png'); ?>" type="image/png" sizes="16x16">
        
        <link rel='stylesheet' href="<?php echo base_url('public/css/pace.css'); ?>" />

        <!--vendors-->
        <link rel='stylesheet' type='text/css' href='<?php echo base_url('public/css/bootstrap-datepicker.css'); ?>'/>

        <link rel='stylesheet' href='<?php echo base_url('public/css/time-picker.css'); ?>'/>

        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,600" rel="stylesheet">
        <!--Material Icons-->
        <link rel='stylesheet' type='text/css' href='<?php echo base_url('public/css/materialdesignicons.min.css'); ?>'/>
        <!--Material Icons-->
        <link rel='stylesheet' type='text/css' href='<?php echo base_url('public/css/feather-icons.css'); ?>'/>
        <!--Bootstrap + atmos Admin CSS-->
        <link rel='stylesheet' type='text/css' href='<?php echo base_url('public/css/atmos.min.css'); ?>'/>
        <!-- Additional library for page -->
        <link rel='stylesheet' type='text/css' href='<?php echo base_url('public/css/style.css'); ?>'/>

    </head>
    <body class="jumbo-page">

        <main class="admin-main  ">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-lg-4  bg-white">
                        <div class="row align-items-center m-h-100">
                            <div class="mx-auto col-md-8">
                                <div class="p-b-20 text-center">
                                    <p>
                                        <img src="<?php echo base_url('public/image/res_logo.png') ?>" width="80" alt="">
                                    </p>
                                    <p class="admin-brand-content">Canadian E-Market</p>
                                </div>
                                <h3 class="text-center p-b-20 fw-400">Update Password</h3>
                                <div id="error_msg"></div>
								<form class="needs-validation" action="<?php echo base_url('admin/update_forgot_password'); ?>" id="update-forgot-password">
                                    <div class="form-row">
                                        
										<div class="form-group floating-label col-md-12">
<!--                                            <label for="email">Email</label>-->
                                            <input type="password" name="new_password" id="new_password" placeholder="New Password" class="form-control "  >
                                        </div>
                                        <div class="form-group floating-label col-md-12">
                                          <!-- <label for="password">Password</label> -->
                                            <input type="password" name="conf_password" id="conf_password" placeholder="Confirm Password" class="form-control "  >
                                        </div>
                                    </div>
                                    <input type="hidden" name="adminid" value="<?php echo $admin_id;?>" />
                                    <button type="submit" class="btn btn-primary btn-block btn-lg">Change</button>
                                </form>
<!--                                <p class="text-right p-t-10">
                                    <a href="" class="text-underline">Forgot Password?</a>
                                </p>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 d-none d-md-block bg-cover" style="background-image: url('<?php echo base_url('public/image/login.svg') ?>');">

                    </div>
                </div>
            </div>
        </main>


        <script src='<?php echo base_url('public/js/pace.min.js') ?>'></script>
        <script src='<?php echo base_url('public/js/demo.js') ?>'></script>
        <script src='<?php echo base_url('public/js/event.js') ?>'></script>
        <!--page specific scripts for demo-->

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-66116118-3"></script> <script> window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'UA-66116118-3');</script>

    </body>

    <!-- Mirrored from atmos.atomui.com/light/login by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 31 May 2019 04:44:38 GMT -->
</html>