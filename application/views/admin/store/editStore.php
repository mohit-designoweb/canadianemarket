<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4>Store</h4>
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
                            <li><a href="<?php echo base_url('admin/adminStore/get_bydefault_wrapper/'.$store['store_id']);?>" class="storetabs active">Store Settings</a></li>
                            <li><a href="<?php echo base_url('admin/adminProduct/'.$store['store_id']);?>" class="storetabs">Products</a></li>
                            <li><a href="<?php echo base_url('admin/adminStore/manage_shop_wrapper/'.$store['store_id']);?>" class="storetabs">Product Category</a></li>
                            <!--<li><a href="<?php echo base_url('admin/storeCategorys');?>" class="storetabs">Products Category</a></li>-->
                            <li><a href="<?php echo base_url('admin/AdminUserSpecification/get_all_specification_wrapper');?>" class="storetabs">Products Attributes</a></li>
                            <li><a href="<?php echo base_url('');?>" class="storetabs">Store Report</a></li>
                                   
                        </ul>
                    </div>
                    
                    <div id="error_msg"></div>
                    <div class="canadContTab" id="store-wrapper">
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</section>

</main>