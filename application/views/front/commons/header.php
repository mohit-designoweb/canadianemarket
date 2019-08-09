<?php// print_r($data);die;?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo base_url('assets/img/favicon.png'); ?>" type="image/ico" sizes="16x16">

        <title><?php if(!empty($title)){ echo $title; }else{ echo 'Home'; }  ?> | Canadian E Market</title>
        
		        <?php if(!empty($product)){ ?>
        <meta property="og:title" content="<?php echo str_replace(' ', '-', $product['product_name']); ?>" />
        <meta property="og:type" content="AssessnSelect" />
        <meta property="og:image" content="<?php echo base_url('uploads/products/' . $product['image_url']); ?>" />
        <meta property="og:url" content="<?php echo base_url('uploads/products/'.str_replace(' ', '-', $product['product_name'])); ?>" />
        <meta property="og:description" content="<?php echo strip_tags($product['description']) ?>" />

        <!--<meta property="og:locale" content="<?php echo strip_tags($product['shortDescription']); ?>" />-->
        <meta property="og:site_name" content="<?php echo base_url(); ?>"/>
        <?php } ?>
        
        <?php if(!empty($store)){ ?>
        <meta property="og:title" content="<?php echo str_replace(' ', '-', $store['store_name']); ?>" />
        <meta property="og:type" content="AssessnSelect" />
        <meta property="og:image" content="<?php echo base_url('uploads/products/' . $store['image_url']); ?>" />
        <meta property="og:url" content="<?php echo base_url('uploads/store/'.str_replace(' ', '-', $store['store_name'])); ?>" />
        <!--<meta property="og:description" content="<?php echo strip_tags($store['description']) ?>" />-->

        <!--<meta property="og:locale" content="<?php echo strip_tags($store['description']); ?>" />-->
        <meta property="og:site_name" content="<?php echo base_url(); ?>"/>
        <?php } ?>
        
        <?php if(!empty($restaurant)){ ?>
        <meta property="og:title" content="<?php echo str_replace(' ', '-', $restaurant['restaurant_name']); ?>" />
        <meta property="og:type" content="AssessnSelect" />
        <meta property="og:image" content="<?php echo base_url('uploads/restaurant/' . $restaurant['image_url']); ?>" />
        <meta property="og:url" content="<?php echo base_url('restaurant/'.str_replace(' ', '-', $restaurant['restaurant_name'])); ?>" />
        <!--<meta property="og:description" content="<?php echo strip_tags($restaurant['description']) ?>" />-->

        <!--<meta property="og:locale" content="<?php echo strip_tags($restaurant['description']); ?>" />-->
        <meta property="og:site_name" content="<?php echo base_url(); ?>"/>
        <?php } ?>
		
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/hamburgers.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/slick-theme.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/slick.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/media.css'); ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    </head>

    <body>

        <header class="header">
            <div class="container-fluid">
                <div class="h_top">
                    <div class="row rowflex">
                        <div class="col-sm-6 width40">
                            <div class="h_top_lft">
                                <a href="<?php echo base_url('site') ?>">Welcome to canadianemarket.ca</a>
                            </div>
                        </div>
                        <div class="col-sm-6 width60">
                            <div class="h_top_ryt">
                                <span> <?php if(!empty($this->input->cookie('address', true))){ echo $this->input->cookie('address', true); } ?></span>
                                <div class="resScroll">
                                <div class="resFlex">
                                <div class="chat_box chat_box_header">
                                    <a href="javascript:void(0)" class="chat">
                                        <img src="<?php echo base_url('assets/img/chat_03.png'); ?>" alt="chat">
                                        <span>Support</span>
                                    </a>
                                </div>
                                
                                
                                <div class="dropbox">
                                    <?php
                                    $country_id = $this->input->cookie('country_id', true);
                                    $city_id = $this->input->cookie('city_id', true);
                                    ?>
                                    <span class="custom-dropdown big">
                                        <?php echo form_dropdown(['name' => 'country', 'id' => 'country', 'data-url' => base_url('site/getCityByCountry')], $countries, isset($country_id) ? $country_id : ''); ?>
                                    </span>
                                </div>
                                <div class="dropbox">
                                    <span class="custom-dropdown big">
                                        <select name="city" id="city" data-url="<?php echo base_url('site/set-city'); ?>">
                                            <?php
                                            if (!empty($cities)) {
                                                foreach ($cities as $city) {
                                                    ?>
                                                    <option value="<?php echo $city['city_id']; ?>" <?php
                                                    if (!empty($city_id)) {
                                                        if ($city_id == $city['city_id']) {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>><?php echo $city['city_name']; ?></option><?php
                                                        }
                                                    } else {
                                                        ?>
                                                <option value=''>Select City</option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </span>
                                </div>
                                <div id="google_translate_element"></div> 
                            </div>
                                </div>    
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="h_btm">
                        <div class="row rowflex">
                            <div class="col-sm-6 width45">
                                <div class="h_btm_lft">
                                    <button class="hamburger hamburger--squeeze hamburgerres" type="button" aria-label="Menu" aria-controls="navigation">
                                        <span class="hamburger-box">
                                            <span class="hamburger-inner"></span>
                                        </span>
                                    </button>
                                    <a class="brand_logo" href="<?php echo base_url('site'); ?>"><img src="<?php echo base_url('assets/img/logo.png'); ?>" class="img-responsive res_logo_hide" alt="logo"><img src="<?php echo base_url('assets/img/res_logo.png'); ?>" class="img-responsive res_logo_show" alt="logo"></a>
                                    <div class="searchbox searchboxindex searchpos1">
                                        <form id="frontSearchData" name="frontSearchData" class="frontSearchData" method="post" >
                                            <div class="input_group">
                                                <input id="search" type="text" class="form-control" name="search" placeholder="Restaurants, grocery, fashion" data-url="<?php echo base_url('site/do-search-data');?>">
                                                <a href="#" class="searchbtns"><img src="<?php echo base_url('assets/img/searchicon.png');?>" alt="searchicon" class="img-responsive "></a>
                                            </div>
                                        
                                            <div class="searchresults searchpos2" id="search_founds">
                                                
                                            </div>
                                        </form>
                                    </div>
                                    <form id="demo-2" class="searchrespon head_search">
                                        <input type="search" placeholder="Search">
                                    </form>
                                    <div class="carticon">
                                        <a href="javascript:void(0)"><img src="<?php echo base_url('assets/img/cart2.png'); ?>" alt="cart"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 dnone width55">
                                <div class="h_btm_ryt">
								
                                    <?php
                                        $address = $this->input->cookie('address', true);
                                        ?>
                                <ul class="navlinks <?php if(empty($address)){ echo 'hidden'; } ?> ">
                                        <li><a href="<?php echo base_url('store'); ?>" class="<?php
                                        if (!empty($title)) {
                                            if ($title == 'Store') {
                                                echo 'active';
                                            }
                                        }
                                        ?>">Stores</a></li>
                                    <li><a href="<?php echo base_url('restaurant'); ?>" class="<?php
                                        if (!empty($title)) {
                                            if ($title == 'Restaurant') {
                                                echo 'active';
                                            }
                                        }
                                        ?>">Restaurants</a></li>
                                    <li><a href="<?php echo base_url('marketPlace'); ?>" class="<?php
                                        if (!empty($title)) {
                                            if ($title == 'Market Place') {
                                                echo 'active';
                                            }
                                        }
                                        ?>">Marketplace</a></li>
                                    </ul>
                                    
                                   <div class="myaccountdrop">
                                    <?php $this->session->set_userdata('page_url', base_url(uri_string())); ?>
                                    <?php if (!empty($this->session->userdata('unique_id'))) { ?>
                                        <div class="myaccdrop_down">
                                            <button class="myaccdropbtn" type="button">
                                                <img src="<?php
                                                if (isset($user_data['image_off_on']) && isset($user_data['image_url'])) {
                                                    $image = $user_data['image_url'];
                                                    echo base_url('uploads/profile_images/') . $image;
                                                } else {
                                                    echo base_url('assets/img/userimg.png');
                                                }
                                                ?>" alt="myaccimg" class="img-responsive changFlg">
                                                <span><?php echo ucwords($user_data['user_name']);?></span> <img src="<?php echo base_url('assets'); ?>/img/arrowdwn.png" alt="arrowdwn" class="img-responsive rotate"></button>
                                            <ul class="accdrop_menu">
                                                <li><a href="<?php echo base_url('user/my-account'); ?>">My Account</a></li>
                                                <li><a href="<?php echo base_url('user/logout'); ?>">logout</a></li>
                                            </ul>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <p><a href="javascript:void(0)" class="login" data-toggle="modal" data-target="#login">login</a> / <a href="javascript:void(0)" class="login" data-toggle="modal" data-target="#register">Register</a></p>
                                    <?php }
                                    ?>
                                </div>
                                    <p>
                                    <?php
                                    $count=0;
                                    if (!empty($this->cart->contents())) {
                                        foreach($this->cart->contents() as $cartdata){
                                            if(!empty($cartdata['module'] === 'store')){
                                                $count+=$cartdata['qty'];
                                            }
                                            // print_r($cartdata);
                                            
                                            // $cartdata['module'];
                                        }
                                        
                                    }
                                    ?>
                                    <a href="<?php echo base_url('cart'); ?>" class="basket"><img src="<?php echo base_url('assets/img/basket.png'); ?>" alt="basket" class="img-responsive"><span><?php if(!empty($count)){ echo $count; }else { echo '0'; }  ?></span></a>
                                    <!--<a href="javascript:void(0)" id="get-location" class="detectbtn"><img src="<?php echo base_url('assets/img/detectloc.png'); ?>" alt="detectloc" class="img-responsive">Detect Location</a> -->
                                </p>
                                </div>

                            </div>
                        </div>
                    </div>
            </div>
        </header>

        <!-- sidenav start -->
        <!-- <div class="sidenav" id="mySidenav">
             <a href="javascript:void(0)" class="morebtn">Detect Location</a>
             <a href="javascript:void(0)" data-toggle="modal" data-target="#login" class="morebtn lgn">Login</a>
             <a href="javascript:void(0)" ata-toggle="modal" data-target="#register" class="morebtn ">Register</a>
             <a href="cart" class="morebtn ">Cart</a>
     
             <a href="stores" class="morebtn lgn">Stores</a>
             <a href="marketplace" class="morebtn lgn">Marketplace</a>
             <a href="restaurantslisting" class="morebtn">Restaurants</a>
             <a href="javascript:void(0)" class="more_btn">More <img src="<?php echo base_url('assets'); ?>/img/arrowdwn.png" class="rotate"></a>
             <div class="more_Links">
                 <a href="terms" class="morebtn">Terms and Conditions</a>
                 <a href="privacy" class="morebtn">Privacy Policy</a>
                 <a href="help" class="morebtn">Help</a>
                 <a href="javascript:void(0)" class="morebtn">Refer a Friend</a>
                 <a href="partnerwithus" class="morebtn">Partner with Us</a>
             </div>
         </div>-->
        <div class="sidenav sidenav2" id="mySidenav">
            <?php
            if (!empty($this->session->userdata('unique_id'))) {
                ?>
                <a href="javascript:void(0)" class="res_showbtn morebtn">
                    <img src="<?php
                    if (isset($user_data['image_off_on']) && isset($user_data['image_url'])) {
                        $image = $user_data['image_url'];
                        echo base_url('uploads/profile_images/') . $image;
                    } else {
                        echo base_url('assets/img/userimg.png');
                    }
                    ?>" alt="myaccimg" class="img-responsive changFlg">My Account <img src="<?php echo base_url('assets/img/arrowdwn.png'); ?>" alt="arrowdwn" class="img-responsive rotate">
                </a>
                <div class="useracclink">
                    <a href="javascript:void(0)">Orders History</a>
                    <a href="javascript:void(0)">Invite a friend</a>
                    <a href="javascript:void(0)">E - Market Credit <span>($28)</span></a>
                    <a href="javascript:void(0)">Auto Re - Order</a>
                    <?php if (isset($user_data)) {
                        if ($user_data['source'] == 'self') {
                            ?>
                            <a href="javascript:void(0)">Change Password</a>
                        <?php }
                    }
                    ?>
                    <a href="<?php echo base_url('user/logout'); ?>">Logout</a>
                </div>
                <?php
            } else {
                ?>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#login" class="morebtn lgn">Login</a>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#register" class="morebtn ">Register</a>
                <?php
            }
            ?>
            <!--<a href="javascript:void(0)"  class="morebtn" id="get-location">Detect Location</a>-->
            <a href="cart" class="morebtn ">Cart</a>

            <a href="<?php echo base_url('store'); ?>" class="morebtn lgn">Stores</a>
            <a href="<?php echo base_url('marketPlace'); ?>" class="morebtn lgn">Marketplace</a>
            <a href="<?php echo base_url('restaurant'); ?>" class="morebtn">Restaurants</a>
            <a href="javascript:void(0)" class="more_btn">More <img src="<?php echo base_url('assets'); ?>/img/arrowdwn.png" class="rotate"></a>
            <div class="more_Links">
                <a href="<?php echo base_url('site/terms'); ?>" class="morebtn">Terms and Conditions</a>
                <a href="<?php echo base_url('site/privacy') ?>" class="morebtn">Privacy Policy</a>
                <a href="<?php echo base_url('site/help'); ?>" class="morebtn">Help</a>
                <a href="javascript:void(0)" class="morebtn">Refer a Friend</a>
                <a href="<?php echo base_url('site/partner-with-us'); ?>" class="morebtn">Partner with Us</a>
                 <div class="myaccountdrop myaccountdrop233">
            
                <?php $this->session->set_userdata('page_url', base_url(uri_string())); ?>
                <?php if (!empty($this->session->userdata('unique_id'))) {  ?>
                    <div class="myaccdrop_down">
                        <button class="myaccdropbtn" type="button">
                            <img src="<?php
                            if (isset($user_data['image_off_on']) && isset($user_data['image_url'])) {
                                $image = $user_data['image_url'];
                                echo base_url('uploads/profile_images/') . $image;
                            } else {
                                echo base_url('assets/img/userimg.png');
                            }
                            ?>" alt="myaccimg" class="img-responsive changFlg">
                            <span><?php echo ucwords($user_data['user_name']); ?></span> <img src="<?php echo base_url('assets'); ?>/img/arrowdwn.png" alt="arrowdwn" class="img-responsive rotate"></button>
                        <ul class="accdrop_menu">
                            <li><a href="<?php echo base_url('user/my-account'); ?>">My Account</a></li>
                            <li><a href="<?php echo base_url('user/logout'); ?>">logout</a></li>
                        </ul>
                    </div>
                    <?php
                } else {
                    ?>
                    <p><a href="javascript:void(0)" class="login" data-toggle="modal" data-target="#login">login</a> / <a href="javascript:void(0)" class="login" data-toggle="modal" data-target="#register">Register</a></p>
                <?php }
                ?>
            </div>
            </div>
        </div>