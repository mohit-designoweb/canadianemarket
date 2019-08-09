<?php
if (!empty($images)) {
    foreach ($images as $image) {
        ?>
        <div class="col-3 form-group">
            <img src="<?php echo base_url('uploads/product-sku/' . $image['image_url']); ?>" height="150px" width="200px"/><br>
            <a href="<?php echo base_url('admin/doDeleteProductSkuImage/'.$image['image_id']) ?>" class="delete-image" style="display: block; text-align: center;"><i class="fe fe-trash"></i></a>
        </div>
        <?php
    }
}
?>