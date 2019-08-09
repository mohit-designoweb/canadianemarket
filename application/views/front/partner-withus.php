 <section class="banner partnerBanner topScrl">
        <div class="container">
            <div class="banner_inner boxs">
                <h3>Partner with us</h3>
                <h2>Increase Your store's Reach</h2>
            </div>
        </div>
    </section>

    <section class="details partner_details">
        <div class="container">
            <div class="d_inner boxs">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="d_item boxs">
                            <img src="<?php echo base_url('assets/img/customerIcon.png');?>" alt="detail1" class="img-responsive center-block" alt="icon">
                            <h5>Reach More Customers</h5>
                            <p>Partner with Canadian E Market and make your store more accessible to new customers from every end of the city. We help you maximize your store’s potentials by providing you with a seamless Online Shopping and Delivery Service which makes it easier for new customers to find your store and shop.We also help promote your SALE events city-wide and collaborate with you to provide special deals for your customers.</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="d_item boxs">
                            <img src="<?php echo base_url('assets/img/currIcon2.png');?>" alt="detail1" class="img-responsive center-block" alt="icon">
                            <h5>Increase your Revenue</h5>
                            <p>With Our Online Shopping and Delivery service, we will Increase your stores revenue by removing barriers like traffic, distance, weather, tight schedules etc, that affect sales and discourage shoppers from visiting your store. Using a our analytic, we also collaborate with your store, to create successful sale campaigns, to generate more streams for revenue.</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="d_item boxs">
                            <img src="<?php echo base_url('assets/img/currIcon3.png');?>" alt="detail1" class="img-responsive center-block" alt="icon">
                            <h5>Take the Burden off you</h5>
                            <p>We assist you with your on-boarding, store management and provide your business with a professional customer service, to assist your customers with all their questions, orders and issues. We take the burden off you so that you can focus on what really matters. What a great business partner to have! We are committed to helping you succeed at what you do.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="signUpform boxs">
        <div class="signup_top boxs">
            <img src="<?php echo base_url('assets/img/partnerBanner2.png');?>" class="img-responsive" alt="banner">
            <h3>Apply Now</h3>
        </div>
        <div class="signup_bottom boxs">
            <div class="container">
                <div class="form_wrpaer boxs">
                    
                    <div class="formWrap_inn boxs">
                        <form method="post" action="<?php echo base_url('site/doAddPartnerWithUs');?>" name="partnerForm" id="partnerForm">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>First name <i class="fa fa-asterisk"></i></label>
                                        <input type="text" name="first_name" id="first_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Last name <i class="fa fa-asterisk"></i></label>
                                        <input type="text" name="last_name" id="last_name" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email ID <i class="fa fa-asterisk"></i></label>
                                        <input type="email" name="email" id="email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Store Name <i class="fa fa-asterisk"></i></label>
                                        <input type="text" name="store_name" id="store_name" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Store Address<i class="fa fa-asterisk"></i></label>
                                        <input type="text" name="address1" id="address1" class="form-control" placeholder="House number and street name">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Address Line 2</label>
                                        <input type="text" name="address2" id="address2" class="form-control" placeholder="House number and street name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>City<i class="fa fa-asterisk"></i></label>
                                        <input type="text" name="city" id="city" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>State/Province/Region<i class="fa fa-asterisk"></i></label>
                                        <input type="text" name="state" id="state" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Postal / Zip Code<i class="fa fa-asterisk"></i></label>
                                        <input type="text" name="zipcode" id="zipcode" class="form-control">
                                    </div>
                                </div>
                                <!--<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <input type="text" name="country" id="country" class="form-control">
                                    </div>
                                </div>-->
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Select Country<i class="fa fa-asterisk"></i></label>
                                        <!--<input type="text" name="country_code" id="country_code" class="form-control" placeholder="Enter your country code ex: +91">-->
                                        <select name="country_code" id="country_code" class="form-control">
                                            <option>----SELECT-----</option>
                                            <?php foreach($country_code as $country){?>
                                            <option value="<?php echo $country['phonecode'].','.$country['name'];?>"><?php echo $country['name'];?>  (<?php echo '+'.$country['phonecode'];?>)</option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6"></div>
                           
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone Number<i class="fa fa-asterisk"></i></label>
                                        <input type="text" name="phone_no" id="phone_no" class="form-control" placeholder="enter mobile no.">
                                    </div>
                                </div>
                                <div class="col-sm-6"></div>
                            </div>
                            <button type="submit" name="partnerSub" id="partnerSub" class="submit_btn slidehover">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>