<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#menuList" class="active show">Product Listings</a></li>
    <li><a data-toggle="tab" href="#addMenu">Add New Product</a></li>
    <li><a data-toggle="tab" href="#importMenu">Import Menu CSV</a></li>
    <li><a data-toggle="tab" href="#exportMenu">Export Menu CSV</a></li>
</ul>

<div class="tab-content">
    <div id="menuList" class="tab-pane fade in active show">
        <div class="card-body">
            <div class="table-responsive p-t-10">
                <table id="example" class="table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Menu Image</th>
                            <th>Menu Name</th>
                            <th>Price($)</th>
                            <th>Category Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($menus)) {
                            $i = 1;
                            foreach ($menus as $menu_data) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><img height="100" width="100" src="<?php echo base_url('uploads/menu/' . $menu_data['image_url']); ?>"/></td>
                                    <td><a href="<?php echo base_url('admin/AdminMenu/editMenuWrapper/' . $restaurant_id . '/' . $menu_data['menu_id']); ?>" class="btnUrls editMenu restauranttabs_edit" style="color: #4c66fb;"><?php echo $menu_data['menu_name']; ?></a></td>
                                    <td>$<?php echo $menu_data['price']; ?></td>
                                    <td><?php echo $menu_data['menu_category_name']; ?></td>
                                    <td><?php echo $menu_data['is_active']; ?></td>
                                    <td>
                                        <a href="<?php echo base_url('admin/AdminMenu/editMenuWrapper/' . $restaurant_id . '/' . $menu_data['menu_id']); ?>" data-toggle="tooltip" data-placement="top" title data-original-title="Edit Menu" class="btn btn-success btn-sm editMenu restauranttabs_edit">Edit <i class="fe fe-edit"></i></a>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div id="addMenu" class="tab-pane fade in">
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" id="restaurant-wrapper-image-form" action="<?php  echo base_url('admin/AdminMenu/doAddRestaurantMenu/' . $restaurant_id); ?>">
                <?php if (!empty($menu['image_url'])) {  ?>
                    <div class="row">
                        <div class="col-3">
                            <img src="<?php echo base_url('uploads/menu/' . $menu['image_url']); ?>" class="img-responsive">
                        </div>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image_url">Image</label>
                            <?php echo form_upload(['name' => 'image_url', 'id' => 'image_url', 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="menu_name">Name</label>
                            <?php echo form_input(['name' => 'menu_name', 'id' => 'menu_name', 'class' => 'form-control'], isset($menu['menu_name']) ? $menu['menu_name'] : ''); ?>   
                        </div>    
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="price">Price(In $)</label>
                            <?php echo form_input(['name' => 'price', 'id' => 'price', 'class' => 'form-control'], isset($menu['price']) ? $menu['price'] : ''); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="menu_category">Menu Category</label>
                            <?php echo form_dropdown(['name' => 'menu_category', 'id' => 'menu_category', 'class' => 'form-control'], $menu_categorys, isset($menu['menu_category_id']) ? $menu['menu_category_id'] : ''); ?>
                            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="emarket_point">Emarket Point</label>
                            <?php echo form_input(['name' => 'emarket_point', 'id' => 'emarket_point', 'class' => 'form-control'], isset($menu['emarket_point']) ? $menu['emarket_point'] : '') ?>   
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="discount">Discount(In %)</label>
                            <?php echo form_input(['name' => 'discount', 'id' => 'discount', 'class' => 'form-control'], isset($menu['discount']) ? $menu['discount'] : ''); ?>   
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <?php echo form_textarea(['name' => 'description', 'id' => 'description', 'rows' => '5', 'class' => 'form-control'], isset($menu['description']) ? $menu['description'] : '') ?>   
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="is_special">Special Item</label>
                            <input type="checkbox" name="is_special" id="is_special" value="1" <?php if (!empty($menu['is_special'])) {
                                if ($menu['is_special'] == '1') {
                                    echo 'checked';
                                }
                            } ?>/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="spicy">Spicy</label>
                            <input type="checkbox" name="spicy" id="spicy" value="1" <?php if (!empty($menu['spicy'])) {
                                if ($menu['spicy'] == '1') {
                                    echo 'checked';
                                }
                            } ?>/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="topping">Topping</label>
                            <input type="checkbox" name="topping" id="topping" value="1" <?php if (!empty($menu['topping'])) {
                                if ($menu['topping'] == '1') {
                                    echo 'checked';
                                }
                            } ?>/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-2 offset-10">
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div id="importMenu" class="tab-pane fade in">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-2 offset-11">
                       <a href="<?php echo base_url('admin/adminRestaurant'); ?>" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <div id="error_msg"></div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" id="file-import-form" action="<?php echo base_url('admin/AdminMenu/doImportMenuInCSVFile/' . $restaurant_id); ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="new_menu_csv">Add New Products with CSV</label>
                                <?php echo form_input(['type' => 'file', 'name' => 'new_menu_csv', 'id' => 'new_menu_csv', 'class' => 'form-control']); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2">
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div id="exportMenu" class="tab-pane fade in">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-2 offset-11">
                        <a href="<?php echo base_url('admin/adminRestaurant'); ?>" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <div id="error_msg"></div>
            <div class="card-body">
                <form >
                    <div class="row">
                        <div class="col-md-6 offset-3">
                            <div class="form-group">
                                
                                <a class="btn btn-primary" href="<?php echo base_url('admin/AdminMenu/doExportMenuCSVFile/'.$restaurant_id);?>" >Export All Products to CSV</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>

<!-- Modal -->
<div class="modal fade editProduct_model" id="editMenuModel" role="dialog">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Restaurant Menu Details</h4>
            </div>
            <div class="modal-body" id="edit_menu_wrapper">

            </div>
        </div>
    </div>
</div>