<div class="row"> 
    <div class="col-md-8">    
        <div class="card-body">
            <div class="table-responsive p-t-10">
                <table id="example" class="table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Topping Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (!empty($toppings)) {
                            $i = 1;
                            foreach ($toppings as $topp) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><a href="<?php echo base_url('admin/AdminUserSpecification/manage-topping-wrapper/' . $topp['id']); ?>" class="btnUrls restauranttabs_edit" style="color: #4c66fb;"><?php echo $topp['topping_name']; ?></a></td>
                                    <td><?php echo $topp['is_active']; ?></td>
                                    <td>
                                        <a href="<?php echo base_url('admin/AdminUserSpecification/manage-topping-wrapper/' . $topp['id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Topping" class="btn btn-success btn-sm restauranttabs_edit">Edit <i class="fe fe-edit"></i></a>
                                        <?php if ($topp['is_active'] == 'Active') {
                                            ?>
                                            <a href="<?php echo base_url('admin/topping/change_topping_status/' . $topp['id'] . '/Inactive'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Active <i class="fe fe-thumbs-up"></i></a>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="<?php echo base_url('admin/topping/change_topping_status/' . $topp['id'] . '/Active'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Inactive <i class="fe fe-thumbs-down"></i></a>
                                            <?php }
                                            ?>
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
    <div class="col-4">
        <div class="card m-b-30">
            <div id="error_msg"></div>
            <div class="card-header">
                <h5 class="m-b-0">Add Topping</h5>
            </div>
            <div class="card-body">
                <form method="post" id="restaurant-wrapper-common-form" action="<?php
                if (!empty($topping)) {
                    echo base_url('admin/do-edit-topping/' . $topping['id']);
                } else {
                    echo base_url('admin/do-add-topping');
                }
                ?>">
                    <div class="form-group">
                        <label for="topping_name">Topping Name</label>
                        <?php echo form_input(['name' => 'topping_name', 'id' => 'topping_name', 'class' => 'form-control'], isset($topping['topping_name']) ? $topping['topping_name'] : '') ?>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>