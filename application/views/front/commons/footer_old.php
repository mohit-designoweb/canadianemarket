<section class="cards">
    <div class="container">
        <div class="card_inner boxs">
            <div class="row">
                <div class="col-xs-4">
                    <div class="cards_content boxs">
                        <img src="<?php echo base_url('assets/img/cardimg1.png'); ?>" alt="cardimg" class="img-responsive">
                        <h4>Gift Cards</h4>
                        <p>Lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="cards_content boxs">
                        <img src="<?php echo base_url('assets/img/cardimg2.png'); ?>" alt="cardimg" class="img-responsive">
                        <h4>100% ORIGINAL </h4>
                        <p>Lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="cards_content boxs">
                        <img src="<?php echo base_url('assets/img/cardimg3.png'); ?>" alt="cardimg" class="img-responsive">
                        <h4>Easy Returns</h4>
                        <p>Lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>    
<footer class="footer">
    <div class="container">
        <div class="f_inner boxs">
            <div class="row">

                <div class="col-sm-8 bd_ryt">
                    <div class="f_lft boxs">
                        <div class="row">
                            <div class="col-sm-6 width40 res_dnone">
                                <div class="lft_item boxs">
                                    <a href="<?php echo base_url('site'); ?>" class="f_logo"><img src="<?php echo base_url('assets/img/logo.png'); ?>" alt="logo" class="img-responsive"></a>
                                    <p class="copyright">Canadian Markets <br>&copy; 2019 Canadiane Market</p>
                                </div>
                            </div>
                            <div class="col-sm-6 width60">
                                <div class="f_links boxs">
                                    <ul>
                                        <li><a>Categories</a></li>
                                        <li><a href="<?php echo base_url('site/stores'); ?>">Stores</a></li>
                                        <li><a href="<?php echo base_url('site/market-place'); ?>">Marketplace</a></li>
                                        <li><a href="<?php echo base_url('restaurant'); ?>">Restaurants</a></li>
                                        <li></li>
                                        <li></li>
                                    </ul>
                                </div>
                                <div class="f_links boxs">
                                    <ul>
                                        <li><a>Quick Links</a></li>
                                        <li><a href="<?php echo base_url('site/terms'); ?>">Terms and Conditions</a></li>
                                        <li><a href="<?php echo base_url('site/privacy') ?>">Privacy Policy</a></li>
                                        <li><a href="<?php echo base_url('site/help'); ?>">Help</a></li>
                                        <li><a href="javascript:void(0)">Refer a Friend</a></li>
                                        <li><a href="<?php echo base_url('site/partner-with-us'); ?>">Partner with Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="f_ryt boxs">
                        <div class="fryt_inner boxs">
                            <h3>Subscribe Now</h3>
                            <div class="subscribebtn boxs">
                                <div class="input_group">
                                    <input id="subscribe" type="text" class="form-control" name="subscribe" placeholder="Enter Your email address">
                                    <a href="javascript:void(0)" class="slidehover"><img src="<?php echo base_url('assets/img/subicon.png'); ?>" alt="subicon" class="img-responsive"></a>
                                </div>
                            </div>
                            <div class="social_links boxs">
                                <a href="javascript:void(0);"  class="fblogin" id="fb-login"><img src="<?php echo base_url('assets/img/sicon.png'); ?>" alt="sicon" class="img center-block"><span></span></a>
                                <a href="javascript:void(0);" class="gogglelogin" id="google-login"><img src="<?php echo base_url('assets/img/sicon2.png'); ?>" alt="sicon" class="img-responsive center-block"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- register modal start -->
