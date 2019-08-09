<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <h5 class="m-b-0" style="padding-top: 5px">
                    Partner Listing
                </h5>
            </div>
            <div class="col-2 offset-7">
                <a href="<?php echo base_url('admin/addPartner'); ?>" class="btn btn-primary">Add Partner</a>
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
                        <th>Partner Name</th>
                        <th>Country</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (!empty($partners)) {

                        $i = 1;
                        foreach ($partners as $partner) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><img src="<?php echo base_url('uploads/partner/' . $partner['image_url']); ?>" class="img-responsive" height="70px" width="80px"></td>
                                <td><?php echo $partner['first_name'] . ' ' . $partner['last_name']; ?></td>
                                <td><?php echo $partner['country']; ?></td>
                                <td><?php echo $partner['state']; ?></td>
                                <td><?php echo $partner['city']; ?></td>
                                <td><?php echo $partner['is_active']; ?></td>
                                <td>
								<?php if ($partner['is_active'] == 'Active') {
                                        ?>
                                        <a href="<?php echo base_url('admin/changePartnerStatus/' . $partner['partner_id'] . '/Inactive'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Active <i class="fe fe-thumbs-up"></i></a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="<?php echo base_url('admin/changePartnerStatus/' . $partner['partner_id'] . '/Active'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Inactive <i class="fe fe-thumbs-down"></i></a>
                                    <?php }
                                    ?>
                                    <a href="<?php echo base_url('admin/partnerSection/addPartner/' . $partner['partner_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Store" class="btn btn-success btn-sm">Edit <i class="fe fe-edit"></i></a>
                                    
                                    <a href="<?php echo base_url('admin/partner-change-password/') . $partner['partner_id']; ?>" title="Change Password" class="btn btn-info btn-sm change-password">Change Password <i class="fa fa-key" aria-hidden="true"></i></a>
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
