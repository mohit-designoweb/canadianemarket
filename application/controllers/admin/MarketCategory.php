<?php

/**
 * Description of marketCategory
 *
 * @author Manish Khandelwal
 */

class MarketCategory extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model', 'market_place_model']);
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
            $data['cat'] = $this->market_place_model->getMarketPlaceCategoryById($id);
        }
        $data['table'] = '1';
        $data['title'] = 'Market Category';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/market-category/view-market-category',$data);
        $this->load->view('admin/commons/footer');
    }
    
    public function get_market_place_category_wrapper(){
        $this->output->set_content_type('application/json');
        $data['catgories'] = $this->market_place_model->getAllMarketPlaceCategory();
        $content_wrapper = $this->load->view('admin/market-category/category-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    public function doAddMarketPlaceCategory(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('category_name', 'Category Name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->market_place_model->doAddMarketPlaceCategory();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Category Added Sucessfully', 'url' => base_url('admin/market-category')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Category Not Added']));
            return FALSE;
        }
    }
    
    public function doEditMarketPlaceCategory($id) {
        
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('category_name', 'Category Name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->market_place_model->doEditMarketPlaceCategory($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1,'msg'=>'Details updated sucessfully', 'url' => base_url('admin/market-category')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Changes Were Made.', 'url' => base_url('admin/market-category')]));
            return FALSE;
        }
    }
    
    public function changeMarketPlacetCategoryStatus($category_id,$status) {
        $this->output->set_content_type('application/json'); 
        $this->market_place_model->changeCategoryStatus($category_id,$status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

}
