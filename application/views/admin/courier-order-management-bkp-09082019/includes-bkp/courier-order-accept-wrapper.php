<div class="row">
    <div class="col-md-4 offset-4">
        <a href="<?php echo base_url('courier/updateCourierAvailableStatus/' . $courierOrderMappingDetail['courier_order_mapping_id'] . "/" . $courierOrderMappingDetail['restaurant_order_id'].'/Accepted'); ?>" class="btn btn-primary change-courier-status" id="accept-order">Accept Order</a>
    </div>
    <div class="col-md-4">
        <a href="<?php echo base_url('courier/updateCourierAvailableStatus/' . $courierOrderMappingDetail['courier_order_mapping_id'] . "/" . $courierOrderMappingDetail['restaurant_order_id'].'/Rejected'); ?>" class="btn btn-primary change-courier-status">Reject Order</a>
    </div>
</div>