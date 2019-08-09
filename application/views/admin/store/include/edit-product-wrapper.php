<p id="error-msg"></p>
<div class="card-body">
    <form method="post" enctype="multipart/form-data" id="store-wrapper-image-form" action="<?php
    if (!empty($product)) {
        echo base_url('admin/adminProduct/doEditProduct/' . $store_id . '/' . $product['product_id']);
    }
    ?>">

        <div class="row">
            <?php if (!empty($product['product_id'])) {  ?>
                <!-- <div class="row" id="image-wrapper" data-url="<?php echo base_url('admin/AdminProduct/get_product_image_wrapper/' . $product['product_id']) ?>">
                </div> -->
                
                <?php
                if (!empty($pro_image)) {
                    
                    foreach ($pro_image as $image) {
                        ?>
                        <div class="col-3 form-group">
                            <img src="<?php echo base_url('uploads/product-sku/' . $image['image_url']); ?>" height="100px" width="150px"/><br>
                            <a href="<?php echo base_url('admin/AdminProduct/doDeleteProductSkuImage/'. $store_id . '/' . $product['product_id'] .'/'. $image['image_id']) ?>" class="delete-image" style="display: block; text-align: center;">Delete <i class="fe fe-trash"></i></a>
                        </div>
                        <?php
                    }
                }
                ?>
            <?php } ?>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="image_url">Select Image</label>
                    <?php echo form_upload(['name' => 'image_url[]', 'id' => 'image_url', 'class' => 'form-control', 'multiple' => 'multiple']); ?>
                </div>
            </div>
            <input type="hidden" name="store_id" value="<?php echo $store_id; ?>"/>
            <input type="hidden" name="shop_section_id" value="<?php echo $shop_section_id; ?>"/>
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
                    <label for="description">Add Attribute</label>
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
                <input type="hidden" name="sku_mapping_id[]" id="mapping_id" value="<?php echo $spec['sku_mapping_id']; ?>" />
                <div class="row form-group corner_clone">
                    <div class="col-md-3">
                        <?php echo form_dropdown(['name' => 'specification[]', 'placeholder' => 'Attributes Name', 'id' => 'specification', 'class' => 'form-control'], $specification, $spec['group_id']); ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo form_input(['name' => 'specification_value[]', 'id' => 'specification_value', 'class' => 'form-control', 'placeholder' => 'Attributes Value'], isset($spec['group_value']) ? $spec['group_value'] : ''); ?>
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
                    <?php echo form_input(['name' => 'specification_value[]', 'id' => 'specification_value', 'class' => 'form-control', 'placeholder' => 'Attributes Value']); ?>
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


