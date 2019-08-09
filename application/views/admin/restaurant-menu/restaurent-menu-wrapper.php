<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <h5 class="m-b-0" style="padding-top: 5px">
                    Restaurant Menu Listing
                </h5>
            </div>
            <div class="col-2 offset-7">
                <a href="<?php echo base_url('admin/add-restaurant-menu/' . $restaurant_id . '/' . $menu_category_id); ?>" class="btn btn-primary">add Menu</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive p-t-10">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Menu Image</th>
                        <th>Menu Name</th>
                        <th>Price($)</th>
                        <th>Category Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (!empty($menus)) {
                        $i = 1;
                        foreach ($menus as $menu) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><img height="100" width="100" src="<?php echo base_url('uploads/menu/' . $menu['image_url']); ?>"/></td>
                                <td><?php echo $menu['menu_name']; ?></td>
                                <td>$<?php echo $menu['price']; ?></td>
                                <td><?php echo $menu['menu_category_name']; ?></td>
                                <td><?php echo $menu['is_active']; ?></td>
                                <td>
								<?php if ($menu['is_active'] == 'Active') {
                                        ?>
                                        <a href="<?php echo base_url('admin/changeRestaurantMenuStatus/' . $menu['menu_id'] . '/Inactive'); ?>" data-toggle="tooltip" data-placement="top" title data-original-title="Change-Status" class="btn btn-primary btn-sm change-status">Active <i class="fe fe-thumbs-up"></i></a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="<?php echo base_url('admin/changeRestaurantMenuStatus/' . $menu['menu_id'] . '/Active'); ?>" data-toggle="tooltip" data-placement="top" title data-original-title="Change-Status" class="btn btn-primary btn-sm change-status">Inactive <i class="fe fe-thumbs-down"></i></a>
                                        <?php }
                                        ?>
                                    <a href="<?php echo base_url('admin/add-restaurant-menu/' . $restaurant_id . '/' . $menu_category_id.'/'.$menu['menu_id']);    ?>" data-toggle="tooltip" data-placement="top" title data-original-title="Edit Menu" class="btn btn-success btn-sm">Edit <i class="fe fe-edit"></i></a>
                                    
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