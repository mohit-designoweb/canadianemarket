
    <!-- sidenav start -->

   <section class="banner topScrl">
        <div class="container">
            <div class="banner_inner boxs">
                <h3>Skip the mall with</h3>
                <h2>Canadian e Market</h2>
                <div class="searchbox2">
                    <div class="locationbtn">
                        <img src="<?php echo base_url('assets/img/locicon.png'); ?>" alt="locicon" class="img-responsive locicon">
                        <div class="input_group">
                          <!--  <button class="input-group-addon slidehover">FIND</button>-->
                            <input id="address" type="text" class="form-control" name="search" placeholder="Enter your address here">
                            <div class="mapshowbox" id="googlePlace">
                                <div id="map" class="map_inner map_inner2"></div>
                                <div id="map2" class="map_inner map_inner3"></div>
                                <div class="btnbox boxs">
                                    <button type="button" disabled data-url="<?php echo base_url('site/setAddress'); ?>" id="set-address" class="btn_btn">Provide House number </button>
                                </div>
                                <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.409323577076!2d77.38927341440682!3d28.617491891513858!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ceff90fa5fafb%3A0x3ebe611df73b7817!2sDesignoweb+Technologies+PVT.+LTD.!5e0!3m2!1sen!2sin!4v1562308433498!5m2!1sen!2sin" frameborder="0" style="border:0" allowfullscreen></iframe> -->
 
                            </div>
                           
                        </div>
                        <div class="locbox">
                            <img onclick="initMap()" src="<?php echo base_url('assets/img/detectlocblk.png'); ?>" alt="detectloc" class="img-responsive lockimg find_bn">                             
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="details">
        <div class="container">
            <div class="d_inner boxs">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="d_item boxs">
                            <img src="<?php echo base_url('assets/img/detail1.png');?>" alt="detail1" class="img-responsive center-block">
                            <h5>Skip The Mall</h5>
                            <p>We have partnered with local Stores around you, even those that do not normally sell online or deliver, to provide you with a more effective and convenient way to shop for everything from Groceries, Fashion, to Household/Gift items in one order and have it delivered to your door in minutes.</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="d_item boxs">
                            <img src="<?php echo base_url('assets/img/detail2.png');?>" alt="detail1" class="img-responsive center-block">
                            <h5>Delivery in Minutes</h5>
                            <p>Our city wide delivery network is tailored to provide a fast, most efficient way of shopping. Our couriers are always ready to jump on your order as soon as it is placed and get it to you in no time.</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="d_item boxs ditem_res_mgbtm">
                            <img src="<?php echo base_url('assets/img/detail3.png');?>" alt="detail1" class="img-responsive center-block">
                            <h5>Save Time</h5>
                            <p>Finding the right time to do all your in town shopping, can be hard and complicated. Now you can Skip the mall, traffic, long drives or checkout queue and Let us take care of the hassle and heavy lifting while you focus on selecting those items you really love.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="services">
        <div class="container">
            <div class="s_inner boxs">
                <h3 class="s_head">Now Servicing</h3>

                <div class="slider slick res_slickhide">
                    <div class="boxs">
                    <div class="row">
                        <?php foreach ($all_cities as $city) {
                            ?>
                            <div class="col-sm-3">
                                <div class="s_item">
                                    <?php if($city['is_active']=='Inactive'){
                                    ?>
                                    <div class="ribn">Coming Soon</div>
                                    <?php
                                    } ?>
                                    <a href="<?php if($city['is_active']=='Active'){ echo base_url('site/set-city/'.$city['city_id']);  }else{ echo 'javascript:void(0)'; }  ?>" id="select-city">
                                        <img src="<?php echo base_url('uploads/country/'.$city['image_url']); ?>" alt="Image Not Found" class="img-responsive center-block slideimg">
                                        <p class="posdown"><?php echo $city['city_name']; ?><img src="<?php echo base_url('assets'); ?>/img/shape1.png" alt="shape1" class="img-responsive center-block"></p>
                                    </a>
                                </div>
<!--                                                                <div class="s_item">
                                                                    <div class="ribn">Coming Soon</div>
                                                                    <a href="javascript:void(0)">
                                                                        <img src="<?php echo base_url('assets'); ?>/img/s_img2.png" alt="s_img1" class="img-responsive center-block slideimg">
                                                                        <p class="posdown">Ottwa</p>
                                                                    </a>
                                                                </div>-->
                            </div>
                        <?php }
                        ?>

                        <!--                        <div class="col-sm-3">
                                                    <div class="s_item">
                                                        <div class="ribn">Coming Soon</div>
                                                        <a href="javascript:void(0)">
                                                            <img src="<?php echo base_url('assets'); ?>/img/s_img3.png" alt="s_img1" class="img-responsive center-block slideimg">
                                                            <p class="postop">Toronto</p>
                                                        </a>
                                                    </div>
                                                    <div class="s_item">
                                                        <div class="ribn">Coming Soon</div>
                                                        <a href="javascript:void(0)">
                                                            <img src="<?php echo base_url('assets'); ?>/img/s_img4.png" alt="s_img1" class="img-responsive center-block slideimg">
                                                            <p class="postop">Montreal</p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="s_item">
                                                        <div class="ribn">Coming Soon</div>
                                                        <a href="javascript:void(0)">
                                                            <img src="<?php echo base_url('assets'); ?>/img/s_img5.png" alt="s_img1" class="img-responsive center-block slideimg">
                                                            <p class="posdown">Calgary</p>
                                                        </a>
                                                    </div>
                                                    <div class="s_item">
                                                        <div class="ribn">Coming Soon</div>
                                                        <a href="javascript:void(0)">
                                                            <img src="<?php echo base_url('assets'); ?>/img/s_img6.png" alt="s_img1" class="img-responsive center-block slideimg">
                                                            <p class="postop">Edmonton</p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="s_item">
                                                        <div class="ribn">Coming Soon</div>
                                                        <a href="javascript:void(0)">
                                                            <img src="<?php echo base_url('assets'); ?>/img/s_img7.png" alt="s_img1" class="img-responsive center-block slideimg">
                                                            <p class="postop">Vanvouver</p>
                                                        </a>
                                                    </div>
                                                    <div class="s_item">
                                                        <div class="ribn">Coming Soon</div>
                                                        <a href="javascript:void(0)">
                                                            <img src="<?php echo base_url('assets'); ?>/img/s_img8.png" alt="s_img1" class="img-responsive center-block slideimg">
                                                            <p class="postop">Mississauga</p>
                                                        </a>
                                                    </div>
                                                </div>-->
                    </div>
                </div>
                    
                </div>
            </div>
        </div>
    </section>


    <section class="courier">
        <div class="container">
            <div class="cou_inner boxs">
                <h3>Become a Courier</h3>
                <p>Become a courier with Canadian E Market and Earn some extra money. You get 100% of your delivery fee and tips with a possibility of getting extra bonus, paid out every week. You set your schedule to suit you.</p>
                <p><a href="<?php echo base_url('site/courier');?>" class="slidehover">JOIN NOW</a></p>
            </div>
        </div>
    </section>

    <section class="partner">
        <div class="container">
            <div class="partner_inner boxs">
                <div class="row rowflex rowflexinitial">
                    <div class="col-sm-6">
                        <div class="part_items boxs">
                            <p><img src="<?php echo base_url('assets/img/partnerimg1.png');?>" alt="partnerimg" class="img-responsive center-block"></p>
                            <div class="part_content boxs">
                                <h4>Partner with us</h4>
                                <p>Reach more local Shoppers and build a new revenue stream by partnering with us. Provide your Business with Our online shopping and delivery service and become more accessible to your community.</p>
                                <a href="<?php echo base_url('site/partner-with-us');?>">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="part_items boxs">
                            <p><img src="<?php echo base_url('assets/img/partnerimg2.png');?>" alt="partnerimg" class="img-responsive center-block"></p>
                            <div class="part_content boxs">
                                <h4>Career</h4>
                                <p>Build a career with us and acquire skills that can help you stand out in your field and grow into an industry leader in a very relaxed environment. Grow with our team as we take on challenging tasks, on a daily basis.</p>
                                <a href="<?php echo base_url('career');?>">APPLY</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    