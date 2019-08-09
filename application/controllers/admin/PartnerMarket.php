<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class PartnerMarket extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model','partner_model']);
    }
    public function getUserData() {
        $email = $this->session->userdata('email_partner');
        return $this->admin_model->getUserdata('partner', $email);
    }
    private function getFilteredCategories()
    {
        $list = [''=>'----Seletc The Category----'];
        $categories = $this->partner_model->getAllActiveProductCategory();
        foreach($categories as $category)
        {
            $list[$category['market_place_category_id']] = $category['category_name'];
        }
        return $list;
    }

    public function index()
    {
        $data['title'] = 'Market Place Product';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/partner-sidebar', $data);
        $this->load->view('admin/partner-market/view-product');
        $this->load->view('admin/commons/footer');
    }
    public function get_partner_market_place_product_wrapper() {
        $this->output->set_content_type('application/json');
        $email = $this->session->userdata('email_partner');
        $result = $this->partner_model->getPartnerId($email);
        $partner_id = $result['partner_id'];
        $data['products'] = $this->partner_model->getProductByPartnerId($partner_id);
        $content_wrapper = $this->load->view('admin/partner-market/product-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    public function changePartnerProductStatus($id,$status)
    {
        $this->output->set_content_type('application/json');
        $this->partner_model->changePartnerProductStatus($id,$status);
        $this->output->set_output(json_encode(['result'=>1]));
        return FALSE;
    }
    public function getPartnerById()
    {
        $email = $this->session->userdata('email_partner');
    }
    public function addPartnerProduct($id=null) {
        if(!empty($id))
        {
        $data['product'] = $this->partner_model->getPartnerProductById($id);
        }
        $data['user'] = $this->getUserData();
        $data['title'] = 'Market Place Product';
//        $data['partners'] = $this->filteredPartner();
        $data['category'] = $this->getFilteredCategories();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/partner-sidebar', $data);
        $this->load->view('admin/partner-market/add-product');
        $this->load->view('admin/commons/footer');
    }
    
    public function doAddPartnerProduct()
    {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('market_place_category_id','Category','required');
        $this->form_validation->set_rules('product_name', 'Product Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $email = $this->session->userdata('email_partner');
        $result = $this->partner_model->getPartnerId($email);
        $partner_id = $result['partner_id'];
        $image_url = $this->doUploadImg();
        if (!$image_url) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
            $this->session->unset_userdata('error');
            return FALSE;
        }
        $result = $this->partner_model->doAddPartnerProduct($image_url,$partner_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail Added sucessfully', 'url' => base_url('partner/partnerMarket')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Product Not Added.']));
            return FALSE;
        }
    }
    public function doEditPartnerProduct($id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('market_place_category_id','Category','required');
        $this->form_validation->set_rules('product_name', 'Product Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
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
            $product = $this->partner_model->getPartnerProductById($id);
            $image_url = $product['image_url'];
        }
        $result = $this->partner_model->doEditPartnerProduct($id, $image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail updated sucessfully', 'url' => base_url('partner/partnerMarket')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Changes Were Made.']));
            return FALSE;
        }
    }
    
    public function doDeletePartnerProduct($id)
    {
       
        $this->output->set_content_type('application/json');
        $result = $this->partner_model->doDeletePartnerProduct($id);
        
        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail updated sucessfully', 'url' => base_url('partner/partnerMarket')]));
        return FALSE;
    }
    public function doUploadImg() {
        $config = array(
            'upload_path' => "./uploads/market-product",
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

}
