<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <h5 class="m-b-0" style="padding-top: 5px">
                    Coupon Listing
                </h5>
            </div>
            <div class="col-2 offset-7">
                <a href="<?php echo base_url('admin/addCoupon'); ?>" class="btn btn-primary">Add Coupon</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive p-t-10">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Coupon Name</th>
                        <th>Discount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (!empty($coupons)) {

                        $i = 1;
                        foreach ($coupons as $coupon) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $coupon['coupon_code']; ?></td>
                                <td><?php echo $coupon['coupon_type']; ?></td>
                                <td><?php echo $coupon['is_active']; ?></td>
                                <td>
								 <?php if ($coupon['is_active'] == 'Active') {
                                        ?>
                                        <a href="<?php echo base_url('admin/doChangeCouponStatus/' . $coupon['coupon_id'] . '/Inactive'); ?>" data-toggle="tooltip" data-placement="top" title="Change Status To Inactive" class="btn btn-primary btn-sm change-status">Active <i class="fe fe-thumbs-up"></i></a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="<?php echo base_url('admin/doChangeCouponStatus/' . $coupon['coupon_id'] . '/Active'); ?>" data-toggle="tooltip" data-placement="top" title="Change Status To Active" class="btn btn-primary btn-sm change-status">Inactive <i class="fe fe-thumbs-down"></i></a>
                                        <?php }
                                        ?>
                                    <a href="<?php echo base_url('admin/addCoupon/' . $coupon['coupon_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit User Detail" class="btn btn-success btn-sm">Edit <i class="fe fe-edit"></i></a>
                                    <a href="<?php echo base_url('admin/doDeleteCouponById/' . $coupon['coupon_id']); ?>" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-sm delete" title="Delete User">Delete <i class="fe fe-delete"></i></a>
                                   
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