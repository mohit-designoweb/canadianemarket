<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4>Shop Section</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container pull-up">
        <div class="row">
            <div class="col-8" id="content-wrapper" data-url="<?php echo base_url('admin/get-shop-section-wrapper'); ?>"></div>
            <div class="col-4">
                <div class="card m-b-30">
                    <div id="error_msg"></div>
                    <div class="card-header">
                        <h5 class="m-b-0">Add Shop Section</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" id="common-form" action="<?php
                        if (!empty($shop_section)) {
                            echo base_url('admin/doEditShopSection/' . $shop_section['shop_section_id']);
                        } else {
                            echo base_url('admin/doAddShopSection');
                        }
                        ?>">
                            <div class="form-group">
                                <label for="store_id">Store</label>
                                <?php echo form_dropdown(['name'=>'store_id','id'=>'store_id','class'=>'form-control'],$stores,isset($shop_section['store_id'])?$shop_section['store_id']:'');  ?>
                            </div>
                            <div class="form-group">
                                <label for="shop_section_name">Shop Section Name</label>
                                <?php echo form_input(['name'=>'shop_section_name','id'=>'shop_section_name','class'=>'form-control'],isset($shop_section['shop_section_name'])?$shop_section['shop_section_name']:'') ?>
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



