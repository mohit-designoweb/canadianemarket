<div class="modal-content newOffer">
            <div class="modal-body">
            <button type="button" class="btnclose" data-dismiss="modal"><img src="<?php echo base_url('assets/img/cross2.png'); ?>" alt="cross2" class="img-responsive center-block"></button>
                <div class="register_inner modalflex">
                    <div class="row">
                        <div class="col-12">
                            <form method="post" name="order-prepare-time" id="order-prepare-time" action="<?php echo base_url('partnerOrder/order-prepared-time/'.$order_detail1['order_id']); ?>">
                                <div class="row form-group">
                                    <div class="col-6">
                                        <h5>NEW OFFER</h5>
                                    </div>
                                        <div class="col-6">
                                        <p class="price">    <?php echo "$ ".$address['total_amount'];?></p>
                                    </div>
                                </div>
                            
                                <div class="row detailDiv form-group">
                                    <p>Driving To Restaurant</p>
                                    <div class="col-10">
                                        <label>Collect-</label> <?php echo $address['restaurant_address'];?>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-5 offset-7">
                                      <!--  <button class="btn btn-primary pull-right" type="submit" name="accept-order">Accept Order</button>-->
                                        <a href="" class="btn btn-danger btn-sm" id="user-add-detail" data-dismiss="modal" data-toggle="modal" data-target="#user-address-detail" data-url="<?php echo base_url('courier/getuserAddress/'.$address['order_id']);?>">PARKED AT RESTAURANT</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>