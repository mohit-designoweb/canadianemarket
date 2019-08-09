<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">

                    <h4>Restaurant</h4>
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
                                <h5 class="m-b-0" style="padding-top: 5px"><?php
                                    if (!empty($restaurant['restaurant_id'])) {
                                        echo 'Edit';
                                    } else {
                                        echo 'Add';
                                    }
                                    ?> Restaurant</h5>
                            </div>
                            <div class="col-2 offset-7">
                                <a href="<?php echo base_url('admin/adminRestaurant'); ?>" class="btn btn-primary">View Restaurant</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" id="image-common-form" action="<?php
                        if (!empty($restaurant)) {
                            echo base_url('admin/doEditRestaurant/' . $restaurant['restaurant_id']);
                        } else {
                            echo base_url('admin/doAddRestaurant');
                        }
                        ?>">
                                  <?php if (!empty($restaurant['image_url'])) {
                                      ?>
                                <div class="row">
                                    <div class="col-3">
                                        <img src="<?php echo base_url('uploads/restaurant/' . $restaurant['image_url']); ?>" class="img-responsive">
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="restaurant_category_id">Category <i style="color:red;">*</i></label>
                                        <?php echo form_dropdown(['name' => 'restaurant_category_id', 'id' => 'restaurant_category_id', 'class' => 'form-control'], $category, isset($restaurant['restaurant_category_id']) ? $restaurant['restaurant_category_id'] : ''); ?>   
                                    </div>    
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="partner_id">Partner <i style="color:red;">*</i></label>
                                        <?php
                                        echo form_dropdown(['name' => 'partner_id', 'id' => 'partner_id', 'class' => 'form-control'], $partners, isset($restaurant['partner_id']) ? $restaurant['partner_id'] : '');
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="store_name">Restaurant Name <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'restaurant_name', 'id' => 'restaurant_name', 'class' => 'form-control'], isset($restaurant['restaurant_name']) ? $restaurant['restaurant_name'] : ''); ?>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="country">Country <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'country', 'id' => 'country', 'class' => 'form-control'], isset($restaurant['country']) ? $restaurant['country'] : ''); ?>   
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="state">State <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'state', 'id' => 'state', 'class' => 'form-control'], isset($restaurant['state']) ? $restaurant['state'] : ''); ?>   
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="description">Description <i style="color:red;">*</i></label>
                                        <?php echo form_textarea(['name' => 'description', 'id' => 'description', 'rows' => '5', 'class' => 'form-control'], isset($restaurant['description']) ? $restaurant['description'] : '') ?>   
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="city">City <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'form-control'], isset($restaurant['city']) ? $restaurant['city'] : ''); ?>   
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="about">About <i style="color:red;">*</i></label>
                                        <?php echo form_textarea(['name' => 'about', 'id' => 'about', 'rows' => '5', 'class' => 'form-control'], isset($restaurant['about']) ? $restaurant['about'] : '') ?>   
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Address <i style="color:red;">*</i></label>
                                        <?php echo form_textarea(['name' => 'address', 'id' => 'address', 'rows' => '5', 'class' => 'form-control'], isset($restaurant['address']) ? $restaurant['address'] : '') ?>   
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="service_fee">Service Fee <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'service_fee', 'id' => 'service_fee',  'class' => 'form-control'], isset($restaurant['service_fee']) ? $restaurant['service_fee'] : '') ?>   
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="speciality">Speciality <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'speciality', 'id' => 'speciality',  'class' => 'form-control'], isset($restaurant['speciality']) ? $restaurant['speciality'] : '') ?>   
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="delivery_charge">Delivery Charge <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'delivery_charge', 'id' => 'delivery_charge', 'class' => 'form-control'], isset($restaurant['delivery_charge']) ? $restaurant['delivery_charge'] : ''); ?>   
                                    </div>
                                </div>
								<?php 
                                $estimate_time = array(
                                'Select Time'         => 'Select Time',
                                '30 - 40 minute'           => '30 - 40 minute',
                                '40 - 50 minute'         => '40 - 50 minute',
                                '50 - 60 minute'        => '50 - 60 minute',
                                  );                                  
                                ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="estimated_deliver_time">Estimated Delivery Time <i style="color:red;">*</i></label>
                                        <?php echo form_dropdown(['name' => 'estimated_deliver_time', 'id' =>'estimated_deliver_time','class'=>'form-control'], $estimate_time, isset($restaurant['estimated_deliver_time'])? $restaurant['estimated_deliver_time']:''); ?>
                                         
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="opening_time_from">Opening time <i style="color:red;">*</i></label>
                                        <?php echo form_input(['type' => 'time', 'name' => 'opening_time_from', 'id' => 'opening_time_from', 'class' => 'timepicker form-control'], isset($restaurant['opening_time_from']) ? $restaurant['opening_time_from'] : '') ?>   
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="opening_time_to">Closing Time <i style="color:red;">*</i></label>
                                        <?php echo form_input(['type' => 'time', 'name' => 'opening_time_to', 'id' => 'opening_time_to', 'class' => 'timepicker form-control'], isset($restaurant['opening_time_to']) ? $restaurant['opening_time_to'] : ''); ?>   
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                         <label for="latitude">Latitude</label>
                                        <?php echo form_input(['type'=>'text', 'name' => 'latitude', 'id' => 'latitude', 'class' => 'form-control'], isset($restaurant['latitude']) ? $restaurant['latitude'] : '') ?>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="longitude">Longitude</label>
                                        <?php echo form_input(['type'=>'text', 'name' => 'longitude', 'id' => 'longitude', 'class' => 'form-control'], isset($restaurant['longitude']) ? $restaurant['longitude'] : '') ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group" id="map">

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-2 offset-10">
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->

                </div>
            </div>
        </div>
    </div>
</div>
</section>

</main>