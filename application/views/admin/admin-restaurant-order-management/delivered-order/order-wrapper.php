
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <h5 class="m-b-0" style="padding-top: 5px">
                    Delivered Order
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
                        <th>Restaurant Name</th>
                        <th>User Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
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
                                <td><?php echo $order['restaurant_name']; ?></td>
                                <td><?php echo $order['user_name']; ?></td>
                                <td><?php echo $order['order_date']; ?></td>
                                <td><?php echo $order['order_time']; ?></td>
                                <td><?php echo $order['order_status']; ?></td>
                                <td>
                                    <a href="<?php echo base_url('admin/viewOrderDetail/' . $order['order_id']."/".$order['restaurant_id']); ?>" data-toggle="tooltip" data-placement="top" title="View Order Detail"><i class="fe fe-eye"></i></a>

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