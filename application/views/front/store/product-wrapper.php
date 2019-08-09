<div class="storeType boxs">
    <div class="row">
        <input type="hidden" id="restaurant-category" data-url="<?php echo base_url('store/get_product_wrapper/' . $shop_section_id . '/0'); ?>" />
        <input type="hidden" name="search-store-product-url" id="search-store-product-url"
        data-url="<?php echo base_url('store/get-product-wrapper/'.$shop_section_id);?>">
        <?php
        foreach ($products as $product) {
            ?>
            <div class="col-sm-3 p_items_content">
                <div class="storeBox boxs exTab2">
                    <a href="<?php echo base_url('product/' . str_replace(' ', '-', $product['product_name'])); ?>">
                        <div class="storeBox_top boxs">
                            <img src="<?php echo base_url('uploads/product/' . $product['image_url']); ?>" class="img-responsive" alt="store">
                            <?php  if(isset($user_data['user_id'])){       
                                if(!empty($product['product_wish'])){
                            ?> 
                                <a href="<?php echo base_url('store/storeProductWishlist/'.$product['product_id'].'/'.$user_data['user_id']);?>" class="heart_icon product-wishlist-heart">
                                    <i class="fa fa-heart wishlist-color"></i>
                                </a> 
                                <?php } else {?>
                                 <a href="<?php echo base_url('store/storeProductWishlist/'.$product['product_id'].'/'.$user_data['user_id']);?>" class="heart_icon product-wishlist-heart">
                                    <i class="fa fa-heart"></i>
                                 </a>
                                
                            <?php } }else { ?>
                                <a href="javscript:void(0)" data-toggle="modal" data-target="#login" class="heart_icon" >
                                    <i class="fa fa-heart"></i>
                                </a>
                            <?php } ?>
                        </div>
                    </a>
                    <div class="storeBox_bottom storeBox_bottom_f boxs">
                        <h4><?php echo $product['store_name']; ?></h4>
                        <h2><?php echo $product['product_name']; ?></h2>
                        
                        <ul class="cart_p">
                            <?php
                            if (!empty($product['discount'])) {
                                $price = $product['price'];
                                $discount = $product['discount'];
                                $discounted_price = round(($price * $discount) / 100, 1);
                                $total_price = $price - $discounted_price;
                                ?>
                                <li class="priceWidth">$<?php echo $total_price; ?><strike>$<?php echo $product['price']; ?> </strike></li>
                                <?php
                            } else {
                                ?>
                                <li class="priceWidth">$<?php echo $product['price']; ?></li>
                            <?php }
                            ?>
                            <li class="cartWidth"><a href="javascript:void(0)"><img src="<?php echo base_url('assets'); ?>/img/cart.png" alt="cart"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>


    </div>

</div>
<div class="pagination_route boxs">
    <?php echo $links; ?>
</div>