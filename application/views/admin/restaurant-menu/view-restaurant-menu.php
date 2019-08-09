<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4><a href="<?php echo base_url('admin/adminRestaurant'); ?>">Restaurant</a> / <a href="<?php echo base_url('admin/restaurant-menu-category/'.$restaurant_id); ?>">Restaurant Menu Category</a> / Restaurant Menu</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container pull-up">
        <div class="row">
            <div class="col-12" id="content-wrapper" data-url="<?php echo base_url('admin/get-restaurant-menu-wrapper/'.$restaurant_id.'/'.$menu_category_id); ?>"></div>
        </div>
    </div>
</section>

</main>



