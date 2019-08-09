<section class="giftCard_main topScrl">
    <div class="container">
        <div class="girfCard_inner boxs">
            <!--  <div class="gifrCart_top boxs">
                  <h2>Canadian e Market Gift Card</h2>
                  <div class="upperLinks">
                      <a href="javascript:void(0)">Buy a Gift Card </a>
                      <span>|</span>
                      <a href="javascript:void(0)">Check Gift Card Balance</a>
                  </div>
              </div>
              <div class="accordianBox boxs">
                  <div class="store_banner_in infoanddesc boxs">
                      <div class="set">
                          <a href="javascript:void(0)" class="">
                              <i class="fa fa-plus"></i>
                              Add a Gift Card

                          </a>
                          <div class="content" style="display: none;">
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
                          </div>
                      </div>
                  </div>
              </div>-->
            <div class="markGiftCard boxs">
                <h2>Buy a Canadian e Market Gift Card</h2>
                <div class="personal_gift boxs">
                    <h3>Personal Gift Cards</h3>
                    <form method="post" action="<?php echo base_url('site/giftCard'); ?>" name="gift-card-form" id="gift-card-form">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="prsnl_gft_lft boxs">
                                    <div class="form-group">
                                        <label for="receiver_name">Receiver's Name<i class="fa fa-asterisk"></i></label>
                                        <input type="text" name="receiver_name" id="receiver_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Choose your delivery type<i class="fa fa-asterisk"></i></label>
                                        <div class="boxs giftcardradio">
                                            <div class="tick">
                                                <input type="radio" class="tick_input" id="email_address" name="address_type" value="emailid" checked>
                                                <label for="email_address"><span></span>Email</label>
                                            </div>
                                            <div class="tick">
                                                <input type="radio" class="tick_input" id="shipping_address" name="address_type" value="address">
                                                <label for="shipping_address"><span></span>Address</label>
                                            </div>
                                        </div>
                                        <input type="email" id="emailid" name="emailid" class="form-control" style="display: none;">
                                        <input type="text" id="receiver_address" name="receiver_address" class="form-control" style="display: none;">
                                    </div>
                                    <div class="form-group boxs">

                                        <div class="fil_drop giftSelect">
                                            <label for="gift_amount">Card Value in $<i class="fa fa-asterisk"></i></label>
                                            <?php echo form_dropdown(['name' => 'gift_amount', 'id' => 'gift_amount', 'class' => 'filDrop_btn form-control'], $gift_amounts); ?>

                                        </div>
                                    </div>
                                    <div class="form-group boxs">
                                        <label for="gifter_name">Gifter's Name<i class="fa fa-asterisk"></i></label>
                                        <input type="text" name="gifter_name" id="gifter_name" class="form-control" value="<?php if(!empty($user_data['user_name'])) {echo $user_data['user_name']; }?>">
                                        <input type="hidden" name="unique_id" value="<?php if(!empty($user_data['unique_id'])) {echo $user_data['unique_id']; }?>">
                                    </div>
                                    <div class="form-group boxs">
                                        <label>Write a message (Optional)</label>
                                        <textarea class="form-control" id="message" name="message"></textarea>
                                    </div>
                                    <div class="payment_lft_btm boxs form-group">
                                        <p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.</p>
                                        <div class="readaggre boxs">
                                            <div class="tick">
                                                <input type="checkbox" class="tick_input" id="term_condition" name="term_condition">
                                                <label for="term_condition"><span></span>I have read and agree to the website terms and conditions <sup>*</sup></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if (!empty($this->session->userdata('unique_id'))) { ?>
                                <button type="submit" class="buygift_btn slidehover">Buy Gift Card</button>
                                 <?php } else { ?>
                                    <a href="javascript:void(0)" class="buygift_btn slidehover" class="slidehover" data-toggle="modal" data-target="#login">Buy Gift Card</a>
                                <?php } ?>
                            </div>
                            <div class="col-sm-6">
                                <div class="prsnl_gft_rht boxs">
                                    <img src="<?php echo base_url('assets/img/gifcrd.png'); ?>" class="img-responsive" alt="giftcard">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>