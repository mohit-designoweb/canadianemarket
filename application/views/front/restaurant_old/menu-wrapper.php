<?php
$carts = $this->cart->contents();
//echo '<pre>';
//print_r($carts);
//echo '</pre>';

foreach ($menus as $menu) {
    ?>
    <div class="cart_items boxs">
        <form method="post" action="<?php echo base_url('restaurant/addToCartMenu'); ?>" class="add-to-cart">
            <div class="item_img">
                <img src="<?php echo base_url('uploads/menu/' . $menu['image_url']); ?>" alt="itemimg" class="img-responsive">
            </div>
            <div class="item_details itemDet">
                <input type="hidden" name="id" value="<?php echo $menu['menu_id']; ?>"/>
                <input type="hidden" name="qty" value="1"/>
                <input type="hidden" name="name" value="<?php echo str_replace(' ', '_', $menu['menu_name']); ?>"/>
                <input type="hidden" name="size" value="size"/>

                <div class="id_lft restFood boxs">
                    <h5><?php echo $menu['menu_name']; ?></h5>
                    <h6><?php echo $menu['description']; ?></h6>
                    <?php
                    if (!empty($menu['discount'])) {
                        $price = $menu['price'];
                        $discount = $menu['discount'];
                        $discounted_price = round(($price * $discount) / 100, 1);
                        $total_price = $price - $discounted_price;
                        ?>
                        <input type="hidden" name="price" value="<?php echo $total_price; ?>"/>
                        <p><strike>$<?php echo $menu['price']; ?></strike>$<?php echo $total_price; ?><span class="d_off">20% OFF</span></p>
                        <?php
                    } else {
                        ?>
                        <input type="hidden" name="price" value="<?php echo $menu['price']; ?>"/>
                        <?php
                        echo '<p>$' . $menu['price'] . '</p>';
                    }
                    ?>
                </div>
                <div class="id_ryt boxs">
                    <div class="quantity">
                        <button type="submit" class="add_btn">Add</button>
                        <?php
                        if (!empty($carts)) {
                            foreach ($carts as $cart) {
                                if ($cart['id'] == $menu['menu_id']) {
                                    ?>
                                    <a href="<?php echo base_url('restaurant/removeFromCart/' . $cart['rowid']); ?>" class="removeitem">Remove</a>
                                    <?php
                                }
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
            <div class="bd_btm boxs"></div>
        </form>
    </div>
    <?php
}
?>
