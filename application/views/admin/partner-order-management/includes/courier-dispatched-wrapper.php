<div class="row">
    <div class="col-6 offset-6">
        <div class="form-group">
             <!--<a href="<?php echo base_url('partnerOrder/getCourierStatusWrapper/' . $order_id); ?>" id="refresh-courier"><i class="fa fa-refresh"></i></a>
            <?php echo form_dropdown(['name' => 'courier_id', 'class' => 'form-control', 'data-url' => base_url('partnerorder/allotOrderToCourier/' . $order_id), 'id' => 'courier_id'], $couriers); ?>-->
            
            
            
            <form name="common-form" id="common-form" method="post" action="<?php echo base_url('partnerorder/order-cancel-reason'.$order_id);?>">
                <textarea name="message" rows="10" cols="30" id="order-cancel" name="order-cancel" placeholder="Give Reason To Reject Order"></textarea>
            <button class="btn btn-primary" type="submit">Submit</button>
            </form>
            
        </div>
       
    </div>
</div>