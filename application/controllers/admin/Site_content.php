<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Site_content extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model','site_content_model']);
    }
    
     public function getUserData() {
        $email = $this->session->userdata('email_admin');
        return $this->admin_model->getUserdata('admin', $email);
    }
    //////////////Terms And Condition Page Content Function
    public function terms_condition()
    {
        $data['title'] = 'Terms And Condition';
        $this->session->set_userdata('function_name','terms_condition');
        $data['user'] = $this->getUserData();
        $data['is_admin'] = $this->session->userdata('is_admin');
        $data['content'] = $this->site_content_model->getTermsPageContent();
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/admin-sidebar',$data);
        $this->load->view('admin/site-content/viewContent',$data);
        $this->load->view('admin/commons/footer');
    }
    

    public function addTermsPageContent()
    {
        $this->output->set_content_type('application/json');
        $this->site_content_model->addTermsPageContent();
        $this->output->set_output(json_encode(['result'=>1,'url'=>  base_url('admin/terms-condition')]));
        return FALSE;
    }
    
    public function editTermsPageContent($id)
    {
        $this->output->set_content_type('application/json');
        $this->site_content_model->editTermsPageContent($id);
        $this->output->set_output(json_encode(['result'=>1,'url'=>  base_url('admin/terms-condition')]));
        return FALSE;
    }
    //////////////Privacy Policay Page Content Function
     public function privacy_policy()
    {
        $data['title'] = 'Privact and Policy';
        $data['user'] = $this->getUserData();
        $data['is_admin'] = $this->session->userdata('is_admin');
        $data['content'] = $this->site_content_model->getPrivactPageContent();
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/admin-sidebar',$data);
        $this->load->view('admin/site-content/viewPrivacyContent',$data);
        $this->load->view('admin/commons/footer');
    }
    

    public function addPrivacyPageContent()
    {
        $this->output->set_content_type('application/json');
        $this->site_content_model->addPrivacyPageContent();
        $this->output->set_output(json_encode(['result'=>1,'url'=>  base_url('admin/privacy_policy')]));
        return FALSE;
    }
    
    public function editPrivacyPageContent($id)
    {
        $this->output->set_content_type('application/json');
        $this->site_content_model->editPrivacyPageContent($id);
        $this->output->set_output(json_encode(['result'=>1,'url'=>  base_url('admin/privacy_policy')]));
        return FALSE;
    }
    
    ////////////////Help Category Function
    
    public function help()
    {
        $data['title'] = 'Help Category';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $data['is_admin'] = $this->session->userdata('is_admin');
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/admin-sidebar',$data);
        $this->load->view('admin/help-category/category');
        $this->load->view('admin/commons/footer');
    }
    
    public  function addHelpCategory($id=null)
    {
        if(!empty($id))
        {
            $data['category1'] = $this->site_content_model->getHelpCategoryById($id);
        }
        $data['user'] = $this->getUserData();
        $data['title'] = 'Help Category';
        $data['table'] = '1';
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/help-category/category');
        $this->load->view('admin/commons/footer');
    }


    public function get_help_category_wrapper()
    {
        $this->output->set_content_type('application/json');
        $data['categories'] = $this->site_content_model->getAllHelpCategory();
        $content_wrapper = $this->load->view('admin/help-category/category-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    public function doAddHelpCategory()
    {
         $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('help_category_name', 'Category', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->site_content_model->doAddHelpCategory();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Category Added Sucessfully', 'url' => base_url('admin/help')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Category Not Added']));
            return FALSE;
        }
    }
     public function doEditHelpCategory($id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('help_category_name', 'Category', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->site_content_model->doEditHelpCategory($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Category Updated Sucessfully', 'url' => base_url('admin/help')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Do Some Updation', 'url' => base_url('admin/help')]));
            return FALSE;
        }
    }
    
    public function doChangeHelpCategoryStatus($id,$status)
    {
        $this->output->set_content_type('application/json');
        $this->site_content_model->doChangeHelpCategoryStatus($id,$status);
        $this->output->set_output(json_encode(['result'=>1,'url'=>base_url('admin/help')]));
        return FALSE;
    }
 //////////////Help Category Content Management Function
    
     public function helpContent($id)
    {
        $data['title'] = 'Help Page Content';
        $data['user'] = $this->getUserData();
        $data['is_admin'] = $this->session->userdata('is_admin');
        $data['category_id'] = $id;
        $data['content'] = $this->site_content_model->getHelpPageContent($id);
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/admin-sidebar',$data);
        $this->load->view('admin/site-content/viewHelpContent',$data);
        $this->load->view('admin/commons/footer');
    }
    

    public function addHelpPageContent($id)
    {
//          echo "hello"; die;
        $this->output->set_content_type('application/json');
        $this->site_content_model->addHelpPageContent($id);
//        echo "hello";die;
        $this->output->set_output(json_encode(['result'=>1,'url'=>  base_url('admin/helpContent/'.$id)]));
        return FALSE;
    }
    
    public function editHelpPageContent($id)
    {
       
        $this->output->set_content_type('application/json');
        $result = $this->site_content_model->editHelpPageContent($id);
        if($result)
        {
        $this->output->set_output(json_encode(['result'=>1,'url'=>  base_url('admin/helpContent/'.$id)]));
        return FALSE;
        }
        else
        {
            $this->output->set_output(json_encode(['result'=>1,'msg'=>'No Changes Done','url'=>  base_url('admin/helpContent/'.$id)]));
        }
    }
}
