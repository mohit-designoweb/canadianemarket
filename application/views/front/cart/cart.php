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
            foreach($this->cart->contents() as $cartdata){
                $cartdata['module'];
            }
            if(!empty($cartdata['module'] === 'store')){
                $count = count($this->cart->contents());
            }
        }
        ?>
        <div class="ship_inner boxs">
            <div class="shipping_process boxs">
                <ul>
                    <li><a href="<?php echo base_url('cart'); ?>" class="active">Cart</a></li>
                    <li><a href="javascript:void(0)" class="dashedline">Delivery</a></li>
                    <li><a href="javascript:void(0)">Payment</a></li>
                </ul>
            </div>
            <div class="ship_head boxs">
                <h2>My Cart</h2>
            </div>
            <div class="row">
                <div class="col-sm-8">
               
                    <div class="ship_lft boxs cart_lft">
                        <h3>My Cart (<?php
                            if (!empty($count)) {
                                echo $count;
                            } else {
                                echo 0;
                            }
                            ?>)
                        </h3>
                    
                        <?php
                        if (!empty($count)) {
                            if ($count > 0) {

                                foreach ($this->cart->contents() as $car) {
                                    foreach ($cart_data as $key => $value) {
                                        if ($key == $car['id']) {
                                            ?>
                                            <div class="cartlist boxs">
                                                <div class="cart_items boxs">
                                                    <div class="item_img">
                                                        <img src="<?php echo base_url('uploads/product-sku/' . $value['product']['image_url']); ?>" alt="itemimg" class="img-responsive">
                                                    </div>
                                                    <div class="item_details">
                                                        <div class="id_lft boxs">
                                                            <h5><?php echo $value['product']['product_name']; ?><span><?php echo $value['product']['store_name']; ?></span></h5>
                                                            <?php
                                                            foreach ($value['sku_mapping'] as $sku_map) {
                                                                $size = '';
                                                                foreach ($specifications as $spec) {
                                                                    if ($spec['group_id'] == $sku_map['group_id']) {
                                                                        $size .= '<h6>' . $spec['group_name'] . ' : <span>' . $sku_map['group_value'] . '</span></h6>';
                                                                    }
                                                                }
                                                                echo $size;
                                                            }
                                                            ?>
                                                            <?php
                                                            if (!empty($value['product']['discount'])) {
                                                                $discount = $value['product']['discount'];
                                                                $price = $value['product']['price'];
                                                                $discounted_price = round(($price * $discount) / 100, 1);
                                                                $total_price = $price - $discounted_price;
                                                                ?>
                                                                <p><strike>$<?php echo $total_price; ?></strike>$<?php echo $value['product']['price']; ?><span class="d_off"><?php echo $value['product']['discount']; ?>% OFF</span></p>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <p>$<?php echo $value['product']['price']; ?></p>
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="id_ryt boxs">
                                                            <div class="quantity">
                                                                <div class="vaulebox">
                                                                    <button type="button" class="sub_btn">-</button>
                                                                    <input type="text" data-url="<?php echo base_url('cart/changeQty/' . $car['rowid']); ?>" value="<?php echo $car['qty']; ?>" class="qty">
                                                                    <button type="button" class="add_btn1">+</button>
                                                                </div>
                                                                <a href="<?php echo base_url('cart/removeFromCart/' . $car['rowid']); ?>" class="removeitem removeCart">Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bd_btm boxs"></div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                            }
                        }
                        else{
                        ?>
                        <div class="cartlist boxs">
                            <div class="cart_items boxs text-center">
                                <h2>Your cart is empty!</h2>
                                <img src="<?php echo base_url('public/image/cart.png'); ?>" height="250px" width="300px" alt="Empty Cart">
                            </div>
                            <div class="cart_items boxs text-center"><br/>
                                <a href="<?php echo base_url('store'); ?>" class="btn btn-primary">Go to shopping</a>
                            </div>
                        </div>
                        <?php } ?>
                        
                    </div>
                </div>
                <div class="col-sm-4" data-url="<?php echo base_url('cart/get-order-wrapper'); ?>" id="content-wrapper"></div>
            </div>
        </div>
    </div>
</section>