<div id="register" class="modal fade register" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btnclose" data-dismiss="modal"><img src="<?php echo base_url('assets'); ?>/img/cross2.png" alt="cross2" class="img-responsive center-block"></button>
                <div class="register_inner modalflex">
                    <div class="col-sm-6 modalflex nopadding">
                        <div class="reg_lft boxs">
                            <img src="<?php echo base_url('assets/img/regimg.png'); ?>" alt="regimg" class="img-responsive center-block reshide">
                            <img src="<?php echo base_url('assets/img/res_signupBanner.png'); ?>" alt="regimg" class="img-responsive center-block resshow">
                            <div class="reg_lft_heading">
                                <h3>Register</h3>
                                <p>Join Canadian E Market</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 modalflex nopadding">

                        <div class="reg_ryt boxs">
                            <p id="error_msg"></p>
                            <form method="post" action="<?php echo base_url('site/registerForm'); ?>" id="registerForm" name="registerForm">
                                <div class="formbox boxs">
                                    <h6>Fill the form</h6>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="email_reg">Email address <sup>*</sup></label>
                                                <input type="email" name="email_reg" class="form-control" id="email_reg">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="user_name_reg">User Name <sup>*</sup></label>
                                                <input type="text" name="user_name_reg" class="form-control" id="user_name_reg">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="password_reg">Password <sup>*</sup></label>
                                                <input type="password" name="password_reg" class="form-control" id="password_reg">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="registerbtns boxs">
                                                <button class="regbtn slidehover" type="submit" name="regsform">Register</button>
                                                <p>or</p>
                                                <div class="social_links">
                                                    <a href="<?php  echo $this->facebook->login_url();   ?>"  class="fblogin" id="fb-login"><img src="<?php echo base_url('assets/img/sicon.png'); ?>" alt="sicon" class="img center-block"><span></span></a>
                                                    <a href="<?php  echo $this->google->get_login_url();   ?>" class="gogglelogin" id="google-login"><img src="<?php echo base_url('assets/img/sicon2.png'); ?>" alt="sicon" class="img-responsive center-block"></a>
                                                </div>
                                            </div>
                                            <p class="modalfont">Already a member? <a href="javascript:void(0)" data-dismiss="modal" data-toggle="modal" data-target="#login">Sign In.</a></p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- register modal end -->

<!-- login modal start -->
<div id="login" class="modal fade register" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btnclose" data-dismiss="modal"><img src="<?php echo base_url('assets/img/cross2.png'); ?>" alt="cross2" class="img-responsive center-block"></button>
                <div class="register_inner modalflex">
                    <div class="col-sm-6 modalflex nopadding">
                        <div class="reg_lft boxs">
                            <img src="<?php echo base_url('assets/img/regimg.png'); ?>" alt="regimg" class="img-responsive center-block reshide">
                            <img src="<?php echo base_url('assets/img/res_signupBanner.png'); ?>" alt="regimg" class="img-responsive center-block resshow">
                            <div class="reg_lft_heading">
                                <h3>Login</h3>
                                <p>Login into Canadian E Market</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 modalflex nopadding">
                        <div class="reg_ryt boxs">
                            <p id="error_msg1"></p>
                            <form method="post" name="loginForm" id="loginForm" action="<?php echo base_url('site/login'); ?>">
                                <div class="formbox boxs">
                                    <h6>Fill the form</h6>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="email">Email Id <sup>*</sup></label>
                                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter your name">
