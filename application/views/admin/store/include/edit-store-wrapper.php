<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#storeInfo" class="active show">Store Info</a></li>
    <li><a data-toggle="tab" href="#storeAddress">Address</a></li>
    <li><a data-toggle="tab" href="#storeOperation">Store Operations</a></li>
    <li><a data-toggle="tab" href="#deliveryAndTax">Delivery & Tax</a></li>
    <li><a data-toggle="tab" href="#bankPayment">Bank details & payments</a></li>
</ul>

<div class="tab-content">
    <div id="storeInfo" class="tab-pane fade in active show">
        <div class="card-header">
            <div class="row">
                <div class="col-2 offset-11">
                    <?php
                    $view_url = base_url('admin/adminStore');
                    ?>
                    <a href="<?php echo $view_url; ?>" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" id="image-common-form" action="<?php
                if (!empty($store)) {
                    echo base_url('admin/doEditStoreInfo/' . $store['store_id']);
                }
            ?>">
                <?php if (!empty($store['image_url'])) { ?>
                    <div class="row">
                        <div class="col-3">
                            <img src="<?php echo base_url('uploads/store/' . $store['image_url']); ?>" class="img-responsive">
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
                            <label for="image_url">Category</label>
                            <?php echo form_dropdown(['name' => 'category_id', 'id' => 'category_id', 'class' => 'form-control'], $category, isset($store['category_id']) ? $store['category_id'] : ''); ?>   
                        </div>    
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="partner_id">Partner</label>
                            <?php
                            echo form_dropdown(['name' => 'partner_id', 'id' => 'partner_id', 'class' => 'form-control'], $partners, isset($store['partner_id']) ? $store['partner_id'] : '');
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="store_name">Store Name</label>
                            <?php
                            echo form_input(['name' => 'store_name', 'id' => 'store_name', 'class' => 'form-control'], isset($store['store_name']) ? $store['store_name'] : '');
                            ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <?php echo form_textarea(['name' => 'description', 'id' => 'description', 'rows' => '5', 'class' => 'form-control'], isset($store['description']) ? $store['description'] : '') ?>   
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="return_policy">Return Policy</label>
                            <?php echo form_textarea(['name' => 'return_policy', 'id' => 'return_policy', 'rows' => '5', 'class' => 'form-control'], isset($store['return_policy']) ? $store['return_policy'] : '') ?>   
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
        <!-- /.box-body -->
    </div>
    
    <div id="storeAddress" class="tab-pane fade">
        <div class="card-header">
            <div class="row">
                <div class="col-2 offset-11">
                    <?php
                    $view_url = base_url('admin/adminStore');
                    ?>
                    <a href="<?php echo $view_url; ?>" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" id="store-wrapper-common-form" action="<?php
            if (!empty($store)) {
                echo base_url('admin/doEditStoreAddress/' . $store['store_id']);
            }
            ?>">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <?php echo form_textarea(['name' => 'address', 'id' => 'address', 'rows' => '5', 'class' => 'form-control'], isset($store['address']) ? $store['address'] : '') ?>   
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="country">Country</label>
                            <?php echo form_input(['name' => 'country', 'id' => 'country', 'class' => 'form-control'], isset($store['country']) ? $store['country'] : ''); ?>   
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="state">State</label>
                            <?php echo form_input(['name' => 'state', 'id' => 'state', 'class' => 'form-control'], isset($store['state']) ? $store['state'] : ''); ?>   
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="city">City</label>
                            <?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'form-control'], isset($store['city']) ? $store['city'] : ''); ?>   
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="latitude">Latitude</label>
                            <?php echo form_input(['type' => 'text', 'name' => 'latitude', 'id' => 'latitude', 'class' => 'form-control'], isset($store['latitude']) ? $store['latitude'] : '');?>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="longitude">Longitude</label>
                            <?php echo form_input(['type' => 'text', 'name' => 'longitude', 'id' => 'longitude', 'class' => 'form-control'], isset($store['longitude']) ? $store['longitude'] : ''); ?>
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
        <!-- /.box-body -->
    </div>
    
    <div id="storeOperation" class="tab-pane fade">
        <div class="card-header">
            <div class="row">
                <div class="col-2 offset-11">
                    <?php
                    $view_url = base_url('admin/adminStore');
                    ?>
                    <a href="<?php echo $view_url; ?>" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" id="store-wrapper-common-form" action="<?php
            if (!empty($store)) {
                echo base_url('admin/doEditStoreOperation/' . $store['store_id']);
            } 
            ?>">
                
                <div class="row">
                    <div class="col-md-4">
                        <label for="status">Status</label>
                        <div class="form-group onOffbtn">
                            <button name="off">Close</button>
                            <label class="switch">
                                <input type="checkbox" id="option-dismiss" <?php if($store['is_status'] == 'Active'){ echo "Checked"; }else{ echo "" ; } ?> name="option" value="<?php if($store['is_status'] == 'Active'){ echo base_url('admin/changeStoreStatusOpenOrClose/' . $store['store_id'] . '/Inactive');}else{ echo base_url('admin/changeStoreStatusOpenOrClose/' . $store['store_id'] . '/Active');} ?>" class="cstm-switch-input">
                                <span class="slider round"></span>
                            </label>
                            <button name="on">Open</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="store_status">Action</label>
                        <div class="form-group">
                            <?php
                            if ($store['is_active'] == 'Active') {
                                ?>
                                <a href="<?php echo base_url('admin/changeStoreStatus/' . $store['store_id'] . '/Inactive'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="change-status btn btn-success">Active <i class="fe fe-thumbs-up"></i></a>
                                <?php
                            } else {
                                ?>
                                <a href="<?php echo base_url('admin/changeStoreStatus/' . $store['store_id'] . '/Active'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="change-status btn btn-success">Inactive <i class="fe fe-thumbs-down"></i></a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="opening_time_from">Opening time</label>
                            <?php echo form_input(['type' => 'time', 'name' => 'opening_time_from', 'id' => 'opening_time_from', 'class' => 'timepicker form-control'], isset($store['opening_time_from']) ? $store['opening_time_from'] : '') ?>   
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="opening_time_to">Closing Time</label>
                            <?php echo form_input(['type' => 'time', 'name' => 'opening_time_to', 'id' => 'opening_time_to', 'class' => 'timepicker form-control'], isset($store['opening_time_to']) ? $store['opening_time_to'] : ''); ?>   
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="store_notice">Store Notice</label>
                            <?php echo form_textarea(['name' => 'store_notice', 'id' => 'store_notice', 'rows' => '5', 'class' => 'form-control'], isset($store['store_notice']) ? $store['store_notice'] : '') ?>   
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
        <!-- /.box-body -->
    </div>
    <div id="deliveryAndTax" class="tab-pane fade">
        <div class="card-header">
            <div class="row">
                <div class="col-2 offset-11">
                    <?php
                    $view_url = base_url('admin/adminStore');
                    ?>
                    <a href="<?php echo $view_url; ?>" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" id="store-wrapper-common-form" action="<?php
            if (!empty($store)) {
                echo base_url('admin/doEditStoreDeliveryTax/' . $store['store_id']);
            } 
            ?>">
                
                <div class="row">
                    <div class="col-md-4">
                        <label for="status">Delivery Service Charge</label>
                        <div class="form-group onOffbtn">
                            <button name="off">OFF</button>
                            <label class="switch">
                                <input type="checkbox" id="option-dismiss" <?php if($store['store_delivery_charge'] == 'ON'){ echo "Checked"; }else{ echo "" ; } ?> name="option" value="<?php if($store['store_delivery_charge'] == 'ON'){ echo base_url('admin/changeStoreDeliveryChargeOnOrOff/' . $store['store_id'] . '/OFF');}else{ echo base_url('admin/changeStoreDeliveryChargeOnOrOff/' . $store['store_id'] . '/ON');} ?>" class="cstm-switch-input">
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
                                <input type="checkbox" id="option-dismiss" <?php if($store['apply_delivery_charge'] == 'Custom'){ echo "Checked"; }else{ echo "" ; } ?> name="option" value="<?php if($store['apply_delivery_charge'] == 'Custom'){ echo base_url('admin/StoreDeliveryChargeType/' . $store['store_id'] . '/Default');}else{ echo base_url('admin/StoreDeliveryChargeType/' . $store['store_id'] . '/Custom');} ?>" class="cstm-switch-input">
                                <span class="slider round"></span>
                            </label>
                            <button name="custom">Custom</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="custom_charge">Custome</label>
                            <?php
                            echo form_input(['name' => 'custom_charge', 'id' => 'custom_charge', 'class' => 'form-control'], isset($store['delivery_charge']) ? $store['delivery_charge'] : '');
                            ?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="driver_instuction">Delivery Driver Instruction</label>
                            <?php echo form_textarea(['name' => 'driver_instuction', 'id' => 'driver_instuction', 'rows' => '5', 'class' => 'form-control'], isset($store['driver_instuction']) ? $store['driver_instuction'] : '') ?>   
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tax_province">Tax Province</label>
                            <?php
                            echo form_dropdown(['name' => 'tax_province', 'id' => 'tax_province', 'class' => 'form-control'], $taxProvince, isset($store['tax_province']) ? $store['tax_province'] : '');
                            ?> 
                        </div>
                        <div class="form-group">
                            <label for="estimated_delivery_time">Order Fulfilment time</label>
                            <?php
                            echo form_dropdown(['name' => 'estimated_delivery_time', 'id' => 'estimated_delivery_time', 'class' => 'form-control'], $fulfilment, isset($store['estimated_delivery_time']) ? $store['estimated_delivery_time'] : '');
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
        <!-- /.box-body -->
    </div>
    <div id="bankPayment" class="tab-pane fade">
        <div class="card-header">
            <div class="row">
                <div class="col-2 offset-11">
                    <?php
                    $view_url = base_url('admin/adminStore');
                    ?>
                    <a href="<?php echo $view_url; ?>" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" id="store-wrapper-common-form" action="<?php
            if (!empty($store)) {
                echo base_url('admin/doEditStoreBank/' . $store['store_id']);
            }
            ?>">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="holder_name">Holder Name</label>
                            <?php echo form_input(['name' => 'holder_name', 'id' => 'holder_name', 'class' => 'form-control'], isset($store['account_holder']) ? $store['account_holder'] : ''); ?>   
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="account_number">Account Number</label>
                            <?php echo form_input(['name' => 'account_number', 'id' => 'account_number', 'class' => 'form-control'], isset($store['account_number']) ? $store['account_number'] : ''); ?>   
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ifsc_code">IFSC Code</label>
                            <?php echo form_input(['name' => 'ifsc_code', 'id' => 'ifsc_code', 'class' => 'form-control'], isset($store['ifsc_code']) ? $store['ifsc_code'] : ''); ?>   
                        </div>
                    </div>
                </div>
                                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bank_name">Bank Name</label>
                            <?php echo form_input(['name' => 'bank_name', 'id' => 'bank_name', 'class' => 'form-control'], isset($store['bank_name']) ? $store['bank_name'] : ''); ?>   
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="branch_name">Branch Name</label>
                            <?php echo form_input(['name' => 'branch_name', 'id' => 'branch_name', 'class' => 'form-control'], isset($store['branch_name']) ? $store['branch_name'] : ''); ?>   
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-8">
                        <div class="form-group">
                            <label for="bank_address">Bank Address</label>
                            <?php echo form_textarea(['name' => 'bank_address', 'id' => 'bank_address', 'rows' => '5', 'class' => 'form-control'], isset($store['bank_address']) ? $store['bank_address'] : '') ?>   
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
        <!-- /.box-body -->
    </div>
</div>