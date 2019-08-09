<?php 
if(!empty($_REQUEST['id']))
{
    $id = $_REQUEST['id'];
}
?>
<section class="signUpform boxs">
        <div class="signup_top boxs">
            <img src="<?php echo base_url('assets/img/signupBanner.png');?>" class="img-responsive" alt="banner">
            <h3>Reset Password</h3>
        </div>
        <div class="signup_bottom boxs">
            <div class="container">
                <div class="form_wrpaer boxs">
                    <div class="formWrap_inn boxs">
                        <form method="post" action="<?php echo base_url('ecommerce/changePassword/'.$id);?>" name="changePassword" id="myAccountForm">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>Old Password<i class="fa fa-asterisk"></i></label>
                                        <input type="text" name="old_password" id="old_password" class="form-control" placeholder="enter old password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>New Password<i class="fa fa-asterisk"></i></label>
                                        <input type="email" name="new_password" id="new_password" class="form-control" placeholder="enter new password">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>Confirm New Password <i class="fa fa-asterisk"></i></label>
                                        <input type="text" class="form-control" name="confirm_new_password" id="confirm_new_password" placeholder="enter confirm new password">
                                    </div>
                                </div>
                            </div>
                           
                            </div>
                            <button type="submit" class="submit_btn slidehover" name="courierBtn" id="courierBtn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>