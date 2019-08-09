<div class="storeType resto_in boxs">
    <div class="rest_head boxs">
        <h2>Open Restaurants</h2>
    </div>
    <div class="rowSec boxs">
        <input type="hidden" id="restaurant-category" data-url="<?php echo base_url('restaurant/get-restaurant-wrapper/' . $restaurant_category . '/0'); ?>" />
        <div class="row">
            <?php
            foreach ($restaurants as $restaurant) {
            ?>
            <div class="col-sm-3">
                <a href="<?php echo base_url('restaurant/'.str_replace(' ', '-', $restaurant['restaurant_name'])); ?>">
                    <div class="storeBox restoBox boxs">
                        <div class="storeBox_top  restoBox_top boxs">
                            <img src="<?php echo base_url('uploads/restaurant/'.$restaurant['image_url']); ?>" class="img-responsive" alt="store">
                            <!--<span>Opening at <g>11am</g></span>-->
                        </div>
                        <div class="storeBox_bottom boxs">
                            <h4><?php echo $restaurant['address']; ?></h4>
                            <h2><?php echo $restaurant['restaurant_name']; ?></h2>
                            <h3><span><?php if(!empty($restaurant['distance'])){ echo $restaurant['distance'].'km away </span> | <span>'; } ?> <?php echo $restaurant['category_name']; ?></span></h3>
                            <h6>Pre-Order Now</h6>
                            <p>
                                <span id="rating">3.8<i class="fa fa-star"></i></span>

                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            }
            ?>
            

            <!--            <div class="col-sm-3">
                            <a href="javascript:void(0)">
                                <div class="storeBox restoBox boxs">
                                    <div class="storeBox_top  restoBox_top boxs">
                                        <img src="<?php echo base_url('assets'); ?>/img/restaurants8.png" class="img-responsive" alt="store">
                                        <span>Open till <g>5pm</g></span>
                                    </div>
                                    <div class="storeBox_bottom boxs">
                                        <h4>Sector 63, Noida </h4>
                                        <h2>Chicago Pizza</h2>
                                        <h3><span>1.8 km away </span> | <span>Fast Food</span></h3>
                                        <h6></h6>
                                        <p>
                                            <span id="rating">3.8<i class="fa fa-star"></i></span>
                                            <span id="discount">(10% OFF)</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>-->
        </div>
    </div>
</div>
<div class="pagination_route boxs">
<!--    <ul>
        <li><a href="javascript:void(0)" class="prev commControl">Previous</a></li>
        <li><a href="javascript:void(0)" class="active">1</a></li>
        <li><a href="javascript:void(0)">2</a></li>
        <li><a href="javascript:void(0)">3</a></li>
        <li><a href="javascript:void(0)">4</a></li>
        <li><a href="javascript:void(0)">5</a></li>
        <li><a class="dots">...</a></li>
        <li><a href="javascript:void(0)">119</a></li>
        <li><a href="javascript:void(0)" class="next commControl">Next</a></li>
    </ul>-->
 <?php echo $links; ?>
</div>