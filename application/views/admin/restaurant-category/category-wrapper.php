<div class="card">
    <div class="card-header">
        <h5 class="m-b-0">
            Category Listing
        </h5>
    </div>
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
                    if (!empty($catgories)) {
                        $i = 1;
                        foreach ($catgories as $category) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $category['category_name']; ?></td>
                                <td><?php echo $category['is_active']; ?></td>
                                <td>
								 <?php if ($category['is_active'] == 'Active') {
                                        ?>
                                        <a href="<?php echo base_url('admin/changeRestaurantCategoryStatus/' . $category['restaurant_category_id'] . '/Inactive'); ?>" data-toggle="tooltip" data-placement="top" title data-original-title="Change-Status" class="btn btn-primary btn-sm change-status">Active <i class="fe fe-thumbs-up"></i></a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="<?php echo base_url('admin/changeRestaurantCategoryStatus/' . $category['restaurant_category_id'] . '/Active'); ?>" data-toggle="tooltip" data-placement="top" title data-original-title="Change-Status" class="btn btn-primary btn-sm change-status">Inactive <i class="fe fe-thumbs-down"></i></a>
                                        <?php }
                                        ?>
                                    <a href="<?php  echo base_url('admin/restaurant-category/'.$category['restaurant_category_id']) ?>" data-toggle="tooltip" data-placement="top" title data-original-title="Edit Category" class="btn btn-success btn-sm">Edit <i class="fe fe-edit"></i></a>
                                   
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