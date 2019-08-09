<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <h5 class="m-b-0" style="padding-top: 5px">
                    User Listing
                </h5>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive p-t-10">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>UserName</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Source</th>
                        <th>Contact</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (!empty($users)) {

                        $i = 1;
                        foreach ($users as $user) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $user['user_name']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><?php echo $user['gender']; ?></td>
                                <td><?php echo $user['source']; ?></td>
                                <td><?php echo $user['phone']; ?></td>
                                <td>
								<?php if ($user['is_active'] == 'Active') {
                                        ?>
                                        <a href="<?php echo base_url('admin/doChangeUserStatus/' . $user['user_id'] . '/Inactive'); ?>" data-toggle="tooltip" data-placement="top"  title="Change Status To Inactive" class="btn btn-primary btn-sm change-status">Active <i class="fe fe-thumbs-up"></i></a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="<?php echo base_url('admin/doChangeUserStatus/' . $user['user_id'] . '/Active'); ?>" data-toggle="tooltip" data-placement="top" title="Change Status To Active" class="btn btn-primary btn-sm change-status change-status">Inactive <i class="fe fe-thumbs-down"></i></a>
                                        <?php }
                                        ?>
                                    <a href="<?php echo base_url('admin/add-registered-user/' . $user['user_id']); ?>" data-toggle="tooltip" data-placement="top" class="btn btn-success btn-sm" title="Edit User Detail">Edit  <i class="fe fe-edit"></i></a>
                                    <!--<a href="<?php echo base_url('admin/doDeleteUserById/' . $user['user_id']); ?>" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-sm delete" title="Delete User">Delete <i class="fe fe-delete"></i></a>-->
                                    <a href="<?php echo base_url('admin/user-change-password/') . $user['user_id']; ?>" title="Change Password" class="btn btn-info btn-sm change-password">Change Password <i class="fa fa-key" aria-hidden="true"></i></a>
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