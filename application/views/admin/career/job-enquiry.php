<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4>Job Enquiry</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container pull-up">
        <div class="row">
            <div class="col-12" id="">
			<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <h5 class="m-b-0" style="padding-top: 5px">
                    Job Enquiry Listing
                </h5>
            </div>
            <div class="col-2 offset-7">
                
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive p-t-10">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
						<th>Applied For Job</th>
						<th>Resume</th>
                        
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (!empty($appliedJobs)) {
                        $i = 1;
                        foreach ($appliedJobs as $appliedJob) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>

                                <td><?php echo $appliedJob['name']; ?></td>
								
                                <td><?php echo $appliedJob['email']; ?></td>
								<td><?php echo $appliedJob['job_name']; ?></td>
								<td><a href="<?php echo base_url('uploads/job_resume/'.$appliedJob['resume_url']);?>" download="myimage">Download</a></td>
                                <!--<td>
                                    <a href="<?php echo base_url('admin/addJobBoardDetail/' . $jobDetail1['job_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Job Detail"><i class="fe fe-edit"></i></a>
                                    <a href="<?php echo base_url('admin/doDeleteJobDetail/' . $jobDetail1['job_id']); ?>" data-toggle="tooltip" data-placement="top" class="delete" title="Delete Job"><i class="fe fe-delete"></i></a>
                                    <?php
                                    if ($jobDetail1['is_active'] == 'Active') {
                                        ?>
                                        <a href="<?php echo base_url('admin/changeJobDetailStatus/' . $jobDetail1['job_id'] . '/Inactive'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="change-status"><i class="fe fe-thumbs-up"></i></a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="<?php echo base_url('admin/changeJobDetailStatus/' . $jobDetail1['job_id'] . '/Active'); ?>" data-toggle="tooltip" data-placement="top" title="Change-Status" class="change-status"><i class="fe fe-thumbs-down"></i></a>
                                            <?php
                                        }
                                    ?>
                                </td>-->

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
			</div>
        </div>
    </div>
</section>

</main>



