<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#restaurantInfo" class="active show">Restaurant Info</a></li>
    <li><a data-toggle="tab" href="#restaurantAddress">Address</a></li>
    <li><a data-toggle="tab" href="#restaurantOperation">Restaurant Operations</a></li>
    <li><a data-toggle="tab" href="#deliveryAndTax">Delivery & Tax</a></li>
    <li><a data-toggle="tab" href="#bankPayment">Bank details & payments</a></li>
</ul>

<div class="tab-content">
    <div id="restaurantInfo" class="tab-pane fade in active show">
        <div class="card-header">
            <div class="row">
                <div class="col-2 offset-11">
                    <a href="<?php echo base_url('admin/adminRestaurant'); ?>" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" id="restaurant-wrapper-image-form" action="<?php
            if (!empty($restaurant)) {
                echo base_url('admin/AdminRestaurant/doEditRestaurantInfo/' . $restaurant['restaurant_id']);
            }
            ?>">
                <?php if (!empty($restaurant['image_url'])) {  ?>
                    <div class="row">
                        <div class="col-3">
                            <img src="<?php echo base_url('uploads/restaurant/' . $restaurant['image_url']); ?>" class="img-responsive">
                        </div>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image_url">Image</label>
                            <?php echo form_upload(['name' => 'image_url', 'id' => 'image_url', 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="restaurant_category_id">Category</label>
                            <?php echo form_dropdown(['name' => 'restaurant_category_id', 'id' => 'restaurant_category_id', 'class' => 'form-control'], $category, isset($restaurant['restaurant_category_id']) ? $restaurant['restaurant_category_id'] : ''); ?>   
                        </div>    
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="partner_id">Partner</label>
                            <?php
                            echo form_dropdown(['name' => 'partner_id', 'id' => 'partner_id', 'class' => 'form-control'], $partners, isset($restaurant['partner_id']) ? $restaurant['partner_id'] : '');
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="store_name">Restaurant Name</label>
                            <?php echo form_input(['name' => 'restaurant_name', 'id' => 'restaurant_name', 'class' => 'form-control'], isset($restaurant['restaurant_name']) ? $restaurant['restaurant_name'] : ''); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="speciality">Speciality</label>
                            <?php echo form_input(['name' => 'speciality', 'id' => 'speciality', 'class' => 'form-control'], isset($restaurant['speciality']) ? $restaurant['speciality'] : '') ?>   
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <?php echo form_textarea(['name' => 'description', 'id' => 'description', 'rows' => '5', 'class' => 'form-control'], isset($restaurant['description']) ? $restaurant['description'] : '') ?>   
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="return_policy">Return Policy</label>
                            <?php echo form_textarea(['name' => 'return_policy', 'id' => 'return_policy', 'rows' => '5', 'class' => 'form-control'], isset($restaurant['return_policy']) ? $restaurant['return_policy'] : '') ?>   
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-2">
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div id="restaurantAddress" class="tab-pane fade in">
        <div class="card-header">
            <div class="row">
                <div class="col-2 offset-11">
                    <a href="<?php echo base_url('admin/adminRestaurant'); ?>" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" id="restaurant-wrapper-common-form" action="<?php
            if (!empty($restaurant)) {
                echo base_url('admin/AdminRestaurant/doEditRestaurantAddress/' . $restaurant['restaurant_id']);
            }
            ?>">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <?php echo form_textarea(['name' => 'address', 'id' => 'address', 'rows' => '5', 'class' => 'form-control'], isset($restaurant['address']) ? $restaurant['address'] : '') ?>   
                        </div>
                    </div>
                </div>   
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="country">Country</label>
                            <?php echo form_input(['name' => 'country', 'id' => 'country', 'class' => 'form-control'], isset($restaurant['country']) ? $restaurant['country'] : ''); ?>   
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="state">State</label>
                            <?php echo form_input(['name' => 'state', 'id' => 'state', 'class' => 'form-control'], isset($restaurant['state']) ? $restaurant['state'] : ''); ?>   
                        </div>
                    </div>    
                </div>
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="city">City</label>
                            <?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'form-control'], isset($restaurant['city']) ? $restaurant['city'] : ''); ?>   
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="latitude">Latitude</label>
                            <?php echo form_input(['type' => 'text', 'name' => 'latitude', 'id' => 'latitude', 'class' => 'form-control'], isset($restaurant['latitude']) ? $restaurant['latitude'] : '') ?>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="longitude">Longitude</label>
                            <?php echo form_input(['type' => 'text', 'name' => 'longitude', 'id' => 'longitude', 'class' => 'form-control'], isset($restaurant['longitude']) ? $restaurant['longitude'] : '') ?>
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
                    <div class="col-2">
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div id="restaurantOperation" class="tab-pane fade in">
        <div class="card-header">
            <div class="row">
                <div class="col-2 offset-11">
                    <a href="<?php echo base_url('admin/adminRestaurant');?>" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" id="restaurant-wrapper-common-form" action="<?php
            if (!empty($restaurant)) {
                echo base_url('admin/AdminRestaurant/doEditRestaurantOperation/' . $restaurant['restaurant_id']);
            }
            ?>">
                <div class="row">
                    <div class="col-md-4">
                        <label for="status">Status</label>
                        <div class="form-group onOffbtn">
                            <button name="off">Close</button>
                            <label class="switch">
                                <input type="checkbox" id="option-dismiss" <?php echo $restaurant['is_open']=='Enable' ? 'Checked': ''; ?> name="option" value="<?php if( $restaurant['is_open'] == 'Enable'){ echo base_url('admin/changeAdminRestaurantStatusOpenOrClose/' . $restaurant['restaurant_id'] . '/Disable'); } else { echo base_url('admin/changeAdminRestaurantStatusOpenOrClose/' . $restaurant['restaurant_id'] . '/Enable'); }?>" class="cstm-switch-input">
                                <span class="slider round"></span>
                            </label>
                            <button name="on">Open</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="restataurant_status">Action</label>
                        <div class="form-group">
                            <?php if ($restaurant['is_active'] == 'Active') { ?>
                                <a href="<?php echo base_url('admin/changeAdminRestaurantStatus/' . $restaurant['restaurant_id'] . '/Inactive'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-success change-status">Active <i class="fe fe-thumbs-up"></i></a>
                            <?php } else { ?>
                                <a href="<?php echo base_url('admin/changeAdminRestaurantStatus/' . $restaurant['restaurant_id'] . '/Active'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-success change-status">Inactive <i class="fe fe-thumbs-down"></i></a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="estimated_delivery_time">Order Fulfilment Time</label>
                            <?php
                            echo form_dropdown(['name' => 'estimated_delivery_time', 'id' => 'estimated_delivery_time', 'class' => 'form-control'], $fulfilment, isset($restaurant['delivery_time']) ? $restaurant['delivery_time'] : '');
                            ?> 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="opening_time_from">Opening time</label>
                            <?php echo form_input(['type' => 'time', 'name' => 'opening_time_from', 'id' => 'opening_time_from', 'class' => 'timepicker form-control'], isset($restaurant['opening_time_from']) ? $restaurant['opening_time_from'] : '') ?>   
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="opening_time_to">Closing Time</label>
                            <?php echo form_input(['type' => 'time', 'name' => 'opening_time_to', 'id' => 'opening_time_to', 'class' => 'timepicker form-control'], isset($restaurant['opening_time_to']) ? $restaurant['opening_time_to'] : ''); ?>   
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-2">
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div id="deliveryAndTax" class="tab-pane fade in">
        <div class="card-header">
            <div class="row">
                <div class="col-2 offset-11">
                    <a href="<?php echo base_url('admin/adminRestaurant');?>" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" id="restaurant-wrapper-common-form" action="<?php
            if (!empty($restaurant)) {
                echo base_url('admin/AdminRestaurant/doEditRestaurantTaxDelivery/' . $restaurant['restaurant_id']);
            } 
            ?>">
               
                <div class="row">
                    <div class="col-md-4">
                        <label for="status">Delivery Service Charge</label>
                        <div class="form-group onOffbtn">
                            <button name="off">OFF </button>
                            <label class="switch">
                                <input type="checkbox" id="option-dismiss" <?php if($restaurant['restaurant_delivery_charge'] == 'ON'){ echo "Checked"; }else{ echo "" ; } ?> name="option" value="<?php if($restaurant['restaurant_delivery_charge'] == 'ON'){ echo base_url('admin/changeAdminRestaurantDeliveryChargeOnOrOff/' . $restaurant['restaurant_id'] . '/OFF');}else{ echo base_url('admin/changeAdminRestaurantDeliveryChargeOnOrOff/' . $restaurant['restaurant_id'] . '/ON');} ?>" class="cstm-switch-input">
                                <span class="slider round"></span>
                            </label>
                            <button name="on">ON</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="status">Delivery Service Type</label>
                        <div class="form-group onOffbtn">
                            <button name="default">Default</button>
                            <label class="switch">
                                <input type="checkbox" id="option-dismiss" <?php if($restaurant['apply_delivery_charge'] == 'Custom'){ echo "Checked"; }else{ echo "" ; } ?> name="option" value="<?php if($restaurant['apply_delivery_charge'] == 'Custom'){ echo base_url('admin/changeAdminRestaurantDeliveryChargeType/' . $restaurant['restaurant_id'] . '/Default');}else{ echo base_url('admin/changeAdminRestaurantDeliveryChargeType/' . $restaurant['restaurant_id'] . '/Custom');} ?>" class="cstm-switch-input">
                                <span class="slider round"></span>
                            </label>
                            <button name="custom">Custom</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="custom_charge">Custome</label>
                            <?php
                            echo form_input(['name' => 'custom_charge', 'id' => 'custom_charge', 'class' => 'form-control'], isset($restaurant['delivery_charge']) ? $restaurant['delivery_charge'] : '');
                            ?>
                        </div>
                    </div>
                </div>
                
              
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="driver_instuction">Delivery Driver Instruction</label>
                            <?php echo form_textarea(['name' => 'driver_instuction', 'id' => 'driver_instuction', 'rows' => '5', 'class' => 'form-control'], isset($restaurant['driver_instuction']) ? $restaurant['driver_instuction'] : '') ?>   
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="service_fee">Service Fee</label>
                            <?php echo form_input(['name' => 'service_fee', 'id' => 'service_fee', 'class' => 'form-control'], isset($restaurant['service_fee']) ? $restaurant['service_fee'] : '') ?>   
                        </div>

                        <div class="form-group">
                            <label for="tax_province">Tax Province</label>
                            <?php
                            echo form_dropdown(['name' => 'tax_province', 'id' => 'tax_province', 'class' => 'form-control'], $taxProvince, isset($restaurant['tax_province']) ? $restaurant['tax_province'] : '');
                            ?> 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div id="bankPayment" class="tab-pane fade in">
        <div class="card-header">
            <div class="row">
                <div class="col-2 offset-11">
                  <a href="<?php echo base_url('admin/adminRestaurant'); ?>" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" id="restaurant-wrapper-common-form" action="<?php
            if (!empty($restaurant)) {
                echo base_url('admin/AdminRestaurant/doEditRestaurantBank/' . $restaurant['restaurant_id']);
            }
            ?>">
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="holder_name">Holder Name</label>
                            <?php echo form_input(['name' => 'holder_name', 'id' => 'holder_name', 'class' => 'form-control'], isset($restaurant['account_holder']) ? $restaurant['account_holder'] : ''); ?>   
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="account_number">Account Number</label>
                            <?php echo form_input(['name' => 'account_number', 'id' => 'account_number', 'class' => 'form-control'], isset($restaurant['account_number']) ? $restaurant['account_number'] : ''); ?>   
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ifsc_code">IFSC Code</label>
                            <?php echo form_input(['name' => 'ifsc_code', 'id' => 'ifsc_code', 'class' => 'form-control'], isset($restaurant['ifsc_code']) ? $restaurant['ifsc_code'] : ''); ?>   
                        </div>
                    </div>
                </div>
                                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bank_name">Bank Name</label>
                            <?php echo form_input(['name' => 'bank_name', 'id' => 'bank_name', 'class' => 'form-control'], isset($restaurant['bank_name']) ? $restaurant['bank_name'] : ''); ?>   
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="branch_name">Branch Name</label>
                            <?php echo form_input(['name' => 'branch_name', 'id' => 'branch_name', 'class' => 'form-control'], isset($restaurant['branch_name']) ? $restaurant['branch_name'] : ''); ?>   
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-8">
                        <div class="form-group">
                            <label for="bank_address">Bank Address</label>
                            <?php echo form_textarea(['name' => 'bank_address', 'id' => 'bank_address', 'rows' => '5', 'class' => 'form-control'], isset($restaurant['bank_address']) ? $restaurant['bank_address'] : '') ?>   
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-2">
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</div>