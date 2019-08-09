                                <?php if(!empty($return_store_orders)) {
                                    foreach($return_store_orders as $return_store_order){
                                ?>
                                <div class="orderitem boxs">
                                    <div class="orderdetails boxs">
                                        <div class="orderid">
                                            <a href="javascript:void(0)" class="slidehover"><?php if(!empty($return_store_order['order_unique_id'])){ echo $return_store_order['order_unique_id']; }?></a>
                                            <span class="redcolor"><?php if(!empty($return_store_order['status']) == 'Return'){ echo "Return"; }?></span>
                                        </div>
                                        <div class="orderhelp">
                                            <a href="javascript:void(0)"><img src="<?php echo base_url('assets');?>/img/help.png" alt="help" class="img-responsive">Need Help</a>
                                        </div>
                                    </div>
                                    <div class="bd_btm boxs"></div>
                                    <?php foreach($return_store_order['ordered_product'] as $ordered_product){ ?>
                                    <div class="cart_items lists_items boxs">
                                        <div class="item_img">
                                            <img src="<?php echo base_url('uploads/product/'.$ordered_product['image_url']);?>" alt="itemimg" class="img-responsive">
                                        </div>
                                        <div class="item_details">
                                            <div class="id_lft boxs">
                                                <h5><?php echo $ordered_product['product_name']; ?><span><?php echo $ordered_product['store_name']; ?></span></h5>
                                                <h6>
                                                <?php $i = 1; foreach($ordered_product['ordered_product_sku'] as $ordered_product_sku){ if($i ==1){ ?>
                                                <?php echo $ordered_product_sku['group_name'];?>: <span><?php echo $ordered_product_sku['group_value'];?></span>
                                                <?php } else{ ?>
                                                |<?php echo $ordered_product_sku['group_name'];?>: <span><?php echo $ordered_product_sku['group_value'];?></span>     
                                                <?php }$i++; } ?>
                                                </h6>
                                                <p class="deldeatil">$652 </p>
                                            </div>
                                            <div class="id_ryt boxs">
                                                <div class="productrate">
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target=".rate_review" id="rate_review"  data-url="<?php echo base_url('user/rateReview/'. $ordered_product['product_id']);?>" class="rateitem"><img src="<?php echo base_url('assets');?>/img/star.png" alt="star">Rate & Review Product</a>
<!--                                                    <a href="javascript:void(0)" class="cancelitem"><img src="<?php echo base_url('assets');?>/img/cross_red.png" alt="cross_red">Cancel</a>
                                                    <div class="returnbox">
                                                        <p>You will return within 10 days </p>
                                                        <a href="javascript:void(0)" class="cancelitem"><img src="<?php echo base_url('assets');?>/img/cross_red.png" alt="cross_red">Return Item</a>
                                                    </div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <p class="pull-right"><strong>Order Total: </strong><span><?php echo '$'.$return_store_order['total_amount'];?></span></p>
                                </div>
                                <?php }  } ?>
                                
                                <?php if(!empty($return_restaurant_orders)) {
                                    foreach($return_restaurant_orders as $return_restaurant_order){
                                ?>
                                <div class="orderitem boxs">
                                    <div class="orderdetails boxs">
                                        <div class="orderid">
                                            <a href="javascript:void(0)" class="slidehover"><?php if(!empty($return_restaurant_order['unique_order_id'])){ echo $return_restaurant_order['unique_order_id']; }?></a>
                                            <span class="redcolor"><?php if(!empty($return_restaurant_order['order_status']) == 'Return'){ echo "Return"; }?></span>
                                        </div>
                                        <div class="orderhelp">
                                            <a href="javascript:void(0)"><img src="<?php echo base_url('assets');?>/img/help.png" alt="help" class="img-responsive">Need Help</a>
                                        </div>
                                    </div>
                                    <div class="bd_btm boxs"></div>
                                    <?php foreach($return_restaurant_order['restaurant_menudetail'] as $restaurant_menudetail){ ?>
                                    <div class="cart_items lists_items boxs">
                                        <div class="item_img">
                                            <img src="<?php echo base_url('uploads/menu/'.$restaurant_menudetail['image_url']);?>" alt="itemimg" class="img-responsive">
                                        </div>
                                        <div class="item_details">
                                            <div class="id_lft boxs">
                                                <h5><?php echo $restaurant_menudetail['menu_name'];?><span><?php echo $return_restaurant_order['restaurant_name'];?></span></h5>
                                                <!--<h6>Color : <span>Blue, Brown</span> | Size : <span>6</span></h6>-->
                                                <p class="deldeatil"><?php echo '$'.$restaurant_menudetail['price'];?></p>
                                            </div>
                                            <div class="id_ryt boxs">
                                                <div class="productrate">
                                                     <a href="javascript:void(0)" class="rateitem" data-toggle="modal" id="restaurant_review"  data-target=".review" data-url="<?php echo base_url('user/restaurantReview/'. $restaurant_menudetail['menu_id']);?>" >Review Product</a>
<!--                                                    <a href="javascript:void(0)" class="cancelitem"><img src="<?php echo base_url('assets');?>/img/cross_red.png" alt="cross_red">Cancel</a>
                                                    <div class="returnbox">
                                                        <p>You will return within 10 days </p>
                                                        <a href="javascript:void(0)" class="cancelitem"><img src="<?php echo base_url('assets');?>/img/cross_red.png" alt="cross_red">Return Item</a>
                                                    </div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <p class="pull-right"><strong>Order Total: </strong><span><?php echo '$'.$return_restaurant_order['total_amount'];?></span></p>
                                </div>
                                <?php }  } ?>