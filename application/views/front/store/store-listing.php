<section class="store_banner storelisting topScrl">
    <div class="container">
        <div class="bread_crumb breadcrumb_shipping">
            <ul class="bread_crumb_menu">
                <li><a href="<?php echo base_url('site'); ?>">Home</a></li>
                <li><a> <i class="fa fa-angle-right"></i></a></li>
                <li><a href="<?php echo base_url('store'); ?>" class="active">Stores</a></li>
            </ul>
        </div>

        <div class="store_banner_in infoanddesc boxs">
            <div class="set set_d_none">
                <a href="javascript:void(0)">
                    Store Description and information
                    <img src="<?php echo base_url('assets'); ?>/img/arrowdwn.png" alt="arrow">
                </a>
                <div class="content">
                    <p><?php echo $store['description']; ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
if (!empty($ratings)) {
    $rating_count = count($ratings);
}
?>
<!--information section end-->

<!--brows stores section-->
<section class="brows_store brows_store2">
    <div class="container">
        <div class="browsStore_inner boxs">
            <div class="row">
                <div class="col-sm-3 colWidth1 dnone">
                    <div class="brows_store_lft boxs">
                        <div class="shop_store boxs">
                            <img src="<?php echo base_url('uploads/store/' . $store['image_url']); ?>" class="img-responsive" alt="logo">
                            <h2><?php echo $store['store_name']; ?></h2>
                            <h3><span><?php echo $store['distance']; ?> km away</span> | <span>Open till <?php echo $store['opening_time_to']; ?><g></g></span></h3>
                            <div class="review_sec boxs">
                                <ul class="review_box">
                                    <li>
                                        <?php if(!empty($user_data['unique_id'])){?> 
                                        <a href="javascript:void(0)" data-toggle="modal" data-target=".rate_review" id="rate_review"  data-url="<?php echo base_url('user/storeReview/'. $store['store_id']);?>" class="rateitem"><img src="<?php echo base_url('assets');?>/img/star.png" alt="star">Rate & Review Store</a>
                                       <?php } else{ ?> 
                                        <p>Please Login For Review</p> <?php }; ?>
                                        
                                    </li>
                                    <li>
                                        <span class="starRe"><?php if(!empty($average_rating)){ echo round($average_rating['rating'],2); } else{ echo '0.0'; } ?> <i class="fa fa-star"></i></span>
                                        <span class="rating"><?php echo $rating_count?> Rating</span>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><?php if(!empty($review_count['total'])){ echo  $review_count['total'] ; } else{ echo '0'; } ?> Reviews</a>
                                        <!-- <a href="javascript:void(0)"><i class="fa fa-heart"></i></a> -->
                                        <div class="dropdown">
                                            <a href="javascript:void(0)" class="btn btn-primary dropdown-toggle shareIcon" type="button" data-toggle="dropdown"><i class="fa fa-share-alt"></i></a>
                                            <ul class="dropdown-menu">
                                              <li><a href="http://www.facebook.com/sharer.php?u=<?php echo base_url('store/'.str_replace(' ', '-', $store['store_name']));?>"><img src="<?php echo base_url('public/image/facebook.png');?>" height="30px" width="40px"></a></li>
                                              <li><a href="https://plus.google.com/share?url=<?php echo base_url('store/'.str_replace(' ', '-', $store['store_name']));?>"><img  src="<?php echo base_url('public/image/google.png');?>" height="30px" width="40px"></a></li>
                                              <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo base_url('store/'.str_replace(' ', '-', $store['store_name']));?>"><img  src="<?php echo base_url('public/image/linkedin.png');?>" height="30px" width="40px"></a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="underline boxs"></div>
                            <div class="boxs">
                                <h4>Estimated delivery charge</h4>
                                <h5>$<?php echo $store['delivery_charge']; ?></h5>
                                <h6><?php echo $store['estimated_delivery_time']; ?> mins</h6>
                            </div>
                        </div>
                        <div class="chat_box boxs">
                            <a href="javascript:void(0)" class="chat">
                                <img src="<?php echo base_url('assets/img/chat_03.png'); ?>" alt="chat">
                                <span>Chat with Us</span>
                            </a>
                        </div>
                        <div class="categories boxs categories_d_none">
                            <h3>Product category</h3>
                            <div class="categories_btm shop_secton_d boxs">
                                <?php
                                $i = 1;
                                foreach ($shop_sections as $shop_section) {
                                    ?>
                                <a href="<?php echo base_url('store/get-product-wrapper/'.$shop_section['shop_section_id'].'/0'); ?>" class="common-menu <?php
                                    if ($i == 1) {
                                        echo 'active';
                                    }
                                    ?>"><?php echo $shop_section['shop_section_name']; ?> <span>(<?php echo $shop_section['total']; ?>)</span></a>
                                       <?php
                                       $i++;
                                   }
                                   ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9 colWidth2">
                    <div class="browsAll_store_lft boxs">
                        <div class="browsAll_store canad_foot boxs">
                            <!--                                <div class="s_notice boxs s_notice2">
                                                                <p>Store notice: store will be closed for online orders on Mother’s day</p>
                                                            </div>-->
                            <div class="brows_head boxs brows_head_Res">
                                <h2><?php echo $store['store_name']; ?></h2>
                            </div>
                            <div class="res_timebox boxs">
                                <h3><span><?php echo $store['distance']; ?> km away</span> | <span>Open till <g><?php echo $store['opening_time_to']; ?></g></span></h3>
                            </div>
                            <div class="review_sec boxs res_review_sec resSS_review">
                                <ul class="review_box">
                                    <li class="width100 mgzer0">
                                        <span class="starRe"><?php if(!empty($average_rating)){ echo round($average_rating['rating'],2); } else{ echo '0.0'; } ?> <i class="fa fa-star"></i></span>
                                        <span class="rating rating_sdd"><?php echo $rating_count?> Rating</span>
                                        <a href="javascript:void(0)" class="reviewss"><?php echo $review_count['total']?> Reviews</a>
                                        <!-- <a href="javascript:void(0)" class="hearticon"><i class="fa fa-heart"></i></a> -->
                                        <div class="dropdown">
                                            <a href="javascript:void(0)" class="btn btn-primary dropdown-toggle shareIcon" type="button" data-toggle="dropdown"><i class="fa fa-share-alt"></i></a>
                                            <ul class="dropdown-menu">
                                              <li><a href="http://www.facebook.com/sharer.php?u=<?php echo base_url('store/'.str_replace(' ', '-', $store['store_name']));?>"><img src="<?php echo base_url('public/image/facebook.png');?>" height="30px" width="40px"></a></li>
                                              <li><a href="https://plus.google.com/share?url=<?php echo base_url('store/'.str_replace(' ', '-', $store['store_name']));?>"><img  src="<?php echo base_url('public/image/google.png');?>" height="30px" width="40px"></a></li>
                                              <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo base_url('store/'.str_replace(' ', '-', $store['store_name']));?>"><img  src="<?php echo base_url('public/image/linkedin.png');?>" height="30px" width="40px"></a></li>
                                            </ul>
                                        </div>
                                        <a href="javascript:void(0)" class="res_chat res_chat2"><img src="<?php echo base_url('assets'); ?>/img/chat_032.png" alt="chat"><span>Chat with Us</span></a>
                                    </li>

                                </ul>
                            </div>

                            <div class="set set_d_block boxs" id='setStc'>
                                <a href="javascript:void(0)">
                                    Store Description and information
                                    <img src="<?php echo base_url('assets'); ?>/img/arrowdwn.png" alt="arrow">
                                    <!--<i class="fa fa-plus"></i>-->
                                </a>
                                <div class="content">
                                    <p><?php echo $store['description']; ?></p>
                                </div>
                            </div>


                            <div class="brows_store_box boxs brows_store_box_res respSort">
                                <div class="browsAll_str_lft">
                                    <div class="search_sec search_stick boxs">
                                        <input type="text" id="search-store-product" name="search-store-product" class="form-control" placeholder="Search product by name">
                                        <img src="<?php echo base_url('assets/img/searchicon.png'); ?>" alt="search">
                                    </div>
                                </div>
                                <div class="res_prod_cat boxs">
                                    <div class="categories catResStck boxs">
                                        <a href="javascript:void(0)" class="pro_drop">Categories<img src="<?php echo base_url('assets'); ?>/img/arrowdwn.png" alt="arrowdwn" class="img-responsive rotate"></a>
                                        <div class="pro_drop_menu boxs">
                                            <?php
                                            $i = 1;
                                            foreach ($shop_sections as $shop_section) {
                                                ?>
                                                <a href="javascript:void(0)" class="common-menu <?php
                                                if ($i == 1) {
                                                    echo 'active';
                                                }
                                                ?>"><?php echo $shop_section['shop_section_name']; ?> <span>(<?php echo $shop_section['total']; ?>)</span></a>
                                                   <?php
                                                   $i++;
                                               }
                                               ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="browsAll_str_rht res_prod_sort">
                                    <div class="fil_drop">
                                        <button type="button" class="filDrop_btn popFil_btn">
                                            Sort By : <span>Most recent</span>
                                            <img src="<?php echo base_url('assets'); ?>/img/arrowdwn.png" alt="arrow">
                                        </button>
                                        <div class="filDrop_content popularity">
                                            <a href="javascript:void(0)" class="filteration" data-val="price_hi_low">Price (High-low)</a>
                                            <a href="javascript:void(0)" class="filteration" data-val="price_low_hi">Price (Low - high)</a>
                                            <a href="javascript:void(0)" class="filteration" data-val="free_delivery">Free Delivery</a>
                                            
                                            <!--<a href="javascript:void(0)" class="filteration" data-val="new_product">New products</a>-->
                                            <!--<a href="javascript:void(0)" class="filteration" data-val="review_score">E Market review score</a>-->
                                            <!--<a href="javascript:void(0)">Most ordered</a>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="itmcnt boxs">
                                    <!--<span>(1–16 OF 599)</span>-->
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
<div class="modal fade rate_review" role="dialog">
    <div class="modal-dialog" id="review_main_form">
        
    </div>
  </div>