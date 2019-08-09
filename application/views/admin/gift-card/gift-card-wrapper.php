<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <h5 class="m-b-0" style="padding-top: 5px">
                    Restaurant Listing
                </h5>
            </div>
<!--            <div class="col-2 offset-7">
                <a href="<?php echo base_url('admin/addRestaurant'); ?>" class="btn btn-primary">add Restaurant</a>
            </div>-->
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive p-t-10">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Receiver Name</th>
                        <th>Address</th>
                        <th>Card value</th>
                        <th>Gifter Name</th>
                       
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    //print_r($restaurants);
                    if (!empty($gifts)) {
                        $i = 1;
                        foreach ($gifts as $gift) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $gift['receiver_name'];?></td>
                                <td><?php echo $gift['address']; ?></td>
                                <td><?php echo $gift['card_value']; ?></td>
                                <td><?php echo $gift['gifter_name']; ?></td>
                                <td>
                                    
                                    <a href="<?php echo base_url('admin/doDeleteGiftCard/' . $gift['gift_card_id']); ?>" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-sm delete" title="Delete Gift Card">Delete<i class="fe fe-trash"></i></a>
                                  
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