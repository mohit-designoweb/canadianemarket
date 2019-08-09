<section class="privacy topScrl">
        <div class="container" >
            <div class="col-sm-3 modalflex nopadding">
                
            </div>
            <div class="col-sm-6 modalflex nopadding">
                        <div class="reg_ryt boxs">
                           <p id="error_msg_forgot_password"></p>
                            <form method="post" name="forgotPasswordForm" id="update-forgot-password" action="<?php echo base_url('user/update_forgot_password'); ?>">
                                <div class="formbox boxs">
                                <h6>Update password</h6>
                                    <div class="row">
                                       <div class="col-sm-12">
                                             <div class="form-group">
                                                <label for="password">Password <sup>*</sup></label>
                                                <input type="password" name="password"  class="form-control" id="password" placeholder="********">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="password">Confirm Password <sup>*</sup></label>
                                                <input type="password" name="conf_password" class="form-control" id="conf_password" placeholder="********">
												<input type="hidden" name="userid" value="<?php echo $user_id; ?>">
                                            </div>
                                        </div>    
                                        <div class="col-sm-12">
                                            <div class="registerbtns boxs">
                                                <button class="regbtn slidehover" type="submit" name="loginbtn">Update</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-3 modalflex nopadding">
                
                    </div>
        </div>
    </section>