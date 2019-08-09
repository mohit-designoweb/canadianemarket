<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">

                    <h4>Store</h4>
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
                                    if (!empty($store)) {
                                        echo 'Edit';
                                    } else {
                                        echo 'Add';
                                    }
                                    ?>
                                     Store
                                </h5>
                            </div>
                            <div class="col-2 offset-7">
                                <?php
                                $view_url = base_url('admin/adminStore');
                                ?>
                                <a href="<?php echo base_url('partner/partnerStore'); ?>" class="btn btn-primary">View Store</a>
                            </div>
                        </div>
                    </div>
                    <p id="error-msg"></p>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" id="image-common-form" action="<?php
                                if (!empty($store)) {
                                    echo base_url('admin/doEditPartnerStore/' . $store['store_id']);
                                } else {
                                    echo base_url('admin/doAddStore');
                                }
                                ?>">
                              <?php if (!empty($store['image_url'])) {
                                  ?>
                                <div class="row">
                                    <div class="col-3">
                                        <img src="<?php echo base_url('uploads/store/' . $store['image_url']); ?>" class="img-responsive">
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
<!--                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="image_url">Category</label>
                                        <?php echo form_dropdown(['name' => 'category_id', 'id' => 'category_id', 'class' => 'form-control'], $category, isset($store['category_id']) ? $store['category_id'] : ''); ?>   
                                    </div>    
                                </div>
                                -->
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="store_name">Store Name <i style="color:red;">*</i></label>
                                        <?php
                                            echo form_input(['name' => 'store_name', 'id' => 'store_name', 'class' => 'form-control','readonly'=>'true'], isset($store['store_name']) ? $store['store_name'] : '');
                                        
                                        ?>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="country">Country <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'country', 'id' => 'country', 'class' => 'form-control'], isset($store['country']) ? $store['country'] : ''); ?>   
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="state">State <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'state', 'id' => 'state', 'class' => 'form-control'], isset($store['state']) ? $store['state'] : ''); ?>   
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="description">Description <i style="color:red;">*</i></label>
                                        <?php echo form_textarea(['name' => 'description', 'id' => 'description', 'rows' => '5', 'class' => 'form-control'], isset($store['description']) ? $store['description'] : '') ?>   
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="city">City <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'form-control'], isset($store['city']) ? $store['city'] : ''); ?>   
                                    </div>
                                </div>
                            </div>

<!--                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="latitude">Latitude</label>
                                        <?php echo form_input(['name' => 'latitude', 'id' => 'latitude', 'class' => 'form-control'], isset($store['latitude']) ? $store['latitude'] : '') ?>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="longitude">Longitude</label>
                                        <?php echo form_input(['name' => 'longitude', 'id' => 'longitude', 'class' => 'form-control'], isset($store['longitude']) ? $store['longitude'] : '') ?>
                                    </div>
                                </div>
                            </div>-->

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