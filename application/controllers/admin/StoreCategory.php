<?php

/**
 * Description of Admin
 *
 * 	@author Ram Ji Yadav
 */
class StoreCategory extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['category_model', 'admin_model']);
        if (empty($this->session->userdata('email_admin'))) {
            redirect(base_url('admin'));
        }
    }

    public function getUserData() {
        $email = $this->session->userdata('email_admin');
        return $this->admin_model->getUserdata($this->session->userdata('is_admin'), $email);
    }

    public function index($id = NULL) {
        if (!empty($id)) {
            $data['cat'] = $this->category_model->getCategoryById($id);
        }
        $data['table'] = '1';
        $data['title'] = 'Store Category';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/category/category');
        $this->load->view('admin/commons/footer');
    }

    public function doAddCategory() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('category_name', 'Category Name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->category_model->doAddCategory();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Category Added Sucessfully', 'url' => base_url('admin/storeCategory')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Category Not Added']));
            return FALSE;
        }
    }

    public function doEditCategory($id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('category_name', 'Category Name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->category_model->doEditCategory($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1,'msg'=>'Update Successfully', 'url' => base_url('admin/storeCategory')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Changes Were Made.', 'url' => base_url('admin/storeCategory')]));
            return FALSE;
        }
    }

    public function get_store_category_wrapper() {
        $this->output->set_content_type('application/json');
        $data['catgories'] = $this->category_model->getAllCategory();
        $content_wrapper = $this->load->view('admin/category/category-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function changeCategoryStatus($category_id, $status) {
        $this->output->set_content_type('application/json');
        $this->category_model->changeCategoryStatus($category_id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

}
