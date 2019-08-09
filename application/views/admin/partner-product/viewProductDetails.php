  
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           <?php
                            if (isset($product)) {
                                echo "Edit Product";
                            } else
                                echo "Add Product";
                            ?>
        </h1>
        <a href="<?php echo site_url('store/product');?>" class="pull-right btn btn-primary">Back</a>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                   
                    <p id="error_msg"></p>
                    <!-- /.box-header -->
                    <!-- form start -->
                   
                        <div class="box-body">
                               <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subcategory_id">Store Name :</label>
                                   
                                           <?php echo $product['store_name']; ?>
                                                   
                                  
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_id">Category :</label>
                                
                                            <?php echo $product['category_name']; ?>
                                                  
                                </div>
                            </div>
                         

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                   <?php
                                    if (isset($product)) {
                                        echo $product['product_name'];
                                    }
                                    ?></div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product_name">Product Price</label>
                                   <?php
                                    if (isset($product)) {
                                        echo $product['price'];
                                    }
                                    ?></div>
                            </div>
 <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product_name">Product Sku</label>
                                   <?php
                                    if (isset($product)) {
                                        echo $product['sku'];
                                    }
                                    ?></div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image_url">Small Image</label>
                                    <?php
                                    if (isset($product)) {
                                        
                                    ?>
                                    <img height="100" width="100" src="<?php echo base_url('uploads/'.$product['small_image']);?>"/>
                                    <?php
                                    }
                                   
                                    ?>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image_url">Large Image</label>
                                    <?php
                                    if (isset($product)) {
                                        
                                    ?>
                                    <img height="100" width="100" src="<?php echo base_url('uploads/'.$product['large_image']);?>"/>
                                    <?php
                                    }
                                   
                                    ?>
                                    </div>
                            </div>


                            <div class="form-group">
                                <label for="subcategory_name">Description</label>
                                <label for="description">Description</label>
                               <?php
                                    if (isset($product)) {
                                        echo $product['description'];
                                    }
                                    ?>
                            </div>
                        </div>
                             <?php
                            if (!empty($product)) {
                               foreach ($specification as $specification1) {
                                   
                                    ?>
                                <div class="row add-speci-group" id="add-speci-group">
                                    <div class="col-md-3"></div>
                                            <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Group Name :</label>
                                                <?php echo $specification1['group_id']; ?>
                                            </div> 
                                        </div>
                                        <div class="col-sm-3">
                                             <label>Group Value :</label>
                                            <?php echo $specification1['group_value']; ?>
                                        </div>
                                      
                                    </div>
                                    <?php
                                   
                                }
                            }
                            ?>
                         

                        </div>
                        <!-- /.box-body -->

                </div>
                <!-- /.box -->

            </div>


            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
