<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4>Card Amount</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container pull-up">
        <div class="row">
            <div class="col-8" id="content-wrapper" data-url="<?php echo base_url('admin/get-gift-card-amount-wrapper'); ?>"></div>
            <div class="col-4">
                <div class="card m-b-30">
                    <div id="error_msg"></div>
                    <div class="card-header">
                        <h5 class="m-b-0"><?php if(!empty($amount)){ echo 'Edit'; }else{ echo 'Add'; } ?> Amount</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" id="common-form" action="<?php
                        if (!empty($amount)) {
                            echo base_url('admin/doEditGiftCardAmount/'.$amount['amount_id']);
                        } else {
                            echo base_url('admin/doAddGiftCardAmount');
                        }
                        ?>">
                            <div class="form-group">
                                <label for="card_amount">Card Amount <i style="color:red;">*</i></label>
                                <?php echo form_input(['name'=>'card_amount','id'=>'card_amount','class'=>'form-control'],isset($amount['amount'])?$amount['amount']:'') ?>
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



