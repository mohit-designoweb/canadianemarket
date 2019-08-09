<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4>Order Detail</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="pull-up">
        <div class="container" id="printableArea">
            <div class="row"  >
                <div class="col-md-12 m-b-40">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="assets/img/logos/nytimes.jpg" width="60" class="rounded-circle"
                                         alt="">
                                    <?php //print_r($user_info); die;?>
                                    <address class="m-t-10">
                                        To,<br>
                                        <span class="h4 font-primary"><?php echo ucwords($user_info['user_name']); ?></span> <br>
                                        <?php echo $user_info['address1']; ?><br>
                                        <?php echo $user_info['address2']; ?> <br>
                                       
                                        <input type="hidden" id="user_lat" value="<?php echo $user_info['latitude'];?>">
                                        <input type="hidden" id="user_lng" value="<?php echo $user_info['longitude'];?>">
                                       <?php if(!empty($courierDetail)){?>
                                        <input type="hidden" id="courier_lat" value="<?php echo $courierDetail['latitude'];?>">
                                        <input type="hidden" id="courier_lng" value="<?php echo $courierDetail['longitude'];?>">
                                       <?php }?>

                                    </address>
                                </div>
                                

                            </div>
                        </div>

                        <div class="table-responsive"  border="1">
                            <table class="table m-t-50">
                                <thead>
                                    <tr>
                                        <th class="">Sr. No.</th>
                                        <th class="">Item Image</th>
                                        <th class="">Item Name</th>
										<th class="text-center">SKU</th>
										<th class="text-center">Quantity</th>
                                        <th class="text-center">price</th>
										
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($order_details as $order_detail) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td class="align-middle">
                                                <div class="avatar avatar-xs ">
                                                    <img class="rounded-circle avatar-img"
                                                         src="<?php echo base_url('/uploads/menu/' . $order_detail['image_url']); ?>" alt="">
                                                </div>
                                            </td>
                                            <td class="">
                                                <p class="text-black m-0"><?php echo $order_detail['product_name']; ?></p>

                                            </td>
                                            <td class="text-center"><?php echo $order_detail['sku']; ?></td>
                                            <td class="text-center"><?php echo $order_detail['qty']; ?></td>
											<td class="text-center"><?php echo $order_detail['price']*$order_detail['qty']; 
											
											?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    ?>
                                    <tr class="bg-light">
                                        <td colspan="3" class="text-right">
                                            <b>Tax</b>
                                        </td>
                                        <td colspan="2" class="text-right">
                                            
                                            $ <?php echo $price_detail['tax']; ?>
                                        </td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td colspan="3" class="text-right">
                                            <b>Service Fee</b>
                                        </td>
                                        <td colspan="2" class="text-right">
                                            
                                            $ <?php echo $price_detail['service_fee']; ?>
                                        </td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td colspan="3" class="text-right">
                                            <b>Delivery Charges</b>
                                        </td>
                                        <td colspan="2" class="text-right">
                                            
                                            $ <?php echo $price_detail['delivery_charge']; ?>
                                        </td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td colspan="3" class="text-right">
                                            <b>tip</b>
                                        </td>
                                        <td colspan="2" class="text-right">
                                            
                                            $ <?php echo $price_detail['tip']; ?>
                                        </td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td colspan="3" class="text-right">
                                            <b>Grand Total</b>
                                        </td>
                                        <td colspan="2" class="text-right">
                                            
                                            $ <?php echo $price_detail['total_amount']; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                         <?php //if($order_detail1['order_status']=="Accepted"){?>
                       <!-- <div id="dvMap" style="width:100%; height: 400px">
                    </div>-->
                         <?php //}?>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
</div>
</div>
</section>

</main>