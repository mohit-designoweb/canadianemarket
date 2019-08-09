<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Ecommerce_model extends CI_Model {

    public function __construct() {

        parent::__construct();
    }

    public function getTextByLang($lang) {
        $this->db->select('text,' . $lang);
        $this->db->from('text');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getLanguage() {
        $query = $this->db->get('lang');
        return $query->result_array();
    }

    public function login() {
        $data = array(
            'email' => $this->security->xss_clean($this->input->post('email')),
            'password' => $this->security->xss_clean(hash('sha256', $this->input->post('password')))
        );
        $result = $this->db->get_where('user', $data);
        return $result->row_array();
    }

    public function getCountryCode() {
        $query = $this->db->get('countries');
        return $query->result_array();
    }
    
    public function registerForm($unique_id) {
            $ref_code = $this->security->xss_clean($this->input->post('ref_code'));
            if(!empty($ref_code))
            {
                $query = $this->db->get_where('user',['unique_id'=>$ref_code]);
                if($query->num_rows() == 1)
                {
                    $data = array(
                    'user_name' => $this->security->xss_clean($this->input->post('user_name_reg')),
                    'email' => $this->security->xss_clean($this->input->post('email_reg')),
                    'password' => $this->security->xss_clean(hash('sha256', $this->input->post('password_reg'))),
                    'source' => 'self',
                    'unique_id' => $unique_id,
                    'refrance_code' => $this->security->xss_clean($this->input->post('ref_code')),
                    'credit_points' => 20
                    );
                    $result = $query->row_Array();
                    $new_credit_points = $result['credit_points']+20;
                    $this->db->update('user',['credit_points'=>$new_credit_points],['unique_id'=>$ref_code]);
                }
                else { 
                    return 0;
                }
            }
            else{
        $data = array(
            'user_name' => $this->security->xss_clean($this->input->post('user_name_reg')),
            'email' => $this->security->xss_clean($this->input->post('email_reg')),
            'password' => $this->security->xss_clean(hash('sha256', $this->input->post('password_reg'))),
            'source' => 'self',
            'unique_id' => $unique_id
        );
            }
        $email = $data['email'];
        $query = $this->db->get_where('user', ['email' => $email, 'source' => 'self']);
        if ($query->num_rows() == 1) {
            return 0;
        } else {
            $this->db->insert('user', $data);
	    $user_id = $this->db->insert_id();
            $this->db->insert('address', ['user_id' => $user_id]);
            $this->db->insert('user_payment_data', ['user_id' => $user_id]);
            $result = $this->db->order_by('user_id', "desc")
                    ->limit(1)
                    ->get('user')
                    ->row_array();
            return $result;
        }
    }

  /*  public function registerForm($unique_id) {
        $data = array(
            'user_name' => $this->security->xss_clean($this->input->post('user_name_reg')),
            'email' => $this->security->xss_clean($this->input->post('email_reg')),
            'password' => $this->security->xss_clean(hash('sha256', $this->input->post('password_reg'))),
            'source' => 'self',
            'unique_id' => $unique_id
        );
        $email = $data['email'];
        $query = $this->db->get_where('user', ['email' => $email, 'source' => 'self']);
        if ($query->num_rows() == 1) {
            return 0;
        } else {
            $this->db->insert('user', $data);
            $result = $this->db->order_by('user_id', "desc")
                    ->limit(1)
                    ->get('user')
                    ->row_array();
            // print_r($result); exit;
            return $result;
        }
    }*/

    public function myAccountForm($user_id, $image = NULL) {

        $data = array(
            'user_id' => $user_id,
            'first_name' => $this->security->xss_clean($this->input->post('first_name')),
            'last_name' => $this->security->xss_clean($this->input->post('last_name')),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'address1' => $this->security->xss_clean($this->input->post('address1')),
            'address2' => $this->security->xss_clean($this->input->post('address2')),
            'dob' => $this->security->xss_clean($this->input->post('dob')),
            'mobile' => $this->security->xss_clean($this->input->post('mobile')),
            'gender' => $this->security->xss_clean($this->input->post('gender')),
        );

        $this->db->insert('user', $data);
        echo $this->db->last_query();
        exit;
        return $this->db->insert_id();
    }

    public function myAccountFormUpdate($user_id, $image = NULL) {
        $data = array(
            'user_id' => $user_id,
            'user_name' => $this->security->xss_clean($this->input->post('first_name')),
            'last_name' => $this->security->xss_clean($this->input->post('last_name')),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'address1' => $this->security->xss_clean($this->input->post('address1')),
            'address2' => $this->security->xss_clean($this->input->post('address2')),
            'phone' => $this->security->xss_clean($this->input->post('mobile')),
            'dob' => $this->security->xss_clean($this->input->post('dob')),
            'gender' => $this->security->xss_clean($this->input->post('gender')),
        );
        $this->db->update('user', $data, ['user_id' => $user_id]);
        return $this->db->affected_rows();
    }

    public function changePassword($id) {
        $old_password = hash('sha256', $this->input->post('old_password'));
        $data = array(
            'password' => hash('sha256', $this->input->post('new_password'))
        );
        $this->db->update('user', $data, ['user_id' => $id, 'password' => $old_password]);
        return $this->db->affected_rows();
    }

    public function doSetForgotPassword() {

        $email = $this->input->post('email');
        $result = $this->db->get_where('user', ['email' => $email]);
        return $result->row_array();
    }

    public function myAccountFormData($user_id) {
        $result = $this->db->get_where('user', ['user_id' => $user_id]);
        return $result->row_array();
    }

    public function getDataByUniqueId($unique_id) {
        $result = $this->db->get_where('user', ['unique_id' => $unique_id]);
        return $result->row_array();
    }

    public function checkClient($email, $source) {
        $query = $this->db->get_where('user', ['email' => $email, 'source' => $source]);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
        return 0;
    }

    public function client_login($session_data, $unique_id) {
        $unique_id = $unique_id;
        $data = array(
            'user_name' => $session_data['name'],
            'email' => $session_data['email'],
            'source' => $session_data['source'],
            'unique_id' => $unique_id
        );
        $this->db->insert('user', $data);
        //$this->db->update('register', ['referral_code' => 'ABK_' . $this->db->insert_id()], ['id' => $this->db->insert_id()]);
        return $this->db->affected_rows();
    }

    public function doUploadProfileImage($user_id, $image_name) {
        $data = array(
            'image_url' => $image_name
        );
        $this->db->update('user', $data, ['user_id' => $user_id]);
	//	echo $this->db->last_query(); die;
        return $this->db->affected_rows();
    }

    public function doAddPartnerWithUs($otp) {
        $country = $this->security->xss_clean(explode(',', $this->input->post('country_code')));
        $country_code = $country[0];
        $country_name = $country[1];
        $data = array(
            'first_name' => $this->security->xss_clean($this->input->post('first_name')),
            'last_name' => $this->security->xss_clean($this->input->post('last_name')),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'store_name' => $this->security->xss_clean($this->input->post('store_name')),
            'address1' => $this->security->xss_clean($this->input->post('address1')),
            'address2' => $this->security->xss_clean($this->input->post('address2')),
            'city' => $this->security->xss_clean($this->input->post('city')),
            'state' => $this->security->xss_clean($this->input->post('state')),
            'zipcode' => $this->security->xss_clean($this->input->post('zipcode')),
            'country' => $country_name,
            'country_code' => $country_code,
            'phone_no' => $this->security->xss_clean($this->input->post('phone_no')),
            'otp' => $otp
        );
        $id = $this->db->insert('partner_query', $data);
//        $data = array(
//            'store_name'=>$this->security->xss_clean($this->input->post('store_name')),
//            'service_provider_id'=>$id
//        );
//        $this->db->insert('store',$data);
        return $id;
    }

    public function doUpdatePartner($id) {
        $otp = $this->input->post('otp');
        $query = $this->db->get_where('partner_query', ['partner_query_id' => $id]);
        // echo $this->db->last_query();die;
        $row = $query->row_array();
        $data = array(
            'is_verified' => '1'
        );
        if ($row['otp'] == $otp) {
            $this->db->update('partner_query', $data, ['partner_query_id' => $id, 'otp' => $otp]);

            return true;
        } else {
            return FALSE;
        }
    }

    public function doAddCourier($otp) {
        $country = $this->security->xss_clean(explode(',', $this->input->post('country_code')));
        $country_code = $country[0];
        $country_name = $country[1];
        $data = array(
            'first_name' => $this->security->xss_clean($this->input->post('first_name')),
            'last_name' => $this->security->xss_clean($this->input->post('last_name')),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'address1' => $this->security->xss_clean($this->input->post('store_address1')),
            'address2' => $this->security->xss_clean($this->input->post('store_address2')),
            'city' => $this->security->xss_clean($this->input->post('city')),
            'state' => $this->security->xss_clean($this->input->post('state')),
            'zipcode' => $this->security->xss_clean($this->input->post('zipcode')),
            'country' => $country_name,
            'phone_no' => $this->security->xss_clean($this->input->post('phone')),
            'country_code' => $country_code,
            'otp' => $otp
        );
        $this->db->insert('courier_query', $data);
        return $this->db->insert_id();
    }

    public function doUpdateCourier($id) {
        $otp = $this->input->post('courireOtp');
        $query = $this->db->get_where('courier_query', ['courier_query_id' => $id]);
        $row = $query->row_array();
        $data = array(
            'is_verified' => '1'
        );
        if ($row['otp'] == $otp) {
            $this->db->update('courier_query', $data, ['courier_query_id' => $id, 'otp' => $otp]);
            return true;
        } else {
            return FALSE;
        }
    }

    // Restaurant Functions

    public function getAllRestaurantCategory() {
//        $this->db->select('count(r.restaurant_id),rc.*');
//        $this->db->from('restaurant_category rc');
//        $this->db->join('restaurant r','r.restaurant_category_id=rc.restaurant_category_id');
//        $this->db->order_by('rc.restaurant_category_id');
        $query = $this->db->get_where('restaurant_category', ['is_active' => 'Active']);
        return $query->result_array();
    }

    public function getRestaurantCount() {
        $this->db->select('count(restaurant_id) as count');
        $query = $this->db->get_where('restaurant', ['is_active' => 'Active']);
        return $query->row_array();
    }

    public function getRestaurantCountByRestaurantCategoryId($restaurant_category) {
        $this->db->select('count(restaurant_id) as count');
        $query = $this->db->get_where('restaurant', ['is_active' => 'Active', 'restaurant_category_id' => $restaurant_category]);
        return $query->row_array();
    }

    public function getLimitedActiveRestaurant($limit, $start, $restaurant_category) {
        $this->db->select('rc.category_name,r.image_url,r.restaurant_name,r.address,r.latitude,r.longitude');
        $this->db->from('restaurant r');
        $this->db->join('restaurant_category rc', 'r.restaurant_category_id=rc.restaurant_category_id');
        $this->db->where('r.is_active', 'Active');
        $this->db->where('r.restaurant_category_id', $restaurant_category);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getRestaurantIdByRestaurantName($restaurant_name) {
        $query = $this->db->get_where('restaurant', ['restaurant_name' => $restaurant_name]);
        return $query->row_array();
    }

    public function getRestaurantMenuByRestaurantId($restaurant_id) {
        $query = $this->db->get_where('menu_category', ['restaurant_id' => $restaurant_id, 'is_active' => 'Active']);
        return $query->result_array();
    }

    public function getMenuByMenuCategoryId($menu_category_id) {
        $query = $this->db->get_where('menu', ['menu_category_id' => $menu_category_id, 'is_active' => 'Active']);
        return $query->result_array();
    }

    public function getItemCountByRestaurantId($restaurant_id) {
        $this->db->select('count(menu_id) as count');
        $query = $this->db->get_where('menu', ['restaurant_id' => $restaurant_id]);
        return $query->row_array();
    }

    public function updateVisitCount($restaurant_id) {
        $points = 1;
        $this->db->set('visit_count', 'visit_count + ' . (int) $points, FALSE);
        $this->db->where('restaurant_id', $restaurant_id);
        $this->db->update('restaurant');
        return $this->db->affected_rows();
    }

    public function getRestaurantBySearch($limit, $start, $search_val) {
        $this->db->select('rc.category_name,r.image_url,r.restaurant_name,r.address,r.latitude,r.longitude');
        $this->db->from('restaurant r');
        $this->db->join('restaurant_category rc', 'r.restaurant_category_id=rc.restaurant_category_id');
        $this->db->where('r.is_active', 'Active');
        $this->db->like('r.restaurant_name', $search_val);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getMostViewedActiveRestaurant($limit, $start, $restaurant_category) {
        $this->db->select('rc.category_name,r.image_url,r.restaurant_name,r.address,r.latitude,r.longitude');
        $this->db->from('restaurant r');
        $this->db->join('restaurant_category rc', 'r.restaurant_category_id=rc.restaurant_category_id');
        $this->db->where('r.is_active', 'Active');
        $this->db->where('r.restaurant_category_id', $restaurant_category);
        $this->db->order_by('r.visit_count', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getNewActiveRestaurant($limit, $start, $restaurant_category) {
        $this->db->select('rc.category_name,r.image_url,r.restaurant_name,r.address,r.latitude,r.longitude');
        $this->db->from('restaurant r');
        $this->db->join('restaurant_category rc', 'r.restaurant_category_id=rc.restaurant_category_id');
        $this->db->where('r.is_active', 'Active');
        $this->db->where('r.restaurant_category_id', $restaurant_category);
        $this->db->order_by('r.insert_date', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getRestaurantByRestaurantId($restaurant_id) {
        $query = $this->db->get_where('restaurant', ['restaurant_id' => $restaurant_id]);
        return $query->row_array();
    }

    public function getSpecialRestaurantMenu($restaurant_id) {
        $query = $this->db->get_where('menu', ['restaurant_id' => $restaurant_id, 'is_special' => 1, 'is_active' => 'Active']);
        return $query->result_array();
    }

    public function checkCoupon() {
        $data = array(
            'coupon_code' => $this->input->post('coupon'),
            'is_active' => 'Active'
        );
        $query = $this->db->get_where('coupon',$data);
        return $query->row_array();
    }
	 /////////////Get Page content function
    
    public function getTermsPageContent()
    {
       $result=$this->db->get('terms_condition');
       return $result->row_array();
    }
    public function getPrivacyPageContent()
    {
       $result=$this->db->get('privacy_policy');
       return $result->row_array();
    }
    public function getHelpPageContent()
    {
       $result=$this->db->get('terms_condition');
       return $result->row_array();
    }
    
    public function getActiveJobCategory()
    {
        $result = $this->db->get_where('job_category',['is_active'=>'Active']);
        return $result->result_array();
    }
    public function getJobType()
    {
        $result = $this->db->get('job_type');
        return $result->result_array();
    }
   public function getHelpCategory()
   {
       $result = $this->db->get_where('help_category',['is_active'=>'Active']);
       return $result->result_array();
   }
   public function help_category_wrapper($id)
   {
       $result = $this->db->get_where('help',['help_category_id'=>$id]);
       return $result->row_array();
   }
   public function getAllActiveJob()
   {
       $result = $this->db->get_where('job_detail',['is_active'=>'Active']);
       return $result->result_array();
   }
   public function getJobDetailByJobName($alias)
   {
       $result = $this->db->get_where('job_detail',['alias'=>$alias]);
       return $result->row_array();
   }
   public function jobEnquiry($job_id,$resume_name)
   {
       $data = array(
           'job_id'=>$job_id,
           'resume_url'=>$resume_name,
           'first_name'=>$this->security->xss_clean($this->input->post('job_first_name')),
           'last_name'=>$this->security->xss_clean($this->input->post('job_last_name')),
           'email'=>$this->security->xss_clean($this->input->post('job_email')),
           'cover_letter'=>$this->security->xss_clean($this->input->post('job_cover_letter')),
       );
       $this->db->insert('job_enquiry',$data);
       return $this->db->last_query();
   }
   ///////career job filter functions
   public function getJobLocation()
   {
       $this->db->get_where('');
   }
   public function getFilteredJobtype($id)
   {
       $result = $this->db->get_where('job_type',['job_category_id'=>$id]);
       return $result->result_array();
   }
   public function getFilteredJobCity($id)
   {
       $result = $this->db->get_where('job_detail',['job_type_id'=>$id]);
       return $result->result_array();
   }
   public function getCategoryIdByName($cat_name)
   {
       $result = $this->db->get_where('job_category',['job_category_name'=>$cat_name]);
       return $result->row_array();
   }
   public function getTypeIdByName($type_name)
   {
       $result = $this->db->get_where('job_type',['job_type_name'=>$type_name]);
       return $result->row_array();
   }
   public function getFilteredJobs($cat_id,$type_id,$location_name)
   {
       $result = $this->db->get_where('job_detail',['job_category_id'=>$cat_id,'job_type_id'=>$type_id,'job_location'=>$location_name]);
      
       return $result->result_array();
   }
    
	public function varify_emailid(){
       $query = $this->db->get_where('user',['email'=>$this->input->post('regiter_email'), 'source'=>'self']);
       return $query->row_array();
    }
   
    public function do_reset_password(){
       $user_id = $this->input->post('user_id');
       $password = $this->input->post('password');
       $this->db->update('user', ['password'=>$password],['user_id'=>$user_id]);
       return $this->db->affected_row();
    }
}
