<div class="admin-sidebar-wrapper js-scrollbar">
    <ul class="menu">
        <li class="menu-item <?php if($title=='Dashboard'){ echo 'active'; } ?>">
            <a href="<?php echo base_url('admin/dashboard');  ?>" class="menu-link open-dropdown ">
                <span class="menu-label">
                    <span class="menu-name caret">Dashboard</span>
                     <span class="arrowcaret">
                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                        <i class="fa fa-angle-up" aria-hidden="true"></i>
                    </span>
                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder fe fe-activity "></i>
                </span>
            </a>
			<!--<ul class="sub-menu">
                <li class="menu-item <?php if($title=='New Order'){ echo 'active'; } ?>">
                    <a href="#" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name caret">New Orders</span>

                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder fe fe-package "></i>
                        </span>
                    </a>
                </li>
                <li class="menu-item <?php if($title=='Statistic'){ echo 'active'; } ?>">
                    <a href="#" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name caret">Statistic</span>

                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder fe fe-activity "></i>
                        </span>
                    </a>
                </li>
                <li class="menu-item <?php if($title=='Sales Report'){ echo 'active'; } ?>">
                    <a href="#" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name caret">Sales Report</span>

                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder fe fe-activity "></i>
                        </span>
                    </a>
                </li>
            </ul> -->   
        </li>
		<li class="menu-item <?php if($title=='Admin Restaurant Orders'|$title=='Admin Store Orders'){ echo 'active opened'; } ?>">
            <a href="#" class="open-dropdown menu-link">
                <span class="menu-label">
                    <span class="menu-name">New Orders
                    </span>
                    <span class="arrowcaret">
                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                        <i class="fa fa-angle-up" aria-hidden="true"></i>
                    </span>
                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder fe fe-activity"></i>
                </span>
            </a>
            <!--submenu-->
            <ul class="sub-menu" <?php if($title=='Admin Restaurant Orders'|$title=='Add Registered User'){ echo 'style="display: block;"'; } ?>>

                <li class="menu-item <?php if($title=='Admin Restaurant Orders'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/restaurant-orders') ?>" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Restaurant Orders</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward"></i>
                        </span>
                    </a>
                </li>    

                <li class="menu-item <?php if($title=='Admin Store Orders'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/store-orders'); ?>" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Store Orders</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward"></i>
                        </span>
                    </a>
                </li>

            </ul>
        </li>
		<!--
        <li class="menu-item <?php if($title=='New Order'){ echo 'active'; } ?>">
            <a href="#" class="menu-link">
                <span class="menu-label">
                    <span class="menu-name caret">New Orders</span>

                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder fe fe-package "></i>
                </span>
            </a>
        </li>
		-->
		<!--
        <li class="menu-item <?php if($title=='Statistic'){ echo 'active'; } ?>">
            <a href="#" class="menu-link">
                <span class="menu-label">
                    <span class="menu-name caret">Statistic</span>

                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder fe fe-activity "></i>
                </span>
            </a>
        </li>
		-->
		<!--
        <li class="menu-item <?php if($title=='Sales Report'){ echo 'active'; } ?>">
            <a href="#" class="menu-link">
                <span class="menu-label">
                    <span class="menu-name caret">Sales Report</span>

                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder fe fe-activity "></i>
                </span>
            </a>
        </li>
		-->
        <!-- User module opens -->
        <li class="menu-item <?php if($title=='Registered User'|$title=='Add Registered User'){ echo 'active opened'; } ?>">
            <a href="#" class="open-dropdown menu-link">
                <span class="menu-label">
                    <span class="menu-name">User
                    </span>
                    <span class="arrowcaret">
                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                        <i class="fa fa-angle-up" aria-hidden="true"></i>
                    </span>
                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder fe fe-user"></i>
                </span>
            </a>
            <!--submenu-->
            <ul class="sub-menu" <?php if($title=='Registered User'|$title=='Add Registered User'){ echo 'style="display: block;"'; } ?>>

                <li class="menu-item <?php if($title=='Registered User'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/registered-user') ?>" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Registered User</span>
                        </span>

                        <span class="menu-icon">
                            <i class="icon-placeholder fe fe-package"></i>
                        </span>
                    </a>
                </li>    

                <li class="menu-item <?php if($title=='Add Registered User'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/add-registered-user'); ?>" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Add New User</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder fe fe-user-plus"></i>
                        </span>
                    </a>
                </li>

            </ul>
        </li>
        <!-- User module Close -->

        <!-- Partner module opens -->
        <li class="menu-item <?php if($title=='Partner'|$title=='Add Partner'|$title=='Restaurant Category'|$title=="Restaurant"|$title=='Store Category'|$title=='Store'|$title=='Shop Section'|$title=='Product'|$title=='Partner Application'|$title=='Market Category'|$title=='Market'|$title=='Market Place Product'){ echo 'active opened'; } ?>">
            <a href="#" class="open-dropdown menu-link">
                <span class="menu-label">
                    <span class="menu-name">Partner
                        <!--<span class="menu-arrow"></span>-->
                    </span>
                    <span class="arrowcaret">
                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                        <i class="fa fa-angle-up" aria-hidden="true"></i>
                    </span>
                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder fe fe-user"></i>
                </span>
            </a>
            <!--submenu-->
            <ul class="sub-menu" <?php if($title=='Partner'|$title=='Add Partner'|$title=='Restaurant Category'|$title=="Restaurant"|$title=='Store Category'|$title=='Store'|$title=='Shop Section'|$title=='Product'|$title=='Partner Application'|$title=='Market Category'|$title=='Market'|$title=='Market Place Product'){ echo 'style="display: block;"'; } ?>>
                <!--
				<li class="menu-item <?php if($title=='User Specification'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/user-specification'); ?>" class=' menu-link'>
                        <span class="menu-label">
                            <span class="menu-name">User Specification</span>
                        </span>
                        <span class="menu-icon">
                            <i class="fa fa-cogs" aria-hidden="true"></i>
                        </span>
                    </a>
                </li>
				-->
				<!--
                <li class="menu-item <?php if($title=='Store Category'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/storeCategory'); ?>" class=' menu-link'>
                        <span class="menu-label">
                            <span class="menu-name">Store Category</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-calendar-edit "></i>
                        </span>
                    </a>
                </li>
                -->
                <li class="menu-item <?php if($title=='Store'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/adminStore'); ?>" class=' menu-link'>
                        <span class="menu-label">
                            <span class="menu-name">Store</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-calendar-edit "></i>
                        </span>
                    </a>
                </li>
                
				 <li class="menu-item <?php if($title=='Shop Section'|$title=='Product'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/shop-section'); ?>" class=' menu-link'>
                        <span class="menu-label">
                            <span class="menu-name">Shop Section</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-calendar-edit "></i>
                        </span>
                    </a>
                </li>
				<!--
                <li class="menu-item <?php if($title=='Restaurant Category'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/restaurant-category'); ?>" class=' menu-link'>
                        <span class="menu-label">
                            <span class="menu-name">Restaurant Category</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-checkbox-multiple-marked-circle "></i>
                        </span>
                    </a>
                </li>
				-->
                <li class="menu-item <?php if($title=='Restaurant'){ echo 'active'; } ?>">
                    <a href='<?php echo base_url('admin/adminRestaurant'); ?>' class=' menu-link'>
                        <span class="menu-label">
                            <span class="menu-name">Restaurant</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-checkbox-multiple-marked-circle "></i>
                        </span>
                    </a>
                </li>
                
                <li class="menu-item <?php if($title=='Partner'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/partnerSection'); ?>" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Manage Partner</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder fe fe-user-plus"></i>
                        </span>
                    </a>
                </li>
                <li class="menu-item <?php if($title=='Add Partner'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/addPartner'); ?>" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Add New Partner</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder fe fe-user-plus"></i>
                        </span>
                    </a>
                </li>
                <li class="menu-item <?php if($title=='Partner Application'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/partner-application'); ?>" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Partner Applications</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder fe fe-package"></i>
                        </span>
                    </a>
                </li>    
            </ul>
        </li>
        <!-- Partner module closed -->

        <!-- Courier module opens -->
        <li class="menu-item <?php if($title=='Courier'|$title=='Add Courier'|$title=='Courier Application'){ echo 'active opened'; } ?>">
            <a href="#" class="open-dropdown menu-link">
                <span class="menu-label">
                    <span class="menu-name">Courier</span>
                    <span class="arrowcaret">
                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                        <i class="fa fa-angle-up" aria-hidden="true"></i>
                    </span>
                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder fe fe-home"></i>
                </span>
            </a>
            <!--submenu-->
            <ul class="sub-menu" <?php if($title=='Courier'|$title=='Add Courier'|$title=='Courier Application'){ echo 'style="display: block;"'; } ?>>

                <li class="menu-item <?php if($title=='Courier'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/courierSection') ?>" class='menu-link'>
                        <span class="menu-label">
                            <span class="menu-name">Registered Courier</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-checkbox-multiple-marked-circle "></i>
                        </span>
                    </a>
                </li>

                <li class="menu-item <?php if($title=='Add Courier'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/addCourier'); ?>" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Add New Courier</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward  "></i>
                        </span>
                    </a>
                </li>

                <li class="menu-item <?php if($title=='Shop Section'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/courierSection');?>" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Manage Couriers</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward  "></i>
                        </span>
                    </a>
                </li>

                <li class="menu-item <?php if($title=='Shop Section'){ echo 'active'; } ?>">
                    <a href="#" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Dispatch </span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward  "></i>
                        </span>
                    </a>
                </li>

                <li class="menu-item <?php if($title=='Shop Section'){ echo 'active'; } ?>">
                    <a href="#" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Courier Scheduling</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward  "></i>
                        </span>
                    </a>
                </li>

                <li class="menu-item <?php if($title=='Courier Application'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/courier-application') ?>" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Courier Applications</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward  "></i>
                        </span>
                    </a>
                </li>

            </ul>
        </li>
        <!-- Courier module closes -->

        <!-- Service Manager module opens -->
        <li class="menu-item <?php if($title=='Job Category'|$title=='User Specification'|$title=='Job Type'|$title=='Job Board'|$title=='Job Applied'|$title=='Store Delivery Charges'|$title=='Restaurant Delivery Charges'){ echo 'active opened'; } ?>">
            <a href="#" class="open-dropdown menu-link">
                <span class="menu-label">
                    <span class="menu-name">Service Manager</span>
                    <span class="arrowcaret">
                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                        <i class="fa fa-angle-up" aria-hidden="true"></i>
                    </span>
                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder fe fe-home"></i>
                </span>
            </a>
            <!--submenu-->
            <ul class="sub-menu" <?php if($title=='Job Category'|$title=='Job Type'|$title=='Job Board'|$title=='Job Applied'){ echo 'style="display: block;"'; } ?>>
				
				<li class="menu-item <?php if($title=='User Specification'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/user-specification'); ?>" class=' menu-link'>
                        <span class="menu-label">
                            <span class="menu-name">Attribute</span>
                        </span>
                        <span class="menu-icon">
                            <i class="fa fa-cogs" aria-hidden="true"></i>
                        </span>
                    </a>
                </li>
				
				<li class="menu-item <?php if($title=='Store Delivery Charges'){ echo 'active'; } ?>">
				
                    <a href="<?php echo base_url('admin/storeDeliveryCharges'); ?>" class=' menu-link'>
                        <span class="menu-label">
                            <span class="menu-name">Store Delivery Charges</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-calendar-edit "></i>
                        </span>
                    </a>
                </li>
				
				<li class="menu-item <?php if($title=='Restaurant Delivery Charges'){ echo 'active'; } ?>">
                    <a href='<?php echo base_url('admin/restaurantDeliveryCharges'); ?>' class=' menu-link'>
                        <span class="menu-label">
                            <span class="menu-name">Restaurant Delivery Charges</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-checkbox-multiple-marked-circle "></i>
                        </span>
                    </a>
                </li>
				
                <li class="menu-item <?php if($title=='Category'){ echo 'active'; } ?>">
                    <a href="" class='menu-link'>
                        <span class="menu-label">
                            <span class="menu-name">Order Manager</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-checkbox-multiple-marked-circle "></i>
                        </span>
                    </a>
                </li>

                <li class="menu-item <?php if($title=='Shop Section'){ echo 'active'; } ?>">
                    <a href="#" class="open-dropdown menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Product/Category Manager</span>
                        </span>
                         <span class="arrowcaret">
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                        </span>
                         <span class="menu-icon">
                            <i class="icon-placeholder fe fe-home"></i>
                        </span>
                    </a>
					<ul class="sub-menu">
                        <li class="menu-item <?php if($title=='Store Category'){ echo 'active'; } ?>">
                            <a href="<?php echo base_url('admin/storeCategory'); ?>" class=' menu-link'>
                                <span class="menu-label">
                                    <span class="menu-name">Store Category</span>
                                </span>
                                <span class="menu-icon">
                                    <i class="icon-placeholder mdi mdi-calendar-edit "></i>
                                </span>
                            </a>
                        </li>
                        <li class="menu-item <?php if($title=='Restaurant Category'){ echo 'active'; } ?>">
                            <a href="<?php echo base_url('admin/restaurant-category'); ?>" class=' menu-link'>
                                <span class="menu-label">
                                    <span class="menu-name">Restaurant Category</span>
                                </span>
                                <span class="menu-icon">
                                    <i class="icon-placeholder mdi mdi-checkbox-multiple-marked-circle "></i>
                                </span>
                            </a>
                        </li>
					</ul>	
                </li>

                <li class="menu-item <?php if($title=='Shop Section'){ echo 'active'; } ?>">
                    <a href="#" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Accounting</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward  "></i>
                        </span>
                    </a>
                </li>
				<li class="menu-item <?php if($title=='Shop Section'){ echo 'active'; } ?>">
                    <a href="#" class="menu-link open-dropdown">
                        <span class="menu-label">
                            <span class="menu-name">Jobs</span>
                        </span>
                         <span class="arrowcaret">
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                        </span>
                         <span class="menu-icon">
                            <i class="icon-placeholder fe fe-home"></i>
                        </span>
                    </a>
                    <ul class="sub-menu">
                        <li class="menu-item <?php if($title=='Job Category'){ echo 'active'; } ?>">
                            <a href="<?php echo base_url('admin/job-category') ?>" class="menu-link">
                                <span class="menu-label">
                                    <span class="menu-name">Job Category</span>
                                </span>
                                <span class="menu-icon">
                                    <i class="icon-placeholder mdi mdi-step-forward  "></i>
                                </span>
                            </a>
                        </li>
                        <li class="menu-item <?php if($title=='Job Type'){ echo 'active'; } ?>">
                            <a href="<?php echo base_url('admin/job-type') ?>" class="menu-link">
                                <span class="menu-label">
                                    <span class="menu-name">Job Type</span>
                                </span>
                                <span class="menu-icon">
                                    <i class="icon-placeholder mdi mdi-step-forward  "></i>
                                </span>
                            </a>
                        </li>
                         <li class="menu-item <?php if($title=='Job Board'){ echo 'active'; } ?>">
                            <a href="<?php echo base_url('admin/job-board') ?>" class="menu-link">
                                <span class="menu-label">
                                    <span class="menu-name">Job Board</span>
                                </span>
                                <span class="menu-icon">
                                    <i class="icon-placeholder mdi mdi-step-forward  "></i>
                                </span>
                            </a>
                        </li>
						<li class="menu-item <?php if($title=='Job Applied'){ echo 'active'; } ?>">
                            <a href="<?php echo base_url('admin/job-applied') ?>" class="menu-link">
                                <span class="menu-label">
                                    <span class="menu-name">Job Applied</span>
                                </span>
                                <span class="menu-icon">
                                    <i class="icon-placeholder mdi mdi-step-forward  "></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                        
                </li>
                <!--
                <li class="menu-item <?php if($title=='Job Category'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/job-category') ?>" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Job Category</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward  "></i>
                        </span>
                    </a>
                </li>
                -->
				<!--
                <li class="menu-item <?php if($title=='Job Type'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/job-type') ?>" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Job Type</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward  "></i>
                        </span>
                    </a>
                </li> -->
				<!--
                <li class="menu-item <?php if($title=='Job Board'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/job-board') ?>" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Job Board</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward  "></i>
                        </span>
                    </a>
                </li>
					-->
                <li class="menu-item <?php if($title=='Shop Section'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/purchased_gift_card');  ?>" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Gift Cards /Coupon</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward  "></i>
                        </span>
                    </a>
                </li>

            <!--    <li class="menu-item <?php if($title=='Shop Section'){ echo 'active'; } ?>">
                    <a href="#" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">E-Market credits</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward  "></i>
                        </span>
                    </a>
                </li>

                <li class="menu-item <?php if($title=='Shop Section'){ echo 'active'; } ?>">
                    <a href="#" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Support Center</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward  "></i>
                        </span>
                    </a>
                </li> -->

            </ul>
        </li>
        <!-- Service Manager  module closes -->


        <!-- Site Content and Setting module opens -->
        <li class="menu-item <?php if($title=='Slider'|$title=='Store Slider'|$title=='Coupon Management'|$title=='Terms And Condition'|$title=='Privact and Policy'|$title=='Help Category'|$title=='Country'){ echo 'active opened'; } ?>">
            <a href="#" class="open-dropdown menu-link">
                <span class="menu-label">
                    <span class="menu-name">Site Content & Settings</span>
                    <span class="arrowcaret">
                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                        <i class="fa fa-angle-up" aria-hidden="true"></i>
                    </span>
                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder fe fe-home"></i>
                </span>
            </a>
            <!--submenu-->
            <ul class="sub-menu" <?php if($title=='City'|$title=='Country'|$title=='Slider'|$title=='Store Slider'|$title=='Coupon Management'|$title=='Terms And Condition'|$title=='Privact and Policy'|$title=='Help Category'|$title=='Country'){ echo 'style="display: block;"'; } ?>>

                <li class="menu-item <?php if($title=='Country'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/country'); ?>" class='menu-link'>
                        <span class="menu-label">
                            <span class="menu-name">Country</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-checkbox-multiple-marked-circle "></i>
                        </span>
                    </a>
                </li>
                
                <li class="menu-item <?php if($title=='City'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/city'); ?>" class='menu-link'>
                        <span class="menu-label">
                            <span class="menu-name">City</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-checkbox-multiple-marked-circle "></i>
                        </span>
                    </a>
                </li>

                <li class="menu-item <?php if($title=='Shop Section'){ echo 'active'; } ?>">
                    <a href="#" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Appearance</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward  "></i>
                        </span>
                    </a>
                </li>

                <li class="menu-item <?php if($title=='Shop Section'){ echo 'active'; } ?>">
                    <a href="#" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Site content</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward  "></i>
                        </span>
                    </a>
                </li>

                <li class="menu-item <?php if($title=='Slider'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/restaurant-slider'); ?>" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Restaurant Sliders</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward  "></i>
                        </span>
                    </a>
                </li>
				<li class="menu-item <?php if($title=='Store Slider'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/store-slider'); ?>" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Store Sliders</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward  "></i>
                        </span>
                    </a>
                </li>

                <li class="menu-item <?php if($title=='Shop Section'){ echo 'active'; } ?>">
                    <a href="#" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Pages</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward  "></i>
                        </span>
                    </a>
                </li>

                <li class="menu-item <?php if($title=='Shop Section'){ echo 'active'; } ?>">
                    <a href="#" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Media</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward  "></i>
                        </span>
                    </a>
                </li>

                <li class="menu-item <?php if($title=='Shop Section'){ echo 'active'; } ?>">
                    <a href="#" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Reviews & comments</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward  "></i>
                        </span>
                    </a>
                </li>
                
                <li class="menu-item <?php if($title=='Coupon Management'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/coupon');?>" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Coupon Management</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward  "></i>
                        </span>
                    </a>
                </li>
				<li class="menu-item <?php if($title=='Terms And Condition'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/terms-condition');?>" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Terms And Conditions</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward  "></i>
                        </span>
                    </a>
                </li>
                 <li class="menu-item <?php if($title=='Privact and Policy'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/privacy_policy');?>" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Privacy Policy</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward  "></i>
                        </span>
                    </a>
                </li>
                <li class="menu-item <?php if($title=='Help Category'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/help');?>" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Help</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward  "></i>
                        </span>
                    </a>
                </li>
				<li class="menu-item <?php if($title=='Gift Card Amount'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/GiftCard');?>" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Gift Card Amount</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward  "></i>
                        </span>
                    </a>
                </li>
                 <li class="menu-item <?php if($title=='Purchase Gift Card'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/purchased-gift-card');?>" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Purchased Gift Card</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward  "></i>
                        </span>
                    </a>
                </li>

            </ul>
        </li>
        <!-- Service Manager  module closes -->


        <!-- Store module opens -->
