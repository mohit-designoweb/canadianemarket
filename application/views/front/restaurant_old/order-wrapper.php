<div class="ship_ryt ship_ryt_s rest_ryt boxs rescatelog2">
    <div class="couponbox coupnhide boxs">
        <h5>Coupons</h5>
        <div class="apply_coupons boxs">
            <input type="text" class="form-control" name="coupon_code" id="coupon" placeholder="Coupon code">
            <a href="<?php echo base_url('restaurant/applyCoupon'); ?>" id="apply-coupon">APPLY NOW</a>
        </div>
        <?php if(!empty($this->session->userdata('coupon'))){ ?>
        <a href="<?php echo base_url('restaurant/removeCoupon'); ?>" id="remove-coupon">Remove Coupon</a>
            <?php } ?>
    </div>
        <?php if (!empty($this->cart->contents())) {
            $carts = $this->cart->contents();
            $count = count($carts);
        }  
        ?>
    <div class="your_order yourOrderbx boxs">
        <div class="hideOrder boxs">
            <?php if(!empty($coupon)){ print_r($coupon); } ?>
            <h5>Your Order</h5>
            <div class="bd_btm"></div>
            <h6>Subtotal (<?php if(!empty($count)){ echo $count; }else { echo '0'; }  ?> items) <span>$<?php echo $this->cart->format_number($this->cart->total()); ?></span></h6>
            <?php if(!empty($this->session->userdata('coupon'))){
                $coupon=$this->session->userdata('coupon');
                $subtotal=$this->cart->total();
                if($coupon['coupon_type']=='per'){
                    $discounted_price = round(($subtotal * $coupon['coupon_amount']) / 100, 1);
                    $discounted_total= round($subtotal-$discounted_price);
                }else if($coupon['coupon_type']=='val'){
                    $discounted_price=$subtotal-$coupon['coupon_amount'];
                    $discounted_total= round($subtotal-$discounted_price);
                }
            ?>
            <h6>Discount <span>-$<?php echo $this->cart->format_number($discounted_price); ?></span></h6>
            <h6><span>$<?php echo $this->cart->format_number($discounted_total); ?></span></h6>
            <?php
            } ?>
            <div class="deliveryboxs boxs">
                <h5>Delivery</h5>
                <div class="fil_drop_main">
                    <div class="tickcol">
                        <div class="boxs mgbtm15">
                            <div class="tick">
                                <input type="radio" name="delivery_type" class="tick_input" value="<?php echo $restaurant['delivery_charge']; ?>" id="tick3">
                                <label for="tick3"><span></span><i>Delivery : </i>$<?php echo $restaurant['delivery_charge']; ?></label>
                            </div>
                        </div>
                        <div class="boxs">
                            <div class="tick">
                                <input type="radio" name="delivery_type" value="pick_up" class="tick_input" id="tick4">
                                <label for="tick4"><span></span>Pick Up</label>
                            </div>
                        </div>
                    </div>
                    <div class="fil_drop">
                        <button type="button" class="filDrop_btn divFil_btn cart_fillbtn" data-toggle="modal" data-target="#time">
                            <g>ASAP </g>
                            <!-- <img src="img/arrowdwn.png" alt="arrow"> -->
                        </button>
                        <!-- <div class="filDrop_content filDrop_content2">
                            <a href="javascript:void(0)">Most Recent</a>
                            <a href="javascript:void(0)">Most Recent</a>
                            <a href="javascript:void(0)">Most Recent</a>
                            <a href="javascript:void(0)">Most Recent</a>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="deliveryboxs boxs">
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
                                <input type="text" name="price" class="form-control" placeholder="10">
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
                                <input type="text" name="price" class="form-control" placeholder="6">
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
            </div>
            <?php if(!empty($restaurant['service_fee'])){?>
            <div class="servicefee boxs">
                <div class="bd_btm"></div>
                <p>Service Fee<span>$<?php echo $restaurant['service_fee']; ?></span></p>
                <div class="bd_btm"></div>
            </div>
			<?php }?>
            <div class="servicefee boxs">
                <p>Tax<span>$7.00</span></p>
                <div class="bd_btm"></div>
            </div>
            <div class="servicefee boxs">
                <div class="tick">
                    <input type="radio" name="price" class="tick_input" id="tick8">
                    <label for="tick8"><span></span>Use E-Markets Credits</label>
                </div>
                <p class="fryt"><span>$8.00</span></p>
            </div>
            <div class="totalpay boxs">
                <div class="bd_btm"></div>
                <p>Total Payable<span>$68.88</span></p>
            </div>
        </div>    
        <div class="continuebtn checkoutbtn boxs">
            <a href="javascript:void(0)" class="slidehover">PROCEED TO CHECKOUT</a>
        </div>
    </div>

</div> 