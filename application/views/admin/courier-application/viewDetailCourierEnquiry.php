<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">

                    <h4>Partner Enquiry</h4>
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
<!--                                <h5 class="m-b-0" style="padding-top: 5px">
                                    Add Partner
                                </h5>-->
                            </div>
                            <div class="col-2 offset-7">
                                <a href="<?php echo base_url('admin/courier-application'); ?>" class="btn btn-primary">View Courier Query</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                     
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <?php echo form_input(['name' => 'first_name', 'id' => 'first_name', 'class' => 'form-control', 'placeholder' => 'First Name'], isset($couriers_enquiry['first_name']) ? $couriers_enquiry['first_name'] : ''); ?>   
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <?php echo form_input(['name' => 'last_name', 'id' => 'last_name', 'class' => 'form-control', 'placeholder' => 'Last Name'], isset($couriers_enquiry['last_name']) ? $couriers_enquiry['last_name'] : ''); ?>   
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <?php echo form_input(['name' => 'email', 'id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email'], isset($couriers_enquiry['email']) ? $couriers_enquiry['email'] : ''); ?>   
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="phone_no">Phone Number</label>
                                        <?php echo form_input(['name' => 'phone_no', 'id' => 'phone_no', 'class' => 'form-control', 'placeholder' => 'phone_no'], isset($couriers_enquiry['phone_no']) ? $couriers_enquiry['phone_no'] : ''); ?>   
                                    </div>
                                </div>
<!--                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="store_name">Store Name</label>
                                        <?php
                                        if (!empty($couriers_enquiry['store_name'])) {
                                            echo form_input(['name' => 'store_name', 'id' => 'store_name', 'readonly' => 'readonly', 'class' => 'form-control', 'placeholder' => 'Store Name'], isset($couriers_enquiry['store_name']) ? $couriers_enquiry['store_name'] : '');
                                        } else {
                                            echo form_input(['name' => 'store_name', 'id' => 'store_name', 'class' => 'form-control', 'placeholder' => 'Store Name'], isset($couriers_enquiry['store_name']) ? $couriers_enquiry['store_name'] : '');
                                        }
                                        ?>
                                    </div>
                                </div>-->
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'form-control'], isset($couriers_enquiry['city']) ? $couriers_enquiry['city'] : ''); ?>   
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="image_url">State</label>
                                        <?php echo form_input(['name' => 'state', 'id' => 'state', 'class' => 'form-control'], isset($couriers_enquiry['state']) ? $couriers_enquiry['state'] : ''); ?>   
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="zipcode">Zip code</label>
                                        <?php echo form_input(['name' => 'zipcode', 'id' => 'zipcode', 'class' => 'form-control'], isset($couriers_enquiry['zipcode']) ? $couriers_enquiry['zipcode'] : ''); ?>   
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <?php echo form_input(['name' => 'country', 'id' => 'country', 'class' => 'form-control'], isset($couriers_enquiry['country']) ? $couriers_enquiry['country'] : ''); ?>   
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="store_address1">Store Address</label>
                                        <?php echo form_textarea(['name' => 'address1', 'rows' => '5', 'id' => 'address1', 'class' => 'form-control', 'placeholder' => 'Store Name', 'value' => isset($couriers_enquiry['address1']) ? $couriers_enquiry['address1'] : '']); ?>  
                                    </div> 
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="store_address2">Address Line 2</label>
                                        <?php echo form_textarea(['name' => 'address2', 'rows' => '5', 'id' => 'address2', 'class' => 'form-control', 'placeholder' => 'Store Name', 'value' => isset($couriers_enquiry['address2']) ? $couriers_enquiry['address2'] : '']); ?>  
                                    </div> 
                                </div>
                            </div>
<!--                            <div class="row">
                                <div class="col-2 offset-10">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>-->

                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</main>