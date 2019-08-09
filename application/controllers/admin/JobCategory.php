<?php

/**
 * Description of jobCategory
 *
 * @author Manish Khandelwal
 */
class JobCategory extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model', 'career_model']);
        if (empty($this->session->userdata('email_admin'))) {
            redirect(base_url('admin'));
        }
    }
    
    private function jobCategory() {
        $list = [' ' => 'select the job type'];
        $categories = $this->career_model->getActiveJobCategory();
        foreach ($categories as $category) {
            $list[$category['job_category_id']] = $category['job_category_name'];
        }
        return $list;
    }

    public function getUserData() {
        $email = $this->session->userdata('email_admin');
        return $this->admin_model->getUserdata($this->session->userdata('is_admin'), $email);
    }

    public function index($id = NULL) {
        if (!empty($id)) {
            $data['category'] = $this->career_model->getJobCategoryById($id);
        }
        $data['table'] = '1';
        $data['title'] = 'Job Category';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/career/jobCategory');
        $this->load->view('admin/commons/footer');
    }

    public function get_job_category_wrapper() {
        $this->output->set_content_type('application/json');
        $data['jobCategories'] = $this->career_model->getAllJobCategory();
        $content_wrapper = $this->load->view('admin/career/job-category-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function doAddJobCategory() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('category_name', 'Category Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->career_model->doAddJobCategory();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Category Added Successfully', 'url' => base_url('admin/jobCategory')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Category Not Added']));
            return FALSE;
        }
    }

    public function doEditJobCategory($id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('category_name', 'Category Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->career_model->doEditJobCategory($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Category Update Successfully', 'url' => base_url('admin/jobCategory')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Please Do Some Changes']));
            return FALSE;
        }
    }

    public function changeJobCategoryStatus($category_id, $status) {
        $this->output->set_content_type('application/json');
        $this->career_model->changeJobCategoryStatus($category_id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }
    
    public function job_type() {
        $data['title'] = 'Job Type';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/career/view-job-type');
        $this->load->view('admin/commons/footer');
    }

    public function get_job_type_wrapper() {
        $this->output->set_content_type('application/json');
        $data['user_type'] = $this->session->userdata('user_type');
        $data['jobTypes'] = $this->career_model->getAllJobType();
        $content_wrapper = $this->load->view('admin/career/job-type-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function add_Job_type($id = NULL) {
        if (!empty($id)) {
            $data['jobType'] = $this->career_model->getJobTypeById($id);
        }
        $data['title'] = 'Job Type';
        $data['user'] = $this->getUserData();
        $data['user_type'] = $this->session->userdata('user_type');
        $data['table'] = '1';
        $data['category'] = $this->jobCategory();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/career/add-job-type');
        $this->load->view('admin/commons/footer');
    }

    public function doAddJobType() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('job_category_id', 'Job Category Name', 'required');
        $this->form_validation->set_rules('job_type', 'Job Type', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->career_model->doAddJobType();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Category Added Successfully', 'url' => base_url('admin/job-type')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Category Not Added']));
            return FALSE;
        }
    }

    public function doEditJobType($id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('job_category_id', 'Job Category Name', 'required');
        $this->form_validation->set_rules('job_type', 'Job Type', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->career_model->doEditJobType($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Category Added Successfully', 'url' => base_url('admin/job-type')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Category Not Added']));
            return FALSE;
        }
    }

    public function doDeleteJobType($id) {
        $this->output->set_content_type('application/json');
        $result = $this->career_model->doDeletJobType($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Category Deleted Successfully', 'url' => base_url('admin/job-type')]));
            return FALSE;
        }
    }

    public function changeJobTypeStatus($id, $status) {
        $this->output->set_content_type('application/json');
        $this->career_model->changeJobTypeStatus($id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

}
