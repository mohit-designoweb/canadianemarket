<div class="ship_ryt boxs mgbtm0">
    <form method="post" action="<?php echo base_url('cart/checkout-continue'); ?>" id="do-add-billing">
        <?php 
            if(!empty($this->cart->contents())){
                foreach($this->cart->contents() as $cartdata){
                    $cartdata['module'];
                }
            }

            if($cartdata['module'] === 'store'){
        ?>
        <div class="couponbox coupon_box boxs res_coupon767">
            <h5>Coupons</h5>
            <?php
            $coupon;
            if (!empty($this->session->userdata('store_coupon'))) {
                $coupon = $this->session->userdata('store_coupon');
            }
            ?>
            <div class="apply_coupons boxs">
                <input type="text" name="coupon_code" id="coupon" class="form-control" value="<?php
                if (!empty($coupon)) {
                    echo $coupon['coupon_code'];
                }
                ?>" placeholder="Coupon code">
                <a href="<?php echo base_url('cart/applyCoupon'); ?>" id="apply-coupon">APPLY NOW</a>
            </div>
            <?php if (!empty($coupon)) { ?>
                <a href="<?php echo base_url('cart/removeCoupon'); ?>" id="remove-coupon">Remove Coupon</a>
            <?php } ?>
        </div>
        <?php
        if (!empty($this->cart->contents())) {
            $carts = $this->cart->contents();
            $count = count($carts);
        }
        ?>
        
        <div class="your_order your2_order2 boxs res_coupon767">
        
            <h5>Your Order</h5>
            <div class="bd_btm"></div>
            <h6>Subtotal (<?php
                if (!empty($count)) {
                    echo $count;
                    ?>
                    <input type="hidden" name="total_items" id="total_items" value="<?php echo $count; ?>"/>
                    <?php
                } else {
                    echo '0';
                    ?>
                    <input type="hidden" name="total_items" id="total_items" value="<?php echo '0'; ?>"/>
                    <?php
                }
                ?> items) <span>$<?php echo $this->cart->format_number($this->cart->total()); ?></span>
                <input type="hidden" name="subtotal" id="subtotal" value="<?php echo $this->cart->format_number($this->cart->total()); ?>"/>
            </h6>

            <?php
            $calculation = 0;
            if (!empty($this->session->userdata('store_coupon'))) {
                $coupon = $this->session->userdata('store_coupon');
                $subtotal = $this->cart->total();
                if ($coupon['coupon_type'] == 'per') {
                    $discounted_price = ($subtotal * $coupon['coupon_amount']) / 100;
                    $discounted_total = $subtotal - $discounted_price;
                    $calculation = $discounted_total;
                    $discount_msg = $coupon['coupon_amount'] . '% OFF';
                } else if ($coupon['coupon_type'] == 'val') {
                    $discounted_price = $subtotal - $coupon['coupon_amount'];
                    $discounted_total = $subtotal - $discounted_price;
                    $calculation = $discounted_total;
                    $discount_msg = $coupon['coupon_amount'] . '/- OFF';
                }
            } else {
                $calculation = $this->cart->total();
            }if (!empty($discounted_price) & !empty($this->cart->contents())) {
                ?>

                <h6>Discount<?php
                    if (!empty($discount_msg)) {
                        echo ' (' . $discount_msg . ')';
                    }
                    ?> <span>-$<?php echo $this->cart->format_number($discounted_price); ?></span></h6>
                <input type="hidden" name="discount" id="discount" value="<?php echo $this->cart->format_number($discounted_price); ?>"/>
                <?php
            }
            if (!empty($discounted_total) & !empty($this->cart->contents())) {
                ?>
                <input type="hidden" name="discounted_total" id="discounted_total" value="<?php echo $this->cart->format_number($discounted_total); ?>"/>

                <?php
            }if (!empty($discounted_total) & !empty($this->cart->contents())) {
                ?>
                <h6>After Discount<span>$<?php echo $this->cart->format_number($discounted_total); ?></span></h6>
                <input type="hidden" name="discounted_total" id="discounted_total" value="<?php echo $this->cart->format_number($discounted_total); ?>"/>

                <?php
            }if (!empty($this->cart->contents())) {
                ?> 
                <h6>Tax <span>$<?php
                        if (!empty($tax_rate['tax_rate'])) {
                            if (!empty($discounted_total)) {
                                $taxed_price = ($discounted_total * $tax_rate['tax_rate']) / 100;
                            } else {
                                $taxed_price = ($this->cart->total() * $tax_rate['tax_rate']) / 100;
                            }
                            echo $this->cart->format_number($taxed_price);
                            ?>
                            <input type="hidden" name="taxed_price" id="taxed_price" value="<?php echo $this->cart->format_number($taxed_price); ?>"/>
                            <?php
                            $calculation += $taxed_price;
                        } else {
                            echo '0';
                        }
                        ?></span>
                </h6>
                <?php
            }
            if (!empty($this->cart->contents())) {
                $service_fee = $this->session->userdata('service_fee');
                ?>
                <h6>Service Fee <span>$<?php echo $this->cart->format_number($service_fee); ?></span></h6>
                <input type="hidden" name="service_fee" id="service_fee" value="<?php echo $this->cart->format_number($service_fee); ?>"/>
                <?php
                $calculation += $service_fee;
            }
            if (!empty($this->session->userdata('unique_id'))) {
                if (!empty($this->session->userdata('check'))) {
                    $check = $this->session->userdata('check');
                }
                ?><div class="servicefee boxs">
                    <div class="tick">
                        <input type="checkbox" name="price" class="tick_input" id="emarket-point" <?php
                        if (!empty($check)) {
                            echo 'checked';
                        }
                        ?> data-url="<?php echo base_url('cart/emarket-points'); ?>">
                        <label for="emarket-point"><span></span>Use E-Markets Credits</label>
                    </div>
                    <p class="fryt">
                        <span id="points"><?php
                            if (!empty($user_data['credit_points'])) {
                                if (!empty($check)) {
                                    $calculation -= $user_data['credit_points'];
                                }
                                echo '$' . $this->cart->format_number($user_data['credit_points']);
                                ?>
                                <input type="hidden" name="credit_points" id="credit_points" value="<?php echo $this->cart->format_number($user_data['credit_points']); ?>"/>
                                <?php
                            } else {
                                echo '$0.00';
                            }
                            ?>
                        </span>
                    </p>
                    <?php ?>
                </div>
            <?php } ?>
            <div class="totalpay boxs">
                <?php if (!empty($this->session->userdata('unique_id'))) { ?>
                    <div class="bd_btm"></div>
                <?php } ?>
                <p>Total<span><?php echo '$' . $this->cart->format_number($calculation); ?></span> </p>
                <input type="hidden" name="total" id="total" value="<?php echo $this->cart->format_number($calculation); ?>"/>
            </div>

            <div class="deliveryboxs boxs">
                <div class="bd_btm"></div>
                <h5>Delivery</h5>
                <div class="fil_drop_main">
                    <div class="tickcol">
                        <div class="boxs mgbtm15">
                            <div class="tick">
                                <input type="radio"  value="7.99" name="delivery_type" class="tick_input" id="tick3">
                                <label for="tick3"><span></span><i>Delivery : </i>$7.99</label>
                            </div>
                        </div>
                        <div class="boxs">
                            <div class="tick">
                                <input type="radio" checked value="null" name="delivery_type" class="tick_input" id="tick4">
                                <label for="tick4"><span></span>Pick Up</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="deliveryboxs boxs">
                <div class="bd_btm"></div>
                <h5>Tip</h5>
                <?php
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
                <input type="hidden" name="user_tip_val" value="<?php if(!empty($tip_calculation)){ echo $this->cart->format_number($tip_calculation); } ?>" id="user_tip_val"/>
                <div class="row">
                    <div class="col-sm-4 pad_ryt_zer0">
                        <div class="calmain">
                            <div class="tick">
                                <input type="radio" name="tip" <?php if (!empty($tip)) {
                    if ($tip == '2') {
                        echo 'checked';
                    }
                } ?> value="2" checked class="tick_input tip" id="tick5">
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
                } ?> value="4" class="tick_input tip" id="tick6">
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
                } ?> value="6" class="tick_input tip" id="tick7">
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
                } ?> class="tick_input tip" id="tick8">
                                <label for="tick8"><span></span><input type="text" value="<?php if(!empty($tip_value)){ echo $tip_value; } ?>" name="tip_value" id="tip_value" placeholder="Tip" class="inpbx"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-offset-4">
                        <a href="javascript:void(0)" data-url="<?php echo base_url('cart/apply-tip'); ?>" id="apply-tip" class="btn-sm btn-primary">Apply Tip</a>
                    </div>
                </div>
            </div>
            <div class="totalpay boxs">
                <div class="bd_btm"></div>
                <p>Total <span><?php echo '$' . $this->cart->format_number($calculation); ?></span></p>
                <input type="hidden" name="final_total" id="final_total" value="<?php echo $this->cart->format_number($calculation); ?>"/>
            </div>
            <div class="continuebtn checkoutbtn boxs">
            <?php if (!empty($this->session->userdata('unique_id'))) { ?>
                    <button type="submit" name="checkout_continue" id="checkout_continue" class="slidehover"  <?php
                if (empty($this->cart->contents())) {
                    echo 'disabled';
                }
                ?> >PROCEED TO CHECKOUT</button>
            <?php } else { ?>
                                <a href="javascript:void(0)" class="slidehover" data-toggle="modal" data-target="#login">PROCEED TO CHECKOUT</a>
            <?php } ?>
            </div>
        
        </div>
        

</div>
<?php } ?>
</form>
</div>