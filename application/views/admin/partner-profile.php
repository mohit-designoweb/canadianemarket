

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
                    <form method="post" action="<?php echo base_url('partner/doUpdateProfile'); ?>" id="image-common-form" enctype="multipart/form-data">
                        <div class="card-body">
                            <?php if(!empty($user['image_url'])){
                            ?>
                            <div class="form-row">
                                <div class="col-6">
                                    <img src=" <?php echo base_url('uploads/profile_images/'.$user['image_url']); ?>" height="160px" width="160px" class="img-circle" />
                                </div>
                            </div>
                            <?php
                            } ?>
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
                                    ?>" id="first_name" name="first_name" placeholder="first_name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control"  value="<?php
                                    if (isset($user)) {
                                        echo $user['last_name'];
                                    }
                                    ?>" id="last_name" name="last_name">
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

                   <!--<input type="text" name="country" id="country" class="form-control" placeholder="Last Name" value="<?php
                                    if (!empty($user)) {
                                        echo $user['country'];
                                    }
                                    ?>">-->
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



