<div class="row">
    <div class="col-md-8">
        <div class="card-body">
            <div class="table-responsive p-t-10">
                <table id="example" class="table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
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
                                    <td><a href="<?php echo base_url('admin/AdminRestaurant/manage_menu_category_wrapper/' . $menu['restaurant_id'] . '/' . $menu['menu_category_id']); ?>" class="btnUrls restauranttabs_edit" style="color: #4c66fb;" ><?php echo $menu['menu_category_name']; ?></a></td>
                                    <td><?php echo $menu['is_active']; ?></td>
                                    <td>
                                        <a href="<?php echo base_url('admin/AdminRestaurant/manage_menu_category_wrapper/' . $menu['restaurant_id'] . '/' . $menu['menu_category_id']); ?>" data-toggle="tooltip" data-placement="top" title data-original-title="Edit Category" class="btn btn-success btn-sm restauranttabs_edit">Edit <i class="fe fe-edit"></i></a>
                                        <?php if ($menu['is_active'] == 'Active') { ?>
                                            <a href="<?php echo base_url('admin/changeRestaurantMenuCategoryStatus/' . $menu['menu_category_id'] . '/Inactive'); ?>" data-toggle="tooltip" data-placement="top" title data-original-title="Change-Status" class="btn btn-primary btn-sm change-status">Active <i class="fe fe-thumbs-up"></i></a>
                                            <?php } else {
                                            ?>
                                            <a href="<?php echo base_url('admin/changeRestaurantMenuCategoryStatus/' . $menu['menu_category_id'] . '/Active'); ?>" data-toggle="tooltip" data-placement="top" title data-original-title="Change-Status" class="btn btn-primary btn-sm change-status">Inactive <i class="fe fe-thumbs-down"></i></a>
                                        <?php } ?>
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
    <div class="col-4">
        <div class="card m-b-30">
            <div id="error_msg"></div>
            <div class="card-header">
                <h5 class="m-b-0"><?php if (!empty($men)) {
                            echo 'Edit';
                        } else {
                            echo 'Add';
                        } ?> Restaurant Menu Category</h5>
            </div>
            <div class="card-body">
                <form method="post" id="restaurant-wrapper-common-form" action="<?php
                if (!empty($men)) {
                    echo base_url('admin/doEditRestaurantMenuCategory/' . $restaurant_id . '/' . $men['menu_category_id']);
                } else {
                    echo base_url('admin/doAddRestaurantMenuCategory/' . $restaurant_id);
                }
                ?>">
                    <div class="form-group">
                        <label for="menu_category_name">Menu Category</label>
                        <?php echo form_input(['name' => 'menu_category_name', 'id' => 'menu_category_name', 'class' => 'form-control'], isset($men['menu_category_name']) ? $men['menu_category_name'] : '') ?>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>