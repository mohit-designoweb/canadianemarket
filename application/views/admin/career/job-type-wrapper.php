<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <h5 class="m-b-0" style="padding-top: 5px">
                    Job Type Listing
                </h5>
            </div>
            <div class="col-2 offset-7">
                <a href="<?php echo base_url('admin/add-job-type'); ?>" class="btn btn-primary">Add Job</a>
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
                    if (!empty($jobTypes)) {
                        $i = 1;
                        foreach ($jobTypes as $jobType) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>

                                <td><?php echo $jobType['job_type_name']; ?></td>
                                <td><?php echo $jobType['is_active']; ?></td>
                                <td>
								<?php
                                    if ($jobType['is_active'] == 'Active') {
                                        ?>
                                        <a href="<?php echo base_url('admin/changeJobTypeStatus/' . $jobType['job_type_id'] . '/Inactive'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Active <i class="fe fe-thumbs-up"></i></a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="<?php echo base_url('admin/changeJobTypeStatus/' . $jobType['job_type_id'] . '/Active'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="btn btn-primary btn-sm change-status">Inactive <i class="fe fe-thumbs-down"></i></a>
                                            <?php
                                        }
                                        ?>
                                    <a href="<?php echo base_url('admin/add-job-type/' . $jobType['job_type_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Job Type" class="btn btn-success btn-sm">Edit <i class="fe fe-edit"></i></a>
                                    <a href="<?php echo base_url('admin/doDeleteJobType/' . $jobType['job_type_id']); ?>" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-sm delete" title="Delete Job Type">Delete <i class="fe fe-trash"></i></a>
                                    
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