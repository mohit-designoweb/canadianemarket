<?php 
foreach($job_type as $job)
{?>
<li><a href="<?php echo base_url('site/getFilteredJobCity/'.$job['job_type_id']);?>" class="job_type"><?php echo $job['job_type_name'];?></a></li>
<?php } ?>
