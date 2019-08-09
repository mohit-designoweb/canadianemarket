                                <?php if(!empty($complete_store_orders)) {
                                    foreach($complete_store_orders as $complete_store_order){
                                ?>

                                <div class="orderitem boxs">
                                    <div class="orderdetails boxs">
                                        <div class="orderid">
                                            <a href="javascript:void(0)" class="slidehover"><?php if(!empty($complete_store_order['order_unique_id'])){ echo $complete_store_order['order_unique_id']; }?></a>
                                            <span class="redcolor"><?php if(!empty($complete_store_order['status']) == 'Delivered'){ echo $complete_store_order['status']; }?></span>
                                        </div>
                                        <div class="orderhelp">
                                            <a href="javascript:void(0)"><img src="<?php echo base_url('assets');?>/img/help.png" alt="help" class="img-responsive">Need Help</a>
                                        </div>
                                    </div>
                                    <div class="bd_btm boxs"></div>
                                    <?php foreach($complete_store_order['ordered_product'] as $ordered_product){ ?>
                                    <div class="cart_items boxs mgbtm">
                                        <div class="item_img">
                                            <img src="<?php echo base_url('uploads/product/'.$ordered_product['image_url']);?>" alt="itemimg" class="img-responsive">
                                        </div>
                                        <div class="item_details">
                                            <div class="id_lft boxs">
                                                <h5><?php echo $ordered_product['product_name']; ?><span><?php echo $ordered_product['store_name']; ?></span></h5>
                                                 <?php $dbdate=strtotime($complete_store_order['order_date'],$complete_store_order['order_time']);?>
                                                    <?php $localdate = date('d-m-Y H:i:s');
                                                    
                                                        $currdate=strtotime($localdate);
                                                        $diff = abs($currdate - $dbdate);

                                                        $years = floor($diff / (365*60*60*24));
                                                        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                                      $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
													?>
												<h6>
                                                <?php $i = 1; foreach($ordered_product['ordered_product_sku'] as $ordered_product_sku){ if($i ==1){ ?>
                                                <?php echo $ordered_product_sku['group_name'];?>: <span><?php echo $ordered_product_sku['group_value'];?></span>
                                                <?php } else{ ?>
                                                |<?php echo $ordered_product_sku['group_name'];?>: <span><?php echo $ordered_product_sku['group_value'];?></span>     
                                                <?php }$i++; } ?>
                                                </h6>
                                                <p class="deldeatil"><?php echo "$".$ordered_product['price']; ?></p>
                                            </div>
                                            <div class="id_ryt boxs">
                                                <div class="productrate">
                                                   <a href="javascript:void(0)" data-toggle="modal" data-target=".rate_review" id="rate_review"  data-url="<?php echo base_url('user/rateReview/'. $ordered_product['product_id']);?>" class="rateitem"><img src="<?php echo base_url('assets');?>/img/star.png" alt="star">Rate & Review Product</a>
                                                    <?php if($days <= 10){ ?>
                                                   <div class="returnbox">
                                                        <p>You will return within 10 days </p>
                                                        <a href="<?php echo base_url('user/return_order/').$ordered_product['product_id'].'/'.$user_data['user_id'];?>" class="return_item"><img src="<?php echo base_url('assets');?>/img/cross_red.png" alt="cross_red">Return Item</a>
                                                    </div>
                                                   <?php }else{ echo ""; }?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <p class="pull-right"><strong>Order Total: </strong><span><?php echo '$'.$complete_store_order['total_amount'];?></span></p>
                                </div>
                                <?php }  } ?>
                                 
                                <?php if(!empty($complete_restaurant_orders)) { 
                                    foreach($complete_restaurant_orders as $complete_restaurant_order){
                                ?>
                                <div class="orderitem boxs">
                                    <div class="orderdetails boxs">
                                        <div class="orderid">
                                            <a href="javascript:void(0)" class="slidehover"><?php if(!empty($complete_restaurant_order['unique_order_id'])){ echo $complete_restaurant_order['unique_order_id']; }?></a>
                                            <span class="redcolor"><?php if(!empty($complete_restaurant_order['order_status']) == 'Delivered'){ echo $complete_restaurant_order['order_status']; }?></span>
                                        </div>
                                        <div class="orderhelp">
                                            <a href="javascript:void(0)"><img src="<?php echo base_url('assets');?>/img/help.png" alt="help" class="img-responsive">Need Help</a>
                                        </div>
                                    </div>
                                    <div class="bd_btm boxs"></div>
                                    <?php foreach($complete_restaurant_order['restaurant_menudetail'] as $restaurant_menudetail){ ?>
                                    <div class="cart_items boxs mgbtm">
                                        <div class="item_img">
                                            <img src="<?php echo base_url('uploads/menu/'.$restaurant_menudetail['image_url']);?>" alt="itemimg" class="img-responsive">
                                        </div>
                                        <div class="item_details">
                                            <div class="id_lft boxs">
                                                <h5><?php echo $restaurant_menudetail['menu_name'];?><span><?php echo $complete_restaurant_order['restaurant_name'];?></span></h5>
                                                <!--<h6>Color : <span>Blue, Brown</span> | Size : <span>6</span></h6>-->
                                                <p class="deldeatil"><?php echo '$'.$restaurant_menudetail['price'];?></p>
                                            </div>
											<?php  $dbdate=strtotime($complete_restaurant_order['order_date'],$complete_restaurant_order['order_time']);
                                                 
                                                        $diff = abs($currdate - $dbdate);

                                                    $years = floor($diff / (365*60*60*24));
                                                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                                ?>   
											
                                            <div class="id_ryt boxs">
                                                <div class="productrate">
                                                    <a href="javascript:void(0)" class="rateitem" data-toggle="modal" id="restaurant_review"  data-target=".review" data-url="<?php echo base_url('user/restaurantReview/'. $complete_restaurant_order['restaurant_id']);?>" >Review Product</a>
                                                    <?php if($days <= 10){ ?>
                                                   <div class="returnbox">
                                                        <p>You will return within 10 days </p>
                                                        <a href="<?php echo base_url('user/return_order_restaurant/').$complete_restaurant_order['restaurant_id'].'/'.$user_data['user_id'];?>" class="return_item"><img src="<?php echo base_url('assets');?>/img/cross_red.png" alt="cross_red">Return Item</a>
                                                    </div>
                                                   <?php }else{ echo ""; }?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <p class="pull-right"><strong>Order Total: </strong><span><?php echo '$'.$complete_restaurant_order['total_amount'];?></span></p>
                                </div>
                                <?php } } ?>