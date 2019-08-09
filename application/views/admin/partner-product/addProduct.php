  

<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4><a href="<?php echo base_url('partner/partner-shop-section') ?>">Shop Section</a> / Product</h4>
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
                                    if (!empty($product)) {
                                        echo 'Edit';
                                    } else {
                                        echo 'Add';
                                    }
                                    ?>
								Product</h5>
                            </div>
                            <div class="col-2 offset-7">
                                <a href="<?php echo base_url('partner/partnerProduct/' . $store_id . '/' . $shop_section_id); ?>" class="btn btn-primary">View Store</a>
                            </div>
                        </div>
                    </div>
                    <p id="error-msg"></p>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" id="image-common-form" action="<?php
                        if (!empty($product)) {
                            echo base_url('partner/doEditProduct/' . $store_id . '/' . $shop_section_id . '/' . $product['product_id']);
                        } else {
                            echo base_url('partner/doAddProduct/' . $store_id . '/' . $shop_section_id);
                        }
                        ?>">

                            <?php if (!empty($product['image_url'])) {
                                ?>
                                <div class="row">
                                    <div class="col-3">
                                        <img src="<?php echo base_url('uploads/product/' . $product['image_url']); ?>" class="img-responsive">
                                    </div>
                                </div>

                            <?php }
                            ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="image_url">Select Image</label>
                                        <?php echo form_upload(['name' => 'image_url', 'id' => 'image_url', 'class' => 'form-control']); ?>
                                    </div>
                                </div>
                                <input type="hidden" name="store_id" value="<?php echo $store_id; ?>"/>
                                <input type="hidden" name="shop_section_id" value="<?php echo $shop_section_id; ?>"/>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="product_name">Product Name <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'product_name', 'id' => 'product_name', 'class' => 'form-control'], isset($product['product_name']) ? $product['product_name'] : ''); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="price">Price(In $) <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'price', 'id' => 'price', 'class' => 'form-control'], isset($product['price']) ? $product['price'] : ''); ?>
                                    </div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="description">Description <i style="color:red;">*</i></label>
                                        <?php echo form_textarea(['name' => 'description', 'id' => 'description', 'rows' => '5', 'class' => 'form-control'], isset($product['description']) ? $product['description'] : '') ?>  
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="discount">Discount</label>
                                        <?php echo form_input(['name' => 'discount', 'id' => 'discount', 'class' => 'form-control'], isset($product['discount']) ? $product['discount'] : ''); ?>
                                    </div> 
                                </div>
                            </div>
							 <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emarket_point">Emarket Point</label>
                                        <?php echo form_input(['name' => 'emarket_point', 'id' => 'emarket_point', 'class' => 'form-control'], isset($product['emarket_point']) ? $product['emarket_point'] : '') ?>  
                                    </div> 
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="description">Add User Specification <i style="color:red;">*</i></label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <a href="#" class="corner_clone_add"><i class="fa fa-plus-square"></i></a>
                                    </div>
                                </div>
                            </div>

                            <?php
                            if (!empty($specifications)) { 
                                $i=1;
                                foreach ($specifications as $spec) {
                                    ?>
                                    <input type="hidden" name="mapping_id[]" id="mapping_id" value="<?php echo $spec['mapping_id']; ?>" />
                                    <div class="row form-group corner_clone">
                                        <div class="col-md-3">
                                            <?php echo form_dropdown(['name' => 'specification[]', 'placeholder' => 'Corner Name', 'required' => 'required', 'id' => 'specification', 'class' => 'form-control'], $specification,$spec['group_id']); ?>
                                        </div>
                                        <div class="col-md-1"  style="margin-top: 7px">
                                            <?php if($i!=1){ ?>
                                            <span><a href="<?php echo base_url('admin/removeProductGroupMapping/'.$spec['mapping_id']); ?>" class="remove_corner"><i class="fa fa-minus-square"></i></a></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <div class="row form-group corner_clone">
                                    <div class="col-md-3">
                                        <?php echo form_dropdown(['name' => 'specification[]', 'placeholder' => 'Corner Name', 'required' => 'required', 'id' => 'specification', 'class' => 'form-control'], $specification); ?>
                                    </div>
                                    <div class="col-md-1"  style="margin-top: 7px"></div>
                                </div>
                                <?php
                            }
                            ?>



                            <div class="corner_row"></div>


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


