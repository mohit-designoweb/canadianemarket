    <!-- sidenav start -->
    <div class="sidenav sidenav2" id="mySidenav">
        <!-- <a href="javascript:void(0)" data-toggle="modal" data-target="#login">Login</a>
            <a href="javascript:void(0)" ata-toggle="modal" data-target="#register">Register</a> -->
        <a href="javascript:void(0)" class="res_showbtn morebtn"><img src="<?php echo base_url('assets');?>/img/myaccimg.png" alt="myaccimg" class="img-responsive changFlg">My Account <img src="img/arrowdwn.png" alt="arrowdwn" class="img-responsive rotate"></a>
        <div class="useracclink">
            <a href="orderhistory">Orders History</a>
            <a href="javascript:void(0)">Invite a friend</a>
            <a href="javascript:void(0)">E - Market Credit <span>($28)</span></a>
            <a href="javascript:void(0)">Auto Re - Order</a>
            <a href="javascript:void(0)">Change Password</a>
            <a href="index">Logout</a>
        </div>
        <a href="javascript:void(0)" class="morebtn">Detect Location</a>
        <a href="javascript:void(0)" data-toggle="modal" data-target="#login" class="morebtn lgn">Login</a>
        <a href="javascript:void(0)" ata-toggle="modal" data-target="#register" class="morebtn ">Register</a>
        <a href="cart" class="morebtn ">Cart</a>

        <a href="stores" class="morebtn lgn">Stores</a>
        <a href="marketplace" class="morebtn lgn">Marketplace</a>
        <a href="restaurantslisting" class="morebtn">Restaurants</a>
        <a href="javascript:void(0)" class="more_btn">More <img src="<?php echo base_url('assets');?>/img/arrowdwn.png" class="rotate"></a>
        <div class="more_Links">
            <a href="terms" class="morebtn">Terms and Conditions</a>
            <a href="privacy" class="morebtn">Privacy Policy</a>
            <a href="help" class="morebtn">Help</a>
            <a href="javascript:void(0)" class="morebtn">Refer a Friend</a>
            <a href="partnerwithus" class="morebtn">Partner with Us</a>
        </div>
    </div>
    <!-- sidenav start -->

    <section class="myaccount topScrl">
        <div class="container">
            <div class="ship_inner boxs">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="myacc_lft">
                            <div class="browsetopics boxs">
                                <h5>Browse Help Topics</h5>
                                <div class="helptopics boxs">
                                    <ul>
                                        <?php 
										$i=1;
										foreach($categories as $category){?>
                                        <li><a href="<?php echo base_url('site/help-category-wrapper/'.$category['help_category_id']);?>" class="site-content <?php if($i==1){ echo "active";}?>" data-url="<?php echo $category['help_category_id'];?>"><?php echo $category['category_name'];?></a></li>
                                       
                                        <?php $i++;}?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="ship_lft boxs myacc_ryt" id="help-content-wrapper">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>