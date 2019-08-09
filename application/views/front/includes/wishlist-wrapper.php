<div class="ship_lft boxs myacc_ryt res_myaccpa">
    <?php $resto = count($resturant_wishlists);$store = count($storeproduct_wishlists);?>
    <h3>Wishlists (<?php echo ($resto+$store);?>)</h3>
    <div class="row">
        <div class="col-sm-12">
            <div class="ship_lft boxs cart_lft">
                <div class="cartlist boxs">
                <div class="bd_btm boxs"></div>
                <?php if(!empty($resturant_wishlists)){ 
                    foreach($resturant_wishlists as $resturant_wishlists){?>    
                    <div class="cart_items boxs">
                        <div class="item_img">
                            <img src="<?php echo base_url('uploads/restaurant/'.$resturant_wishlists['image_url']);?>" alt="itemimg" class="img-responsive">
                        </div>
                        <div class="item_details">
                            <div class="id_lft boxs">
                                <a href="<?php echo base_url('restaurant/'.str_replace(' ','-',$resturant_wishlists['restaurant_name'])); ?>"><h5><?php echo $resturant_wishlists['restaurant_name'];?></h5></a>
                                <h6><?php echo $resturant_wishlists['address'];?></h6>
                                <h6><?php echo $resturant_wishlists['speciality'];?></h6>
                                <p style="font-size:16px;"><?php if(!empty($resturant_wishlists['opening_time_from'])){ ?>Open: <?php echo $resturant_wishlists['opening_time_from'].'AM'; } ?>
                                    <span class="d_off"><?php if(!empty($resturant_wishlists['opening_time_to'])){ ?>Close: <?php echo $resturant_wishlists['opening_time_to'].'PM'; } ?></span></p>
                            </div>
                            
                        </div>
                        <a href="<?php echo base_url('user/removeRestaurantItemFromWishlist/'.$resturant_wishlist['id']); ?>" class="removeitem removeWishlist">Remove</a>
                        <div class="bd_btm boxs"></div>
                    </div>
                    <?php } } ?> 
                    <?php if(!empty($storeproduct_wishlists)){ 
                         foreach($storeproduct_wishlists as $storeproduct_wishlist){
                        ?>
                    <div class="cart_items boxs">
                        <div class="item_img">
                            <img src="<?php echo base_url('uploads/product/'.$storeproduct_wishlist['image_url']);?>" alt="itemimg" class="img-responsive">
                        </div>
                        <div class="item_details">
                            <div class="id_lft boxs">
                                <a href="<?php echo base_url('product/'.str_replace(' ','-',$storeproduct_wishlist['product_name'])); ?>"><h5><?php echo $storeproduct_wishlist['product_name'];?></h5></a>
                                <h6><?php echo $storeproduct_wishlist['store_name'];?>, <?php echo $storeproduct_wishlist['address'];?></h6>
                                <p style="font-size:16px;"><?php echo 'Price: $'.$storeproduct_wishlist['price'];?></p>
                            </div>
                        </div>
                        <a href="<?php echo base_url('user/removeStoreItemFromWishlist/'.$storeproduct_wishlist['id']); ?>" class="removeitem removeWishlist">Remove</a>
                        <div class="bd_btm boxs"></div>
                    </div>
                    <?php } } ?>
                </div>
            </div>
        </div>
    </div>
</div>