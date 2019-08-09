<section class="shipping topScrl">
    <div class="container">
        <!--breadcrumb navigation section-->
        <div class="bread_crumb breadcrumb_shipping">
            <ul class="bread_crumb_menu">
                <li><a href="<?php echo base_url('site'); ?>">Home</a></li>
                <li><a><i class="fa fa-angle-right"></i></a></li>
                <li><a href="<?php echo base_url('store'); ?>" class="active">Stores</a></li>
            </ul>
        </div>
        <!--breadcrumb navigation section end-->
        <?php
        if (!empty($this->cart->contents())) {
            $count = count($this->cart->contents());
        }
        ?>
        <div class="ship_inner boxs">
            <div class="shipping_process boxs">
                <ul>
                    <li><a href="<?php echo base_url('cart'); ?>">Cart</a></li>
                    <li><a href="<?php
                        if (!empty($count)) {
                            echo base_url('delivery');
                        } else {
                            echo '#';
                        }
                        ?>" class="dashedline">Delivery</a></li>
                    <li><a href="<?php
                        if (!empty($count)) {
                            echo base_url('payment');
                        } else {
                            echo '#';
                        }
                        ?>" class="active">Payment</a></li>
                </ul>
            </div>
            <div class="ship_head boxs">
                <h2>Payment</h2>
                <div class="error_msg"></div>
            </div>
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <div class="ship_lft boxs payment_lft">

                        <form name="payment_form" id="payment_form" action="<?php echo base_url('cart/do-payment'); ?>" method="post">
                            <div class="cardstype boxs">
                                <div class="tick">
                                    <input type="radio" checked value="credit_card" name="payment_type" class="tick_input" id="tick11">
                                    <label for="tick11"><span></span>Credit Card <img src="<?php echo base_url('assets/img/cardtype.png'); ?>" alt="cardtype" class="img-responsive"></label>
                                </div>
                                <div class="payment-status text-center text-danger"></div>
                                <div class="bd_btm"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="card_holder">Name on card <sup>*</sup></label>
                                        <input type="text" class="form-control" id="card_holder" name="card_holder" value="<?php if(!empty($userpayment_data['card_holder'])) { echo $userpayment_data['card_holder']; } ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="card_number">Card number <sup>*</sup></label>
                                        <input type="text" class="form-control" id="card_number" name="card_number" value="<?php if(!empty($userpayment_data['card_number'])) { echo $userpayment_data['card_number']; } ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6 reswidth100">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exp_date">Expiration Month <sup>*</sup></label>
                                                <div class="card_dropbox">
                                                    <div class="card_drop_down">
                                                        <select class="form-control" id="month" name="month" value="">
                                                                <?php
                                                                    $min_month = 1;
                                                                    $max_month = 12;
                                                                    echo '<option value="">Select Month</option>';
                                                                    for($month = $min_month; $month<= $max_month; $month){
                                                                    ?>    
                                                                    <option value="<?php echo $month;?>" <?php if($month == $userpayment_data['month']){ echo "selected";} ?>><?php  echo $month; ?></option>
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
                                                <label for="email">Expiration Year <sup>*</sup></label>
                                                <div class="card_dropbox">
                                                    <div class="card_drop_down">
                                                        <select class="form-control" id="year" name="year" >
                                                                <?php
                                                                    $min_year = date("Y");
                                                                    $max_year = 2050;
                                                                    echo '<option value="">Select Year</option>';
                                                                    for($year = $min_year; $year<= $max_year; $year){
                                                                    ?>
                                                                    <option value="<?php echo $year;?>" <?php if($year == $userpayment_data['year']){ echo "selected";} ?>><?php  echo $year; ?></option>
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
                                                <input type="text" class="form-control" id="card_code" name="card_code" >
                                                <p class="cvvexamp">123</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" name="payment_tbn" id="payment_tbn" class="savebtn blkhover">Save And Continue</button>
                                    <div class="bd_btm"></div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="cash boxs">
                                        <div class="tick">
                                            <input type="radio" value="cod" name="payment_type" id="cash_on_delivery" data-url="<?php echo base_url('cart/cash-on-delivery/'); ?>" class="tick_input" id="tick9">
                                            <label for="cash_on_delivery"><span></span>Cash on Delivery</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>
    </div>
</section>