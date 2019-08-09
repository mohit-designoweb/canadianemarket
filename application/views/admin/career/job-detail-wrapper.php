<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <h5 class="m-b-0" style="padding-top: 5px">
                    Job Detail Listing
                </h5>
            </div>
            <div class="col-2 offset-7">
                <a href="<?php echo base_url('admin/addJobBoardDetail'); ?>" class="btn btn-primary">Add Job Detail</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive p-t-10">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Job Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (!empty($jobDetails)) {
                        $i = 1;
                        foreach ($jobDetails as $jobDetail1) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>

                                <td><?php echo $jobDetail1['designation_name']; ?></td>
                                <td><?php echo $jobDetail1['is_active']; ?></td>
                                <td>
								 <?php
                                    if ($jobDetail1['is_active'] == 'Active') {
                                        ?>
                                        <a href="<?php echo base_url('admin/changeJobDetailStatus/' . $jobDetail1['job_id'] . '/Inactive'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Active <i class="fe fe-thumbs-up"></i></a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="<?php echo base_url('admin/changeJobDetailStatus/' . $jobDetail1['job_id'] . '/Active'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Inactive <i class="fe fe-thumbs-down"></i></a>
                                            <?php
                                        }
                                    ?>
                                    <a href="<?php echo base_url('admin/addJobBoardDetail/' . $jobDetail1['job_id']); ?>" data-toggle="tooltip" data-placement="top" class="btn btn-success btn-sm" title="Edit Job Detail">Edit <i class="fe fe-edit"></i></a>
                                    <a href="<?php echo base_url('admin/doDeleteJobDetail/' . $jobDetail1['job_id']); ?>" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-sm delete" title="Delete Job">Delete <i class="fe fe-trash"></i></a>
                                   
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