<!--                                                    <span class="error text-danger">error</span>-->
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="password">Password <sup>*</sup></label>
                                                <input type="password" name="password" class="form-control" id="password" placeholder="********">
                                            </div>
                                            <div class="forgotpass boxs">
                                                <a href="javascript:void(0)" class="forgotbtn" data-dismiss="modal" data-toggle="modal" data-target="#forgotPassword">Forgot Password?</a>
                                                <div class="tick">
                                                    <input type="checkbox" class="tick_input" id="tick1">
                                                    <label for="tick1"><span></span>Create an account?</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="registerbtns boxs">
                                                <button class="regbtn slidehover" type="submit" name="loginbtn">LOGIN</button>
                                                <p>or</p>
                                                <div class="social_links">
                                                    <a href="<?php  echo $this->facebook->login_url();   ?>"  class="fblogin" id="fb-login"><img src="<?php echo base_url('assets/img/sicon.png'); ?>" alt="sicon" class="img center-block"><span></span></a>
                                                    <a href="<?php  echo $this->google->get_login_url();   ?>" class="gogglelogin" id="google-login"><img src="<?php echo base_url('assets/img/sicon2.png'); ?>" alt="sicon" class="img-responsive center-block"></a>
                                                </div>
                                            </div>
                                            <p class="modalfont">Not a member? <a href="javascript:void(0)" data-dismiss="modal" data-toggle="modal" data-target="#register">Register Now!</a></p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="forgotPassword" class="modal fade register" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btnclose" data-dismiss="modal"><img src="<?php echo base_url('assets/img/cross2.png'); ?>" alt="cross2" class="img-responsive center-block"></button>
                <div class="register_inner modalflex">
                    <div class="col-sm-6 modalflex nopadding">
                        <div class="reg_lft boxs">
                            <img src="<?php echo base_url('assets/img/regimg.png'); ?>" alt="regimg" class="img-responsive center-block reshide">
                            <img src="<?php echo base_url('assets/img/res_signupBanner.png'); ?>" alt="regimg" class="img-responsive center-block resshow">
                            <div class="reg_lft_heading">
                                <h3>Login</h3>
                                <p>Login into Canadian E Market</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 modalflex nopadding">
                        <div class="reg_ryt boxs">

                            <form method="post" name="forgotPasswordForm" id="forgotPasswordForm" action="<?php echo base_url('site/doSetForgotPassword'); ?>">
                                <div class="formbox boxs">
                                    <h6>Fill the form</h6>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="email">Email Id <sup>*</sup></label>
                                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter your registered email id">

                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="registerbtns boxs">
                                                <button class="regbtn slidehover" type="submit" name="loginbtn">SEND LINK</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- login modal end -->
<div id="mobileOTP" class="modal fade register" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btnclose" data-dismiss="modal"><img src="<?php echo base_url('assets/img/cross2.png'); ?>" alt="cross2" class="img-responsive center-block"></button>
                <div class="register_inner modalflex">

                    <div class="col-sm-6 modalflex nopadding" >
                        <div class="reg_ryt boxs" >
                            <form method="post" name="otpForm" id="otpForm" action="<?php echo base_url('site/doCheckPartnerOtp'); ?>">
                                <div class="formbox boxs">
                                    <h6>ENTER OTP</h6>
                                    <p id="error_msg"></p>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="otp">OTP <sup>*</sup></label>
                                                <input type="text" name="otp" class="form-control" id="otp" placeholder="Enter One Time Password">

                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="registerbtns boxs">
                                                <button class="regbtn slidehover" type="submit" name="otpBtn">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="courierOTP" class="modal fade register" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btnclose" data-dismiss="modal"><img src="<?php echo base_url('assets/img/cross2.png'); ?>" alt="cross2" class="img-responsive center-block"></button>
                <div class="register_inner modalflex">

                    <div class="col-sm-6 modalflex nopadding" >
                        <div class="reg_ryt boxs" >
                            <form method="post" name="courierOtpForm" id="courierOtpForm" action="<?php echo base_url('site/doCheckCourierOtp'); ?>">
                                <div class="formbox boxs">
                                    <h6>ENTER OTP</h6>
                                    <p id="courier_error_msg"></p>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="courireOtp">OTP <sup>*</sup></label>
                                                <input type="text" name="courireOtp" class="form-control" id="courireOtp" placeholder="Enter One Time Password">

                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="registerbtns boxs">
                                                <button class="regbtn slidehover" type="submit" name="courierOtpBtn">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="base_url" value="<?php echo base_url(); ?>"/>
<!--    top button-->
<div class="top">
    <i class="fa fa-arrow-circle-up"></i>
</div>
<!--    top button-->
<input type="hidden" id="base-url" value="<?php echo base_url(); ?>"/>
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/slick.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>
<script src="<?php echo base_url('public/js/ecommerce.js'); ?>"></script>
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>-->

<script type="text/javascript">
//    $(function () {
//        $("#dob").datepicker({
//            autoclose: true,
//            todayHighlight: true
//        }).datepicker('update', new Date());
//    });
</script>
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
    }
</script> 
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> 
</body>

</html>