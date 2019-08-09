<div class="card">
    <div class="card-header">
        <h5 class="m-b-0">Text</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive p-t-10">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Text</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (!empty($texts)) {
                        $i = 1;
                        foreach ($texts as $text) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $text['text']; ?></td>
                                <td><?php echo $text['is_active']; ?></td>
                                <td>
								<?php if ($text['is_active'] == 'Active') {
                                        ?>
                                        <a href="<?php echo base_url('admin/changeLanguageTextStatus/' . $text['text_id'] . '/Inactive'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Active <i class="fe fe-thumbs-up"></i></a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="<?php echo base_url('admin/changeLanguageTextStatus/' . $text['text_id'] . '/Active'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Inactive <i class="fe fe-thumbs-down"></i></a>
                                            <?php }
                                        ?>
                                    <a href="<?php echo base_url('admin/textlang/' . $text['text_id']); ?>" data-toggle="tooltip" data-placement="top" title="Add Language"><i class="fe fe-anchor"></i></a>
                                    <a href="<?php echo base_url('admin/text/' . $text['text_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Text" class="btn btn-success btn-sm">Edit <i class="fe fe-edit"></i></a>
                                    
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