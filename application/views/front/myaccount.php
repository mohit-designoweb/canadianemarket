<section class="myaccount topScrl">
        <div class="container">
            <div class="ship_inner boxs">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="myacc_lft">
                            <div class="acc_details boxs">
                                <div class="userimg boxs">
                                    <a href="javascript:void(0)">
                                        <img src="<?php if(isset($user_data['image_url'])){
                                            echo base_url('uploads/profile_images/'.$user_data['image_url']);
                                        }else{  echo base_url('assets/img/userimg.png');}?>"  alt="userimg" class="img-responsive center-block profile_pic" ></a>
                                </div>
                                <div class="user_details boxs">
                                    <h4><?php if(isset($user_data)){echo ucwords($user_data['user_name']);}?></h4>
                                    <p><a href="mailto:<?php if(isset($user_data)){echo $user_data['email'];}?>" class="mail"><?php if(isset($user_data)){echo $user_data['email'];}?></a></p>
                                    <span id="spnFilePath"></span>
                                    <p><a href="<?php  echo base_url('user/profile-upload-wrapper');?>" class="editimg">Edit Photo<img src="<?php echo base_url('assets/img/editbtn.png');?>" class="img-responsive"></a></p>
<!--                                <form id="imgForm" action="<?php echo base_url('site/doUploadProfileImage');?>" enctype="multipart/form-data">
                                    <input type="file" data-url="<?php echo base_url('site/doUploadProfileImage');?>" id="FileUpload1" name="FileUpload1" style="display: none" />
                                    <p><a href="" class="editimg">Edit Photo<img src="<?php echo base_url('assets/img/editbtn.png');?>" id="imgFileUpload" alt="Select File" title="Select File" class="img-responsive"></a></p>
                                    </form>-->
                                </div>
                            </div>

                            <div class="userprofile boxs">
                                <h5>Account</h5>
                                <div class="profiledetails boxs">
                                    <ul>
                                        <li><a class="user-account active" href="<?php echo base_url('user/my_account_wrapper'); ?>">My Profile</a></li>
                                        <li><a class="user-account" href="<?php echo base_url('user/order-history-wrapper');?>">Orders History</a>
                                            <!-- <a href="javascript:void(0)" class="his">Invite a friend</a> -->
                                        </li>
                                        <!--<li><a class="user-account" href="<?php //echo base_url('user/invite-friend');?>">Invite a friend</a></li>-->
										<li><a href="javascript:void(0)" class="login" data-toggle="modal" data-target="#userUniqueid">Invite a friend</a></li>
                                        <li><a class="user-account" href="<?php echo base_url('user/market_credit_point_wrapper');?>">E - Market Credit <span>(<?php if(!empty($user_data['credit_points'])){ echo '$'.$user_data['credit_points'];}else{ echo '$0';} ?>)</span></a></li>
                                        <li><a class="user-account" href="<?php echo base_url('user/auto-re-order-wrapper');?>">Auto Re - Order</a></li>
                                        <li><a class="user-account" href="<?php echo base_url('user/wishlist-wrapper');?>">Wishlist</a></li>
                                        <?php if(isset($user_data)){ if($user_data['source']=='self'){ ?>
                                        <li><a id="change-password" class="user-account" href="<?php echo base_url('user/change-password-wrapper');?>">Change Password</a></li>
                                        <?php }}?>
                                        <li><a href="<?php echo base_url('user/logout');?>">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-9">
                        <div id="content-wrapper"></div>
                        
<!--                    <div class="account-wrapper" data-url="<?php echo base_url('user/profile-upload-wrapper');?>">
                        </div> -->
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
