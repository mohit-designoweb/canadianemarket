<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4>Coupon</h4>
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
                                <h5 class="m-b-0" style="padding-top: 5px">
								<?php if (!empty($coupon)) {
                                echo 'Edit';
                            } else {
                                echo 'Add';
                            } ?>
                                     Coupon
                                </h5>
                            </div>
                            <div class="col-2 offset-7">
                                <a href="<?php echo base_url('admin/coupon'); ?>" class="btn btn-primary">View Coupon</a>
                            </div>
                        </div>
                    </div>
                    <p id="error-msg"></p>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" id="image-common-form" action="<?php
                        if (!empty($coupon)) {
                            echo base_url('admin/doEditCoupon/' . $coupon['coupon_id']);
                        } else {
                            echo base_url('admin/doAddCoupon');
                        }
                        ?>">
                            
                            <div class="row">
                                 
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="coupon_name">Coupon Code Name <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'coupon_name', 'id' => 'coupon_name', 'class' => 'form-control', 'placeholder' => 'Coupon Code Name'], isset($coupon['coupon_code']) ? $coupon['coupon_code'] : ''); ?>   
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="coupon_name">Coupon Code Type <i style="color:red;">*</i></label>
                                        <?php echo form_dropdown(['name'=>'coupon_type','id'=>'coupon_type','class'=>'form-control'],[''=>'--Select Coupon Type','per'=>'Percentage','val'=>'Amount'],isset($coupon['coupon_type'])?$coupon['coupon_type'] :''); ?>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="coupon_type">Coupon Code Amount/Percentage <i style="color:red;">*</i></label>
                                        <?php echo form_input(['name' => 'coupon_amount', 'id' => 'coupon_amount', 'class' => 'form-control', 'placeholder' => 'Coupon Code Amount/Percentage'], isset($coupon['coupon_amount']) ? $coupon['coupon_amount'] : ''); ?>   
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-2 offset-10">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</main>