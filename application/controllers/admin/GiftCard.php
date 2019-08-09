<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Giftcard extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model','gift_card_model']);
    }
     public function getUserData() {
        $email = $this->session->userdata('email_admin');
        return $this->admin_model->getUserdata('admin', $email);
    }
    public function index($id=NULL)
    {
        if(!empty($id))
        {
            $data['amount'] = $this->gift_card_model->getAmountById($id);
        }
        $data['title'] = 'Gift Card Amount';
        $data['table'] = '1';
        $data['user'] = $this->getuserData();
        $data['is_admin'] = $this->session->userdata('is_admin');
        $data['amounts'] = $this->gift_card_model->getAllCardAmount();
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/admin-sidebar',$data);
        $this->load->view('admin/gift-card-amount/category');
        $this->load->view('admin/commons/footer');
    }
    
     public function get_gift_card_amount_wrapper()
    {
        $this->output->set_content_type('application/json');
        $data['amounts'] = $this->gift_card_model->getAllCardAmount();
        $content_wrapper = $this->load->view('admin/gift-card-amount/category-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    public function doAddGiftCardAmount()
    {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('card_amount','Amount','required|numeric');
        if($this->form_validation->run()==FALSE)
        {
            $this->output->set_output(json_encode(['result'=>0,'msg'=>'Please Fill Field','errors'=>$this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->gift_card_model->doAddGiftCardAmount();
        if($result)
        {
            $this->output->set_output(json_encode(['result'=>1,'url'=>  base_url('admin/giftcard'),'msg'=>'Amount Added']));
            return FALSE;
        }
        else
        {
            $this->output->set_output(json_encode(['result'=>-1,'url'=>  base_url('admin/giftcard'),'msg'=>'Amount Not Added']));
            return FALSE;
        }
                
    }
    public function doEditGiftCardAmount($id)
    {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('card_amount','Amount','required|numeric');
        if($this->form_validation->run()==FALSE)
        {
            $this->output->set_output(json_encode(['result'=>0,'msg'=>'Please Fill Field','errors'=>$this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->gift_card_model->doEditGiftCardAmount($id);
        if($result)
        {
            $this->output->set_output(json_encode(['result'=>1,'url'=>  base_url('admin/giftcard'),'msg'=>'Amount Updated']));
            return FALSE;
        }
        else
        {
            $this->output->set_output(json_encode(['result'=>-1,'url'=>  base_url('admin/giftcard'),'msg'=>'Amount Not Added']));
            return FALSE;
        }
                
    }
    public function doDeleteAmountById($id)
    {
        $this->output->set_content_type('application/json');
        $this->gift_card_model->doDeleteAmountById($id);
        $this->output->set_output(json_encode(['result'=>1,'url'=>  base_url('admin/giftCard')]));
        return FALSE;
    }
    public function doChangeAmountStatus($id,$status)
    {
        $this->output->set_content_type('application/json');
        $this->gift_card_model->doChangeAmountStatus($id,$status);
        $this->output->set_output(json_encode(['result'=>1,'url'=>  base_url('admin/giftCard')]));
        return FALSE;
    }
    
    public function purchased_gift_card()
    {
        $data['title'] = 'Purchase Gift Card';
        $data['table'] = '1';
        $data['user'] = $this->getuserData();
        $data['is_admin'] = $this->session->userdata('is_admin');
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/admin-sidebar',$data);
        $this->load->view('admin/gift-card/view-gift-card');
        $this->load->view('admin/commons/footer');
    }
    
    public function get_gift_card_wrapper()
    {
        $this->output->set_content_type('application/json');
        $data['gifts'] = $this->gift_card_model->getAllGiftCard();
        $content_wrapper = $this->load->view('admin/gift-card/gift-card-wrapper',$data,true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    public function doDeleteGiftCard($id)
    {
//        echo $id;
//        echo "hello"; die;
        $this->output->set_content_type('application/json');
        $result = $this->gift_card_model->doDeleteGiftCard($id);
       
        $this->output->set_output(json_encode(['result'=>1,'url'=>  base_url('admin/purchased-gift-card')]));
        return FALSE;
    }
}

