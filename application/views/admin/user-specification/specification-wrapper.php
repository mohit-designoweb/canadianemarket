<div class="card">
    <div class="card-header">
        <h5 class="m-b-0">
            Attribute Listing
        </h5>
    </div>
    <div class="card-body">
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
                                <td><?php echo $specification['group_name']; ?></td>
                                <td><?php echo $specification['is_active']; ?></td>
                                <td>
                                    <a href="<?php  echo base_url('admin/user-specification/' . $specification['group_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Specification" class="btn btn-success btn-sm">Edit <i class="fe fe-edit"></i></a>
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
</div>