<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <h5 class="m-b-0" style="padding-top: 5px">
                    Courier Listing
                </h5>
            </div>
            <div class="col-2 offset-7">
                <a href="<?php echo base_url('admin/addCourier'); ?>" class="btn btn-primary">Add Courier</a>
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
                        <th>Courier Name</th>
                        <th>Country</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (!empty($couriers)) {

                        $i = 1;
                        foreach ($couriers as $courier) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><img src="<?php echo base_url('uploads/courier/' . $courier['image_url']); ?>" height="50" width="60" class="img-responsive"></td>
                                <td><?php echo $courier['first_name'] . ' ' . $courier['last_name']; ?></td>
                                <td><?php echo $courier['country']; ?></td>
                                <td><?php echo $courier['state']; ?></td>
                                <td><?php echo $courier['city']; ?></td>
                                <td><?php echo $courier['is_active']; ?></td>
                                <td>
								 <?php if ($courier['is_active'] == 'Active') {
                                        ?>
                                        <a href="<?php echo base_url('admin/changeCourierStatus/' . $courier['courier_id'] . '/Inactive'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Active <i class="fe fe-thumbs-up"></i></a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="<?php echo base_url('admin/changeCourierStatus/' . $courier['courier_id'] . '/Active'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Inactive <i class="fe fe-thumbs-down"></i></a>
                                        <?php }
                                        ?>
                                    <a href="<?php echo base_url('admin/addCourier/' . $courier['courier_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Courier" class="btn btn-success btn-sm">Edit <i class="fe fe-edit"></i></a>
                                    <a href="<?php echo base_url('admin/doDeleteCourier/' . $courier['courier_id']); ?>" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-sm delete" title="Delete Courier">Delete <i class="fe fe-delete"></i></a>
                                    <a href="<?php echo base_url('admin/courier-change-password/') . $courier['courier_id']; ?>" title="Change Password" class="btn btn-info btn-sm change-password">Change Password <i class="fa fa-key" aria-hidden="true"></i></a>
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