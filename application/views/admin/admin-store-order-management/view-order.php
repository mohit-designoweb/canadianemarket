<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4>Admin Orders</h4>
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
                            <li><a href="<?php echo base_url('admin/get-admin-store-order-wrapper');?>" class="storeorder active">Ongoing Orders</a></li>
                            <li><a href="<?php echo base_url('admin/get-admin-store-delivered-order-wrapper');?>" class="storeorder">Delivered Orders</a></li>
                            <li><a href="<?php echo base_url('admin/get-admin-store-canceled-order-wrapper');?>" class="storeorder">Cancel Order</a></li>
                        </ul>
                    </div>
                    
                    <div id="error_msg"></div>
                    <div class="canadContTab" id="restaurant-wrapper">
                        
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12" id="content-wrapper" data-url="<?php echo base_url('admin/get-admin-store-order-wrapper'); ?>"></div>
        </div>
    </div>
</section>

</main>



