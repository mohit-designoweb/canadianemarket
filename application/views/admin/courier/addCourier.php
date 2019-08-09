<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">

                    <h4>Courier</h4>
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
								<?php if (!empty($courier)) {
                                echo 'Edit';
                            } else {
                                echo 'Add';
                            } ?>
                                     Courier
                                </h5>
                            </div>
                            <div class="col-2 offset-7">
                                <a href="<?php echo base_url('admin/courierSection'); ?>" class="btn btn-primary">View Courier</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" id="image-common-form" action="<?php
                        if (!empty($courier)) {
                            echo base_url('admin/doEditCourier/' . $courier['courier_id']);
                        } else {
                            echo base_url('admin/doAddCourier');
                        }
                        ?>">
                                  <?php if (!empty($courier['image_url'])) {
                                      ?>
                            <div class="row">
                                <div class="col-3">
                                    <img src="<?php echo base_url('uploads/courier/' . $courier['image_url']); ?>" class="img-responsive">
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
                                        <?php echo form_input(['name' => 'first_name', 'id' => 'first_name', 'class' => 'form-control', 'placeholder' => 'First Name'], isset($courier['first_name']) ? $courier['first_name'] : ''); ?>   
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="last_name">Last Name <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'last_name', 'id' => 'last_name', 'class' => 'form-control', 'placeholder' => 'Last Name'], isset($courier['last_name']) ? $courier['last_name'] : ''); ?>   
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="email">Email <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'email', 'id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email'], isset($courier['email']) ? $courier['email'] : ''); ?>   
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="phone_no">Phone Number <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'phone_no', 'id' => 'phone_no', 'class' => 'form-control', 'placeholder' => 'Phone Number'], isset($courier['phone']) ? $courier['phone'] : ''); ?>   
                                    </div>
                                </div>
								<?php if(empty($courier['password'])){?>
								<div class="col-4">
                                    <div class="form-group">
                                        <label for="phone_no">Password <i style="color:red;">*</i></label>
                                        <?php echo form_input(['type'=>'password','name' => 'password', 'id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password'], isset($courier['password']) ? $courier['password'] . 'readonly' : ''); ?>   
                                    </div>
                                </div>
								<?php }?>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="city">City <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'form-control','placeholder'=>'City'], isset($courier['city']) ? $courier['city'] : ''); ?>   
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="image_url">State <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'state', 'id' => 'state', 'class' => 'form-control', 'Placeholder'=>'State'], isset($courier['state']) ? $courier['state'] : ''); ?>   
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="zipcode">Zip code <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'zipcode', 'id' => 'zipcode', 'class' => 'form-control', 'placeholder'=>'Zip Code'], isset($courier['zipcode']) ? $courier['zipcode'] : ''); ?>   
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="country">Country <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'country', 'id' => 'country', 'class' => 'form-control', 'Placeholder'=>'Country'], isset($courier['country']) ? $courier['country'] : ''); ?>   
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="store_address1">Address <i style="color:red;">*</i></label>
                                        <?php echo form_textarea(['name' => 'store_address1', 'rows' => '5', 'id' => 'store_address1', 'class' => 'form-control', 'placeholder' => 'Addresss1', 'value' => isset($courier['address1']) ? $courier['address1'] : '']); ?>  
                                    </div> 
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="store_address2">Address Line 2</label>
                                        <?php echo form_textarea(['name' => 'store_address2', 'rows' => '5', 'id' => 'store_address2', 'class' => 'form-control', 'placeholder' => 'Address2', 'value' => isset($courier['address2']) ? $courier['address2'] : '']); ?>  
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