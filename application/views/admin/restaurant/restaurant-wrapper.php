<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <h5 class="m-b-0" style="padding-top: 5px">
                    Restaurant Listing
                </h5>
            </div>
            <div class="col-2 offset-7">
                <a href="<?php echo base_url('admin/addRestaurant'); ?>" class="btn btn-primary">Add Restaurant</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive p-t-10">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Restaurant Name</th>
                        <th>Category</th>
                        <th>Address</th>
                        <th>Country</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (!empty($restaurants)) {
                        $i = 1;
                        foreach ($restaurants as $restaurant) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><img height="100" width="100" src="<?php echo base_url('uploads/restaurant/' . $restaurant['image_url']); ?>"/></td>
                                <td><a class="btnUrls" href="<?php echo base_url('admin/editRestaurant/' . $restaurant['restaurant_id']); ?>"><?php echo $restaurant['restaurant_name']; ?></a></td>
                                <td><?php echo $restaurant['category_name']; ?></td>
                                <td><?php echo $restaurant['address']; ?></td>
                                <td><?php echo $restaurant['country']; ?></td>

<!--				<td>
                                    <label class="cstm-switch">
                                        <input type="checkbox" id="option-dismiss" <?php echo $restaurant['is_open']=='Enable' ? 'Checked': ''; ?> name="option" value="<?php if( $restaurant['is_open'] == 'Enable'){ echo base_url('admin/changeAdminRestaurantStatusOpenOrClose/' . $restaurant['restaurant_id'] . '/Disable'); } else { echo base_url('admin/changeAdminRestaurantStatusOpenOrClose/' . $restaurant['restaurant_id'] . '/Enable'); }?>" class="cstm-switch-input">
                                        <span class="cstm-switch-indicator "></span>
                                        <span class="cstm-switch-description"><?php echo $restaurant['is_open']=='Enable' ? 'Open': 'Close'; ?> </span>
                                    </label>
                                </td>-->
                                <td>
<!--				    <?php if ($restaurant['is_active'] == 'Active') { ?>
                                        <a href="<?php echo base_url('admin/changeAdminRestaurantStatus/' . $restaurant['restaurant_id'] . '/Inactive'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Active <i class="fe fe-thumbs-up"></i></a>
                                    <?php } else { ?>
                                        <a href="<?php echo base_url('admin/changeAdminRestaurantStatus/' . $restaurant['restaurant_id'] . '/Active'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Inactive <i class="fe fe-thumbs-down"></i></a>
                                        <?php } ?>
                                    <a href="<?php echo base_url('admin/restaurant-menu-category/' . $restaurant['restaurant_id']); ?>" data-toggle="tooltip" data-placement="top" title="Add Menu Category" class="btn btn-info btn-sm">Add <i class="fe fe-menu"></i></a>-->
                                    <a href="<?php echo base_url('admin/editRestaurant/' . $restaurant['restaurant_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Store" class="btn btn-success btn-sm">Edit <i class="fe fe-edit"></i></a>
                                    
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