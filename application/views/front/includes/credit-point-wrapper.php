                        <div class="ship_lft boxs myacc_ryt or_his_ryt">
                            <h3>E-Market Credit <span> (<?php if(!empty($user_data['credit_points'])){ echo '$'.$user_data['credit_points'];} else{echo '$0';}?>)</span></h3>

                            <div class="tabs_menu order_tabs boxs">
                                <!--<div id="order_histroy"><a href="" class="user_history active" data-tag="secOne">Total Credit Points</a></div>-->
                                <a href="<?php echo base_url('user/received_gift_card'); ?>" class="user_history" data-tag="secTwo">Received Gift-Card </a>
                                <a href="<?php echo base_url('user/send_gift_card'); ?>" class="user_history" data-tag="secThree">Send Gift-Card </a>
               
                            </div>

                            <div class="mar_top boxs" >
                                <div id="history-wrapper"></div>
                                                                
                            </div>
                        </div>
