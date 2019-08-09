<div class="row">
    <div class="col-8">
        <div class="table-responsive p-t-10">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Attribute Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($specifications)) {
                        $i = 1;
                        foreach ($specifications as $specification) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><a href="<?php  echo base_url('admin/AdminUserSpecification/get_all_specification_wrapper/' . $specification['group_id']); ?>" class="storetabs-edit btnUrls" style="color: #4c66fb;"><?php echo $specification['group_name']; ?></a></td>
                                <td><?php echo $specification['is_active']; ?></td>
                                <td>
                                    <a href="<?php  echo base_url('admin/AdminUserSpecification/get_all_specification_wrapper/' . $specification['group_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Specification" class="btn btn-success btn-sm storetabs-edit">Edit <i class="fe fe-edit"></i></a>
                                    <?php if ($specification['is_active'] == 'Active') {
                                        ?>
                                        <a href="<?php echo base_url('admin/user-specification/change_specification_status/' . $specification['group_id'] . '/Inactive'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Active <i class="fe fe-thumbs-up"></i></a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="<?php echo base_url('admin/user-specification/change_specification_status/' . $specification['group_id'] . '/Active'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Inactive <i class="fe fe-thumbs-down"></i></a>
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
    <div class="col-4">
        <div class="card m-b-30">
            <div id="error_msg"></div>
            <div class="card-header">
                <h5 class="m-b-0">Add Attribute</h5>
            </div>
            <div class="card-body">
                <form method="post" id="store-wrapper-common-form" action="<?php
                if (!empty($specifi)) {
                    echo base_url('admin/do-edit-specification/' . $specifi['group_id']);
                } else {
                    echo base_url('admin/do-add-specification');
                }
                ?>">
                    <div class="form-group">
                        <label for="category_name">Attribute</label>
                        <?php echo form_input(['name' => 'group_name', 'id' => 'group_name', 'class' => 'form-control'], isset($specifi['group_name']) ? $specifi['group_name'] : '') ?>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>