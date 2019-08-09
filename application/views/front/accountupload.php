<section class="myaccount topScrl">
        <div class="container">
            <div class="ship_inner boxs">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="myacc_lft">
                            <div class="acc_details boxs">
                                <div class="userimg boxs">
                                    <a href="javascript:void(0)"><img src="<?php echo base_url('assets');?>/img/userimg1.png" alt="userimg" class="img-responsive center-block"></a>
                                </div>
                                <div class="user_details boxs">
                                    <h4>Angelina</h4>
                                    <p><a href="mailto:angelinajoseph234@gmail.com" class="mail">angelinajoseph234@gmail.com</a></p>
                                    <p><a href="javascript:void(0)" class="editimg">Edit Photo<img src="<?php echo base_url('assets');?>/img/editbtn.png" alt="editbtn" class="img-responsive"></a></p>
                                </div>
                            </div>

                            <div class="userprofile boxs">
                                <h5>Account</h5>
                                <div class="profiledetails boxs">
                                    <ul>
                                        <li><a href="javascript:void(0)" class="active">Orders History</a>
                                            <!-- <a href="javascript:void(0)" class="his">Invite a friend</a> -->
                                        </li>
                                        <li><a href="javascript:void(0)">Invite a friend</a></li>
                                        <li><a href="javascript:void(0)">E - Market Credit <span>($28)</span></a></li>
                                        <li><a href="javascript:void(0)">Auto Re - Order</a></li>
                                        <li><a href="javascript:void(0)">Change Password</a></li>
                                        <li><a href="javascript:void(0)">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="ship_lft boxs myacc_ryt accupload">
                            <h3>Change Profile Photo</h3>
                            <p>Our profile photo will be used on your profile and throughout the site. If there is a Gravatar associated with your account email we will use that, or you can upload an image from your computer.</p>

                            <div class="dropBox boxs">
                                <div class="preview dropimgbox">
                                    <img src="<?php echo base_url('assets');?>/img/uplimg.png" id="imgPrime" class="img-responsive" alt="user_image">
                                </div>
                            </div>
                            <div class="drop_Box boxs">
                                <div id="userActions">
                                    <span class="dragBox">
                                        <p>Drop your file here <span>or</span></p>
                                        <input type="file" id="uploadFile" onChange="dragNdrop(event)" ondragover="drag()" ondrop="drop()" />
                                    </span>
                                    <div class="box_drop boxs">
                                        <label for="uploadFile" class="slidehover">Select your photo</label>
                                        <button type="button" class="take_btn">Take a photo</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>