                        <div class="ship_lft boxs myacc_ryt res_myaccpa">
                            <h3>Profile</h3>
                            <form method="post" action="<?php echo base_url('user/myAccountFormUpdate'); ?>" name="myAccountForm" id="myAccountForm">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="first_name">First name <sup>*</sup></label>
                                           
                                            <input type="text" name="first_name" class="form-control" id="first_name" value="<?php if(isset($user_data)){echo $user_data['user_name'];}?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="last_name">Last name</label>
                                            <input type="text" name="last_name" class="form-control" id="last_name" value="<?php if(isset($user_data)){echo $user_data['last_name'];}?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Email address <sup>*</sup></label>
                                            <input type="email" name="email" class="form-control" id="email" value="<?php if(isset($user_data)){echo $user_data['email'];}?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="mobile">Mobile Number <sup>*</sup></label>
                                            <input type="text" name="mobile" class="form-control" id="mobile" value="<?php if(isset($user_data)){echo $user_data['phone'];}?>">
                                        </div>
                                    </div>
                                    <!--<div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="address1">Home address <sup>*</sup></label>
                                            <input type="text" name="address1" class="form-control" id="address1" placeholder="House number and street name" value="<?php if(isset($user_data)){echo $user_data['address1'];}?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="address2">Street address <sup>*</sup></label>
                                            <input type="text" name="address2" class="form-control" id="address2" placeholder="Apartment, suite, unit etc." value="<?php if(isset($user_data)){echo $user_data['address2'];}?>">
                                        </div>
                                    </div>-->
									<div class="col-sm-12">
                                        <div class="form-group">
										<label for="address_id">Address <sup>*</sup></label>
										<?php echo  form_dropdown(['name'=>'address_id','id'=>'address_id','class'=>'form-control'],$user_address,isset($user_data['address_id'])?$user_data['address_id']:'');?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" id="datetimepicker1">
                                        <div class="form-group" >
                                            <label for="dob">Date of Birth <sup>*</sup></label>
                                            <input type="text" name="dob" class="form-control" id="dob"  value="<?php if(isset($user_data)){echo $user_data['dob'];}?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">  
                                        <p><label for="gender">Gender <sup>*</sup></label></p>
                                        <div class="tick restick">
                                            <?php   if(isset($user_data)){ $gender = $user_data['gender'];}?>
                                            <input type="radio" name="gender" value="M" class="tick_input" id="tick1" <?php if(isset($gender)){ if($gender =='M'){?> checked <?php }}?>>
                                            <label for="tick1"><span></span>Male</label>
                                        </div>
                                        <div class="tick restick">
                                            <input type="radio" name="gender"  value="F" class="tick_input" id="tick2" <?php if(isset($gender)){ if($gender =='F'){?> checked<?php }}?>>
                                            <label for="tick2"><span></span>Female</label>
                                        </div>
                                       </div> 
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" class="slidehover savebtn2">SAVE</button>
                                    </div>
                                </div>
                            </form>
                        </div> 
                        <script> 
                          $(document).ready(function($){
                              $("#dob").datepicker({ changeYear: true,
                                                     changeMonth: true,
                                                     yearRange: '1950:2019',});
                              });

                       </script>