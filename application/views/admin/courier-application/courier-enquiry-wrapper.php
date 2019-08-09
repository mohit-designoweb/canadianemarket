<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <h5 class="m-b-0" style="padding-top: 5px">
                    Courier Enquiry Listing
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
                        <th>Courier Name</th>
                        <th>Country</th>
                        <th>State</th>
                        <th>City</th>
                        <!--<th>Status</th>-->
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (!empty($couriers_enquiry)) {

                        $i = 1;
                        foreach ($couriers_enquiry as $courier_enquiry) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $courier_enquiry['first_name'] . ' ' . $courier_enquiry['last_name']; ?></td>
                                <td><?php echo $courier_enquiry['country']; ?></td>
                                <td><?php echo $courier_enquiry['state']; ?></td>
                                <td><?php echo $courier_enquiry['city']; ?></td>
                                <td>
                                    <a href="<?php echo base_url('admin/viewCourierEnquiry/' . $courier_enquiry['courier_query_id']); ?>" data-toggle="tooltip" data-placement="top" title="View More" class="btn btn-info btn-sm">View More <i class="fe fe-eye"></i></a>
                                    
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