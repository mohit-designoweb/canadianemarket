<section class="slide_sec productdetails topScrl">
    <div class="container">
        <div class="bread_crumb bread_crumb_rest_deta breadcrumb_shipping pd_zero">
            <div class="bread_crumb_in res_breadCrumb_in boxs">
                <ul class="bread_crumb_menu">
                    <li><a href="<?php echo base_url('site'); ?>">Home</a></li>
                    <li><a> <i class="fa fa-angle-right"></i></a></li>
                    <li><a href="<?php echo base_url('store'); ?>">Store</a></li>
                    <li><a> <i class="fa fa-angle-right"></i></a></li>
                    <li><a href="<?php echo base_url('store/' . str_replace(' ', '-', $product['store_name'])); ?>"><?php echo $product['store_name']; ?></a></li>
                    <li><a> <i class="fa fa-angle-right"></i></a></li>
                    <li><a href="<?php echo base_url('product/' . str_replace(' ', '-', $product['product_name'])); ?>" class="active"><?php echo $product['product_name']; ?></a></li>
                </ul>
                <!--                <div class="item_boxs">
                                    <h2>599</h2>
                                    <p>Items</p>
                                </div>-->
            </div>
        </div>
        <div class="slide_sec_in boxs" id="product-detail-wrapper" data-url="<?php echo base_url('store/get-product-detail-wrapper/' . $product['product_id'] . '/' . $product_sku['product_sku_id']); ?>"></div>
    </div>
</section>
<!--slider seciton end-->

<!-- middle section-->
<?php
if (!empty($ratings)) {
    $rating_count = count($ratings);
}
?>
<section class="procucts_rest">
    <div class="container">
        <div class="ship_lft boxs rest_catelog prdct_rvw">
            <div class="tabs_menu prod_des_tab boxs restab2">
                <a href="javascript:void(0)" class="active" data-tag="secOne">Description</a>
                <a href="javascript:void(0)" data-tag="secTwo">Reviews (<?php
                    if (!empty($ratings)) {
                        echo $rating_count;
                    } else {
                        echo '0';
                    }
                    ?>)</a>
                <a href="javascript:void(0)" data-tag="secThree">Store Info</a>
            </div>

            <div class="descipt boxs product_descipt commn showTab" id="secOne">
                <h2>Description</h2>
                <?php echo $product['description']; ?>
            </div>
            <div class="descipt boxs product_descipt reviewbx commn" id="secTwo">

                
                <div id="error_msg"></div>
                <h2>Reviews</h2>

                 
                <?php if(!empty($review_details)){
                 foreach ($review_details as $review_detail) {
                ?>
                   <div class="item_img">
                       <?php if(!empty($review_detail['image_url'])) {?>
                  <img src="<?php echo base_url('uploads/profile_images/'.$review_detail['image_url']); ?>" alt="itemimg" class="img-responsive" height="30px" width="40px">
                  <?php } else {?>
                  <img src="<?php echo base_url('/assets/img/userimg.png'); ?>" alt="itemimg" class="img-responsive" height="30px" width="40px">
                  <?php }?>
              </div>
                <div class="item_details itemDet">
                  <h5><?php echo $review_detail['user_name']; ?></h5>
                  <h5><?php echo $review_detail['review']; ?></h5>

                  <h6><?php echo strtok($review_detail['created'],' '); ?></h6>
                  <h6>
                 <div class="star-rating" style="margin-left:-10px; color:#ca5f14;">
                    <?php foreach($review_detail as $rd ){
                                                
                                                if($rd == 5){
                                                        $i=$rd;
                                                        while($i>=1){
                                                    ?>
                                                    <span class="fa fa-star " ></span>
                                                <?php
                                                        $i--;}
                                                }elseif($rd == 4){
                                                    ?>
                                                    <span class="fa fa-star"></span>
                                                    <?php 
                                                            $i=$rd;
                                                            while($i>=1){
                                                    ?>
                                                    <span class="fa fa-star " ></span>
                                                   
                                                <?php
                                                $i--;}
                                                }elseif($rd == 3){
                                                        $i=$rd;  
                                                     ?>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <?php while($i>=1){?>
                                                    <span class="fa fa-star chk" ></span>
                                                    
                                                    <?php
                                                    $i--;}
                                                }elseif($rd == 2){ 
                                                    $i=1;   
                                                    while($i <= 3 ){
                                                    ?>
                                                    <span class="fa fa-star"></span>
                                                       <?php $i++; }?>
                                                    <span class="fa fa-star chk"></span>
                                                    <span class="fa fa-star chk" ></span>
                                               
                                                <?php
                                                }elseif($rd == 1){
                                                    $i=1;   
                                                    while($i <= 4 ){
                                                    ?>
                                                    
                                                    <span class="fa fa-star"></span>
                                                    <?php $i++ ;} ?>
                                                    <span class="fa fa-star "></span>
                                                    <?php
                                                }
                                                
                                            }?>    
                                                
                                            </div>
                                        </h6>
                                    </div>
                                     <div class="bd_btm boxs"></div>
                    
                <?php } } else { ?>

                    <p>There are no reviews yet.</p>
                    <p>Be the first to review</p>

                <?php }  ?>
                <?php if(!empty($user_data['unique_id'])){ ?>
                  <div class="col-sm-12">
                <form method="post" action="<?php echo base_url('store/doAddStoreRateReview/' . $product['product_id']); ?>" id="registerForm">
                    <h4>
                        <img src="<?php 
                                       if(!empty($user_data['unique_id'])) {
										if(!empty($user_data['image_url'])){	
											 echo base_url('uploads/profile_images/'.$user_data['image_url']);
											}else{
												echo base_url('assets/img/avtar.png');}
												}
                                        
                                       else{echo base_url('assets/img/avtar.png');}
                                        ?>" alt="icon">
                        <span>Your review <g>*</g></span>
                    </h4>
                   
                    <div class="messag_wrp boxs">
                        <div class="form-group">
                            <textarea name="review" id="review" class="form-control"></textarea>
                        </div>
                    </div>
                    <h5>Your rating</h5>
                    <div class="star-rating" style="margin-left:-10px; color:#ca5f14;">
                        <input type="radio" id="5-stars" name="rating" value="5" />
                        <label for="5-stars" class="star">&bigstar;</label>
                        <input type="radio" id="4-stars" name="rating" value="4" />
                        <label for="4-stars" class="star">&bigstar;</label>
                        <input type="radio" id="3-stars" checked name="rating" value="3" />
                        <label for="3-stars" class="star">&bigstar;</label>
                        <input type="radio" id="2-stars" name="rating" value="2" />
                        <label for="2-stars" class="star">&bigstar;</label>
                        <input type="radio" id="1-stars" name="rating" value="1" />
                        <label for="1-star" class="star">&bigstar;</label>
                    </div>
                    <button type="submit" class="btn_submit">Submit</button>
                </form>
                <?php } else { ?>
                       <p>Please login for review.</p>
                <?php } ?>
            </div>
            </div>  
			
            <div class="descipt boxs product_descipt storInfo commn" id="secThree">
                <?php echo $product['store_description']; ?>
            </div>
        </div>
    </div>
