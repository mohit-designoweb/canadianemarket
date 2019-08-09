<div class="row">
    <div class="col-8">
        <div class="card">
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
                            if (!empty($shop_sections)) {
                                $i = 1;
                                foreach ($shop_sections as $shop) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><a class="btnUrls storetabs-edit" href="<?php echo base_url('admin/adminStore/manage_shop_wrapper/' . $shop['store_id'] . '/' . $shop['shop_section_id']); ?>" style="color: #4c66fb;"><?php echo $shop['shop_section_name']; ?></a></td>
                                        <td><?php echo $shop['is_active']; ?></td>
                                        <td>

                                            <a href="<?php echo base_url('admin/adminStore/manage_shop_wrapper/' . $shop['store_id'] . '/' . $shop['shop_section_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Category" class="btn btn-success btn-sm storetabs-edit"> Edit <i class="fe fe-edit"></i></a>
                                            <?php
                                            if ($shop['is_active'] == 'Active') {
                                                ?>
                                                <a href="<?php echo base_url('admin/changeShopSectionStatus/' . $shop['shop_section_id'] . '/Inactive'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="change-status btn btn-primary btn-sm change-status"> Active <i class="fe fe-thumbs-up"></i></a>
                                                <?php
                                            } else {
                                                ?>
                                                <a href="<?php echo base_url('admin/changeShopSectionStatus/' . $shop['shop_section_id'] . '/Active'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="change-status btn btn-primary btn-sm change-status"> Inactive <i class="fe fe-thumbs-down"></i></a>
                                            <?php }
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
    </div>
    <div class="col-4">
        <div class="card m-b-30">
            <div id="error_msg"></div>
            <div class="card-header">
                <h5 class="m-b-0"><?php  if (!empty($shop_section)) { echo "Edit";} else { echo "Add"; } ?> Category Section</h5>
            </div>
            <div class="card-body">
                <form method="post" id="store-wrapper-common-form" action="<?php
                if (!empty($shop_section)) {
                    echo base_url('admin/doEditShopSection/' . $shop_section['shop_section_id']);
                } else {
                    echo base_url('admin/doAddShopSection');
                }
                ?>">
                    <div class="form-group">
                        <label for="shop_section_name">Shop Section Name</label>
                        <?php echo form_input(['name' => 'shop_section_name', 'id' => 'shop_section_name', 'class' => 'form-control'], isset($shop_section['shop_section_name']) ? $shop_section['shop_section_name'] : '') ?>
                        <input type="hidden" name="store_id" value="<?php echo $store_id; ?>">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>