<div class="ship_lft boxs myacc_ryt or_his_ryt">
    <h3>Auto Re-order</h3>

    <div class="mar_top boxs" >

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
										    
                                            <a href="javascript:void(0)" data-url="<?php echo base_url('user/product_reorder/'. $complete_store_order['order_unique_id']);?>" data-toggle="modal" data-target=".store_product_reorder" class="store_product_reorder"><img src="<?php echo base_url('public/image/auto-reorder.png');?>" alt="help" class="img-responsive" height="30px" width="30px">Reorder</a>
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
                                                <h6>
                                                <?php $i = 1; foreach($ordered_product['ordered_product_sku'] as $ordered_product_sku){ if($i ==1){ ?>
                                                <?php echo $ordered_product_sku['group_name'];?>: <span><?php echo $ordered_product_sku['group_value'];?></span>
                                                <?php } else{ ?>
                                                |<?php echo $ordered_product_sku['group_name'];?>: <span><?php echo $ordered_product_sku['group_value'];?></span>     
                                                <?php }$i++; } ?>
                                                </h6>
                                                <p class="deldeatil"><?php echo "$".$ordered_product['price']; ?></p>
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
										    
                                            <a href="javascript:void(0)" data-url="<?php echo base_url('user/restaurant_reorder/'. $complete_restaurant_order['unique_order_id']);?>" data-toggle="modal" data-target=".restaurant_reorder" class="restaurant_reorder"><img src="<?php echo base_url('public/image/auto-reorder.png');?>" alt="help" class="img-responsive" height="30px" width="30px" >Reorder</a>
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
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <p class="pull-right"><strong>Order Total: </strong><span><?php echo '$'.$complete_restaurant_order['total_amount'];?></span></p>
                                </div>
                                <?php } } ?>
            
       

    </div>
</div>


<!-- Modal -->
  <div class="modal fade store_product_reorder" id="store_product_reorder" role="dialog">
    <div class="modal-dialog" id="product_reorders">
   
    </div>
  </div>

<!-- Modal -->
  <div class="modal fade restaurant_reorder" id="restaurant_reorder" role="dialog">
    <div class="modal-dialog" id="restaurant_reorders">
          
    </div>
  </div>