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
                                            <td class="text-center" >$<?php echo $total_price; ?></td>
                                            <!--<td class="text-center"><?php //echo $item['discount'];    ?>%</td>-->
                                           <!-- <td class="text-right">$<?php //$discount = ($item['price']*$item['discount'])/100;                              echo $fimal_price = $item['price']-$discount;    ?></td>-->
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
                                            <?php echo $order_detail['tax'];?> 
                                        </td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td colspan="3" class="text-right">
                                            <b>Service Fee</b>
                                        </td>
                                        <td colspan="2" class="text-right">
                                            <?php echo $order_detail['service_fee'];?>
                                        </td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td colspan="3" class="text-right">
                                            <b>Delivery Charges</b>
                                        </td>
                                        <td colspan="2" class="text-right">
                                             <?php echo $order_detail['delivery_charge'];?>
                                        </td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td colspan="3" class="text-right">
                                            <b>Grand Total</b>
                                        </td>
                                        <td colspan="2" class="text-right">
                                             <?php $price =str_replace(',','',strtok($order_detail['sub_total'], '.')) - $order_detail['discount_price']; 
											
											 ?>
                                            $ <?php echo $grand_total = number_format($price + $order_detail['tax'] + $order_detail['service_fee'] + $order_detail['delivery_charge'], 2); ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                         <?php if($order_detail1['order_status']=="Accepted"){?>
                        <div id="dvMap" style="width:100%; height: 400px">
                    </div>
                         <?php }?>
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