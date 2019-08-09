<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Coupon extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model']);
    }
    
    public function getUserData() {
        $email = $this->session->userdata('email_admin');
        return $this->admin_model->getUserdata('admin', $email);
    }
    
    public function index()
    {
        $data['user'] = $this->getUserData();
        $data['table'] = '1';
        $data['title'] = 'Coupon Management';
        $data['is_admin'] = $this->session->userdata('is_admin');
        $data['admin']='1';
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/admin-sidebar',$data);
        $this->load->view('admin/coupon-management/viewCoupon');
        $this->load->view('admin/commons/footer');
    }
    
    public function get_coupon_wrapper()
    {
        $this->output->set_content_type('application/json');
        $data['coupons'] = $this->admin_model->getAllCoupon();
        $content_wrapper = $this->load->view('admin/coupon-management/coupon-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    public function addCoupon($id=null)
    {
        if(!empty($id))
        {
            $data['coupon'] = $this->admin_model->getCouponById($id);
        }
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $data['title'] = 'Coupon Management';
        $data['is_admin'] = $this->session->userdata('is_admin');
        $data['admin']='1';
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/admin-sidebar',$data);
        $this->load->view('admin/coupon-management/addCoupon');
        $this->load->view('admin/commons/footer');
    }
    
    public function coupon_type()
    {
        if ($this->input->post('coupon_type') === 'selectCouponType')  {
            $this->form_validation->set_message('coupon_type', 'Please Select Coupon Type.');
            return FALSE;
        }
        else {
            return TRUE;
        }
    }


    public function doAddCoupon()
    {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('coupon_name','Coupon Name','required');
        $this->form_validation->set_rules('coupon_type','Coupon Type','required|callback_coupon_type');
        $this->form_validation->set_rules('coupon_amount','Coupon Type','required');
        if($this->form_validation->run()==FALSE)
        {
             $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doAddCoupon();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('admin/coupon'), 'msg' => 'Coupon Added sucessfully.']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Password is not correct']));
            return FALSE;
        }
    }
    public function doEditCoupon($id)
    {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('coupon_name','Coupon Name','required');
        $this->form_validation->set_rules('coupon_type','Coupon Type','required|callback_coupon_type');
        $this->form_validation->set_rules('coupon_amount','Coupon Amount','required');
        if($this->form_validation->run()==FALSE)
        {
             $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doEditCoupon($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('admin/coupon'), 'msg' => 'Coupon Added sucessfully.']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Please Do Some Changes']));
            return FALSE;
        }
    }
    
    public function doDeleteCouponById($id)
    {
         $this->output->set_content_type('application/json');
         $result = $this->admin_model->doDeleteCouponById($id);
         $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('admin/coupon'), 'msg' => 'Coupon Added sucessfully.']));
         return FALSE;
    }
    
    public function doChangeCouponStatus($id,$status)
    {
        $this->output->set_content_type('application/json');
        $result = $this->admin_model->doChangeCouponStatus($id,$status);
        if($result)
        {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('admin/coupon'), 'msg' => 'status updated sucessfully.']));
            return FALSE;
        }
    }
}