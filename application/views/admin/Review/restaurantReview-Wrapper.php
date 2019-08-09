<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <h5 class="m-b-0" style="padding-top: 5px">
                    Store Review
                </h5>
            </div>
            <div class="col-2 offset-7">
<!--                <a href="<?php echo base_url('admin/addStore'); ?>" class="btn btn-primary">add Store</a>-->
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive p-t-10">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Restaurant Name</th>
                        <th>User Name</th>
                        <th>Review</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (!empty($restaurantReview)) {                
                        $i = 1;
                        foreach ($restaurantReview as $review) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $review['restaurant_name']; ?></td>
                                <td><?php echo $review['user_name']; ?></td>
                                <td><?php echo $review['review']; ?></td>
                                <td><?php echo $review['is_approve']; ?></td>
                                <td>
<!--                                    <a href="<?php echo base_url('admin/addStore/' . $review['review_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Store"><i class="fe fe-edit"></i></a>-->
                                    <?php
                                   if ($review['is_approve'] == 'Approved') {
                                        ?>
                                        <a href="<?php echo base_url('admin/changeRestaurantReviewStatus/' . $review['restaurent_rev_rat_id'] . '/NotApproved'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Active <i class="fe fe-thumbs-up"></i></a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="<?php echo base_url('admin/changeRestaurantReviewStatus/' . $review['restaurent_rev_rat_id'] . '/Approved'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Inactive <i class="fe fe-thumbs-down"></i></a>
                                            <?php
                                        }
                                        ?>
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