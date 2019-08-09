<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class PartnerStore extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model','partner_model','category_model']);
    }
     public function getUserData() {
        $email = $this->session->userdata('email_partner');
        return $this->admin_model->getUserdata('partner', $email);
    }
    
    public function index()
    {
        $data['title'] = 'Store';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/partner-sidebar', $data);
        $this->load->view('admin/partner-store/viewStore');
        $this->load->view('admin/commons/footer');
    }
	 private function getFilteredStores() {
        $email = $this->session->userdata('email_partner');
        $result = $this->partner_model->getPartnerId($email);
        $partner_id = $result['partner_id'];
	//	echo $partner_id; die;
        $list = ['' => '--Select The Store--'];
        $stores = $this->category_model->getAllActiveStoresByPartnerId($partner_id);
        foreach ($stores as $store) {
            $list[$store['store_id']] = $store['store_name'];
        }
        return $list;
    }
    
    public function view_Partner_Store($id)
    {
        $data['title'] = 'Store';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $data['store'] = $this->partner_model->getStoreById($id);
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/partner-sidebar', $data);
        $this->load->view('admin/partner-store/addStore');
        $this->load->view('admin/commons/footer');
    }
    
    public function get_partner_store_wrapper() {
        $this->output->set_content_type('application/json');
        $email = $this->session->userdata('email_partner');
        $result = $this->partner_model->getPartnerId($email);
        $partner_id = $result['partner_id'];
        $data['stores'] = $this->partner_model->getStoreByPartnerId($partner_id);
        $content_wrapper = $this->load->view('admin/partner-store/store-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    public function changeStoreStatus($id,$status)
    {
        $this->output->set_content_type('application/json');
        $this->partner_model->changeStoreStatus($id,$status);
        $this->output->set_output(json_encode(['result'=>1]));
        return FALSE;
    }
    
    public function doEditPartnerStore($id)
    {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        if ($this->form_validation->run() === FALSE) {
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
            $store = $this->partner_model->getStoreById($id);
            $image_url = $store['image_url'];
        }
        $result = $this->partner_model->doEditPartnerStore($id, $image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail updated sucessfully', 'url' => base_url('partner/partnerStore')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Changes Were Made.']));
            return FALSE;
        }
    }
    
    public function doUploadImg() {
        $config = array(
            'upload_path' => "./uploads/store",
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
	///Partner Shop Section
    
     public function partner_shop_section($id = null) {
          if (!empty($id)) {
            $data['shop_section'] = $this->category_model->getShopSectionById($id);
        }
        $data['title'] = 'Shop Section';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $data['stores'] = $this->getFilteredStores();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/partner-sidebar', $data);
        $this->load->view('admin/partner-shop-section/shop-section');
        $this->load->view('admin/commons/footer');
    }
     public function get_partner_shop_section_wrapper() {
        $this->output->set_content_type('application/json');
        $data['user'] = $this->getUserData();
        $email = $this->session->userdata('email_partner');
        $result = $this->partner_model->getPartnerId($email);
        $partner_id = $result['partner_id'];
        $data['shop_sections'] = $this->category_model->getShopSection();
        $content_wrapper = $this->load->view('admin/partner-shop-section/shop-section-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    public function doEditPartnerShopSection($id)
    {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('store_id', 'Store Name', 'required');
        $this->form_validation->set_rules('shop_section_name', 'Shop Section Name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->category_model->doEditShopSection($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Details updated sucessfully', 'url' => base_url('partner/partner-shop-section')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Changes Were Made']));
            return FALSE;
        }
    }
    public function doAddPartnerShopSection()
    {
         $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('store_id', 'Store Name', 'required');
        $this->form_validation->set_rules('shop_section_name', 'Shop Section Name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->category_model->doAddShopSection();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'details added sucessfully', 'url' => base_url('partner/partner-shop-section')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Category did not added sucessfully.']));
            return FALSE;
        }
    }

        public function changePartnerShopSectionStatus($shop_section_id, $status)
    {
         $this->output->set_content_type('application/json');
        $this->category_model->doChangeCategoryStatus($shop_section_id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }
}
