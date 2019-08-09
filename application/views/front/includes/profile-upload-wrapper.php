                        <div class="ship_lft boxs myacc_ryt accupload">
                            <h3>Change Profile Photo</h3>
                            <p>Our profile photo will be used on your profile and throughout the site. If there is a Gravatar associated with your account email we will use that, or you can upload an image from your computer.</p>

                            <div class="dropBox boxs">
                                <div class="preview dropimgbox">
                                    <img src="<?php if(isset($user_data['image_url'])){
                                            echo base_url('uploads/profile_images/'.$user_data['image_url']);
                                        }else{  echo base_url('assets/img/userimg.png');}?>" id="imgPrime" class="img-responsive" alt="user_image">
                                </div>
                            </div>
                            <div class="drop_Box boxs">
                                <form id="imgForm" enctype="multipart/form-data">
                                <div id="userActions">
                                    
                                    <span class="dragBox">
                                        <p>Drop your file here <span>or</span></p>
                                        <input type="file" id="uploadFile" name="image_url" data-url="<?php echo base_url('user/doUploadProfileImage'); ?>"  />
                                    </span>
                                    <div class="box_drop boxs">
                                        <!--<input type="file" id="FileUpload1" name="FileUpload1" style="display: none" />-->
                                        <label for="uploadFile" class="slidehover">Select your photo</label>
                                        <button type="button" class="take_btn" onClick="setup();">Take a photo</button>
                                        <!--<input type="button" value="Take Snapshot" onClick="take_snapshot()" style="display:none">-->
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>