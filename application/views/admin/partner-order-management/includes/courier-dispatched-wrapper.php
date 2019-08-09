<div class="row">
    <div class="col-6 offset-6">
        <label for="courier-name">Courier Agent</label> <a href="<?php echo base_url('partnerOrder/getCourierStatusWrapper/' . $order_id); ?>" id="refresh-courier"><i class="fa fa-refresh"></i></a>
            <?php echo form_dropdown(['name' => 'courier_id', 'class' => 'form-control', 'data-url' => base_url('partnerorder/allotOrderToCourier/' . $order_id), 'id' => 'courier_id'], $couriers); ?>
    </div>
</div>