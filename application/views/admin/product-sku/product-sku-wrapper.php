<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <h5 class="m-b-0" style="padding-top: 5px">
                    Product Sku Listing
                </h5>
            </div>
            <div class="col-2 offset-7">
                <a href="<?php echo base_url('admin/add-product-sku/' . $store_id . '/' . $shop_section_id . '/' . $product_id); ?>" class="btn btn-primary">Add Sku</a>
            </div>
        </div>
    </div>
    <div class="card-body">

        <div class="table-responsive p-t-10">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Product</th>
                        <th>SKU</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (!empty($products)) {
                        $i = 1;
                        foreach ($products as $product) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $product['product_name']; ?></td>
                                <td><?php echo $product['sku']; ?></td>
                                <td><?php echo $product['is_active']; ?></td>
                                <td>
								 <?php
                                    if ($product['is_active'] == 'Active') {
                                        ?>
                                        <a href="<?php echo base_url('admin/changeProductSkuStatus/' . $product['product_sku_id'] . '/Inactive'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Active <i class="fe fe-thumbs-up"></i></a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="<?php echo base_url('admin/changeProductSkuStatus/' . $product['product_sku_id'] . '/Active'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Inactive <i class="fe fe-thumbs-down"></i></a>
                                            <?php
                                        }
                                        ?>
                                    <a href="<?php echo base_url('admin/add-product-sku/' . $store_id . '/' . $shop_section_id . '/' . $product_id.'/'.$product['product_sku_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Product Sku" class="btn btn-success btn-sm">Edit <i class="fe fe-edit"></i></a>
                                   
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