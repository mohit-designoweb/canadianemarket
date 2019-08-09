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
                                <h5 class="m-b-0" style="padding-top: 5px">
								<?php
                                    if (!empty($charges)) {
                                        echo 'Edit';
                                    } else {
                                        echo 'Add';
                                    }
                                    ?>
                                    Restaurant Delivery Charges
                                </h5>
                            </div>
                            <!--<div class="col-2 offset-7">
                                <a href="<?php echo base_url('admin/storeDeliveryCharges'); ?>" class="btn btn-primary">View Delivery Charges</a>
                            </div>-->
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" id="image-common-form" action="<?php
                       
                        if (!empty($charges)) {
                            
                            echo base_url('admin/doEditRestaurantDeliveryCharges/' . $charges['restaurant_delivery_charges_id']);
                        } else {

                            echo base_url('admin/doAddRestaurantDeliveryCharges');
                        }
                        ?>">
                                  
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="restaurant_distance">Restaurant Distance</label>
                                        <?php echo form_input(['name' => 'restaurant_distance', 'id' => 'restaurant_distance', 'class' => 'form-control', 'placeholder' => 'Store Distance'], isset($charges['restaurant_distance']) ? $charges['restaurant_distance'] : ''); ?>    
                                    </div>

                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="base_charge">Delivery Charges</label>
                                        <?php echo form_input(['name' => 'base_charge', 'id' => 'base_charge', 'class' => 'form-control', 'placeholder' => 'Base Charge'], isset($charges['base_charge']) ? $charges['base_charge'] : ''); ?>   
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="extra_charge">Extra Charges/km</label>
                                        <?php echo form_input(['name' => 'extra_charge', 'id' => 'extra_charge', 'class' => 'form-control', 'placeholder' => 'Extra Charge'], isset($charges['extra_charge']) ? $charges['extra_charge'] : ''); ?>   
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