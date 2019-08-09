

<!--site header ends -->    
<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4 class="">Update Profile</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container  pull-up">
        <div class="row">
            <div class="col-lg-12">

                <!--widget card begin-->
                <div class="card m-b-30">
                    <p id="error_msg"></p>
                    <form method="post" action="<?php echo base_url('courier/doUpdateProfile'); ?>" id="image-common-form" enctype="multipart/form-data">
                        <div class="card-body">
                            <?php if(!empty($user['image_url'])){
                            ?>
                            <div class="form-row">
                                <div class="col-6">
                                    <img src=" <?php echo base_url('uploads/profile_images/'.$user['image_url']); ?>" height="160px" width="160px" class="img-circle" />
                                </div>
                            </div>
                            <?php
                            } else{?>
							<div class="form-row">
                                <div class="col-6">
                                    <img src=" <?php echo base_url('assets/img/userimg.png'); ?>" height="160px" width="160px" class="img-circle" />
                                </div>
                            </div>
							<?php }?>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="image_url">Upload Image</label>
                                    <input type="file" id="image_url" name="image_url" class="form-control" />

                                </div> 
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" value="<?php
                                    if (isset($user)) {
                                        echo $user['first_name'];
                                    }
                                    ?>" id="first_name" name="first_name" placeholder="First Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control"  value="<?php
                                    if (isset($user)) {
                                        echo $user['last_name'];
                                    }
                                    ?>" id="last_name" name="last_name" placeholder="Last Name">
                                </div>
                            </div> 

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="address1" class="control-label">Store Address</label>
                                    <input type="text" name="address1" id="address1" class="form-control" placeholder="Store Address" value="<?php
                                    if (!empty($user)) {
                                        echo $user['address1'];
                                    }
                                    ?>">

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="address2" class="control-label">Address Line 2</label>
                                    <input type="text" name="address2" id="address2" class="form-control" placeholder="Street Name" value="<?php
                                    if (!empty($user)) {
                                        echo $user['address2'];
                                    }
                                    ?>">

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="city" class="col-sm-2 control-label">City</label>

                                    <input type="text" name="city" id="city" class="form-control" placeholder="Last Name" value="<?php
                                    if (!empty($user)) {
                                        echo $user['city'];
                                    }
                                    ?>">

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="state" class="col-sm-2 control-label">State</label>

                                    <input type="text" name="state" id="state" class="form-control" placeholder="Last Name" value="<?php
                                    if (!empty($user)) {
                                        echo $user['state'];
                                    }
                                    ?>">

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="zipcode" class="col-sm-2 control-label">Postal</label>

                                    <input type="text" name="zipcode" id="zipcode" class="form-control" placeholder="Last Name" value="<?php
                                    if (!empty($user)) {
                                        echo $user['zipcode'];
                                    }
                                    ?>">

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="country" class="col-sm-2 control-label">Country</label>

                                    <select name="country_code" id="country_code" class="form-control">
                                        <option>----SELECT-----</option>
                                        <?php foreach ($country_code as $country) { ?>
                                            <option value="<?php echo $country['phonecode'] . ',' . $country['name']; ?>" <?php if ($user['country'] == $country['name']) { ?> selected="selected"<?php } ?>>
                                                <?php echo $country['name']; ?>  (<?php echo '+' . $country['phonecode']; ?>)
                                            </option>
                                        <?php } ?>
                                    </select>

                                </div>    

                            </div>
                            <hr>
                            <b><p>Fill Other Details</p></b>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="bank_name" class="col-sm-4 control-label">Bank Name</label>

                                    <input type="text" name="bank_name" id="bank_name" class="form-control" placeholder="Bank Name" value="<?php
                                    if (!empty($user)) {
                                        echo $user['bank_name'];
                                    }
                                    ?>">

                                </div>
                                <div class="form-group col-md-4">
                                    <label for="bank_ifsc_code" class="col-sm-4 control-label">IFSC Code</label>

                                    <input type="text" name="bank_ifsc_code" id="bank_ifsc_code" class="form-control" placeholder="IFSC Code" value="<?php
                                    if (!empty($user)) {
                                        echo $user['bank_ifsc_code'];
                                    }
                                    ?>">

                                </div>
                                <div class="form-group col-md-4">
                                    <label for="bank_account_number" class="col-sm-4 control-label">Account No.</label>

                                    <input type="text" name="bank_account_number" id="bank_account_number" class="form-control" placeholder="Account No." value="<?php
                                    if (!empty($user)) {
                                        echo $user['bank_account_number'];
                                    }
                                    ?>">

                                </div>
                            </div>
                             <?php if(!empty($user['driving_licence_image'])){
                            ?>
                            <div class="form-row">
                                <div class="col-6">
                                    <img src=" <?php echo base_url('uploads/courier_driving_licence/'.$user['driving_licence_image']); ?>" height="160px" width="160px" class="img-circle" />
                                </div>
                            </div>
                            <?php
                            } ?>
                           
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="image_url">Upload Driving Licence Image</label>
                                    <input type="file" id="dl_image_url" name="dl_image_url" class="form-control" />

                                </div> 
                            </div>
                            
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!--widget card ends-->


            </div>

        </div>


    </div
</section>

</main>



