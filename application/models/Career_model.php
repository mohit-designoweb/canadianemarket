<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Career_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function getActiveJobCategory()
    {
        $result = $this->db->get_where('job_category',['is_active'=>'Active']);
        return $result->result_Array();
    }
    public function getActiveJobType()
    {
        $result = $this->db->get_where('job_type',['is_active'=>'Active']);
        return $result->result_Array();
    }


    public function getAllJobCategory()
    {
        $result = $this->db->get('job_category');
        return $result->result_array();
    }
    
    public function getJobCategoryById($id)
    {
        $query = $this->db->get_where('job_category',['job_category_id'=>$id]);
        return $query->row_array();
    }


    public function doAddJobCategory()
    {
        $data = array(
            'job_category_name'=>$this->security->xss_clean($this->input->post('category_name'))
        );
        $this->db->insert('job_category',$data);
        return $this->db->insert_id();
    }
    
    public function doEditJobCategory($id)
    {
       $data = array(
            'job_category_name'=>$this->security->xss_clean($this->input->post('category_name'))
        );
       $this->db->update('job_category',$data,['job_category_id'=>$id]);
       return $this->db->affected_rows();
    }
     public function changeJobCategoryStatus($category_id, $status) {
        $this->db->update('job_category', ['is_active' => $status], ['job_category_id' => $category_id]);
        return $this->db->affected_rows();
    }
    
    public function getAllJobType()
    {
        $result=$this->db->get('job_type');
        return $result->result_array();
    }
    
    public function doAddJobType()
    {
         $data = array(
            'job_category_id'=>$this->security->xss_clean($this->input->post('job_category_id')),
            'job_type_name'=>$this->security->xss_clean($this->input->post('job_type'))
        );
         
        $this->db->insert('job_type',$data);
        return $this->db->insert_id();
    }
    
    public function getJobTypeById($id)
    {
        $result = $this->db->get_where('job_type',['job_type_id'=>$id]);
        return $result->row_array();
    }
    
    public function doEditJobType($id)
    {
        $data = array(
            'job_category_id'=>$this->security->xss_clean($this->input->post('job_category_id')),
            'job_type_name'=>$this->security->xss_clean($this->input->post('job_type'))
        );
        $this->db->update('job_type',$data,['job_type_id'=>$id]);
        return $this->db->affected_rows();
    }
    public function doDeletJobType($id)
    {
        $this->db->delete('job_type',['job_type_id'=>$id]);
        return $this->db->affected_rows();
    }
    public function changeJobTypeStatus($id, $status) {
        $this->db->update('job_type', ['is_active' => $status], ['job_type_id' => $id]);
        return $this->db->affected_rows();
    }
    public function getAllJobdetail()
    {
        $result = $this->db->get('job_detail');
        return $result->result_array();
    }
    public function doAddJobDetail($image_url)
    {
        $data = array(
            'image_url'=>$image_url,
            'job_category_id'=>$this->security->xss_clean($this->input->post('job_category_id')),
            'job_type_id'=>$this->security->xss_clean($this->input->post('job_type_id')),
            'designation_name'=>$this->security->xss_clean($this->input->post('designation_name')),
            'designation_type'=>$this->security->xss_clean($this->input->post('designation_type')),
            'job_post_date'=>$this->security->xss_clean($this->input->post('job_post_date')),
            'description'=>$this->security->xss_clean($this->input->post('description')),
			'job_location'=>$this->security->xss_clean($this->input->post('job_location')),
            'alias'=>str_replace("--","", preg_replace('/[^A-Za-z\-]/',"-", $this->input->post('designation_name'))),
        );
        $this->db->insert('job_detail',$data);
        return $this->db->insert_id();
    }
    public function getJobDetailById($id)
    {
        $result = $this->db->get_where('job_detail',['job_id'=>$id]);
        return $result->row_array();
    }
    public function doEditJobDetail($image_url,$id)
    {
         $data = array(
            'image_url'=>$image_url,
            'job_category_id'=>$this->security->xss_clean($this->input->post('job_category_id')),
            'job_type_id'=>$this->security->xss_clean($this->input->post('job_type_id')),
            'designation_name'=>$this->security->xss_clean($this->input->post('designation_name')),
            'designation_type'=>$this->security->xss_clean($this->input->post('designation_type')),
            'job_post_date'=>$this->security->xss_clean($this->input->post('job_post_date')),
            'description'=>$this->security->xss_clean($this->input->post('description')),
			'job_location'=>$this->security->xss_clean($this->input->post('job_location')),
            'alias'=>str_replace("--","", preg_replace('/[^A-Za-z\-]/',"-", $this->input->post('designation_name'))),
        );
         $this->db->update('job_detail',$data,['job_id'=>$id]);
         return $this->db->affected_rows();
    }
    public function doDeleteJobDetail($id)
    {
        $this->db->delete('job_detail',['job_id'=>$id]);
//        echo $this->db->last_query(); die;
        return $this->db->affected_rows();
    }
    public function changeJobDetailStatus($id, $status) {
        $this->db->update('job_detail', ['is_active' => $status], ['job_id' => $id]);
        return $this->db->affected_rows();
    }
    
    public function filteredJobType($job_cat_id)
    {
        $result = $this->db->get_where('job_type',['job_category_id'=>$job_cat_id]);
        return $result->result_array();
    }
	public function getJobTypeByCatId($job_cat_id)
    {
        $result = $this->db->get_where('job_type',['job_category_id'=>$job_cat_id]);
        
        return $result->result_array();
    }
	public function getAppliedJobDetail()
	{
		$result =$this->db->get('job_enquiry');
		return $result->result_Array();
	}
    
}