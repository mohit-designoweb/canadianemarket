                        <div class="ship_lft boxs myacc_ryt res_myaccpa">
                            <h3>Profile</h3>
                            <form method="post" action="<?php echo base_url('user/changePassword');?>" name="changePassword" id="myAccountForm">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="old_password">Old Password<sup>*</sup></label>
                                            <input type="password" name="old_password" class="form-control" id="old_password">
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="new_password">New Password <sup>*</sup></label>
                                            <input type="password" name="new_password" class="form-control" id="new_password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="con_new_password">Confirm New Password<sup>*</sup></label>
                                            <input type="password" name="confirm_new_password" class="form-control" id="confirm_new_password">
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-sm-12">
                                        <button type="submit" class="slidehover savebtn2">Change Password</button>
                                 </div>
                            </form>
                        </div>