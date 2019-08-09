<section class="shipping topScrl">
    <div class="container">
        <!--breadcrumb navigation section-->
        <div class="bread_crumb breadcrumb_shipping">
            <div class="container">
                <ul class="bread_crumb_menu">
                    <li><a href="<?php echo base_url('site'); ?>">Home</a></li>
                    <li><a><i class="fa fa-angle-right"></i></a></li>
                    <li><a href="<?php echo base_url('store'); ?>" class="active">Stores</a></li>
                </ul>
            </div>
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
                        ?>" class="dashedline active">Delivery</a></li>
                    <li><a href="javascript:void(0)">Payment</a></li>
                </ul>
            </div>
            <div class="ship_head boxs">
                <h2>Delivery</h2>
                <div class="error_msg"></div>
            </div>

            <div class="row">
                <form  name="shipping_form" id="shipping_form" action="<?php echo base_url('cart/do-add-address'); ?>" method="post">
                    <div class="col-sm-8">
                        <div class="ship_lft boxs delivery_lft">
                            <h3>Billing Details</h3>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="fname">First name <sup>*</sup></label>
                                        <input type="text" class="form-control" id="fname" name="fname" value="<?php
                                        if (!empty($shipping_address['first_name'])) {
                                            echo $shipping_address['first_name'];
                                        }
                                        ?>" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="lname">Last name <sup>*</sup></label>
                                        <input type="text" class="form-control" id="lname" name="lname" value="<?php
                                        if (!empty($shipping_address['last_name'])) {
                                            echo $shipping_address['last_name'];
                                        }
                                        ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Email address <sup>*</sup></label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php
                                        if (!empty($shipping_address['email'])) {
                                            echo $shipping_address['email'];
                                        }
                                        ?>" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="cmpny">Company name (optional)</label>
                                        <input type="text" class="form-control" id="cmpny" name="cmpny" value="<?php
                                        if (!empty($shipping_address['company_name'])) {
                                            echo $shipping_address['company_name'];
                                        }
                                        ?>" >
                                    </div>
                                </div>
                            </div>
							<div class="col-sm-12">
                                        <div class="form-group">
										<label for="address_id">Address <sup>*</sup></label>
										<?php echo  form_dropdown(['name'=>'address_id','id'=>'address_id','class'=>'form-control'],$user_address,isset($shipping_address['address_id'])?$shipping_address['address_id']:'');?>
                                        </div>
                             </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="country">Country <sup>*</sup></label>
                                        <input type="text" class="form-control" id="country" name="country" value="<?php
                                        if (!empty($shipping_address['country'])) {
                                            echo $shipping_address['country'];
                                        }
                                        ?>" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="town">Town / City <sup>*</sup></label>
                                        <input type="text" class="form-control" id="town" name="town" value="<?php
                                        if (!empty($shipping_address['city'])) {
                                            echo $shipping_address['city'];
                                        }
                                        ?>" >
                                    </div>
                                </div>
                            </div>
                            <!--<div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="address">Street address <sup>*</sup></label>
                                        <input type="text" class="form-control mgbtm" id="address" name="address" placeholder="House number and street name" value="<?php
                                        if (!empty($shipping_address['address'])) {
                                            echo $shipping_address['address'];
                                        }
                                        ?>" >
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="address2" name="address2" placeholder="Apartment, suite, unit etc. (optional)" value="<?php
                                        if (!empty($shipping_address['address2'])) {
                                            echo $shipping_address['address2'];
                                        }
                                        ?>" >
                                    </div>
                                </div>
                            </div>-->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="province">Province <sup>*</sup></label>
                                        <input type="text" class="form-control" id="province" name="province" value="<?php
                                        if (!empty($shipping_address['province'])) {
                                            echo $shipping_address['province'];
                                        }
                                        ?>" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="pcode">Postcode / ZIP <sup>*</sup></label>
                                        <input type="text" class="form-control" id="pcode" name="pcode" value="<?php
                                        if (!empty($shipping_address['pin_code'])) {
                                            echo $shipping_address['pin_code'];
                                        }
                                        ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="phone">Phone <sup>*</sup></label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="<?php
                                        if (!empty($shipping_address['phone'])) {
                                            echo $shipping_address['phone'];
                                        }
                                        ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!--                                <div class="col-sm-12">
                                                                    <div class="tick">
                                                                        <input type="checkbox" class="tick_input" id="tick1" name="tick1">
                                                                        <label for="tick1"><span></span>Create an account?</label>
                                                                    </div>
                                                                    <div class="tick">
                                                                        <input type="checkbox" class="tick_input" id="tick2" name="tick2">
                                                                        <label for="tick2"><span></span>Ship to a different address?</label>
                                                                    </div>
                                                                </div>-->
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="onotes">Store Order notes (optional) </label>
                                        <textarea type="text" class="form-control" id="onotes"  name="onotes" placeholder="Notes about your order, e.g.special notes for delivery."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="payment_lft_btm boxs">
                                        <p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.</p>
                                        <div class="readaggre boxs">
                                            <div class="tick">
                                                <input type="checkbox" name="terms" class="tick_input" id="terms">
                                                <label for="terms"><span></span>I have read and agree to the website terms and conditions <sup>*</sup></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="ship_ryt boxs delivery_ryt">
                            <!--                            <div class="couponbox boxs res_coupon767">
                                                            <h5>Coupons</h5>
                                                            <div class="apply_coupons boxs">
                                                                <input type="text" class="form-control" placeholder="Coupon code">
                                                                <a href="javascript:void(0)">APPLY NOW</a>
                                                            </div>
                                                        </div>-->

                            <div class="your_order boxs">
                                <h5>Your Order</h5>
                                <div class="bd_btm"></div>
                                <h6>Subtotal (<?php
                                    if (!empty($store_cart['total_items'])) {
                                        echo $store_cart['total_items'];
                                        ?>
                                    <?php } ?> items) 
                                    <span>
                                        <?php
                                        if (!empty($store_cart['subtotal'])) {
                                            echo '$' . $store_cart['subtotal'];
                                        }
                                        ?>
                                    </span>
                                </h6>
                                <?php if (!empty($store_cart['discount'])) { ?>
                                    <h6>Discount <span>-$<?php echo $store_cart['discount']; ?></span></h6>
                                <?php } ?>

                                <?php if (!empty($store_cart['discounted_total'])) { ?>
                                    <h6>After Discount<span>$<?php echo $store_cart['discounted_total']; ?></span></h6>
                                <?php } ?>

                                <?php if (!empty($store_cart['taxed_price'])) { ?>
                                    <h6>Tax <span><?php echo '$' . $store_cart['taxed_price']; ?></span></h6>
                                    <!--                                    <div class="servicefee boxs">
                                                                            <p>Tax<span><?php echo '$' . $store_cart['taxed_price']; ?></span></p>
                                                                            <div class="bd_btm"></div>
                                                                        </div>-->
                                <?php } ?>
                                <?php if (!empty($store_cart['service_fee'])) { ?>
                                    <h6>Service Fee <span><?php echo '$' . $store_cart['service_fee']; ?></span></h6>
                                    <!--                                    <div class="servicefee boxs">
                                                                            
                                                                            <p>Service Fee<span><?php echo '$' . $store_cart['service_fee']; ?></span></p>
                                                                            <div class="bd_btm"></div>
                                                                        </div>-->
                                <?php } ?>



                                <?php if (!empty($store_cart['credit_points'])) { ?>
                                    <div class="servicefee boxs">
                                        <div class="tick">
                                            <input type="checkbox" class="tick_input" id="tick8">
                                            <label for="tick8"><span></span>Use E-Markets Credits</label>
                                        </div>
                                        <p class="fryt"><span><?php echo '$' . $store_cart['credit_points']; ?></span></p>
                                    </div>
                                <?php } ?> 
                                
                                <div class="deliveryboxs boxs">
                                    <div class="bd_btm"></div>
                                    <h5>Delivery</h5>
                                    
                                    <div class="fil_drop_main">
                                        <div class="tickcol">
                                            <div class="boxs mgbtm15">
                                                <div class="tick">
                                                    <input type="radio" name="delivery_type" class="tick_input" <?php if (!empty($this->session->userdata('delivery_type') != NUll)){ echo "checked"; } ?> value="$7.99" id="tick3"  disabled="disabled">
                                                    <label for="tick3"><span></span><i>Delivery : </i>$7.99</label>
                                                </div>
                                            </div>
                                            <div class="boxs">
                                                <div class="tick">
                                                    <input type="radio" name="delivery_type" value="null" class="tick_input"  <?php if (!empty($this->session->userdata('delivery_type') == NULL)){ echo "checked"; } ?> value ="" id="tick4" disabled="disabled">
                                                    <label for="tick4"><span></span>Pick Up</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    
                                <!--                                <div class="deliveryboxs boxs">
                                                                    <div class="bd_btm"></div>
                                                                    <h5>Delivery</h5>
                                
                                                                    <div class="fil_drop_main">
                                                                        <div class="tickcol">
                                                                            <div class="boxs mgbtm15">
                                                                                <div class="tick">
                                                                                    <input type="radio" name="delivery_type" class="tick_input"  value="" id="tick3">
                                                                                    <label for="tick3"><span></span><i>Delivery : </i></label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="boxs">
                                                                                <div class="tick">
                                                                                    <input type="radio" name="delivery_type" value="null" class="tick_input" id="tick4">
                                                                                    <label for="tick4"><span></span>Pick Up</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="fil_drop">
                                                                            <button type="button" class="filDrop_btn divFil_btn cart_fillbtn" data-toggle="modal" data-target="#time">
                                                                                    <g>ASAP </g>
                                                                                     <img src="img/arrowdwn.png" alt="arrow"> 
                                                                                </button>
                                                                        </div>
                                                                    </div>
                                                                </div>-->

                                <!--                                <div class="deliveryboxs boxs">
                                                                    <div class="bd_btm"></div>
                                                                    <h5>Tip</h5>
                                                                    <div class="row">
                                                                        <div class="col-sm-4">
                                                                            <div class="calmain">
                                                                                <div class="tick">
                                                                                    <input type="radio" name="price" class="tick_input" id="tick5">
                                                                                    <label for="tick5"><span></span>$2.00</label>
                                                                                </div>
                                                                                <div class="calcul">
                                                                                    <input type="text" name="price" value="" class="form-control" placeholder="10">
                                                                                    <span>%</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <div class="calmain">
                                                                                <div class="tick">
                                                                                    <input type="radio" name="price" class="tick_input" id="tick6">
                                                                                    <label for="tick6"><span></span>$4.00</label>
                                                                                </div>
                                                                                <div class="calcul">
                                                                                    <input type="text" name="price" value="" class="form-control" placeholder="6">
                                                                                    <span>$</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4 no_padd">
                                                                            <div class="calmain">
                                                                                <div class="tick">
                                                                                    <input type="radio" name="price" class="tick_input" id="tick7">
                                                                                    <label for="tick7"><span></span>$7.00</label>
                                                                                </div>
                                                                                <div class="calcul">
                                                                                    <p>Total : <span>$2.50</span></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>-->
                                <div class="deliveryboxs boxs">
                                    <div class="bd_btm"></div>
                                    <h5>Tip</h5>
                                    <?php 
                                    $calculation = 0;
                                    if (!empty($this->session->userdata('tip'))) {
                                        $tip = $this->session->userdata('tip');
                                        if (!empty($this->session->userdata('tip_value'))) {
                                            $tip_calculation= $this->session->userdata('tip_value');
                                            $calculation += $tip_calculation;
                                        } else {
                                            $tip_calculation = ($calculation * $tip) / 100;
                                            $calculation += $tip_calculation;
                                        }
                                    }
                                    ?>

                                    <div class="row">
                                        <div class="col-sm-4 pad_ryt_zer0">
                                            <div class="calmain">
                                                <div class="tick">
                                                    <input type="radio" name="tip" <?php if (!empty($tip)) {
                                        if ($tip == '2') {
                                            echo 'checked';
                                        }
                                    } ?> value="2" checked class="tick_input tip" id="tick5" disabled>
                                                    <label for="tick5"><span></span>2%</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="calmain">
                                                <div class="tick">
                                                    <input type="radio" name="tip" <?php if (!empty($tip)) {
                                        if ($tip == '4') {
                                            echo 'checked';
                                        }
                                    } ?> value="4" class="tick_input tip" id="tick6" disabled>
                                                    <label for="tick6"><span></span>4%</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 no_padd">
                                            <div class="calmain">
                                                <div class="tick">
                                                    <input type="radio" name="tip" <?php if (!empty($tip)) {
                                        if ($tip == '6') {
                                            echo 'checked';
                                        }
                                    } ?> value="6" class="tick_input tip" id="tick7" disabled>
                                                    <label for="tick7"><span></span>6%</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 pad_ryt_zer0">
                                            <div class="calmain">
                                                <div class="tick">
                                                    <input type="radio" name="tip" value="tip_value" <?php if (!empty($tip)) {
                                        if ($tip == 'tip_value') {
                                            echo 'checked';
                                        }
                                        } ?> class="tick_input tip" id="tick8" disabled>
                                                    <label for="tick8"><span></span><input type="text" value="<?php if(!empty($tip_value)){ echo $tip_value; } ?>" name="tip_value" id="tip_value" placeholder="Tip" class="inpbx"></label>
                                                </div>
                                            </div>
                                        </div>
    <!--                                    <div class="col-sm-4 col-md-offset-4">
                                            <a href="javascript:void(0)" data-url="<?php echo base_url('restaurant/apply-tips'); ?>" id="apply-tip" class="btn-sm btn-primary">Apply Tip</a>
                                        </div>-->
                                    </div>
                                </div>
                                
                                <div class="totalpay boxs">
                                    <div class="bd_btm"></div>
                                    <p>Total Payable
                                        <span>
                                            <?php
                                            if (!empty($store_cart['final_total'])) {
                                                echo '$' . $store_cart['final_total'];
                                            }
                                            ?>
                                        </span> 
                                    </p>
                                </div>

                                <div class="continuebtn boxs">
                                    <button type="submit" name="shipping_form_btn" id="shipping_form_btn" class="slidehover">CONTINUE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>