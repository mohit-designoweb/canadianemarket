<!--slider seciton-->

<section class="slide_sec restaurantsdetail_main topScrl">
    <div class="container">
        <div class="bread_crumb bread_crumb_rest_deta breadcrumb_shipping">
            <div class="bread_crumb_in res_breadCrumb_in boxs">
                <ul class="bread_crumb_menu">
                    <li><a href="<?php echo base_url('site'); ?>">Home</a></li>
                    <li><a> <i class="fa fa-angle-right"></i></a></li>
                    <li><a href="<?php echo base_url('restaurant'); ?>">Restaurant</a></li>
                    <li><a> <i class="fa fa-angle-right"></i></a></li>
                    <li><a href="<?php echo base_url('restaurant/' . str_replace(' ', '-', $restaurant['restaurant_name'])); ?>" class="active"> <?php echo $restaurant['restaurant_name']; ?></a></li>
                </ul>
                <div class="item_boxs">
                    <h2><?php echo $item_count['count']; ?></h2>
                    <p>Items</p>
                </div>
            </div>
        </div>
        <div class="slide_sec_in boxs dnone">
            <div class="row">
                <div class="col-sm-6">
                    <div class="slide_wraper boxs">
                        <div class="slide_img slideLogo_img">
                            <img src="<?php echo base_url('uploads/restaurant/' . $restaurant['image_url']); ?>" class="" alt="foods">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="txt_wraper boxs">
                        <div class="txt_top boxs">
                            <p>Fast Food</p>
                        </div>
                        <div class="txt_mid boxs">
                            <h2><?php echo $restaurant['restaurant_name']; ?>, <?php echo $restaurant['address']; ?></h2>
                            <input type="hidden" id="restaurant_id" value="<?php echo $restaurant['restaurant_id']; ?>"/>
                            <p><?php echo $restaurant['speciality']; ?></p>
                            <p><?php echo $restaurant['address']; ?> <?php
                                if (!empty($restaurant['distance'])) {
                                    echo '- <span>' . $restaurant['distance'] . 'km away </span>';
                                }
                                ?></p>
                        </div>
                        <div class="review_sec boxs res_review_sec resSS_review">
                            <ul class="review_box">
                                <li class="width100 mgzer0">
                                    <span class="starRe">3.8 <i class="fa fa-star"></i></span>
                                    <span class="rating rating_sdd">381 Ratings</span>
                                    <a href="javascript:void(0)" class="reviewss">4 Reviews</a>
                                    <a href="javascript:void(0)" class="hearticon"><i class="fa fa-heart"></i></a>
                                    <a href="javascript:void(0)" class="shareIcon"><i class="fa fa-share-alt"></i></a>
                                    <a href="javascript:void(0)" class="res_chat res_chat2"><img src="<?php echo base_url('assets/img/chat_032.png'); ?>" alt="chat"><span>Chat with Us</span></a>
                                </li>

                            </ul>
                        </div>
                        <div class="txt_bot boxs">
                            <div class="readmoremain boxs">
                                <p class="font3"><?php echo substr($restaurant['description'], 0, 30) . '....'; ?></p>
                                <p class="font3 moretext"><?php echo substr($restaurant['description'], 30); ?></p>
                                <button type="button" class="readBtn">READ MORE</button>
                            </div>
                            <h5>Opening Hours: <span>Open Now</span></h5>
                            <?php
                            // $t=time();
                            //print_r($_SERVER['REMOTE_ADDR']);
