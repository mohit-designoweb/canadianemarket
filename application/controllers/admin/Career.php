<?php

/**
 * Description of Career
 *
 * @author Manish Khandelwal
 */
class Career extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model', 'career_model']);
        if (empty($this->session->userdata('email_admin'))) {
            redirect(base_url('admin'));
        }
    }
    
    private function jobType() {
        $list = [' ' => 'select the job category'];
//        $types = $this->career_model->getActiveJobType();
//       print_r($categories); die;
//        foreach ($types as $type) {
//            $list[$type['job_type_id']] = $type['job_type_name'];
//        }
//        return $list;
    }

    public function getUserData() {
        $email = $this->session->userdata('email_admin');
        return $this->admin_model->getUserdata($this->session->userdata('is_admin'), $email);
    }

    private function jobCategory() {
        $list = [' ' => 'select the job type'];
        $categories = $this->career_model->getActiveJobCategory();
        foreach ($categories as $category) {
            $list[$category['job_category_id']] = $category['job_category_name'];
        }
        return $list;
    }

    public function filteredJobType() {
        $this->output->set_content_type('application/json');
        $job_cat_id = $this->input->post('val');
        $result = $this->career_model->filteredJobType($job_cat_id);
        $list = [' ' => 'select the job category'];
        foreach ($result as $type) {
            $list[$type['job_type_id']] = $type['job_type_name'];
        }
        $data['list'] = $list;
        $content_wrapper = $this->load->view('admin/career/jobType-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }    

    public function job_board() {
        $data['title'] = 'Job Board';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/career/view-job-detail');
        $this->load->view('admin/commons/footer');
    }

    public function get_job_detail_wrapper() {
        $this->output->set_content_type('application/json');
        $data['jobDetails'] = $this->career_model->getAllJobdetail();
        $content_wrapper = $this->load->view('admin/career/job-detail-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function getJobTypeByCatId($job_cat_id)
    {
        $list = [' ' => 'select the job category'];
        $types = $this->career_model->getJobTypeByCatId($job_cat_id);
        foreach ($types as $type) {
            $list[$type['job_type_id']] = $type['job_type_name'];
        }
        return $list;
    }

    public function addJobBoardDetail($id = NULL) {
        if (!empty($id)) {
            $jobDetail = $this->career_model->getJobDetailById($id);
            $job_cat_id = $jobDetail['job_category_id'];
            $data['type'] = $this->getJobTypeByCatId($job_cat_id);
            $data['jobDetail'] = $this->career_model->getJobDetailById($id);
        }
        else
        {
            $data['type'] = $this->jobType(); 
        }
        $data['title'] = 'Job Board';
        $data['user'] = $this->getUserData();
        $data['table'] = '1';
        $data['category'] = $this->jobCategory();
        
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/career/add-job-detail');
        $this->load->view('admin/commons/footer');
    }

    public function doUploadImg() {
        $config = array(
            'upload_path' => "./uploads/job",
            'allowed_types' => "jpeg|jpg|png",
            'file_name' => rand(11111, 99999),
            'max_size' => "3048" // Can be set to particular file size , here it is 2 MB(2048 Kb)
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image_url')) {
            $data = $this->upload->data();
            return $data['file_name'];
        } else {
            $this->session->set_userdata('error', ['image_url' => $this->upload->display_errors()]);
            return 0;
        }
    }

    public function doAddJobDetail() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('job_category_id', 'Job Category Name', 'required');
        $this->form_validation->set_rules('job_type_id', 'Job Type', 'required');
        $this->form_validation->set_rules('designation_name', 'Designation Name', 'required');
        $this->form_validation->set_rules('designation_type', 'Designation Type', 'required');
        $this->form_validation->set_rules('job_post_date', 'Post Date', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $image_url = $this->doUploadImg();
        if (!$image_url) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
            $this->session->unset_userdata('error');
            return FALSE;
        }
        $result = $this->career_model->doAddJobDetail($image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Job Detail Added Successfully', 'url' => base_url('admin/job-board')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Job Detail Not Added']));
            return FALSE;
        }
    }

    public function doEditJobDetail($id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('job_category_id', 'Job Category Name', 'required');
        $this->form_validation->set_rules('job_type_id', 'Job Type', 'required');
        $this->form_validation->set_rules('designation_name', 'Designation Name', 'required');
        $this->form_validation->set_rules('designation_type', 'Designation Type', 'required');
        $this->form_validation->set_rules('job_post_date', 'Post Date', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        if (!empty($_FILES['image_url']['name'])) {
            $image_url = $this->doUploadImg();
            if (!$image_url) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        } else {
            $store = $this->career_model->getJobDetailById($id);
            $image_url = $store['image_url'];
        }
        $result = $this->career_model->doEditJobDetail($image_url, $id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Job Detail Updated Successfully', 'url' => base_url('admin/job-board')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Job Detail Not Updated']));
            return FALSE;
        }
    }

    public function doDeleteJobDetail($id) {
        $this->output->set_content_type('application/json');
        $result = $this->career_model->doDeleteJobDetail($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Category Deleted Successfully', 'url' => base_url('admin/job-board')]));
            return FALSE;
        }
    }

    public function changeJobDetailStatus($id, $status) {
        $this->output->set_content_type('application/json');
        $this->career_model->changeJobDetailStatus($id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }
   public function job_applied() {
	$jobArray = [];
	$i=0;
	$data['title'] = 'Job Applied';
	$data['table'] = '1';
	$data['user'] = $this->getUserData();
	$appliedJobs = $this->career_model->getAppliedJobDetail();
	foreach($appliedJobs as $job)
	{
	$jobArray[$i]['name'] = $job['first_name']." ".$job['last_name'];
	$job_name = $this->career_model->getJobDetailById($job['job_id']);
	$jobArray[$i]['job_name'] = $job_name['designation_name'];
	$jobArray[$i]['email'] = $job['email'];
	$jobArray[$i]['resume_url'] = $job['resume_url'];
	$i++;
	}
	$data['appliedJobs'] = $jobArray;
	$this->load->view('admin/commons/header', $data);
	$this->load->view('admin/commons/admin-sidebar', $data);
	$this->load->view('admin/career/job-enquiry');
	$this->load->view('admin/commons/footer');
  }

}
