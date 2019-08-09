<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">

                    <h4>Partner</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container pull-up">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div id="error_msg"></div>
                    <div class="card-header">
                        <div class="row">
                            <div class="col-3">
                                <h5 class="m-b-0" style="padding-top: 5px">
								<?php
                                    if (!empty($partner)) {
                                        echo 'Edit';
                                    } else {
                                        echo 'Add';
                                    }
                                    ?>
                                     Partner
                                </h5></br>
                                <form action="<?php echo base_url('admin/partnerSection/uploadData'); ?>" method="post" enctype="multipart/form-data" id="image-common-form1"> 
                                    <div class="form-group">
                                        <label for="image_url">Select Csv File</label>
                                        <input type="file" class="form-control" name="userfile" id="userfile" />
                                    </div>

                                    <div class="col-lg-offset-3 col-lg-9">
                                        <button type="submit" name="submit" class="btn btn-primary">Upload</button>
                                    </div>

                                </form>
                                <a href="<?php echo base_url('uploads/uploadPartnerCsv/upload-partner-demo.csv'); ?>" download="sample_partner.csv" >Download sample</a>
                            </div>
                            <div class="col-2 offset-7">
                                <a href="<?php echo base_url('admin/partnerSection'); ?>" class="btn btn-primary">View Partner</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" id="image-common-form" action="<?php
                        if (!empty($partner)) {
                            echo base_url('admin/doEditPartner/' . $partner['partner_id']);
                        } else {
                            echo base_url('admin/doAddPartner');
                        }
                        ?>">
                                  <?php if (!empty($partner['image_url'])) {
                                      ?>
                                <div class="row">
                                    <div class="col-3">
                                        <img src="<?php echo base_url('uploads/partner/' . $partner['image_url']); ?>" class="img-responsive" height="120px" width="150px">
                                    </div>
                                </div>

                            <?php }
                            ?>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="image_url">Image</label>
                                        <?php echo form_upload(['name' => 'image_url', 'id' => 'image_url', 'class' => 'form-control']); ?>   
                                    </div>

                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first_name">First Name <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'first_name', 'id' => 'first_name', 'class' => 'form-control', 'placeholder' => 'First Name'], isset($partner['first_name']) ? $partner['first_name'] : ''); ?>   
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="last_name">Last Name <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'last_name', 'id' => 'last_name', 'class' => 'form-control', 'placeholder' => 'Last Name'], isset($partner['last_name']) ? $partner['last_name'] : ''); ?>   
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="email">Email <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'email', 'id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email'], isset($partner['email']) ? $partner['email'] : ''); ?>   
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="phone_no">Phone Number <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'phone_no', 'id' => 'phone_no', 'class' => 'form-control', 'placeholder' => 'Phone'], isset($partner['phone_no']) ? $partner['phone_no'] : ''); ?>   
                                    </div>
                                </div>
								<?php if(empty($partner['password'])){?>
                                 <div class="col-4">
                                    <div class="form-group">
                                        <label for="password">Password <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'password', 'type' => 'password', 'id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password'], isset($partner['password']) ? $partner['password'] . 'readonly' : ''); ?>   
                                    </div>
                                </div>
								<?php }?>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="city">City <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'form-control','placeholder' =>'CIty'], isset($partner['city']) ? $partner['city'] : ''); ?>   
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="image_url">State <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'state', 'id' => 'state', 'class' => 'form-control','placeholder' => 'State'], isset($partner['state']) ? $partner['state'] : ''); ?>   
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="zipcode">Zip code <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'zipcode', 'id' => 'zipcode', 'class' => 'form-control','placeholder' =>'Zip Code'], isset($partner['zipcode']) ? $partner['zipcode'] : ''); ?>   
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="country">Country <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'country', 'id' => 'country', 'class' => 'form-control','placeholder' =>'Country'], isset($partner['country']) ? $partner['country'] : ''); ?>   
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="store_address1">Store Address <i style="color:red;">*</i></label>
                                        <?php echo form_textarea(['name' => 'store_address1', 'rows' => '5', 'id' => 'store_address1', 'class' => 'form-control', 'placeholder' => 'Store Name', 'value' => isset($partner['address1']) ? $partner['address1'] : '']); ?>  
                                    </div> 
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="store_address2">Address Line 2 <i style="color:red;">*</i></label>
                                        <?php echo form_textarea(['name' => 'store_address2', 'rows' => '5', 'id' => 'store_address2', 'class' => 'form-control', 'placeholder' => 'Store Name', 'value' => isset($partner['address2']) ? $partner['address2'] : '']); ?>  
                                    </div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2 offset-10">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</main>