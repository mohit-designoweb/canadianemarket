<div class="admin-sidebar-wrapper js-scrollbar">
    <ul class="menu">
        <li class="menu-item <?php if($title=='Dashboard'){ echo 'active'; } ?>">
            <a href="<?php echo base_url('partner/dashboard');  ?>" class="menu-link">
                <span class="menu-label">
                    <span class="menu-name caret">Dashboard</span>

                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder fe fe-activity "></i>
                </span>
            </a>
        </li>
        
        <li class="menu-item <?php if($title=='Store'){ echo 'active'; } ?>">
            <a href="<?php echo base_url('admin/partnerStore'); ?>" class=' menu-link'>
                <span class="menu-label">
                    <span class="menu-name">Store</span>
                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder mdi mdi-calendar-edit "></i>
                </span>
            </a>
        </li>
        <li class="menu-item <?php if($title=='Shop Section'|$title=="Product"|$title=="Product SKU"){ echo 'active'; } ?>">
            <a href="<?php echo base_url('partner/partner-shop-section'); ?>" class=' menu-link'>
                <span class="menu-label">
                    <span class="menu-name">Shop Section</span>
                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder mdi mdi-calendar-edit "></i>
                </span>
            </a>
        </li>
         
        <li class="menu-item <?php if($title=='Restaurant'){ echo 'active'; } ?>">
            <a href='<?php echo base_url('admin/partnerRestaurant'); ?>' class=' menu-link'>
                <span class="menu-label">
                    <span class="menu-name">Restaurant</span>
                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder mdi mdi-checkbox-multiple-marked-circle "></i>
                </span>
            </a>
        </li>
		<li class="menu-item <?php if($title=='Restaurant Order'){ echo 'active'; } ?>">
            <a href='<?php echo base_url('admin/partnerOrder'); ?>' class=' menu-link'>
                <span class="menu-label">
                    <span class="menu-name">Restaurant Order Management</span>
                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder mdi mdi-checkbox-multiple-marked-circle "></i>
                </span>
            </a>
        </li>
        <li class="menu-item <?php if($title=='Store Orders'){ echo 'active'; } ?>">
            <a href='<?php echo base_url('partnerOrder/store-order'); ?>' class=' menu-link'>
                <span class="menu-label">
                    <span class="menu-name">Store Order Management</span>
                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder mdi mdi-checkbox-multiple-marked-circle "></i>
                </span>
            </a>
        </li>
		<!--
        <li class="menu-item <?php if($title=='Market Place Product'){ echo 'active'; } ?>">
            <a href='<?php echo base_url('admin/partnerMarket'); ?>' class=' menu-link'>
                <span class="menu-label">
                    <span class="menu-name">Market</span>
                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder mdi mdi-checkbox-multiple-marked-circle "></i>
                </span>
            </a>
        </li>
        -->
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
                            $edit_account= base_url('partner/profile');
                            $change_password_url= base_url('partner/change-password');
                            $logout_url= base_url('partner/logout'); 
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