<!--                    <li class="menu-item <?php if($title=='Category'|$title=='Store'|$title=='Shop Section'){ echo 'active opened'; } ?>">
            <a href="#" class="open-dropdown menu-link">
                <span class="menu-label">
                    <span class="menu-name">Store</span>
                    <span class="arrowcaret">
                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                        <i class="fa fa-angle-up" aria-hidden="true"></i>
                    </span>
                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder fe fe-home"></i>
                </span>
            </a>
            submenu
            <ul class="sub-menu" <?php if($title=='Category'|$title=='Store'|$title=='Shop Section'){ echo 'style="display: block;"'; } ?>>

                <li class="menu-item <?php if($title=='Category'){ echo 'active'; } ?>">
                    <a href='<?php echo $category_url; ?>' class=' menu-link'>
                        <span class="menu-label">
                            <span class="menu-name">Category
                            </span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-checkbox-multiple-marked-circle "></i>
                        </span>
                    </a>
                </li>

                <li class="menu-item <?php if($title=='Shop Section'){ echo 'active'; } ?>">
                    <a href='<?php echo $shop_section_url; ?>' class=' menu-link'>
                        <span class="menu-label">
                            <span class="menu-name">Shop Section
                            </span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-step-forward  "></i>
                        </span>
                    </a>
                </li>

            </ul>
        </li>-->
        <!-- Store module closes -->

        <!-- Language module Opens -->

