<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <h5 class="m-b-0" style="padding-top: 5px">
                    Restaurant Delivery Charges listing
                </h5>
            </div>
            <!--<div class="col-2 offset-7">
                <a href="<?php echo base_url('admin/addStoreDeliveryCharges'); ?>" class="btn btn-primary">Add Store Delivery Charges</a>
            </div>-->
        </div>
    </div>
    <div class="card-body">

        <div class="table-responsive p-t-10">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Restaurant distance</th>
                        <th>Base fare</th>
                        <th>Extra charges</th>
                        <th>Action</th>
                        

                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (!empty($charges)) {

                        $i = 1;
                        
                        foreach ($charges as $charge) {    
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                
                                <td><?php echo $charge['restaurant_distance']; ?></td>
                                <td><?php echo $charge['base_charge']; ?></td>
                                <td><?php echo $charge['extra_charge']; ?></td>
                                
                                <td>
                                   
                                    <a href="<?php echo base_url('admin/addRestaurantDeliveryCharges/' . $charge['restaurant_delivery_charges_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Store delivery Charges" class="btn btn-success btn-sm">Edit <i class="fe fe-edit"></i></a>
                                    
                                    
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