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
                        <th>Restaurant Name</th>
                        <th>User Name</th>
                        <th>Address</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php 
                    //print_r($getRestaurantUserDetail); die;
                    if (!empty($getRestaurantUserDetail)) {
                        $i = 1;
                        foreach ($getRestaurantUserDetail as $order) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $order['restaurant_name']; ?></td>
                                <td><?php echo $order['first_name']." ".$order['last_name']; ?></td>
                                <td><?php echo $order['address']." ".$order['address2'] ; ?></td>
                                <td><?php echo number_format($order['total_amount'],2); ?></td>
                                <td><?php echo $order['order_date']; ?></td>
                                <td><?php echo $order['order_time']; ?></td>
                               
                                <td>
                                    <?php if($order['order_status'] == "AcceptedByCourier"){?>
                                   <!-- <a href="<?php echo base_url('courier/courierOrderDetail/' . $order['order_id']); ?>" data-toggle="tooltip" data-placement="top" title="View Order Detail" class="btn btn-info btn-sm">View Details <i class="fe fe-eye"></i></a>-->
                                    <a href="" class="btn btn-danger btn-sm" id="user-add-detail" data-dismiss="modal" data-toggle="modal" data-target="#user-address-detail" data-url="<?php echo base_url('courier/getuserAddress/'.$order['order_id']);?>">PARKED AT RESTAURANT</a>
                                    <?php }  if($order['order_status'] == "OrderFulfilled"){?>
                                    <a href="" class="btn btn-danger btn-sm" id="update-order-status" data-url="<?php echo base_url('courier/orderDelivered/'.$order['order_id']);?>">PARKED AT CUSTOMER</a>
                                        <?php } if($order['order_status']=="Delivered"){?>
                                     <a href="" class="btn btn-success btn-sm">Order Delivered</a>       
                                            <?php }if($order['order_status']=="Processing") {?>
                                    <!--<a href="<?php echo base_url('courier/courierOrderDetail/' . $order['order_id']); ?>" data-toggle="tooltip" data-placement="top" title="View Order Detail" class="btn btn-success btn-sm">Accept<i class="fe fe-check"></i></a>-->
                                    
                                    <a href="" class="btn btn-info btn-sm" id="address-detail" data-toggle="modal" data-target="#order-address-detail" data-url="<?php echo base_url('courier/getAddress/'.$order['order_id']);?>">View Details <i class="fe fe-eye"></i></a>
                                    <?php }?>

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

<div id="order-address-detail" class="modal fade register" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" id="address-div">
        <!-- Modal content-->
        
    </div>
</div>
<div id="restaurant-address-detail" class="modal fade register" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" id="res-address-div">
        <!-- Modal content-->
        
    </div>
</div>
<div id="user-address-detail" class="modal fade register" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" id="user-address-div">
        <!-- Modal content-->
        
    </div>
</div>