//                                print_r(date_default_timezone_get());
//                                
//                                date_default_timezone_set("Asia/Calcutta");
//                                    print_r(date("H:i:sa"));
                            ?>
                            <h6><?php echo $restaurant['opening_time_from']; ?> – <?php echo $restaurant['opening_time_to']; ?></h6>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="res_slider_show boxs">
            <div class="rest_details_res boxs">
                <div class="notice boxs"></div>
                <h2><img src="img/restaurantsLogo.png" class="img-responsive" alt="logo">Chicago Pizza, Karkar Duma,New Delhi</h2>
                <p class="fastFood">Fast Food</p>
                
                <p class="font2"><?php echo $restaurant['speciality']; ?></p>
                <p class="font2"><p><?php echo $restaurant['address']; ?> <?php
                    if (!empty($restaurant['distance'])) {
                        echo '- <span>' . $restaurant['distance'] . 'km away </span>';
                    }
                    ?></p></p>
                <div class="review_sec boxs res_review_sec resSS_review resBottombdr">
                    <ul class="review_box">
                        <li class="width100 mgzer0">
                            <span class="starRe">3.8 <i class="fa fa-star"></i></span>
                            <span class="rating rating_sdd">381 Ratings</span>
                            <a href="javascript:void(0)" class="reviewss">4 Reviews</a>
                            <a href="javascript:void(0)" class="hearticon"><i class="fa fa-heart"></i></a>
                            <a href="javascript:void(0)" class="shareIcon"><i class="fa fa-share-alt"></i></a>
                            <a href="javascript:void(0)" class="res_chat"><img src="img/chat_032.png" alt="chat"><span>Chat with Us</span></a>
                        </li>

                    </ul>
                </div>
                <div class="readmoremain boxs">
                    <p class="font3"><?php echo substr($restaurant['description'], 0, 30) . '....'; ?></p>
                    <p class="font3 moretext"><?php echo substr($restaurant['description'], 30); ?></p>
                    <button type="button" class="readBtn">READ MORE</button>
                </div>
                <!-- <img src="img/restaurantsLogo.png" class="img-responsive" alt="logo"> -->
                <h5>Opening Hours : <span>Open Now</span></h5>
                <h6><?php echo $restaurant['opening_time_from']; ?> – <?php echo $restaurant['opening_time_to']; ?></h6>
            </div>
            <!-- <div class="resta_img boxs">
                <img src="img/food1.png" alt="food" class="img-responsive center-block">
            </div> -->
            
        </div>
    </div>
</section>
<!--slider seciton end-->

<!-- middle section-->
<section class="procucts_rest">
    <div class="container">
        <div class="prod_rest_in">
            <div class="row">
                <div class="col-sm-8">
                    <div class="ship_lft boxs rest_catelog rescatelog resScrolrr" id="resScrl_t">
                        <div class="tabs_menu boxs restab">
                            <a href="javascript:void(0)" class="active" data-tag="secOne">Menu</a>
                            <a href="javascript:void(0)" data-tag="secTwo">About</a>
                            <a href="javascript:void(0)" data-tag="secThree">Speciality</a>
                            <a href="javascript:void(0)" data-tag="secFour">Reviews <span>(4)</span></a>
                        </div>
                        <div class="cartlist cart_lft products_typ commTabC resScroll boxs" id="secOne">
                            <div class="filter_menu boxs">
                                <div class="fil_menu_inr boxs">
                                    <?php
                                    $i = 1;
                                    foreach ($restaurant_menus as $menu) {
                                        ?>
                                        <a href="<?php echo base_url('restaurant/getRestaurantMenu/' . $menu['menu_category_id']); ?>" class="common-menu <?php
                                           if ($i == 1) {
                                               echo 'active';
                                           }
                                           ?>"><?php echo $menu['menu_category_name']; ?></a>
                                           <?php
                                           $i++;
                                       }
                                       ?>
                                </div>
                            </div>
                            <div id="content-wrapper"></div>

                        </div>
                        <div class="about_txt cart_lft hideSec commTabC resScroll boxs" id="secTwo">
                            <h2>About</h2>
                            <p><?php echo $restaurant['about']; ?></p>
                        </div>
                        <div class="about_txt cart_lft hideSec commTabC resScroll boxs" id="secThree">
                            <h2>Speciality</h2>
                            <div id="special-menu-wrapper" data-url="<?php echo base_url('restaurant/get-special-menu-wrapper/'.$restaurant['restaurant_id']); ?>"></div>
                        </div>
                        <div class="about_txt cart_lft hideSec commTabC resScroll boxs" id="secFour">
                            <h2>Reviews</h2>
                            <div class="cart_items boxs">
                                <div class="item_img">
                                    <img src="img/item2.png" alt="itemimg" class="img-responsive">
                                </div>
                                <div class="item_details itemDet">
                                    <div class="id_lft restFood boxs">
                                        <h5>Garden Veggies & Cheese</h5>
                                        <h6>Garden fresh cucumbers, juicy tomatoes & cheese dolloped with our signature grain mustard sauce on the bed of crunchy green lettuce served in freshly baked bread. For a nutritious turbo charge anytime of the day</h6>
                                        <p><strike>$652</strike>$652<span class="d_off">20% OFF</span></p>
                                    </div>
                                    <div class="id_ryt boxs">
                                        <div class="quantity">
                                            <button type="button" class="add_btn">Add</button>
                                            <a href="javascript:void(0)" class="removeitem">Remove</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="bd_btm boxs"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4" data-url="<?php echo base_url('restaurant/get-order-wrapper'); ?>" id="order-wrapper"></div>
            </div>
        </div>
    </div>
</section>
<!-- middle section end-->
