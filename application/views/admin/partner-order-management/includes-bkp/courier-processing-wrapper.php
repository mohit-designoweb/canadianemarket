<div class="row">
    <div class="col-6 offset-6">
        <label for="status">Order Status</label>
        <?php
        $status = [
            'Processing' => 'Processing',
            'Dispatched' => 'Dispatched',
            'Cancel' => 'Cancel'
        ];
        echo form_dropdown(['name' => 'status', 'class' => 'form-control', 'id' => 'status', 'data-url' => base_url('partnerorder/updateOrderStatus/' . $order_detail['order_id'])], $status, isset($order_detail['order_status']) ? $order_detail['order_status'] : '');
        ?>
    </div>
</div>

