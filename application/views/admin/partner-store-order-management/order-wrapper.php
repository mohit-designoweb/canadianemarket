<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <h5 class="m-b-0" style="padding-top: 5px">
                    Order Listing
                </h5>
            </div>
            <!--            <div class="col-2 offset-7">
                            <a href="<?php echo base_url('admin/addMarketProduct'); ?>" class="btn btn-primary">Add Product</a>
                        </div>-->
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive p-t-10">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Store Name</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Time</th>
                        
                        <th>Action</th>
                     
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (!empty($orders)) {
                        $i = 1;
                        foreach ($orders as $order) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $order['store_name']; ?></td>
                                <td><?php echo $order['total_amount']; ?></td>
                                <td><?php echo $order['order_date']; ?></td>
                                <td><?php echo $order['order_time']; ?></td>
                               
                                <td>
                                   
                                    <a href="<?php echo base_url('partnerOrder/viewStoreOrderDetail/' . $order['order_unique_id']); ?>" data-toggle="tooltip" data-placement="top" title="View Order Detail" class="btn btn-info btn-sm">View Details <i class="fe fe-eye"></i></a>
                                   
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