<div class="card">
    <div class="card-header">
        <h5 class="m-b-0">Shop Section</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive p-t-10">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Shop Section Name</th>
                        <th>Store Name</th>
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
                                <td><?php echo $shop['shop_section_name']; ?></td>
                                <td><?php echo $shop['store_name']; ?></td>
                                <td><?php echo $shop['is_active']; ?></td>
                                <td>
                                    <?php if($user_type=='admin'){
                                        $edit_url=base_url('admin/shop-section/' . $shop['shop_section_id']);
                                    }else if($user_type=='partner'){
                                        $edit_url=base_url('partner/shop-section/' . $shop['shop_section_id']);
                                    } ?>
                                    <a href="<?php echo $edit_url; ?>" data-toggle="tooltip" data-placement="top" title="Edit Category"><i class="fe fe-edit"></i></a>
                                    <?php
                                    if ($shop['is_active'] == 'Active') {
                                        ?>
                                        <a href="<?php echo base_url('admin/changeShopSectionStatus/' . $shop['shop_section_id'] . '/Inactive'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="change-status"><i class="fe fe-thumbs-up"></i></a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="<?php echo base_url('admin/changeShopSectionStatus/' . $shop['shop_section_id'] . '/Active'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="change-status"><i class="fe fe-thumbs-down"></i></a>
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