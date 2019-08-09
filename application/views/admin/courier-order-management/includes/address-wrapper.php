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
                                        <p class="price"><?php echo "$ ".$address['total_amount'];?></p>
                                    </div>
                                </div>
                           
                               <div class="scroll scroll1">
                                   <div class="content">
                                          <div class="row detailDiv form-group">
                                    <p id="error_msg"></p>
                                    <div class="col-10">
                                        <label>Collect-</label> <?php echo $address['restaurant_address'];?>
                                    </div>
                                </div>
                                <div class="row detailDiv form-group">
                                    <p id="error_msg"></p>
                                   
                                    <div class="col-10">
                                         Order<?php 
                                          if($address['order_type']==1){
                                              echo " Paid Online<br>";
                                          }
                                          else
                                          {
                                              echo " Cash On Delivery<br>";'<br>';
                                          }
                                        echo $address['address']."<br>".$address['address2']."<br>";?>
                                        
                                        <?php if(!empty($address['tip'])){
                                        echo "Transit pay: $".$address['tip'];    
                                        }?>
                                    </div>
                                </div>
                                   </div>
                               </div>
                                <?php if($address['order_type']==1){?>
                                <div class="totalEarn boxs">
                                   
                                    <h2>+$ <?php echo $address['tip'];?><span>Total Earnings</span><!--<span class="kiloM">2.1 Km</span>--></h2>
                                     <p><i class="fa fa-clock-o" aria-hidden="true"></i> 1:35</p>
                                </div>
                                <?php }?>
                                <div class="row form-group">
                                    <div class="col-5 offset-7">
                                      <!--  <button class="btn btn-primary pull-right" type="submit" name="accept-order">Accept Order</button>-->
                                        <a href="" class="btn btn-success btn-sm" id="rest-address-detail" data-dismiss="modal" data-toggle="modal" data-target="#restaurant-address-detail" data-url="<?php echo base_url('courier/getRestaurantAddress/'.$address['order_id']);?>">Accept Order</a>
                                        <a href="" class="btn btn-success btn-sm" id="rest-address-detail" data-dismiss="modal" data-toggle="modal" data-target="#restaurant-address-detail" data-url="<?php echo base_url('courier/cancelRestaurantOrder/'.$address['order_id']);?>">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>