<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Site_content_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }
    //////////////Terms And Condition Page Content Function
    public function getTermsPageContent()
    {  
       $result =  $this->db->get('terms_condition');
       return $result->row_array();
    }

    public function addTermsPageContent()
    {
        $data = array(
            'content'=>$this->input->post('description')
        );
       
        $this->db->insert('terms_condition',$data);
        return $this->db->insert_id();
    }
     public function editTermsPageContent($id)
    {
        $data = array(
            'content'=>$this->input->post('description')
        );
       
        $this->db->update('terms_condition',$data,['content_id'=>$id]);
        return $this->db->insert_id();
    }
    /////Privacy Policay Page Content Function
     public function getPrivactPageContent()
    {  
       $result =  $this->db->get('privacy_policy');
       return $result->row_array();
    }

    public function addPrivacyPageContent()
    {
        $data = array(
            'content'=>$this->input->post('description')
        );
       
        $this->db->insert('privacy_policy',$data);
        return $this->db->insert_id();
    }
     public function editPrivacyPageContent($id)
    {
        $data = array(
            'content'=>$this->input->post('description')
        );
       
        $this->db->update('privacy_policy',$data,['content_id'=>$id]);
        return $this->db->insert_id();
    }
    
    ///////////////Help Category Function
    
    public function getAllHelpCategory()
    {
        $result = $this->db->get('help_category');
        return $result->result_array();
    }
    
    public function getHelpCategoryById($id)
    {
        $result = $this->db->get_where('help_category',['help_category_id'=>$id]);
        return $result->row_array();
    }
    public function doAddHelpCategory()
    {
        $data = array(
            'category_name'=>$this->security->xss_clean($this->input->post('help_category_name'))
        );
        $this->db->insert('help_category',$data);
        return $this->db->insert_id();
    }
    public function doEditHelpCategory($id)
    {
        $data = array(
            'category_name'=>$this->security->xss_clean($this->input->post('help_category_name'))
        );
        $this->db->update('help_category',$data,['help_category_id'=>$id]);
        return $this->db->affected_rows();
    }
    public function doChangeHelpCategoryStatus($id,$status)
    {
        $this->db->update('help_category',['is_active'=>$status],['help_category_id'=>$id]);
        $this->db->affected_rows();
    }
    
    //////////////Help Category Content Management Function
    
    public function getHelpPageContent($id)
    {
        $result = $this->db->get_where('help',['help_Category_id'=>$id]);
        return $result->row_array();
    }
    
    public function addHelpPageContent($id)
    {
        $data = array(
            'help_Category_id'=>$id,
            'help_content'=>$this->security->xss_clean($this->input->post('description'))
        );
        $this->db->insert('help',$data);
        return $this->db->insert_id();
    }
    public function editHelpPageContent($id)
    {
        $data = array(
            'help_Category_id'=>$id,
            'help_content'=>$this->security->xss_clean($this->input->post('description'))
        );
        $this->db->update('help',$data,['help_id'=>$id]);
        return $this->db->affected_rows();
    }
}