<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#productList" class="active show">Product Listings</a></li>
    <li><a data-toggle="tab" href="#addProduct">Add New Product</a></li>
    <li><a data-toggle="tab" href="#importProduct">Import Product CSV</a></li>
    <li><a data-toggle="tab" href="#exportProduct">Export Product CSV</a></li>
</ul>

<div class="tab-content">
    <div id="productList" class="tab-pane fade in active show">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-2 offset-11">
                    <!--<a href="<?php echo base_url('admin/add-product/' . $store_id . '/' . $shop_section_id); ?>" class="btn btn-primary">Add Product</a>-->
                        <?php
                        $view_url = base_url('admin/adminStore');
                        ?>
                        <a href="<?php echo $view_url; ?>" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <div id="error_msg"></div>
            <div class="card-body">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Select Bulk Action:</label>
                        <select class="form-control" id="bulk_actions" data-url="<?php echo base_url('admin/AdminProduct/');?>">
                          <option value=""> --Select Action-- </option>
                          <option value="doProductDelete"> Delete </option>
                          <option value="doProductActivate" > Activate </option>
                          <option value="doProductDeactivate" > Deactivate</option>
                          <option value="doProductOutOfStock" > Out of Stock</option>
                        </select>
                    </div>
                </div>
                <div class="table-responsive p-t-10">
                    <table id="example" class="table productCustom" style="width:100%">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Product Category</th>
                                <th>Product SKU/UPC</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($allProduct)) {
                                $i = 1;
                                foreach ($allProduct as $prod) { 
                            ?>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <input type="checkbox" class="bulk-action" data-id="<?php echo $prod['product_id']; ?>" id="product_<?php echo $prod['product_id']; ?>" >
                                                <label for="product_<?php echo $prod['product_id']; ?>" class="check_product"></label>
                                            </div>
                                        </td>
                                        <td><?php echo $i; ?></td>
                                        
                                        <td>
                                            <img height="100" width="100" src="<?php echo base_url('uploads/product-sku/' . $prod['image_url']); ?>" alt="Product Image Not Found Here"/>
                                        </td>
                                        <td><a href="<?php echo base_url('admin/adminProduct/editProductDataWrapper/' . $store_id . '/' . $prod['product_id']); ?>"  class="btnUrls storetabs-edit editProduct " style="color: #4c66fb;"><?php echo $prod['product_name']; ?></a></td>
                                        <td><?php echo $prod['shop_section_name']; ?></td>
                                        <td><?php echo $prod['sku']; ?></td>
                                        <td><?php echo $prod['stock']; ?></td>
                                        <td><?php echo $prod['is_active']; ?></td>

                                        <td>
                                            <a href="<?php echo base_url('admin/adminProduct/editProductDataWrapper/' . $store_id . '/' . $prod['product_id']); ?>" title="Edit Store" class="btn btn-success btn-sm storetabs-edit editProduct">Edit <i class="fe fe-edit"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="addProduct" class="tab-pane fade">

        <div class="card">
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
            <div id="error_msg"></div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" id="store-wrapper-image-form" action="<?php
                if (!empty($product)) {
                    echo base_url('admin/adminProduct/doEditProduct/' . $store_id . '/' . $product['product_id']);
                } else {
                    echo base_url('admin/doAddProduct');
                }
                ?>">
                    <?php if (!empty($product['image_url'])) { ?>
                        <div class="row">
                            <div class="col-3">
                                <img src="<?php echo base_url('uploads/product/' . $product['image_url']); ?>" class="img-responsive">
                            </div>
                        </div>
                    <?php }  ?>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="image_url">Select Image</label>
                                <?php echo form_upload(['name' => 'image_url[]', 'id' => 'image_url', 'class' => 'form-control', 'multiple' => 'multiple']); ?>
                            </div>
                        </div>
                        <input type="hidden" name="store_id" value="<?php echo $store_id; ?>"/>
<!--                        <input type="hidden" name="shop_section_id" value="<?php echo $shop_section_id; ?>"/>-->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <?php echo form_input(['name' => 'product_name', 'id' => 'product_name', 'class' => 'form-control'], isset($product['product_name']) ? $product['product_name'] : ''); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="price">Price(In $)</label>
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="discount">Discount</label>
                                <?php echo form_input(['name' => 'discount', 'id' => 'discount', 'class' => 'form-control'], isset($product['discount']) ? $product['discount'] : ''); ?>
                            </div> 

                            <div class="form-group">
                                <label for="sku">SKU/UPC</label>
                                <?php echo form_input(['name' => 'sku', 'id' => 'sku', 'class' => 'form-control'], isset($product['sku']) ? $product['sku'] : ''); ?>
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shop_section_id">Product Category</label>
                                <?php echo form_dropdown(['name' => 'shop_section_id', 'id' => 'shop_section_id', 'class' => 'form-control'], $categorys, isset($product['shop_section_id']) ? $product['shop_section_id'] : ''); ?>
                            </div> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="attributes">Add Attributes</label>
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
                        $i = 1;
                        foreach ($specifications as $spec) {
                            ?>
                            <input type="hidden" name="mapping_id[]" id="mapping_id" value="<?php echo $spec['mapping_id']; ?>" />
                            <div class="row form-group corner_clone">
                                <div class="col-md-3">
                                    <?php echo form_dropdown(['name' => 'specification[]', 'placeholder' => 'Attributes Name', 'id' => 'specification', 'class' => 'form-control'], $specification, $spec['group_id']); ?>
                                </div>
                                <div class="col-md-3">
                                    <?php echo form_input(['name' => 'specification_value[]', 'id' => 'specification_value', 'class' => 'form-control', 'placeholder' => 'Attributes Value'], isset($product['specification_value']) ? $product['specification_value'] : '') ?>
                                </div>
                                <div class="col-md-1"  style="margin-top: 7px">
                                    <?php if ($i != 1) { ?>
                                        <span><a href="<?php echo base_url('admin/removeProductGroupMapping/' . $spec['mapping_id']); ?>" class="remove_corner"><i class="fa fa-minus-square"></i></a></span>
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
                                <?php echo form_dropdown(['name' => 'specification[]', 'placeholder' => 'Attributes Name', 'id' => 'specification', 'class' => 'form-control'], $specification); ?>
                            </div>
                            <div class="col-md-3">
                                <?php echo form_input(['name' => 'specification_value[]', 'id' => 'specification_value', 'class' => 'form-control', 'placeholder' => 'Attributes Value'], isset($product['specification_value']) ? $product['specification_value'] : '') ?>
                            </div>
                            <div class="col-md-1"  style="margin-top: 7px"></div>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="corner_row"></div>

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

    <div id="importProduct" class="tab-pane fade">
        
        <div class="card">
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
                <form method="post" enctype="multipart/form-data" id="file-import-form" action="<?php echo base_url('admin/AdminProduct/doUploadProductBycsv/' . $store_id); ?>">
                    <div class="row">
                        <div class="col-md-6">
                            
                            <div class="form-group">
                                <label for="new_product_csv">Add New Products with CSV</label>
                                <?php echo form_input(['type' => 'file', 'name' => 'new_product_csv', 'id' => 'new_product_csv', 'class' => 'form-control']); ?>
                            </div>
                            <div id="error_msgs"></div>
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

    <div id="exportProduct" class="tab-pane fade">
        <div class="card">
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
            <div id="error_msg"></div>
            <div class="card-body">
                <form >
                    <div class="row">
                        <div class="col-md-6 offset-3">
                            <div class="form-group">
                                <a class="btn btn-primary" href="<?php echo base_url('admin/AdminProduct/doExportCSVFile/'.$store_id);?>" >Export All Products to CSV</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>


<!-- Modal -->
<div class="modal fade editProduct_model" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Product Details</h4>
            </div>
            <div class="modal-body" id="edit_product_wrapper">

            </div>
        </div>
    </div>
</div>