</section>
<!-- middle section end-->

<!--    related product section-->
<section class="related_prod boxs">
    <div class="container">
        <div class="related_prod_in boxs">
            <h3>Related Products</h3>
            <div class="row">
                <?php
				
                if (!empty($related_products)) {
                    foreach ($related_products as $product) {
                        ?>
                        <div class="col_sm">
                            <div class="storeBox boxs">
                                <a href="javascript:void(0)"></a>
                                <div class="storeBox_top boxs">
                                    <a href="<?php echo base_url('product/' . str_replace(' ', '-', $product['product_name'])); ?>">
                                        <img src="<?php echo base_url('uploads/product/' . $product['image_url']); ?>" class="img-responsive" alt="store">
                                    </a>
									<!--<a href="javascript:void(0)" class="heart_icon">
                                        <i class="fa fa-heart"></i>
                                    </a>-->
									<?php if(!empty($user_data['user_id'])){
										if(in_array($product['product_id'],$relProWishlist)){?>
										 <a href="<?php echo base_url('store/storeProductWishlist/'.$product['product_id'].'/'.$user_data['user_id']);?>" class="heart_icon product-wishlist-heart">
                                          <i class="fa fa-heart wishlist-color" ></i></a>
									<?php } else {?>
                                    <a href="<?php echo base_url('store/storeProductWishlist/'.$product['product_id'].'/'.$user_data['user_id']);?>" class="heart_icon product-wishlist-heart">
                                        <i class="fa fa-heart"></i>
                                    </a>
                                    <?php } }else { ?>
                                    <a href="javascript:void(0)" class="heart_icon" data-toggle="modal" data-target="#login"><i class="fa fa-heart"></i></a>
<!--                                    <a href="javascript:void(0)" class="heart_icon">
                                        <i class="fa fa-heart"></i>
                                    </a>-->
                                    <?php } ?>
                                </div>

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
                                        <li class="cartWidth"><a href="javascript:void(0)"><img src="<?php echo base_url('assets/img/cart.png'); ?>" alt="cart"></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>

            </div>

        </div>
    </div>
</section>
<!--    related product section end-->
