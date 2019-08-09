<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <h5 class="m-b-0" style="padding-top: 5px">
                    Restaurant Listing
                </h5>
            </div>
<!--            <div class="col-2 offset-7">
                <a href="<?php echo base_url('admin/addRestaurant'); ?>" class="btn btn-primary">add Restaurant</a>
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
                        <th class="resName_th">Restaurant Name</th>
                        <th class="partner-rest">Address</th>
                        <th>Country</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    //print_r($restaurants);
                    if (!empty($restaurants)) {
                        $i = 1;
                        foreach ($restaurants as $restaurant) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><img height="100" width="100" src="<?php echo base_url('uploads/restaurant/' . $restaurant['image_url']); ?>"/></td>
                                <td><?php echo $restaurant['restaurant_name']; ?></td>
                                <td><?php echo $restaurant['address']; ?></td>
                                <td><?php echo $restaurant['country']; ?></td>
                                <td><?php echo $restaurant['is_active']; ?></td>
                                <td>
								<?php if ($restaurant['is_active'] == 'Active') { ?>
                                        <a href="<?php echo base_url('admin/changePartnerRestaurantStatus/' . $restaurant['restaurant_id'] . '/Inactive'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Active <i class="fe fe-thumbs-up"></i></a>
                                    <?php } else { ?>
                                        <a href="<?php echo base_url('admin/changePartnerRestaurantStatus/' . $restaurant['restaurant_id'] . '/Active'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Inactive <i class="fe fe-thumbs-down"></i></a>
                                        <?php } ?>
                                    <a href="<?php echo base_url('partner/partner-restaurant-menu-category/' . $restaurant['restaurant_id']); ?>" data-toggle="tooltip" data-placement="top" title="Add Menu Category" class="btn btn-info btn-sm menu_btn">Menu <i class="fe fe-menu"></i></a>
                                    <a href="<?php echo base_url('partner/addPartnerRestaurant/' . $restaurant['restaurant_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Restaurant" class="btn btn-success btn-sm">Edit <i class="fe fe-edit" ></i></a>
                                    
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