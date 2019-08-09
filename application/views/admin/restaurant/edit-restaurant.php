<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4>Restaurant</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container pull-up">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="storeBtn boxs">
                        <ul>
                            <li><a href="<?php echo base_url('admin/AdminRestaurant/default-edit-restaurant-wrapper/'.$restaurant['restaurant_id']);?>" class="restauranttabs active">Restaurant Settings</a></li>
                            <li><a href="<?php echo base_url('admin/AdminMenu/manage-menu-wrapper/'.$restaurant['restaurant_id']);?>" class="restauranttabs">Menu</a></li>
                            <li><a href="<?php echo base_url('admin/AdminRestaurant/manage-menu-category-wrapper/'.$restaurant['restaurant_id']);?>" class="restauranttabs">Menu Category</a></li>
                            <li><a href="<?php echo base_url('admin/AdminUserSpecification/manage-topping-wrapper');?>" class="restauranttabs">Topping</a></li>
                            <li><a href="<?php echo base_url('admin/default-edit-restaurant-wrapper/'.$restaurant['restaurant_id']);?>" class="restauranttabs">Restaurant Report</a></li> 
                        </ul>
                    </div>
                    
                    <div id="error_msg"></div>
                    <div class="canadContTab" id="restaurant-wrapper">
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</section>

</main>