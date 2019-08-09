<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <h5 class="m-b-0" style="padding-top: 5px">
                    User Listing
                </h5>
            </div>
<!--            <div class="col-2 offset-7">
                <a href="<?php echo base_url('admin/addPartner'); ?>" class="btn btn-primary">add Partner</a>
            </div>-->
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive p-t-10">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>User Name</th>
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
                                <td><?php echo $user['phone'];?></td>
                                
                                <td>
								<?php if ($user['is_active'] == 'Active') {
                                        ?>
                                        <a href="<?php echo base_url('admin/doChangeUserStatus/' . $user['user_id'] . '/Inactive'); ?>" data-toggle="tooltip" data-placement="top" title="Change Status To Inactive" class="btn btn-primary btn-sm change-status">Active <i class="fe fe-thumbs-up"></i></a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="<?php echo base_url('admin/doChangeUserStatus/' . $user['user_id'] . '/Active'); ?>" data-toggle="tooltip" data-placement="top" title="Change Status To Active" class="btn btn-primary btn-sm change-status">Inactive <i class="fe fe-thumbs-down"></i></a>
                                        <?php }
                                        ?>
                                    <a href="<?php echo base_url('admin/add-user/' . $user['user_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit User Detail" class="btn btn-success btn-sm">Edit <i class="fe fe-edit"></i></a>
                                    <a href="<?php echo base_url('admin/doDeleteUserById/' . $user['user_id']); ?>" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-sm delete" title="Delete User">Delete <i class="fe fe-trash"></i></a>
                                    
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