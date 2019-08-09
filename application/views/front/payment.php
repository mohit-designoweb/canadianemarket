<section class="shipping topScrl">
        <div class="container">
            <!--breadcrumb navigation section-->
            <div class="bread_crumb breadcrumb_shipping">
                <ul class="bread_crumb_menu">
                    <li><a href="<?php echo base_url('front');?>">Home</a></li>
                    <li><a><i class="fa fa-angle-right"></i></a></li>
                    <li><a href="#" class="active">Stores</a></li>
                </ul>
            </div>
            <!--breadcrumb navigation section end-->
            <div class="ship_inner boxs">
                <div class="shipping_process boxs">
                    <ul>
                        <li><a href="cart.html">Cart</a></li>
                        <li><a href="shipping.html" class="dashedline">Delivery</a></li>
                        <li><a href="payment.html" class="active">Payment</a></li>
                    </ul>
                </div>
                <div class="ship_head boxs">
                    <h2>Payment</h2>
                </div>
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <form method="post" name="payment_form" id="payment_form" action="<?php echo base_url('site/stripe_payment');?>">
                        <div class="ship_lft boxs payment_lft">
                            <div class="cardstype boxs">
                                <div class="tick">
                                    <input type="checkbox" class="tick_input" id="tick11" checked>
                                    <label for="tick11"><span></span>Credit Card <img src="<?php echo base_url('assets/img/cardtype.png');?>" alt="cardtype" class="img-responsive"></label>
                                </div>
                                <div class="bd_btm"></div>
                            </div>
                            
                                <div class="row">
                                    <div class="payment-status danger"></div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="card_holder">Name on card <sup>*</sup></label>
                                            <input type="text" class="form-control" id="card_holder" name="card_holder">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="card_number">Card number <sup>*</sup></label>
                                            <input type="text" class="form-control" id="card_number" name="card_number">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 reswidth100">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="email">Expiration Month <sup>*</sup></label>
                                                    <div class="card_dropbox">
                                                        <div class="card_drop_down">
<!--                                                            <button class="carddropbtn carddropbtn1" type="button"><span>Month</span> <img src="<?php echo base_url('assets/img/arrowdwn.png');?>" alt="arrowdwn" class="img-responsive rotate"></button>
                                                            <ul class="card_drop_menu card_drop_menu_s1">
                                                                <?php for($i='1';$i<='12';$i++){?>
                                                                <li><a href="javascript:void(0)"><?php echo $i;?></a></li>
                                                                <?php }?>
                                                            </ul>-->
                                                            <select class="form-control" id="month" name="month" value="">
                                                                <?php
                                                                    $min_month = 1;
                                                                    $max_month = 12;
                                                                    echo '<option value="">Select Month</option>';
                                                                    for($month = $min_month; $month<= $max_month; $month){
                                                                    ?>    
                                                                    <option value="<?php echo $month;?>"><?php  echo $month; ?></option>
                                                                    <?php
                                                                       $month++;
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="email">Expiration year <sup>*</sup></label>
                                                    <div class="card_dropbox">
                                                        <div class="card_drop_down">
<!--                                                            <button class="carddropbtn carddropbtn2" type="button"><span>Year</span> <img src="<?php echo base_url('assets/img/arrowdwn.png');?>" alt="arrowdwn" class="img-responsive rotate"></button>
                                                            <ul class="card_drop_menu card_drop_menu_s">
                                                                <?php for($i='2019';$i<='2024';$i++){?>
                                                                <li><a href="javascript:void(0)"><?php echo $i;?></a></li>
                                                                <?php }?>
                                                            </ul>-->
                                                            <select class="form-control" id="year" name="year" >
                                                                <?php
                                                                    $min_year = date("Y");
                                                                    $max_year = 2050;
                                                                    echo '<option value="">Select Year</option>';
                                                                    for($year = $min_year; $year<= $max_year; $year){
                                                                    ?>
                                                                    <option value="<?php echo $year;?>"><?php  echo $year; ?></option>
                                                                    <?php
                                                                        $year++;
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 reswidth100 width40">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <div class="form-group posrel">
                                                    <label for="card_code">Card security code <sup>*</sup></label>
                                                    <input type="text" class="form-control" id="card_code" name="card_code">
                                                    <p class="cvvexamp">123</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <!--<a href="javascript:void(0)" class="savebtn blkhover">Pay Now</a>-->
                                        <button class="btn btn-primary btn-lg btn-block" id="payment_tbn" type="submit">Pay Now</button>
                                        <div class="bd_btm"></div>
                                    </div>
<!--                                    <div class="col-sm-12">
                                        <div class="cash boxs">
                                            <div class="tick">
                                                <input type="checkbox" class="tick_input" id="tick9">
                                                <label for="tick9"><span></span>Cash on Delivery</label>
                                            </div>
                                        </div>
                                    </div>-->
                                </div>
                            
                        </div>
<!--                        <div class="payment_lft_btm boxs">
                            <p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.</p>
                            <div class="readaggre boxs">
                                <div class="tick">
                                    <input type="checkbox" class="tick_input" id="tick10">
                                    <label for="tick10"><span></span>I have read and agree to the website terms and conditions <sup>*</sup></label>
                                </div>
                            </div>
                        </div>-->
                    </form>
                    </div>
                    <div class="col-sm-2"></div>
                    
                </div>
            </div>
        </div>
    </section>

     
