<section class="store_banner store2 topScrl">
    <div class="container">
        <div class="bread_crumb breadcrumb_shipping">
            <ul class="bread_crumb_menu">
                <li><a href="<?php echo base_url('site'); ?>">Home</a></li>
                <li><a> <i class="fa fa-angle-right"></i></a></li>
                <li><a href="<?php echo base_url('store'); ?>" class="active">Stores</a></li>
            </ul>
        </div>
        <div class="slider2 slick">
            <div class="store_banner_in boxs">
                <img src="<?php echo base_url('assets'); ?>/img/storeBanner.png" class="img-responsive storeimghide" alt="banner_image">
                <img src="<?php echo base_url('assets'); ?>/img/storeBanner2.png" class="img-responsive storeimgshow" alt="banner_image">

                <h2>Canadian Footwear</h2>
            </div>
            <div class="store_banner_in boxs">
                <img src="<?php echo base_url('assets'); ?>/img/storeBanner.png" class="img-responsive storeimghide" alt="banner_image">
                <img src="<?php echo base_url('assets'); ?>/img/storeBanner2.png" class="img-responsive storeimgshow" alt="banner_image">

                <h2>Canadian Footwear</h2>
            </div>
            <div class="store_banner_in boxs">
                <img src="<?php echo base_url('assets'); ?>/img/storeBanner.png" class="img-responsive storeimghide" alt="banner_image">
                <img src="<?php echo base_url('assets'); ?>/img/storeBanner2.png" class="img-responsive storeimgshow" alt="banner_image">

                <h2>Canadian Footwear</h2>
            </div>
        </div>
    </div>
</section>
<!--banner section end-->

<!--brows stores section-->
<section class="brows_store res_mg mgtop0">
    <div class="container">
        <div class="browsStore_inner boxs">
            <div class="row">
                <div class="col-sm-3 dnone2">
                    <div class="brows_store_lft boxs">
                        <div class="categories boxs">
                            <h3>Categories</h3>
                            <div class="categories_btm boxs">
                                <?php
                                $i = 1;
                                foreach ($categories as $category) {
                                    ?>
                                    <a href="<?php echo base_url('store/get-store-wrapper/' . $category['store_category_id'] . '/0'); ?>" class="common-menu <?php
                                    if ($i == 1) {
                                        echo 'active';
                                    }
                                    ?>" ><?php echo $category['category_name']; ?><span>(<?php echo $category['total']; ?>)</span></a>
                                       <?php
                                       $i++;
                                   }
                                   ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="browsAll_store_lft boxs">
                        <div class="browsAll_store boxs">
                            <div class="brows_head boxs">
                                <h2>Browsing All Stores <span id="store_cnt"></span></h2>
                            </div>
                            <div class="brows_store_box boxs">
                                <div class="browsAll_str_lft res_w_100">
                                    <div class="search_sec search_stick boxs">
                                        <input type="text" id="search" class="form-control" placeholder="Search store name">
                                        <img src="<?php echo base_url('assets/img/searchicon.png'); ?>" alt="search">
                                    </div>
                                </div>
                                <div class="res_prod_cat boxs">
                                    <div class="categories catResStck boxs">
                                        <a href="javascript:void(0)" class="pro_drop">Categories<img src="<?php echo base_url('assets'); ?>/img/arrowdwn.png" alt="arrowdwn" class="img-responsive rotate"></a>
                                        <div class="pro_drop_menu boxs">
                                            <?php
                                            $j = 1;
                                            foreach ($categories as $category) {
                                                ?>
                                                <a id="activeStore" href="<?php echo base_url('store/get-store-wrapper/' . $category['store_category_id'] . '/0'); ?>" class="common-menu <?php
                                                if ($j == 1) {
                                                    echo 'active';
                                                }
                                                ?>" ><?php echo $category['category_name']; ?><span>(<?php echo $category['total']; ?>)</span></a>
                                                   <?php
                                                   $i++;
                                               }
                                               ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="browsAll_str_rht res_prod_sort">
                                    <div class="fil_drop">
                                        <button type="button" class="filDrop_btn">
                                            Sort By : <span>Most Recent</span>
                                            <img src="<?php echo base_url('assets'); ?>/img/arrowdwn.png" alt="arrow">
                                        </button>
                                        <div class="filDrop_content">
                                            <a href="javascript:void(0)" class="filteration" data-val="most_viewed">Most Viewed</a>
                                            <!--<a href="javascript:void(0)" class="filteration" data-val="review_score">E Market review score</a>-->
                                            <a href="javascript:void(0)" class="filteration" data-val="free_delivery">Delivery fee</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="content-wrapper"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>