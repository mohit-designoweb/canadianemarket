<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">

                    <h4>Market Product</h4>
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
                                    if (!empty($product)) {
                                        echo 'Edit';
                                    } else {
                                        echo 'Add';
                                    }
                                    ?> Product</h5>
                            </div>
                            <div class="col-2 offset-7">
                                <a href="<?php echo base_url('partner/partnerMarket'); ?>" class="btn btn-primary">View Product</a>
                            </div>
                        </div>
                    </div>
                    <p id="error-msg"></p>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" id="image-common-form" action="<?php
                        if (!empty($product)) {
                            echo base_url('admin/doEditPartnerProduct/' . $product['market_place_product_id']);
                        } else {
                            echo base_url('admin/doAddMarketProduct');
                        }
                        ?>">
                                  <?php if (!empty($product['image_url'])) {
                                      ?>
                                <div class="row">
                                    <div class="col-3">
                                        <img src="<?php echo base_url('uploads/market-product/' . $product['image_url']); ?>" class="img-responsive">
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
                                        <label for="restaurant_category_id">Category</label>
                                        <?php echo form_dropdown(['name' => 'market_place_category_id', 'id' => 'market_place_category_id', 'class' => 'form-control'], $category, isset($product['market_place_category_id']) ? $product['market_place_category_id'] : ''); ?>   
                                    </div>    
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="partner_id">Partner</label>
                                        <?php
                                        echo form_dropdown(['name' => 'partner_id', 'id' => 'partner_id', 'class' => 'form-control'], $partners, isset($product['partner_id']) ? $product['partner_id'] : '');
                                        ?>
                                    </div>
                                </div>-->
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="store_name">Product Name</label>
                                        <?php echo form_input(['name' => 'product_name', 'id' => 'product_name', 'class' => 'form-control'], isset($product['product_name']) ? $product['product_name'] : ''); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="country">Price</label>
                                        <?php echo form_input(['name' => 'price', 'id' => 'price', 'class' => 'form-control'], isset($product['price']) ? $product['price'] : ''); ?>   
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <?php echo form_textarea(['name' => 'description', 'id' => 'description', 'rows' => '5', 'class' => 'form-control'], isset($product['description']) ? $product['description'] : '') ?>   
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
                </div>
            </div>
            <!-- /.box-body -->

        </div>
    </div>
</div>
</div>
</div>
</section>

</main>