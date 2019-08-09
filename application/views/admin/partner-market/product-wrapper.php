<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <h5 class="m-b-0" style="padding-top: 5px">
                    Product Listing
                </h5>
            </div>
<!--            <div class="col-2 offset-7">
                <a href="<?php echo base_url('admin/addMarketProduct'); ?>" class="btn btn-primary">Add Product</a>
            </div>-->
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive p-t-10">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
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
                                <td><img height="100" width="100" src="<?php echo base_url('uploads/market-product/' . $product['image_url']); ?>"/></td>
                                <td><?php echo $product['product_name']; ?></td>
                                <td><?php echo $product['price']; ?></td>
                                <td><?php echo $product['is_active']; ?></td>
                                <td>
								<?php
                                    if ($product['is_active'] == 'Active') {
                                        ?>
                                        <a href="<?php echo base_url('admin/changePartnerProductStatus/' . $product['market_place_product_id'] . '/Inactive'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Active <i class="fe fe-thumbs-up"></i></a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="<?php echo base_url('admin/changePartnerProductStatus/' . $product['market_place_product_id'] . '/Active'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Inactive <i class="fe fe-thumbs-down"></i></a>
                                            <?php
                                        }
                                        ?>
                                    <a href="<?php echo base_url('partner/addPartnerProduct/' . $product['market_place_product_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Product" class="btn btn-success btn-sm">Edit <i class="fe fe-edit"></i></a>
                                    
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