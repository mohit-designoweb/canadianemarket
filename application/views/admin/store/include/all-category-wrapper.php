<div class="row">
    <div class="col-8">
        <div class="card">
<!--            <div class="card-header">
                <div class="row">
                    <div class="col-2 offset-10">
                        <a href="<?php echo base_url('admin/add-product/' . $store_id . '/' . $shop_section_id); ?>" class="btn btn-primary">Add Product</a>

                        <a href="<?php echo base_url('admin/adminStore'); ?>" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>-->
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
                                        <td><a href="<?php echo base_url('admin/storeCategorys/' . $category['category_id']); ?>" class="btnUrls storetabs" style="color: #4c66fb;"><?php echo $category['category_name']; ?></a></td>
                                        <td><?php echo $category['is_active']; ?></td>
                                        <td>
                                            <?php if ($category['is_active'] == 'Active') {
                                                ?>
                                                <a href="<?php echo base_url('admin/storeCategory/changeCategoryStatus/' . $category['category_id'] . '/Inactive'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Active <i class="fe fe-thumbs-up"></i></a>
                                                <?php
                                            } else {
                                                ?>
                                                <a href="<?php echo base_url('admin/storeCategory/changeCategoryStatus/' . $category['category_id'] . '/Active'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Inactive <i class="fe fe-thumbs-down"></i></a>
                                            <?php }
                                            ?>
                                            <a href="<?php echo base_url('admin/storeCategorys/' . $category['category_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Category" class="btn btn-success btn-sm storetabs">Edit <i class="fe fe-edit"></i></a>

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
    </div>
    <div class="col-4">
        <div class="card m-b-30">
            <div id="error_msg"></div>
            <div class="card-header">
                <h5 class="m-b-0">Add Category</h5>
            </div>
            <div class="card-body">
                <form method="post" id="common-form" action="<?php
                if (!empty($cat)) {
                    echo base_url('admin/doEditCategory/' . $cat['category_id']);
                } else {
                    echo base_url('admin/doAddCategory');
                }
                ?>">
                    <div class="form-group">
                        <label for="category_name">Category</label>
                        <?php echo form_input(['name' => 'category_name', 'id' => 'category_name', 'class' => 'form-control'], isset($cat['category_name']) ? $cat['category_name'] : '') ?>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
