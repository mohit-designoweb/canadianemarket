<div class="modal-content newOffer">
            <div class="modal-body">
            <button type="button" class="btnclose" data-dismiss="modal"><img src="<?php echo base_url('assets/img/cross2.png'); ?>" alt="cross2" class="img-responsive center-block"></button>
                <div class="register_inner modalflex">
                    <div class="row">
                        <div class="col-12">
                            <form method="post" name="order-prepare-time" id="order-prepare-time" action="<?php echo base_url('partnerOrder/order-prepared-time/'.$order_detail1['order_id']); ?>">
                                <div class="row form-group">
                                    <div class="col-8">
                                        <h5>Matching You To Orders</h5>
                                        <h6>Searching...</h6>
                                    </div>
                                    
                                </div>
                           
                               <div class="row">
                                <div class="col-12">
                                    <div class="form-group" id="map">

                                    </div>
                                </div>
                            </div>
                                <div class="row form-group">
                                    <div class="col-5 offset-7">
                                      <!--  <button class="btn btn-primary pull-right" type="submit" name="accept-order">Accept Order</button>-->
                                        <a href="" class="btn btn-success btn-sm" id="rest-address-detail" data-dismiss="modal" data-toggle="modal" data-target="#restaurant-address-detail" data-url="<?php echo base_url('courier/getRestaurantAddress/'.$address['order_id']);?>">Accept Order</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>