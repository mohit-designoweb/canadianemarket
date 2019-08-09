<div class="row">
    <div class="col-6 offset-6">
        
        <?php
//        $status = [
//            'Processing' => 'Processing',
//            'Dispatched' => 'Dispatched',
//            'Cancel' => 'Cancel'
//        ];
//        echo form_dropdown(['name' => 'status', 'class' => 'form-control', 'id' => 'status', 'data-url' => base_url('partnerorder/updateOrderStatus/' . $order_detail['order_id'])], $status, isset($order_detail['order_status']) ? $order_detail['order_status'] : '');
        ?>
        <a href="javascript:void(0)"  data-toggle="modal" data-target="#order-deliver-time" class="btn btn-success btn-sm">Accept Order<i class="fe fe-check"></i></a>
        <a href="javascript:void(0)"  data-toggle="modal" data-target="#order-cancel-reason" class="btn btn-danger btn-sm">Reject Order<i class="fe fe-minus-circle"></i></a>
    </div>
</div>

