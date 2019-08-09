<section class="banner become_banner topScrl">
        <div class="container">
            <div class="banner_inner boxs">
                <h3>Join Our Courier Network</h3>
                <h2>Become a courier</h2>
            </div>
        </div>
    </section>

    <section class="details become_details">
        <div class="container">
            <div class="d_inner boxs">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="d_item boxs">
                            <img src="<?php echo base_url('assets');?>/img/currIcon.png" alt="detail1" class="img-responsive center-block" alt="icon">
                            <h5>Earn Extra Money</h5>
                            <p>Join our Courier network and Earn extra money on your spare time, We take care of our Couriers and ensure their safety. We also provide them with opportunities to grow within the company, in various roles.</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="d_item boxs">
                            <img src="<?php echo base_url('assets');?>/img/calndr.png" alt="detail1" class="img-responsive center-block" alt="icon">
                            <h5>Get Paid Weekly with Bonus</h5>
                            <p>As a courier you get paid weekly and you keep 100% of delivery fees, tips and also get a bonus on your pay every week, when you meet the set quota of deliveries for the week.</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="d_item boxs">
                            <img src="<?php echo base_url('assets');?>/img/calndr2.png" alt="detail1" class="img-responsive center-block" alt="icon">
                            <h5>Choose Schedules, More Money</h5>
                            <p>You choose and control how you work. Set you availability weekly and earn more money when you set your a schedules for a longer period.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="signUpform boxs">
        <div class="signup_top boxs">
            <img src="<?php echo base_url('assets/img/signupBanner.png');?>" class="img-responsive" alt="banner">
            <h3>Sign Up Now</h3>
        </div>
        <div class="signup_bottom boxs">
            <div class="container">
                <div class="form_wrpaer boxs">
                    <div class="formWrap_inn boxs">
                        <form method="post" action="<?php echo base_url('site/doAddCourier');?>" name="courierForm" id="courierForm">
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
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Email ID <i class="fa fa-asterisk"></i></label>
                                        <input type="email" name="email" id="email" class="form-control">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Store Address <i class="fa fa-asterisk"></i></label>
                                        <input type="text" class="form-control" name="store_address1" id="store_address1" placeholder="House number and street name">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Address Line 2</label>
                                        <input type="text" class="form-control" name="store_address2" id="store_address2" placeholder="House number and street name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>City <i class="fa fa-asterisk"></i></label>
                                        <input type="text" name="city" id="city" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>State/Province/Region <i class="fa fa-asterisk"></i></label>
                                        <input type="text" class="form-control" name="state" id="state">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Postal / Zip Code <i class="fa fa-asterisk"></i></label>
                                        <input type="text" class="form-control" name="zipcode" id="zipcode">
                                    </div>
                                </div>
<!--                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <input type="text" class="form-control" name="country" id="country">
                                    </div>
                                </div>-->
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Select Country <i class="fa fa-asterisk"></i></label>
                                        <!--<input type="text" name="country_code" id="country_code" class="form-control" placeholder="Enter your country code ex: +91">-->
                                        <select name="country_code" id="country_code" class="form-control">
                                            <option>----SELECT-----</option>
                                            <?php foreach($country_code as $country){?>
                                            <option value="<?php echo $country['phonecode'].','.$country['name'];?>"><?php echo $country['name'];?>  (<?php echo '+'.$country['phonecode'];?>)</option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone Number <i class="fa fa-asterisk"></i></label>
                                        <input type="text" name="phone" id="phone" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="submit_btn slidehover" name="courierBtn" id="courierBtn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>