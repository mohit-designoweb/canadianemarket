<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4>User</h4>
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
                                    Add User
                                </h5>
                            </div>
                            <div class="col-2 offset-7">
                                <a href="<?php echo base_url('admin/registered-user'); ?>" class="btn btn-primary">View User</a>
                            </div>
                        </div>
                    </div>
                    <p id="error-msg"></p>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" id="image-common-form" action="<?php
                        if (!empty($user_detail)) {
                            echo base_url('admin/doEditUser/' . $user_detail['user_id']);
                        } else {
                            echo base_url('admin/doAddUser');
                        }
                        ?>">
                             <?php if (!empty($user_detail['image_url'])) {
                                      ?>
                                <div class="row">
                                    <div class="col-3">
                                        <img src="<?php echo base_url('uploads/profile_images/' . $user_detail['image_url']); ?>" class="img-responsive">
                                    </div>
                                </div>

                            <?php }
                            ?>    
                            <div class="row">
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="image_url">Image</label>
                                        <?php echo form_upload(['name' => 'image_url', 'id' => 'image_url', 'class' => 'form-control']) ?>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <?php echo form_input(['name' => 'first_name', 'id' => 'first_name', 'class' => 'form-control', 'placeholder' => 'First Name'], isset($user_detail['user_name']) ? $user_detail['user_name'] : ''); ?>   
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <?php echo form_input(['name' => 'last_name', 'id' => 'last_name', 'class' => 'form-control', 'placeholder' => 'Last Name'], isset($user_detail['last_name']) ? $user_detail['last_name'] : ''); ?>   
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                               
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <?php echo form_input(['name' => 'email', 'id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email'], isset($user_detail['email']) ? $user_detail['email'] : ''); ?>   
                                    </div>
                                </div>
                               
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="phone_no">Phone Number</label>
                                        <?php echo form_input(['name' => 'phone_no', 'id' => 'phone_no', 'class' => 'form-control', 'placeholder' => 'phone_no'], isset($user_detail['phone']) ? $user_detail['phone'] : ''); ?>   
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="city">Date Of Birth</label>
                                        <?php echo form_input(['name' => 'dob', 'id' => 'dob', 'class' => 'form-control'], isset($user_detail['city']) ? $user_detail['city'] : ''); ?>   
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="address1">Street Address</label>
                                        <?php echo form_textarea(['name' => 'address1', 'rows' => '5', 'id' => 'address1', 'class' => 'form-control', 'placeholder' => 'Street Address 1', 'value' => isset($user_detail['address1']) ? $user_detail['address1'] : '']); ?>  
                                    </div> 
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="address2">Street Address Line 2</label>
                                        <?php echo form_textarea(['name' => 'address2', 'rows' => '5', 'id' => 'address2', 'class' => 'form-control', 'placeholder' => 'Street Address 1', 'value' => isset($user_detail['address2']) ? $user_detail['address2'] : '']); ?>  
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