  

<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4><a href="<?php echo base_url('admin/shop-section') ?>">Shop Section</a> / <a href="<?php echo base_url('admin/adminProduct/' . $store_id . '/' . $shop_section_id); ?>">Product</a> / Product Sku</h4>
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
								 Product Sku</h5>
                            </div>
                            <div class="col-2 offset-7">
                                <a href="<?php echo base_url('admin/view-product-sku/' . $store_id . '/' . $shop_section_id . '/' . $product_id); ?>" class="btn btn-primary">View SKU</a>
                            </div>
                        </div>
                    </div>
                    <p id="error-msg"></p>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" id="image-common-form" action="<?php
                        if (!empty($product)) {
                            echo base_url('admin/doEditProductSku/' . $store_id . '/' . $shop_section_id . '/' . $product_id . '/' . $product['product_sku_id']);
                        } else {
                            echo base_url('admin/doAddProductSku/' . $store_id . '/' . $shop_section_id . '/' . $product_id);
                        }
                        ?>">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sku">SKU <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'sku', 'id' => 'sku', 'class' => 'form-control'], isset($product['sku']) ? $product['sku'] : ''); ?>
                                    </div>
                                </div>
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>"/>
                                
                                <?php 
                                $i=0;
                                foreach($specifications as $spec){
                                ?>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <?php 
                                        if(!empty($sku_mapping)){
                                        ?>
                                        <input type="hidden" name="mapping_id[]" value="<?php echo $sku_mapping[$i]['group_id']; ?>"/>
                                        <?php
                                        }
                                        ?>
                                        <input type="hidden" name="group_id[]" value="<?php echo $spec['group_id']; ?>"/>
                                        <label for="<?php echo $spec['group_name']; ?>"><?php echo $spec['group_name']; ?> <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => $spec['group_name'], 'id' => $spec['group_name'], 'class' => 'form-control'], isset($mapping[$spec['group_id']]) ? $mapping[$spec['group_id']] : ''); ?>
                                    </div>
                                </div>
                                <?php
                                $i++;
                                } ?>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="image_url">Select Image <i style="color:red;">*</i></label>
                                        <?php if(!empty($product['product_sku_id'])){
                                            echo form_upload(['name' => 'image_url[]', 'id' => 'image_url', 'class' => 'form-control', 'multiple' => 'multiple']);
                                        }else{
                                            echo form_upload(['name' => 'image_url[]','required'=>'required' ,'id' => 'image_url', 'class' => 'form-control', 'multiple' => 'multiple']);
                                        }  ?>
                                    </div>
                                </div>
                            </div>
                            
                            <?php if(!empty($product['product_sku_id'])){
                            ?>
                            <div class="row" id="content-wrapper" data-url="<?php echo base_url('admin/get-product-sku-image-wrapper/'.$product['product_sku_id']) ?>">
                            </div>
                            <?php
                            }  ?>
                            
                            
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