<!--                    <li class="menu-item <?php if($title=='Language'|$title=='Text'){ echo 'active opened'; } ?>">
            <a href="#" class="open-dropdown menu-link">
                <span class="menu-label">
                    <span class="menu-name">Language</span>
                    <span class="arrowcaret">
                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                        <i class="fa fa-angle-up" aria-hidden="true"></i>
                    </span>
                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder fe fe-book-open"></i>
                </span>
            </a>
            submenu
            <ul class="sub-menu" <?php if($title=='Language'|$title=='Text'){ echo 'style="display: block;"'; } ?>>

                <li class="menu-item <?php if($title=='Language'){ echo 'active'; } ?>">
                    <a href='<?php echo base_url('admin/language'); ?>' class='menu-link'>
                        <span class="menu-label">
                            <span class="menu-name">Language</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-checkbox-multiple-marked-circle"></i>
                        </span>
                    </a>
                </li>
                <li class="menu-item <?php if($title=='Text'){ echo 'active'; } ?>">
                    <a href='<?php echo base_url('admin/text'); ?>' class='menu-link'>
                        <span class="menu-label">
                            <span class="menu-name">Text</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-checkbox-multiple-marked-circle"></i>
                        </span>
                    </a>
                </li>

            </ul>

        </li>-->

        <!-- Language module closes -->

        <!-- Restaurant category module opens -->

