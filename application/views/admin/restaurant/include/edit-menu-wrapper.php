<div id="error_msg"></div>
<div class="card-body">
    <form method="post" enctype="multipart/form-data" id="restaurant-wrapper-image-form" action="<?php if(!empty($menu['menu_id'])){echo base_url('admin/AdminMenu/doEditRestaurantMenu/' . $restaurant_id .'/'.$menu['menu_id']);} ?>">
        <?php if (!empty($menu['image_url'])) { ?>
            <div class="row">
                <div class="col-3">
                    <img src="<?php echo base_url('uploads/menu/' . $menu['image_url']); ?>" class="img-responsive">
                </div>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="image_url">Image</label>
                    <?php echo form_upload(['name' => 'image_url', 'id' => 'image_url', 'class' => 'form-control']) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="menu_name">Name</label>
                    <?php echo form_input(['name' => 'menu_name', 'id' => 'menu_name', 'class' => 'form-control'], isset($menu['menu_name']) ? $menu['menu_name'] : ''); ?>   
                </div>    
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="price">Price(In $)</label>
                    <?php echo form_input(['name' => 'price', 'id' => 'price', 'class' => 'form-control'], isset($menu['price']) ? $menu['price'] : ''); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="menu_category">Menu Category</label>
                    <?php echo form_dropdown(['name' => 'menu_category', 'id' => 'menu_category', 'class' => 'form-control'], $menu_categorys, isset($menu['menu_category_id']) ? $menu['menu_category_id'] : ''); ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="emarket_point">Emarket Point</label>
                    <?php echo form_input(['name' => 'emarket_point', 'id' => 'emarket_point', 'class' => 'form-control'], isset($menu['emarket_point']) ? $menu['emarket_point'] : '') ?>   
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="discount">Discount(In %)</label>
                    <?php echo form_input(['name' => 'discount', 'id' => 'discount', 'class' => 'form-control'], isset($menu['discount']) ? $menu['discount'] : ''); ?>   
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="description">Description</label>
                    <?php echo form_textarea(['name' => 'description', 'id' => 'description', 'rows' => '5', 'class' => 'form-control'], isset($menu['description']) ? $menu['description'] : '') ?>   
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="is_special">Special Item</label>
                    <input type="checkbox" name="is_special" id="is_special" value="1" <?php
                    if (!empty($menu['is_special'])) {
                        if ($menu['is_special'] == '1') {
                            echo 'checked';
                        }
                    }
                    ?>/>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="spicy">Spicy</label>
                    <input type="checkbox" name="spicy" id="spicy" value="1" <?php
                    if (!empty($menu['spicy'])) {
                        if ($menu['spicy'] == '1') {
                            echo 'checked';
                        }
                    }
                    ?>/>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="topping">Topping</label>
                    <input type="checkbox" name="topping" id="topping" value="1" <?php
                    if (!empty($menu['topping'])) {
                        if ($menu['topping'] == '1') {
                            echo 'checked';
                        }
                    }
                    ?>/>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-2 offset-10">
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>