<section class="myaccount topScrl">
        <div class="container">
            <div class="ship_inner boxs">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="myacc_lft">
                            <!--<form method="post" action="<?php //echo base_url('ecommerce/imageUpload');?>" id="imgForm" name="imgForm">
                                <img id="imgFileUpload" alt="Select File" title="Select File" src="orange.png" style="cursor: pointer" />
                                <br />
                                <span id="spnFilePath"></span>
                                <input type="file" id="FileUpload1" name="image_url" style="display: none" />
                            </form>-->
                            <div class="acc_details boxs">
                                <div class="userimg boxs">
                                    <a href="javascript:void(0)">
                                        <img src="<?php if(isset($login_user_detail['image_url'])){
                                            $image = $login_user_detail['image_url'];
                                            echo base_url('profile_images/').$image;
                                        }else{  echo base_url('assets/img/userimg.png');}?>"  alt="userimg" class="img-responsive center-block"></a>
                                </div>
                                <div class="user_details boxs">
                                    <h4><?php if(isset($login_user_detail)){echo ucwords($login_user_detail['user_name']);}?></h4>
                                    <p><a href="mailto:<?php if(isset($login_user_detail)){echo $login_user_detail['email'];}?>" class="mail"><?php if(isset($login_user_detail)){echo $login_user_detail['email'];}?></a></p>
                                    <span id="spnFilePath"></span>
                                    <form id="imgForm" action="<?php echo base_url('ecommerce/doUploadProfileImage');?>" enctype="multipart/form-data">
                                    <input type="file" data-url="<?php echo base_url('ecommerce/doUploadProfileImage');?>" id="FileUpload1" name="FileUpload1" style="display: none" />
                                    <p><a href="" class="editimg">Edit Photo<img src="<?php echo base_url('assets/img/editbtn.png');?>" id="imgFileUpload" alt="Select File" title="Select File" class="img-responsive"></a></p>
                                    </form>
                                </div>
                            </div>

                            <div class="userprofile boxs">
                                <h5>Account</h5>
                                <div class="profiledetails boxs">
                                    <ul>
                                        <li><a href="javascript:void(0)">Orders History</a>
                                            <!-- <a href="javascript:void(0)" class="his">Invite a friend</a> -->
                                        </li>
                                        <li><a href="javascript:void(0)">Invite a friend</a></li>
                                        <li><a href="javascript:void(0)">E - Market Credit <span>($20)</span></a></li>
                                        <li><a href="javascript:void(0)">Auto Re - Order</a></li>
                                        <?php if(isset($login_user_detail)){ if($login_user_detail['source']=='self'){?>
                                        <li><a href="<?php echo base_url('ecommerce/change_password');?>">Change Password</a></li>
                                        <?php }}?>
                                        <li><a href="<?php echo base_url('ecommerce/logout');?>">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <?php// print_r($login_user_detail);?>
                        <div class="ship_lft boxs myacc_ryt res_myaccpa">
                            <h3>Profile</h3>
                            <form method="post" action="<?php echo base_url('ecommerce/changePassword');?>" name="changePassword" id="myAccountForm">
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
                    </div>
                </div>
            </div>
        </div>
    </section>