<!--                    <li class="menu-item <?php if($title=='Restaurant Category'|$title=='Restaurant'){ echo 'active opened'; } ?>">
            <a href="#" class="open-dropdown menu-link">
                <span class="menu-label">
                    <span class="menu-name">Restaurant</span>
                    <span class="arrowcaret">
                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                        <i class="fa fa-angle-up" aria-hidden="true"></i>
                    </span>
                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder fe fe-home"></i>
                </span>
            </a>
            submenu
            <ul class="sub-menu" <?php if($title=='Restaurant Category'|$title=='Restaurant'){ echo 'style="display: block;"'; } ?>>

                <li class="menu-item <?php if($title=='Restaurant Category'){ echo 'active'; } ?>">
                    <a href='<?php echo base_url('admin/restaurant-category') ?>' class=' menu-link'>
                        <span class="menu-label">
                            <span class="menu-name">Restaurant Category</span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-checkbox-multiple-marked-circle "></i>
                        </span>
                    </a>
                </li>


            </ul>
        </li>-->
		
		<li class="menu-item <?php if($title=='Dashboard'){ echo 'active'; } ?>">
            <a href="<?php echo base_url('admin/dashboard');  ?>" class="menu-link open-dropdown ">
                <span class="menu-label">
                    <span class="menu-name caret">Review</span>
                     <span class="arrowcaret">
                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                        <i class="fa fa-angle-up" aria-hidden="true"></i>
                    </span>
                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder fe fe-activity "></i>
                </span>
            </a>
			<ul class="sub-menu">
                <li class="menu-item <?php if($title=='StoreReview'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/adminStoreReview'); ?>" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name caret">Store Review</span>

                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder fe fe-package "></i>
                        </span>
                    </a>
                </li>
                <li class="menu-item <?php if($title=='RestaurantReview'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('admin/adminRestaurantReview'); ?>" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name caret">Restaurant Review</span>

                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder fe fe-activity "></i>
                        </span>
                    </a>
                </li>
               
            </ul>    
        </li>
		
		<li class="menu-item ">
                    <a href="<?php echo base_url('admin/adminSubscriber');  ?>" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Subscriber</span>
                             
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder fe fe-users "></i>
                        </span>
                    </a>
        </li>
		
        <!-- Restaurant category module closes -->

    </ul>

</div>

</aside>
<main class="admin-main">
    <!--site header begins-->
    <header class="admin-header">

        <a href="#" class="sidebar-toggle" data-toggleclass="sidebar-open" data-target="body"> </a>

        <nav class=" ml-auto">
            <ul class="nav align-items-center">

                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="#"   role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <div class="avatar avatar-sm avatar-online">
                           <?php if(isset($user)){ $image = $user['image_url'];}?>
                            <span class="avatar-title rounded-circle bg-dark">
                                <img src=" <?php echo base_url('uploads/profile_images/'.$image); ?>" class="img-circle" />
                            </span>
                        </div>
                    </a>
                    <div class="dropdown-menu  dropdown-menu-right">
                        <?php 
                            $edit_account= base_url('admin/profile');
                            $change_password_url= base_url('admin/change-password');
                            $logout_url= base_url('admin/logout'); 
                        ?>
                        <a class="dropdown-item" href="<?php echo $edit_account; ?>">  Edit Account</a>
                        <a class="dropdown-item" href="<?php echo $change_password_url; ?>">  Reset Password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo $logout_url; ?>"> Logout</a>
                    </div>
                </li>

            </ul>

        </nav>
    </header>