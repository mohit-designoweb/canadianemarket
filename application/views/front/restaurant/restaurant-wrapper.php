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
            <div class="col-sm-3 p_items_content" style="height:280px;">
                <a href="<?php echo base_url('restaurant/'.str_replace(' ', '-', $restaurant['restaurant_name'])); ?>">
                    <div class="storeBox restoBox boxs exTab2">
                        <div class="storeBox_top  restoBox_top boxs">
                            <img src="<?php echo base_url('uploads/restaurant/'.$restaurant['image_url']); ?>" class="img-responsive" alt="store">
                            <span> <?php if($restaurant['is_open'] == 'Enable') {echo  "Opening at ";}else{echo ' Close | ' ;} ?> <g><?php if($restaurant['is_open'] == 'Enable'){ echo date('H A', strtotime($restaurant['opening_time_from'])); } else{ echo "Pre-Order Now" ;}  ?></g></span>
                        </div>
                        <div class="storeBox_bottom boxs">
                            <h4><?php echo $restaurant['address']; ?></h4>
                            <h2><?php echo $restaurant['restaurant_name']; ?></h2>
                            <h3><span><?php if(!empty($restaurant['distance'])){ echo $restaurant['distance'].'km away </span> | <span>'; } ?> <?php echo $restaurant['category_name']; ?></span></h3>
                            <?php 
//                            date_default_timezone_set("America/Winnipeg"); 
//                            
//                            $time= date("H:i"); 
//                            $currentTime = strtotime($time);
//                            $opening_time= strtotime($restaurant['opening_time_from']);
//                            $closing_time = strtotime($restaurant['opening_time_to']);
                            ?>
                            <!--<h6><?php //if(($opening_time < $curentTime) && ($curentTime<$closing_time)){ echo 'Order Now'; }else{ echo 'Pre-Order Now'; } ?></h6>-->
                        </div>
                    </div>
                </a>
            </div>
            <?php
            }
            ?>
            
        </div>
    </div>
</div>
<div class="pagination_route boxs">
 <?php echo $links; ?>
</div>