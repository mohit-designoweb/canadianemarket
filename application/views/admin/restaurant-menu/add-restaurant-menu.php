<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4><a href="<?php echo base_url('admin/restaurant'); ?>">Restaurant</a> / <a href="<?php echo base_url('admin/restaurant-menu-category/'.$restaurant_id); ?>">Restaurant Menu Category</a> / Restaurant Menu</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container pull-up">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div id="error_msg"></div>
                    <div class="card-header">
                        <div class="row">
                            <div class="col-3">
                                <h5 class="m-b-0" style="padding-top: 5px"><?php
                                    if (!empty($menu['menu_id'])) {
                                        echo 'Edit';
                                    } else {
                                        echo 'Add';
                                    }
                                    ?> Restaurant Menu</h5>
                            </div>
                            <div class="col-2 offset-7">
                                <a href="<?php echo base_url('admin/restaurant-menu/' . $restaurant_id . '/' . $menu_category_id); ?>" class="btn btn-primary">View Menu</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" id="image-common-form" action="<?php
                        if (!empty($menu)) {
                            echo base_url('admin/doEditRestaurantMenu/' . $restaurant_id . '/' . $menu_category_id . '/' . $menu['restaurant_id']);
                        } else {
                            echo base_url('admin/doAddRestaurantMenu/' . $restaurant_id . '/' . $menu_category_id);
                        }
                        ?>">
                                  <?php if (!empty($menu['image_url'])) {
                                      ?>
                                <div class="row">
                                    <div class="col-3">
                                        <img src="<?php echo base_url('uploads/menu/' . $menu['image_url']); ?>" class="img-responsive">
                                    </div>
                                </div>

                            <?php }
                            ?>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emarket_point">Emarket Point</label>
                                        <?php echo form_input(['name' => 'emarket_point', 'id' => 'emarket_point', 'class' => 'form-control'], isset($menu['emarket_point']) ? $menu['emarket_point'] : '') ?>   
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                        <input type="checkbox" name="is_special" id="is_special" value="1" <?php if(!empty($menu['is_special'])){ if($menu['is_special']=='1'){ echo 'checked'; } }  ?>/>
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
                    <!-- /.box-body -->

                </div>
            </div>
        </div>
    </div>
</div>
</section>

</main>