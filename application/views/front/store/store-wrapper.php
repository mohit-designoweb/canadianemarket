<div class="storeType resto_in boxs">
    <div class="rowSec boxs">
        <input type="hidden" id="restaurant-category" data-url="<?php echo base_url('store/get-store-wrapper/' . $store_category . '/0'); ?>" />
        <div class="row">
            <?php
            foreach ($stores as $store) {
            ?>
            <div class="col-sm-3 p_items_content exTab2">
                <a href="<?php echo base_url('store/'.str_replace(' ', '-', $store['store_name'])); ?>">
                    <div class="storeBox restoBox boxs exTab2">
                        <div class="storeBox_top  restoBox_top boxs">
                            <img src="<?php echo base_url('uploads/store/'.$store['image_url']); ?>" class="img-responsive" alt="store">
							<span> <?php if($store['is_status'] == 'Active') {echo  "Opening at ";}else{echo ' Close | ' ;} ?> <g><?php if($store['is_status'] == 'Active'){ echo date('H A', strtotime($store['opening_time_from'])); } else{ echo "Pre-Order Now" ;}  ?></g></span>
                            <!--<span>Opening at <g>11am</g></span>-->
                        </div>
                        <div class="storeBox_bottom boxs">
                            <h4><?php echo $store['address']; ?></h4>
                            <h2><?php echo $store['store_name']; ?></h2>
                            <h3><span><?php if(!empty($store['distance'])){ echo $store['distance'].'km away </span> | <span>'; } ?> <?php echo $store['category_name']; ?></span></h3>
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
        </div>
    </div>
</div>
<div class="pagination_route boxs">
 <?php echo $links; ?>
</div>