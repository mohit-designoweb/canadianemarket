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
            <div class="row" >
                <div class="col-md-12 m-b-40">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="assets/img/logos/nytimes.jpg" width="60" class="rounded-circle"
                                         alt="">
                                    <address class="m-t-10">
                                        To,<br>
                                        <span class="h4 font-primary"><?php echo ucwords($user_info['user_name']); ?></span> <br>
                                        <?php echo $user_info['address1']; ?><br>
                                        <?php echo $user_info['address2']; ?> <br><br><hr>
                                        <input type="hidden" id="user_lat" value="<?php echo $user_info['latitude']; ?>">
                                        <input type="hidden" id="user_lng" value="<?php echo $user_info['longitude']; ?>">
                                        <?php if(!empty($user['latitude']) && (!empty($user['longitude'])))
                                        { ?>
                                        <input type="hidden" id="courier_lat" value="<?php echo $user['latitude'];?>"> 
                                        <input type="hidden" id="courier_lng" value="<?php echo $user['longitude'];?>">
                                        <?php } ?>
                                        <?php echo "Allot Date: " . $courierOrderMappingDetail['order_date']; ?><br>
                                        <?php echo "Allot Time: " . $courierOrderMappingDetail['order_time']; ?>

                                    </address>
                                </div>
                                <div class="col-md-6" data-url="<?php echo base_url('courier/get-courier-wrapper/'.$order_id); ?>" id="courier-order-wrapper">
                                    
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
                                        <th class="text-center">price</th>
                                        <!--<th class="text-center">Discount</th>
                                        <th class="text-right">Total</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($menu as $item) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td class="align-middle">
                                                <div class="avatar avatar-xs ">
                                                    <img class="rounded-circle avatar-img"
                                                         src="<?php echo base_url('/uploads/menu/' . $item['image_url']); ?>" alt="">
                                                </div>
                                            </td>
                                            <td class="">
                                                <p class="text-black m-0"><?php echo $item['menu_name']; ?></p>

                                            </td>
                                            <?php
                                            if (!empty($item['discount'])) {
                                                $price = $item['price'];
                                                $discount = $item['discount'];
                                                $discounted_price = round(($price * $discount) / 100, 1);
                                                $total_price = $price - $discounted_price;
                                            } else {
                                                $total_price = $item['price'];
                                            }
                                            ?>
                                            <td class="text-center">$<?php echo $total_price; ?></td>
                                            <!--<td class="text-center"><?php //echo $item['discount'];       ?>%</td>-->
                                           <!-- <td class="text-right">$<?php //$discount = ($item['price']*$item['discount'])/100;                              echo $fimal_price = $item['price']-$discount;       ?></td>-->
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    ?>
                                    <?php if (!empty($order_detail['sub_total'])) { ?>
                                        <tr>
                                            <td colspan="3" class="text-right">
                                                <b>Sub Total</b>
                                            </td>
                                            <td colspan="2" class="text-right">
                                                $ <?php echo $price = $order_detail['sub_total']; ?>
                                            </td>
                                        </tr>
                                    <?php }if (!empty($order_detail['sub_total']) && !empty($order_detail['discount_price'])) { ?>

                                        <tr>
                                            <td colspan="3" class="text-right">
                                                <b>Discount(10%)</b>
                                            </td>
                                            <td colspan="2" class="text-right">
                                                $ <?php echo $order_detail['discount_price']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right">
                                                <b>Price After Discounted</b>
                                            </td>
                                            <td colspan="2" class="text-right">
                                                $ <?php echo $price = number_format(str_replace(',', '', strtok($order_detail['sub_total'], '.')) - $order_detail['discount_price'], 2); ?>
                                            </td>
                                        </tr>
                                        <?php
                                    } else {
                                        $price = str_replace(',', '', strtok($order_detail['sub_total'], '.'));
//                                     
                                    }
                                    ?>


                                    <?php if (!empty($order_detail['tax'])) { ?>

                                        <tr>
                                            <td colspan="3" class="text-right">
                                                <b>Tax</b>
                                            </td>
                                            <td colspan="2" class="text-right">
                                                $ <?php echo $order_detail['tax']; ?>
                                            </td>
                                        </tr>
                                    <?php } if (!empty($order_detail['service_fee'])) { ?>
                                        <tr>
                                            <td colspan="3" class="text-right">
                                                <b>Service Fee</b>
                                            </td>
                                            <td colspan="2" class="text-right">
                                                $ <?php echo $order_detail['service_fee']; ?>
                                            </td>
                                        </tr>
                                    <?php } if (!empty($order_detail['delivery_charge'])) { ?>

                                        <tr class="">
                                            <td colspan="3" class="text-right">
                                                <b> Delivery Charges</b>
                                            </td>
                                            <td colspan="2" class="text-right">
                                                $ <?php echo number_format($order_detail['delivery_charge'], 2); ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr class="bg-light">
                                        <td colspan="3" class="text-right">
                                            <b>Grand Total</b>
                                        </td>
                                        <td colspan="2" class="text-right">
                                            $ <?php echo $grand_total = number_format($price + $order_detail['tax'] + $order_detail['service_fee'] + $order_detail['delivery_charge'], 2); ?>
                                        </td>
                                    </tr>
                                    <?php if (!empty($order_detail['tip'])) { ?>
                                        <tr class="bg-light">
                                            <td colspan="3" class="text-right">
                                                <b>Tip</b>
                                            </td>
                                            <td colspan="2" class="text-right">
                                                $ <?php echo $order_detail['tip']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="dvMap" style="width: 1100px; height: 400px">
                        </div>
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