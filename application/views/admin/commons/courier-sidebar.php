<div class="admin-sidebar-wrapper js-scrollbar">
    <ul class="menu">
        <li class="menu-item <?php if($title=='Dashboard'){ echo 'active'; } ?>">
            <a href="<?php echo base_url('courier/dashboard');  ?>" class="menu-link">
                <span class="menu-label">
                    <span class="menu-name caret">Dashboard</span>

                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder fe fe-activity "></i>
                </span>
            </a>
        </li>
        <li class="menu-item <?php if($title=='Search For New Order'){ echo 'active'; } ?>">
            <a href='' id="" data-toggle="modal" data-target="#search-order" class=' menu-link'>
                <span class="menu-label">
                    <span class="menu-name">Search For New Order</span>
                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder mdi mdi-checkbox-multiple-marked-circle "></i>
                </span>
            </a>
        </li>
	<li class="menu-item <?php if($title=='Courier Order'){ echo 'active'; } ?>">
            <a href='<?php echo base_url('courier/view-order'); ?>' class=' menu-link'>
                <span class="menu-label">
                    <span class="menu-name">New Orders</span>
                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder mdi mdi-checkbox-multiple-marked-circle "></i>
                </span>
            </a>
        </li>
        <!--<li class="menu-item <?php if($title=='Courier Delivered Order'){ echo 'active'; } ?>">
            <a href='<?php echo base_url('courier/view-delivered-order'); ?>' class=' menu-link'>
                <span class="menu-label">
                    <span class="menu-name">Delivered Orders</span>
                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder mdi mdi-checkbox-multiple-marked-circle "></i>
                </span>
            </a>
        </li>-->
        
    </ul>

</div>

</aside>
<main class="admin-main">
    <!--site header begins-->
    <header class="admin-header">
        <a href="#" class="sidebar-toggle" data-toggleclass="sidebar-open" data-target="body"> </a>
        <nav class=" ml-auto">
            <ul class="nav align-items-center">
                <li class="nav-item">
                    <div class="dropdown">
                    <a href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-24px mdi-bell-outline"></i>
                        <span class="notification-counter"></span>
                    </a>
                    <div class="dropdown-menu notification-container dropdown-menu-right" x-placement="top-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-264px, -1px, 0px);">
                        <div class="d-flex p-all-15 bg-white justify-content-between border-bottom ">
                            <span class="h5 m-0">Notifications</span>
                        </div>
                        <div class="notification-events bg-gray-300">
                            <div class="text-overline m-b-5"></div>
                            <?php 
                            if(!empty($getRestaurantUserDetail)){
                                 $length = count($getRestaurantUserDetail);
                                 $i=0;
                            foreach($getRestaurantUserDetail as $orderDetail){
                                //print_r($orderDetail);
                                if($orderDetail['status']==0){?>
                            <a href="<?php echo base_url('admin/courier/courierOrderDetail/'.$orderDetail['order_id']."/".$orderDetail['courier_order_mapping_id']);?>" class="d-block m-b-10">
                                <div class="card">
                                    <div class="card-body"> <i class="mdi mdi-circle text-success">New order From </i> <?php echo $orderDetail['restaurant_name'];?></div>
                                </div>
                            </a>
                                <?php  $i++;}} } ?>
                        </div>
                    </div>
                </div>
            </li>
                <form id="common-form" action="<?php if($user['service_status']=="Inactive"){
                echo base_url('admin/courier/startService');}else{echo base_url('admin/courier/endService');}?>">
                <li class="nav-item">
                  <?php if($user['service_status']=="Inactive"){?>
                    <input type="submit" id="start-service" class="btn btn-dark" style="background-color: darkolivegreen;" value="Start Service">
                  <?php } else{?>
                    <input type="submit" class="btn btn-dark" style="background-color: red;" value="End Service">
                  <?php }?>
                </li>
                </form>

                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="#"   role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <div class="avatar avatar-sm avatar-online">
                           <?php if(!empty($user['image_url'])){ 
						   $image = base_url('uploads/courier/'.$user['image_url']);
						   }
						   else{
							   $image = base_url('assets/img/userimg.png');
						   }?>
						   
                            <span class="avatar-title rounded-circle bg-dark">
                                <img src=" <?php echo $image; ?>" class="img-circle" />
                            </span>
                        </div>
                    </a>
                    <div class="dropdown-menu  dropdown-menu-right">
                        <?php 
                            $edit_account= base_url('courier/profile');
                            $change_password_url= base_url('courier/change-password');
                            $logout_url= base_url('courier/logout'); 
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