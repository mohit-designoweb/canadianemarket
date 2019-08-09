<div class="row">
    <div class="col-sm-6">
        <div class="slide_wraper boxs">
            <div class="slides slides2">
                <button type="button" class="arrow_up">
                    <img src="<?php echo base_url('assets/img/arrowdwn.png'); ?>" alt="icon">
                </button>
                <button type="button" class="arrow_down">
                    <img src="<?php echo base_url('assets/img/arrowdwn.png'); ?>" alt="icon">
                </button>
                <ul class="slides_food product_slides">
                    <?php
                    $first_image = '';
                    $i = 1;
                    foreach ($product_images as $image) {
                        if ($i == 1) {
                            $first_image = $image['image_url'];
                        }
                        ?>
                        <li><img src="<?php echo base_url('uploads/product-sku/' . $image['image_url']); ?>" class="img-responsive" alt="slide1"></li>
                        <?php
                        $i++;
                    }
                    ?>
                </ul>
            </div>
            <div class="slide_img">
                <img src="<?php echo base_url('uploads/product-sku/' . $first_image); ?>" class="" alt="shoes">
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="txt_wraper boxs">
            <div class="txt_top txt_top2 boxs">
                <img src="<?php echo base_url('uploads/store/' . $product['store_image']); ?>" height="50" width="100px"  alt="logo">
                <h3><?php echo $product['store_name']; ?></h3>
            </div>
            <div class="txt_mid txt_mid2 boxs">
                <div class="txt_midInn boxs">
                    <h2><?php
                        echo $product['product_name'];
                        if (!empty($product['discount'])) {
                            echo ' <span>(' . $product['discount'] . '% OFF)</span>';
                        }
                        ?>  
                    </h2>
                </div>
                <input type="hidden" id="cart-url" value="<?php echo base_url('store/addToCartStore'); ?>"/>
                <input type="hidden" name="name" id="name" value="<?php echo $product['product_name']; ?>"/>
				<input type="hidden" name="product_id" id="product_id" value="<?php echo $product['product_id']; ?>"/>
                <input type="hidden" name="id" id="id" value="<?php echo $single_product_sku['sku']; ?>"/>
				 <input type="hidden" id="sku-url" value="<?php echo base_url('store/changeSku'); ?>"/>
                <p>SKU: <g><?php echo $single_product_sku['sku']; ?></g> | Category: <g><?php echo $product['shop_section_name']; ?></g></p>
            </div>
            <div class="review_sec boxs res_review_sec resSS_review">
                <ul class="review_box">
                    <li class="width100 mgzer0">
                        <span class="starRe"><?php if(!empty($average_rating)){ echo round($average_rating['rating'],2); } else{ echo '0.0'; } ?> <i class="fa fa-star"></i></span>
                        <a href="javascript:void(0)" class="reviewss"><?php if(!empty($ratings)){ echo count($ratings); }else{ echo 0; } ?> Reviews</a>
                       <?php  if(isset($user_data['user_id'])){       
                                if(!empty($wishlist['product_id'])){
                                    //print_r($wishlist);
                                ?> 
                                <a href="<?php echo base_url('store/storeProductWishlist/'.$product['product_id'].'/'.$user_data['user_id']);?>" class=" product-wishlist-heart">
                                    <i class="fa fa-heart wishlist-color" ></i>
                                </a> 
                                <?php } else {?>
                                 <a href="<?php echo base_url('store/storeProductWishlist/'.$product['product_id'].'/'.$user_data['user_id']);?>" class=" product-wishlist-heart">
                                    <i class="fa fa-heart"></i>
                                 </a>
                                
                            <?php } }else { ?>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#login" class=" product-wishlist-heart" >
                                    <i class="fa fa-heart"></i>
                                 </a>
                            <?php } ?>
                           
                        <div class="dropdown">
                            <a href="javascript:void(0)" class="btn btn-primary dropdown-toggle shareIcon" type="button" data-toggle="dropdown"><i class="fa fa-share-alt"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="http://www.facebook.com/sharer.php?u=<?php echo base_url('product/' . str_replace(' ', '-', $product['product_name'])); ?>"><img src="<?php echo base_url('public/image/facebook.png'); ?>" height="30px" width="40px"></a></li>
                                <li><a href="https://plus.google.com/share?url=<?php echo base_url('product/' . str_replace(' ', '-', $product['product_name'])); ?>"><img  src="<?php echo base_url('public/image/google.png'); ?>" height="30px" width="40px"></a></li>
                                <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo base_url('product/' . str_replace(' ', '-', $product['product_name'])); ?>"><img  src="<?php echo base_url('public/image/linkedin.png'); ?>" height="30px" width="40px"></a></li>
                            </ul>
                        </div>
                        <a href="javascript:void(0)" class="res_chat res_chat2"><img src="<?php echo base_url('assets/img/chat_032.png'); ?>" alt="chat"><span>Chat with Us</span></a>
                    </li>
                </ul>
            </div>
            <div class="txt_bot txt_bot2 boxs">
                <?php
                if (!empty($product['discount'])) {
                    $price = $product['price'];
                    $discount = $product['discount'];
                    $discounted_price = round(($price * $discount) / 100, 1);
                    $total_price = $price - $discounted_price;
                    ?>
                    <input type="hidden" name="price" id="price" value="<?php echo $total_price; ?>"/>
                    <h4>$<?php echo $total_price; ?> <strike>$<?php echo $product['price']; ?> </strike></h4>
                <?php } else { ?>
                    <input type="hidden" name="price" id="price" value="<?php echo $product['price']; ?>"/>
                    <h4>$<?php echo $product['price']; ?></h4>
                <?php } ?>
                    <input type="hidden" name="module" id="module" value="store"/>
                <?php
                $i = 0;
                foreach ($specification as $spec) {
                    ?>
                    <h5>Select <?php echo $spec['group_name']; ?></h5>
                    <div class="size_wrpr color_wrpr boxs">

                        <?php
                        if ($spec['group_name'] == 'color') {
                            foreach ($sku_lists[$spec['group_id']] as $sku_val) {
                                ?>
                                <div class="fb_list">
                                    <input type="radio" class="sku" id="fb<?php echo $i; ?>" <?php if($mapping[$spec['group_id']]==$sku_val){ echo 'checked'; } ?> name="<?php echo $spec['group_name']; ?>" value="<?php echo $sku_val; ?>">
                                    <label for="fb<?php echo $i; ?>" style="background: <?php echo $sku_val; ?>">
                                        <div class="faceads boxs">

                                        </div>
                                    </label>
                                </div>
                                <?php
                                $i++;
                            }
                        } else {
                            foreach ($sku_lists[$spec['group_id']] as $sku_val) {
                                ?>
                                <div class="fb_list">
                                    <input type="radio" class="sku" id="fb<?php echo $i; ?>"  <?php if($mapping[$spec['group_id']]==$sku_val){ echo 'checked'; } ?> name="<?php echo $spec['group_name']; ?>" value="<?php echo $sku_val; ?>">
                                    <label for="fb<?php echo $i; ?>">
                                        <div class="faceads boxs"><h4><?php echo $sku_val; ?></h4></div>
                                    </label>
                                </div>
                                <?php
                                $i++;
                            }
                        }
                        
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="addCartBox boxs">
                <div class="vaulebox">
                    <button type="button" class="minus_btn">-</button>
                    <input type="text" id="qty" value="1" class="qty">
                    <button type="button" class="plus_btn">+</button>
                </div>
                <button type="button" class="addCart_btn slidehover">Add to cart</button>
            </div>
        </div>
    </div>
</div>