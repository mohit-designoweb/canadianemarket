<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4><a href="<?php echo base_url('partner/partnerRestaurant'); ?>">Restaurant</a> / Restaurant Menu Category</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container pull-up">
        <div class="row">
            <div class="col-8" id="content-wrapper" data-url="<?php echo base_url('partner/get-partner-restaurant-menu-category-wrapper/'.$restaurant_id); ?>"></div>
            <div class="col-4">
                <div class="card m-b-30">
                    <div id="error_msg"></div>
                    <div class="card-header">
                        <h5 class="m-b-0"><?php if(!empty($men)){ echo 'Edit'; }else{ echo 'Add'; } ?> Restaurant Menu Category</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" id="common-form" action="<?php
                        if (!empty($men)) {
                            echo base_url('partner/doEditPartnerRestaurantMenuCategory/'.$restaurant_id.'/' . $men['menu_category_id']);
                        } else {
                            echo base_url('partner/doAddPartnerRestaurantMenuCategory/'.$restaurant_id);
                        }
                        ?>">
                            <div class="form-group">
                                <label for="menu_category_name">Menu Category <i style="color:red;">*</i></label>
                                <?php echo form_input(['name'=>'menu_category_name','id'=>'menu_category_name','class'=>'form-control'],isset($men['menu_category_name'])?$men['menu_category_name']:'') ?>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</main>



