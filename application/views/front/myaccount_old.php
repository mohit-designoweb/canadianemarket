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
                                        }else{  echo base_url('assets/img/userimg.png');}?>"  alt="userimg" class="img-responsive center-block"></a>
                                </div>
                                <div class="user_details boxs">
                                    <h4><?php if(isset($user_data)){echo ucwords($user_data['user_name']);}?></h4>
                                    <p><a href="mailto:<?php if(isset($user_data)){echo $user_data['email'];}?>" class="mail"><?php if(isset($login_user_detail)){echo $login_user_detail['email'];}?></a></p>
                                    <span id="spnFilePath"></span>
                                    <form id="imgForm" action="<?php echo base_url('site/doUploadProfileImage');?>" enctype="multipart/form-data">
                                    <input type="file" data-url="<?php echo base_url('site/doUploadProfileImage');?>" id="FileUpload1" name="FileUpload1" style="display: none" />
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
                                        <li><a href="<?php echo base_url('site/change_password');?>">Change Password</a></li>
                                        <?php }}?>
                                        <li><a href="<?php echo base_url('site/logout');?>">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <?php //print_r($formData);?>
                        <div class="ship_lft boxs myacc_ryt res_myaccpa">
                            <h3>Profile</h3>
                            <form method="post" action="<?php echo base_url('site/myAccountFormUpdate');?>" name="myAccountForm" id="myAccountForm">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="first_name">First name <sup>*</sup></label>
                                            <input type="text" name="first_name" class="form-control" id="first_name" value="<?php if(isset($user_data)){echo $user_data['user_name'];}?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="last_name">Last name <sup>*</sup></label>
                                            <input type="text" name="last_name" class="form-control" id="last_name" value="<?php if(isset($user_data)){echo $user_data['last_name'];}?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Email address <sup>*</sup></label>
                                            <input type="email" name="email" class="form-control" id="email" value="<?php if(isset($user_data)){echo $user_data['email'];}?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="mobile">Mobile Number <sup>*</sup></label>
                                            <input type="text" name="mobile" class="form-control" id="mobile" value="<?php if(isset($user_data)){echo $user_data['phone'];}?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="address1">Home address <sup>*</sup></label>
                                            <input type="text" name="address1" class="form-control" id="address1" placeholder="House number and street name" value="<?php if(isset($user_data)){echo $user_data['address1'];}?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="address2">Street address <sup>*</sup></label>
                                            <input type="text" name="address2" class="form-control" id="address2" placeholder="Apartment, suite, unit etc." value="<?php if(isset($user_data)){echo $user_data['address2'];}?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6" id="datetimepicker1">
                                        <div class="form-group" >
                                            <label for="dob">Date of Birth <sup>*</sup></label>
                                            <input type="text" name="dob" class="form-control" id="dob"  value="<?php if(isset($user_data)){echo $user_data['dob'];}?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">  
                                        <p><label for="gender">Gender <sup>*</sup></label></p>
                                        <div class="tick restick">
                                            <?php   if(isset($user_data)){ $gender = $user_data['gender'];}?>
                                            <input type="radio" name="gender" value="M" class="tick_input" id="tick1" <?php if(isset($gender)){ if($gender =='M'){?> checked <?php }}?>>
                                            <label for="tick1"><span></span>Male</label>
                                        </div>
                                        <div class="tick restick">
                                            <input type="radio" name="gender"  value="F" class="tick_input" id="tick2" <?php if(isset($gender)){ if($gender =='F'){?> checked<?php }}?>>
                                            <label for="tick2"><span></span>Female</label>
                                        </div>
                                       </div> 
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" class="slidehover savebtn2">SAVE</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
