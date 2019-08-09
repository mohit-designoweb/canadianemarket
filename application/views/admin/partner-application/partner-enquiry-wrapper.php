<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <h5 class="m-b-0" style="padding-top: 5px">
                    Partner Enquiry Listing
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
                        <!--<th>Image</th>-->
                        <th>Partner Name</th>
                        <th>Country</th>
                        <th>State</th>
                        <th>City</th>
                        <!--<th>Status</th>-->
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
                                <!--<td><img src="<?php echo base_url('uploads/partner/' . $partner['image_url']); ?>" class="img-responsive"></td>-->
                                <td><?php echo $partner['first_name'] . ' ' . $partner['last_name']; ?></td>
                                <td><?php echo $partner['country']; ?></td>
                                <td><?php echo $partner['state']; ?></td>
                                <td><?php echo $partner['city']; ?></td>
                                <!--<td><?php echo $partner['is_active']; ?></td>-->
                                <td>
                                    <a href="<?php echo base_url('admin/viewPartnerEnquiry/' . $partner['partner_query_id']); ?>" data-toggle="tooltip" data-placement="top" title="View More" class="btn btn-info btn-sm">View Details <i class="fe fe-edit"></i></a>
                                    
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