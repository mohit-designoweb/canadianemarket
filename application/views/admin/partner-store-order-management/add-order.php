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
                                    <address class="m-t-10">
                                        To,<br>
                                        <span class="h4 font-primary"><?php echo ucwords($user_info['first_name'])." ".ucwords($user_info['last_name']); ?></span> <br>
                                        <?php echo $user_info['address']; ?><br>
                                        <?php echo $user_info['address2']; ?> <br>
                                        <?php echo $user_info['phone']; ?> <br>

                                        <input type="hidden" id="user_lat" value="<?php echo $user_info['latitude']; ?>">
                                        <input type="hidden" id="user_lng" value="<?php echo $user_info['longitude']; ?>">
                                        <?php if (!empty($courierDetail)) { ?>
                                            <input type="hidden" id="courier_lat" value="<?php echo $courierDetail['latitude']; ?>">
                                            <input type="hidden" id="courier_lng" value="<?php echo $courierDetail['longitude']; ?>">
                                        <?php } ?>
                                            <?php if(!empty($order_detail1['order_prepared_time'])){?>
                                            <input type="hidden" id="partner-countdown" name="partner-countdown" value="">
                                            <?php }?>

                                    </address>
                                </div>
                                <div class="col-md-6" id="courier-wrapper" data-url="<?php echo base_url('partnerOrder/getCourierStatusWrapper/' . $order_id); ?>">
                                    
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
                                        <th>Item Detail</th>
                                        <th>Quantity</th>
                                        <th class="text-center">price</th>
                                        <!--<th class="text-center">Discount</th>
                                        <th class="text-right">Total</th>-->
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
                                                         src="<?php echo base_url('/uploads/product/' . $order_detail['product_image']); ?>" alt="">
                                                </div>
                                            </td>
                                            <td class="">
                                                <p class="text-black m-0"><?php echo $order_detail['product_name']; ?></p>

                                            </td>
                                            <td class="">
                                                <p class="text-black m-0"><?php echo $order_detail['sku']; ?></p>

                                            </td>
                                            <td class="">
                                                <p class="text-black m-0"><?php echo $order_detail['qty']; ?></p>

                                            </td>
                                            <td class="">
                                                <p class="text-black m-0">$<?php echo $order_detail['price']; ?></p>

                                            </td>
                                          
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    ?>
                                    <?php if (!empty($price_detail['tax'])) { ?>
                                        <tr>
                                            <td colspan="3" class="text-right">
                                                <b>Tax</b>
                                            </td>
                                            <td colspan="2" class="text-right">
                                                 <?php echo $price_detail['tax']." "; ?>%
                                            </td>
                                        </tr>
                                    <?php }if (!empty($price_detail['service_fee'])) { ?>

                                        <tr>
                                            <td colspan="3" class="text-right">
                                                <b>Service Fee</b>
                                            </td>
                                            <td colspan="2" class="text-right">
                                                $ <?php echo $price_detail['service_fee']; ?>
                                            </td>
                                        </tr>
                                       
                                        <?php
                                    } 
                                    ?>
                                    <?php if (!empty($price_detail['delivery_charge'])) { ?>

                                        <tr>
                                            <td colspan="3" class="text-right">
                                                <b>Delivery Charge</b>
                                            </td>
                                            <td colspan="2" class="text-right">
                                                $ <?php echo $price_detail['delivery_charge']; ?>
                                            </td>
                                        </tr>
                                    <?php } if (!empty($price_detail['credit_points'])) { ?>
                                        <tr>
                                            <td colspan="3" class="text-right">
                                                <b>Credit Points</b>
                                            </td>
                                            <td colspan="2" class="text-right">
                                                $ <?php echo $price_detail['credit_points']; ?>
                                            </td>
                                        </tr>
                                    <?php } if (!empty($price_detail['total_amount'])) { ?>

                                        <tr class="">
                                            <td colspan="3" class="text-right">
                                                <b> Total Amount</b>
                                            </td>
                                            <td colspan="2" class="text-right">
                                                $ <?php echo number_format($price_detail['total_amount'], 2); ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    
                                </tbody>
                            </table>
                        </div>
                        <?php if ($order_detail1['order_status'] == "Accepted") { ?>
                            <div id="dvMap" style="width:100%; height: 400px">
                            </div>
                        <?php } ?>
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