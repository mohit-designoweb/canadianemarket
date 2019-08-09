<div class="card">
    <div class="card-header">
        <h5 class="m-b-0">
            Gift Card Amount List
        </h5>
    </div>
    <div class="card-body">
        <div class="table-responsive p-t-10">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                        
                    if (!empty($amounts)) {
                        $i = 1;
                        foreach ($amounts as $amount) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                
                                <td><?php echo $amount['amount']; ?></td>
                                <td><?php echo $amount['is_active']; ?></td>
                                <td>
                                    <?php if ($amount['is_active'] == 'Active') {
                                        ?>
                                        <a href="<?php echo base_url('admin/doChangeAmountStatus/' . $amount['amount_id'] . '/Inactive'); ?>" data-toggle="tooltip" data-placement="top" title data-original-title="Change-Status" class="btn btn-primary btn-sm change-status">Active <i class="fe fe-thumbs-up"></i></a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="<?php echo base_url('admin/doChangeAmountStatus/' . $amount['amount_id'] . '/Active'); ?>" data-toggle="tooltip" data-placement="top" title data-original-title="Change-Status" class=" change-status">Inactive <i class="fe fe-thumbs-down"></i></a>
                                        <?php }
                                        ?>
                                    <a href="<?php echo base_url('admin/giftcard/index/' . $amount['amount_id']); ?>" data-toggle="tooltip" data-placement="top" title data-original-title="Edit Category" class="btn btn-success btn-sm">Edit <i class="fe fe-edit"></i></a>
                                    <a href="<?php echo base_url('admin/doDeleteAmountById/' . $amount['amount_id']); ?>" data-toggle="tooltip" class="btn btn-danger btn-sm delete" data-placement="top" title data-original-title="Edit Category">Delete <i class="fe fe-trash"></i></a>
                                    
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