<?php

/**
 * Description of Admin_model
 *
 * @author Ram JI Yadav
 */
class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function checkLogin($user_type) {
        $data = array(
            'email' => $this->security->xss_clean($this->input->post('email')),
            'password' => $this->security->xss_clean(hash('sha256', $this->input->post('password')))
        );
        $query = $this->db->get_where($user_type, $data);
        return $query->row_array();
    }

    public function getUserdata($user_type, $email) {
        $query = $this->db->get_where($user_type, ['email' => $email]);
        return $query->row_array();
    }
        public function getUserdataById($user_id) {
        $query = $this->db->get_where('user', ['user_id' => $user_id]);
        return $query->row_array();
    }
     public function doUpdateUserPassword($userId){
        $data = array(
        'password' => $this->security->xss_clean(hash('sha256',$this->input->post('password')))
        );
        $this->db->update('user', $data, ['user_id' => $userId]);
        return $this->db->affected_rows();
    }

    public function checkServiceProvider($email) {
        $query = $this->db->get_where('service_provider', ['email' => $email]);
        $row = $query->row_array();
        if ($row['is_active'] == 'Inactive') {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function getCountryCode() {
        $query = $this->db->get('countries');
        return $query->result_array();
    }

    public function doChangePassword($table, $email) {
        $data = array(
            'password' => hash('sha256', $this->security->xss_clean($this->input->post('new_password')))
        );
        $this->db->update($table, $data, ['email' => $email]);
        return $this->db->affected_rows();
    }

    public function checkEmail() {
        $data = array(
            'email' => $this->security->xss_clean($this->input->post('email'))
        );
        $query = $this->db->get_where('user', $data);
        return $query->row_array();
    }

    public function getSpecification() {
        $query = $this->db->get('specification_group');
        return $query->result_array();
    }

    public function getSpecifications() {
        $query = $this->db->get_where('specification_group', ['is_active' => 'Active']);
        return $query->result_array();
    }

    public function getSpecificationById($id) {
        $query = $this->db->get_where('specification_group', ['group_id' => $id]);
        return $query->row_array();
    }

    public function doAddSpecification() {
        $data = array(
            'group_name' => $this->security->xss_clean($this->input->post('group_name'))
        );
        $this->db->insert('specification_group', $data);
        return $this->db->insert_id();
    }

    public function doEditSpecification($id) {
        $data = array(
            'group_name' => $this->security->xss_clean($this->input->post('group_name'))
        );
        $this->db->update('specification_group', $data, ['group_id' => $id]);
        return $this->db->affected_rows();
    }

    public function doChangeSpecificationStatus($id) {
        $query = $this->db->get_where('specification_group', ['group_id' => $id]);
        $row = $query->row_array();
        if ($row['is_active'] == "Inactive") {
            $up = $this->db->update('specification_group', ['is_active' => 'Active'], ['group_id' => $id]);
        } else {
            $up = $this->db->update('specification_group', ['is_active' => 'Inactive'], ['group_id' => $id]);
        }
        return true;
    }

    public function getStoreCategoryName() {
        if ($this->session->userdata('user_type') == 'Service_provider') {
            $id = $this->serviceProviderId();
            $query = $this->db->get_where('shop_section', ['is_active' => 'Active']);
        } else {
            $query = $this->db->get_where('shop_section', ['is_active' => 'Active']);
        }
        return $query->result_array();
    }

    public function getShopSectionByStoreId($store_id) {
        $query = $this->db->get_where('shop_section', ['store_id' => $store_id, 'is_active' => 'Active']);
        return $query->result_array();
    }

    public function doChangeProduct($store_id) {
        $this->db->select('s.store_name,sc.*,p.*');
        $this->db->from('store s');
        $this->db->join('shop_section sc', 'sc.store_id = s.store_id');
        $this->db->join('product p', 'p.shop_section_id = sc.shop_section_id');
        if (!empty($store_id)) {
            $this->db->where('p.store_id', $store_id);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function doChangeProductByCategory($category_id, $store_id) {
        $this->db->select('s.store_name,sc.*,p.*');
        $this->db->from('store s');
        $this->db->join('shop_section sc', 'sc.store_id = s.store_id');
        $this->db->join('product p', 'p.shop_section_id = sc.shop_section_id');
        $this->db->where('p.store_id', $store_id);
        if (!empty($category_id)) {
            $this->db->where('p.category_id', $category_id);
        }
        $query = $this->db->get('');
        return $query->result_array();
    }

    public function getProduct() {
        if ($this->session->userdata('user_type') == 'Service_provider') {
            $id = $this->serviceProviderId();
            $this->db->select('s.store_name,sc.*,p.*');
            $this->db->from('store s');
            $this->db->join('shop_section sc', 'sc.store_id = s.store_id');
            $this->db->join('product p', 'p.shop_section_id = sc.shop_section_id');
            $this->db->where('s.service_provider_id', $id['id']);
            $query = $this->db->get('');
        } else {
            $this->db->select('s.store_name,sc.*,p.*');
            $this->db->from('store s');
            $this->db->join('shop_section sc', 'sc.store_id = s.store_id');
            $this->db->join('product p', 'p.shop_section_id = sc.shop_section_id');
            $query = $this->db->get('');
        }
//        echo $this->db->last_query(); die;
        return $query->result_array();
    }

    public function getProductById($id) {
        $this->db->select('s.store_name,sc.*,p.*');
        $this->db->from('store s');
        $this->db->join('shop_section sc', 'sc.store_id = s.store_id');
        $this->db->join('product p', 'p.category_id = sc.shop_section_id');
        $this->db->where('p.product_id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function doRemoveSpecification($id) {
        $this->db->delete('product_group_mapping', ['mapping_id' => $id]);
        return $this->db->affected_rows();
    }

    public function getSpecificationByProductById($id) {
        $query = $this->db->get_where('product_group_mapping', ['product_sku_id' => $id]);
        return $query->result_array();
    }

    public function getSubcategoryByProductId($id) {
        $this->db->select('category_id');
        $query = $this->db->get_where('product', ['product_id' => $id]);
        $row = $query->row_array();
        $query1 = $this->db->get_where('subcategory', ['category_id' => $row['category_id']]);
        return $query1->result_array();
    }

    public function doAddProduct() {
        $data = array(
            'shop_section_id' => $this->security->xss_clean($this->input->post('shop_section_id')),
            'store_id' => $this->security->xss_clean($this->input->post('store_id')),
            'product_name' => $this->security->xss_clean($this->input->post('product_name')),
            'description' => $this->input->post('description'),
            'sku' => $this->security->xss_clean($this->input->post('sku')),
        );
        $this->db->insert('product', $data);
        return $this->db->insert_id();
    }

    public function addProductSku($product_id, $sku) {
        $data = array(
            'product_id' => $product_id,
            'sku' => $sku
        );
        $this->db->insert('product_sku', $data);
        return $this->db->insert_id();
    }

    public function addProductGroupMapping($product_sku_id, $key, $group_val_arr) {
        $data = array(
            'product_sku_id' => $product_sku_id,
            'group_id' => $key,
            'group_value' => $group_val_arr
        );
        $this->db->insert('product_group_mapping', $data);
        return $this->db->insert_id();
    }

    public function doEditProduct($small_image, $large_image, $id) {
        // echo $id;die;
        $data = array(
            'category_id' => $this->security->xss_clean($this->input->post('store_category_id')),
            'store_id' => $this->security->xss_clean($this->input->post('store_id')),
            'product_name' => $this->security->xss_clean($this->input->post('product_name')),
            'description' => $this->input->post('description'),
            'price' => $this->security->xss_clean($this->input->post('price')),
            'sku' => $this->security->xss_clean($this->input->post('sku')),
            'small_image' => $small_image,
            'large_image' => $large_image
        );
        $this->db->update('product', $data, ['product_id' => $id]);
        return $id;
    }

    public function getSkuByProductId($id) {
        $query = $this->db->get_where('product_sku', ['product_id' => $id]);
        return $query->result_array();
    }

    public function doAddSku($id) {
        $group_value = $this->input->post('group_value');
        $group_id = $this->input->post('group_id');

//       $count = count($group_id);
        $counts = array_count_values($group_id);
        $a = 0;
        foreach (array_unique($group_id) as $s) {
            $a++;
        }
        $sr = 1;
        $total = 0;
        foreach ($counts as $key => $count) {
//            echo $key."=>".$count."<br>";
            if ($sr == 1) {
                $first_val = $count;
            } else {
                $total = $total + $first_val * $count;
//            $total = $total + $total;
            }
            $sr++;
        }
//        echo $total;
//       print_r($counts);
        $sk = "";
        for ($i = 0; $i < $total; $i++) {
            $this->db->insert('product_sku', ['product_id' => $id, 'sku' => 'sku']);
            $sku_id1 = $this->db->insert_id();
            $sk .= $sku_id1 . ",";
            $sku_id = substr($sk, 0, -1);
        }
//        $sku_id= substr($sku_id, 0,-1);
        $sku_id = explode(',', $sku_id);
//        print_r($sku_id);
//        die;
        for ($i = 0; $i < count($group_id); $i++) {
            foreach ($sku_id as $sku_id1) {
                $this->db->insert('product_group_mapping', ['product_sku_id' => $sku_id1, 'group_id' => $group_id[$i], 'group_value' => $group_value[$i]]);
            }
        }
    }

    public function doChangeProductStatus($id) {
        $query = $this->db->get_where('product', ['product_id' => $id]);
        $row = $query->row_array();
        if ($row['is_active'] == "Inactive") {
            $up = $this->db->update('product', ['is_active' => 'Active'], ['product_id' => $id]);
        } else {
            $up = $this->db->update('product', ['is_active' => 'Inactive'], ['product_id' => $id]);
        }
        return true;
    }

    public function getUserDetail($user_type, $email) {
        $query = $this->db->get_where($user_type, ['email' => $email]);
        return $query->row_array();
    }

    public function doUpdateProfile($table_name, $email, $image_url,$dl_image_url) {
        if ($table_name == 'admin') {
            $data = array(
                'first_name' => $this->security->xss_clean($this->input->post('first_name')),
                'last_name' => $this->security->xss_clean($this->input->post('last_name')),
                'image_url' => $image_url
            );
        }
        if ($table_name == 'courier') {
            $country_code = explode(",", $this->input->post('country_code'));
            $country = $country_code['1'];
            $data = array(
                'first_name' => $this->security->xss_clean($this->input->post('first_name')),
                'last_name' => $this->security->xss_clean($this->input->post('last_name')),
                'address1' => $this->security->xss_clean($this->input->post('address1')),
                'address2' => $this->security->xss_clean($this->input->post('address2')),
                'city' => $this->security->xss_clean($this->input->post('city')),
                'state' => $this->security->xss_clean($this->input->post('state')),
                'zipcode' => $this->security->xss_clean($this->input->post('zipcode')),
                'country' => $country,
                'image_url' => $image_url,
                'bank_name' => $this->security->xss_clean($this->input->post('bank_name')),
                'bank_ifsc_code' => $this->security->xss_clean($this->input->post('bank_ifsc_code')),
                'bank_account_number' => $this->security->xss_clean($this->input->post('bank_account_number')),
                'driving_licence_image' => $dl_image_url,
            );
        }
        if ($table_name == 'partner') {
            $country_code = explode(",", $this->input->post('country_code'));
            $country = $country_code['1'];
            $data = array(
                'first_name' => $this->security->xss_clean($this->input->post('first_name')),
                'last_name' => $this->security->xss_clean($this->input->post('last_name')),
                'address1' => $this->security->xss_clean($this->input->post('address1')),
                'address2' => $this->security->xss_clean($this->input->post('address2')),
                'city' => $this->security->xss_clean($this->input->post('city')),
                'state' => $this->security->xss_clean($this->input->post('state')),
                'zipcode' => $this->security->xss_clean($this->input->post('zipcode')),
                'country' => $country,
                'image_url' => $image_url
            );
        }
        $this->db->update($table_name, $data, ['email' => $email]);
        return $this->db->affected_rows();
    }

    public function getUser() {
        $result = $this->db->get('user');
        return $result->result_array();
    }

    public function getUserByID($id) {
        $result = $this->db->get_where('user', ['user_id' => $id]);
        return $result->row_array();
    }

    public function doAddUser($image_url, $password) {
        $data = array(
            'image_url' => $image_url,
            'password' => hash('sha256', $password),
            'unique_id' => $password,
            'user_name' => $this->security->xss_clean($this->input->post('first_name')),
            'last_name' => $this->security->xss_clean($this->input->post('last_name')),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'dob' => $this->security->xss_clean($this->input->post('dob')),
            'phone' => $this->security->xss_clean($this->input->post('phone_no')),
            'address1' => $this->security->xss_clean($this->input->post('address1')),
            'address2' => $this->security->xss_clean($this->input->post('address2')),
            'source' => 'self',
            'credit_points' => $this->security->xss_clean($this->input->post('user_point')),
			'image_off_on'=>$this->input->post('image_off_on'),
        );
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

    public function doEditUser($id, $image_url) {
        $data = array(
            'image_url' => $image_url,
            'user_name' => $this->security->xss_clean($this->input->post('first_name')),
            'last_name' => $this->security->xss_clean($this->input->post('last_name')),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'dob' => $this->security->xss_clean($this->input->post('dob')),
            'phone' => $this->security->xss_clean($this->input->post('phone_no')),
            'address1' => $this->security->xss_clean($this->input->post('address1')),
            'address2' => $this->security->xss_clean($this->input->post('address2')),
            'source' => 'self',
            'credit_points' => $this->security->xss_clean($this->input->post('user_point')),
			'image_off_on'=>$this->input->post('image_off_on'),
        );

        $this->db->update('user', $data, ['user_id' => $id]);

        return $this->db->affected_rows();
    }

    public function doDeleteUserById($id) {
        $this->db->delete('user', ['user_id' => $id]);
        return $this->db->affected_rows();
    }

    public function doChangeUserStatus($id, $status) {
        $this->db->update('user', ['is_active' => $status], ['user_id' => $id]);
        return $this->db->affected_rows();
    }
    
    //////////////coupon management functions////////////////
    
    public function getAllCoupon()
    {
        $result = $this->db->get('coupon');
        return $result->result_array();
    }
    
    public function getCouponById($id)
    {
        $result = $this->db->get_where('coupon',['coupon_id'=>$id]);
        return $result->row_array();
    }
    
    public function doAddCoupon()
    {
        $data = array(
            'coupon_code'=>$this->security->xss_clean($this->input->post('coupon_name')),
            'coupon_type'=>$this->security->xss_clean($this->input->post('coupon_type')),
            'coupon_amount'=>$this->security->xss_clean($this->input->post('coupon_amount')),
        );
        $this->db->insert('coupon',$data);
        return $this->db->insert_id();
    }
    public function doEditCoupon($id)
    {
        $data = array(
            'coupon_code'=>$this->security->xss_clean($this->input->post('coupon_name')),
            'coupon_type'=>$this->security->xss_clean($this->input->post('coupon_type')),
            'coupon_amount'=>$this->security->xss_clean($this->input->post('coupon_amount')),
        );
        $this->db->update('coupon',$data,['coupon_id'=>$id]);
        return $this->db->affected_rows();
    }
    
    public function doDeleteCouponById($id)
    {
        $this->db->delete('coupon',['coupon_id'=>$id]);
        $this->db->affected_rows();
    }
    
    public function doChangeCouponStatus($id,$status)
    {
        $this->db->update('coupon',['is_active'=>$status],['coupon_id'=>$id]);
        return $this->db->affected_rows();
    }
	  //////store slider function
    
    public function getSlider() {
        $result = $this->db->get('store_slider');
        return $result->result_array();
    }

    public function doAddSlider($image_url) {
        $data = array(
            'image_url' => $image_url
        );
        $this->db->insert('store_slider', $data);
        return $this->db->insert_id();
    }

    public function doDeleteSlider($id) {
        $this->db->delete('store_slider', ['slider_id' => $id]);
        return $this->db->affected_rows();
    }

    public function changeStatus($id, $status) {
        $this->db->update('store_slider', ['is_active' => $status], ['slider_id' => $id]);
        return $this->db->affected_rows();
    }

    ///////model for csv file import for user!!!!!!!!!!!!!!!!!!!!!!!!!!!!
     public function checkData($user_name, $email)
    {
        $result = $this->db->get_where('user', ['user_name' => $user_name, 'email' => $email]);
        return $result->num_rows();
       ///$this->db->get_where('user', $data);

       
    }
    public function uploadData($data)
    {

       $this->db->insert('user', $data);
       return $this->db->insert_id();
       
    }
///////Store delivery charges......!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function getStoreDeliveryCharges() {
        $query = $this->db->get('store_delivery_charges');
        return $query->result_array();
    }
     public function getStoreDeliveryChargesId($id) {
        $query = $this->db->get_where('store_delivery_charges', ['store_delivery_charges_id' => $id]);
        
        return $query->row_array();
    }
    public function doAddStoreDeliveryCharges($data) {
        
        $this->db->insert('store_delivery_charges', $data); 
        return $this->db->insert_id();
    }
    
     public function doEditStoreDeliveryCharges($data, $id) {
        $this->db->update('store_delivery_charges', $data, ['store_delivery_charges_id' => $id]);
        return $this->db->affected_rows();
    }
/////// End Store delivery charges......!!!!!!!!!!!!!!!!!!!!!!!!!!! 

/////// Restaurant delivery charges......!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function getRestaurantDeliveryCharges() {
        $query = $this->db->get('restaurant_delivery_charges');
        return $query->result_array();
    }
     public function getRestaurantDeliveryChargesId($id) {
        $query = $this->db->get_where('restaurant_delivery_charges', ['restaurant_delivery_charges_id' => $id]);
        
        return $query->row_array();
    }
    public function doAddRestaurantDeliveryCharges($data) {
        
        $this->db->insert('restaurant_delivery_charges', $data); 
        return $this->db->insert_id();
    }
    
     public function doEditRestaurantDeliveryCharges($data, $id) {
        $this->db->update('restaurant_delivery_charges', $data, ['restaurant_delivery_charges_id' => $id]);
        return $this->db->affected_rows();
    }
///////End Restaurant delivery charges......!!!!!!!!!!!!!!!!!!!!!!!!!!!     
	
	public function varify_emailid(){
       $query = $this->db->get_where('partner',['email'=>$this->input->post('email')]);
       return $query->row_array();
    }
	
	public function insert_partner_activationcode($activationcode,$result){
		$data = array(
            'partner_id'=> $result['partner_id'],
            'activationcode'=> $activationcode
        );
        $this->db->insert('partner_email_verify',$data);
        return $this->db->insert_id();
	}
	
	public function update_partner_email_status($partner_id,$activationcode){
		
		$query = $this->db->get_where('partner_email_verify',['partner_id' =>$partner_id, 'activationcode' => $activationcode,'status'=>'Inactive']);
		
		if(!empty($query->row_array())){
		$this->db->update('partner_email_verify', ['status' => 'Active'],['partner_id' =>$partner_id, 'activationcode' => $activationcode]);
			return $this->db->affected_rows();
		}else{
			return false;
		}
		
	}
	
	public function doChangeForgotPassword() {
        $data = array(
            'password' => hash('sha256', $this->security->xss_clean($this->input->post('new_password'))),
        );
            $id= $this->security->xss_clean($this->input->post('partnerid'));
        $this->db->update('partner', $data, ['partner_id' => $id]);
        return $this->db->affected_rows();
    }
	
	public function insert_admin_activationcode($activationcode,$result){
		$data = array(
            'admin_id'=> $result['admin_id'],
            'activationcode'=> $activationcode
        );
        $this->db->insert('admin_email_verify',$data);
        return $this->db->insert_id();
	}
	
	public function varify_admin_emailid(){
       $query = $this->db->get_where('admin',['email'=>$this->input->post('email')]);
       return $query->row_array();
    }
	
	public function update_admin_email_status($admin_id,$activationcode){
		
		$query = $this->db->get_where('admin_email_verify',['admin_id' =>$admin_id, 'activationcode' => $activationcode,'status'=>'Inactive']);
		
		if(!empty($query->row_array())){
		$this->db->update('admin_email_verify', ['status' => 'Active'],['admin_id' =>$admin_id, 'activationcode' => $activationcode]);
			return $this->db->affected_rows();
		}else{
			return false;
		}
		
	}
	
	public function update_courier_email_status($courier_id,$activationcode){
		
		$query = $this->db->get_where('courier_email_verify',['courier_id' =>$courier_id, 'activationcode' => $activationcode,'status'=>'Inactive']);
		
		if(!empty($query->row_array())){
		$this->db->update('courier_email_verify', ['status' => 'Active'],['courier_id' =>$courier_id, 'activationcode' => $activationcode]);
			return $this->db->affected_rows();
		}else{
			return false;
		}
		
	}
	
	public function doChangeForgotPasswordAdmin() {
        $data = array(
            'password' => hash('sha256', $this->security->xss_clean($this->input->post('new_password'))),
        );
            $id= $this->security->xss_clean($this->input->post('adminid'));
        $this->db->update('admin', $data, ['admin_id' => $id]);
        return $this->db->affected_rows();
    }
	
	public function varify_courier_emailid(){
		  $query = $this->db->get_where('courier',['email'=>$this->input->post('email')]);
       return $query->row_array();
	}
	public function insert_courier_activationcode($activationcode,$result){
		$data = array(
            'courier_id'=> $result['courier_id'],
            'activationcode'=> $activationcode
        );
        $this->db->insert('courier_email_verify',$data);
        return $this->db->insert_id();
	}
	
	public function doChangeForgotPasswordCourier() {
        $data = array(
            'password' => hash('sha256', $this->security->xss_clean($this->input->post('new_password'))),
        );
            $id= $this->security->xss_clean($this->input->post('courierid'));
        $this->db->update('courier', $data, ['courier_id' => $id]);
        return $this->db->affected_rows();
    }
	//////dashboard functions
	public function countUsersForDashboard()
    {
//        $this->db->select('count(*) as total,source');
//        $this->db->from('user');
//        $this->db->group_by('source');
//        $query = $this->db->get();
//        return $query->result_array();
        $this->db->select('count(*) as total_users');
        $this->db->from('user');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function countCourierForDashboard()
    {
        $this->db->select('count(*) as total_courier');
        $this->db->from('courier');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function countCourierEnquiriesForDashboard()
    {
        $this->db->select('count(*) as total_courier');
        $this->db->from('courier');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function countPartnerEnquiriesForDashboard()
    {
        $this->db->select('count(*) as total_partner');
        $this->db->from('partner');
        $query = $this->db->get();
        return $query->row_array();
    }
	 /////////Restaurant Order Functions Start
     public function getRestaurantOrderData() {
        $this->db->select('o.order_id,o.total_amount,o.order_status,o.order_date,o.order_time,r.restaurant_name,r.latitude,r.longitude,r.restaurant_id,u.user_name');
        $this->db->from('restaurant_orders o');
        $this->db->join('restaurant r', 'r.restaurant_id=o.restaurant_id');
        $this->db->join('user u','o.user_id=u.user_id');
        $this->db->where('o.order_status', 'Processing');
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
        return $query->result_array();
         
    }
     public function getOrderDetailById($order_id) {
        $result = $this->db->get_where('restaurant_orders', ['order_id' => $order_id]);
        return $result->row_array();
    }
    public function getUserDetailById($user_id) {
        $result = $this->db->get_where('user', ['user_id' => $user_id]);
        return $result->row_array();
    }
     public function getMenuDetailById($menu_id) {
        $list = [];
        $i = 0;
        $menu_id = explode(",", $menu_id);
        foreach ($menu_id as $id) {
            $result = $this->db->get_where('menu', ['menu_id' => $id]);
            $menu_detail = $result->row_array();
            $list[$i]['image_url'] = $menu_detail['image_url'];
            $list[$i]['menu_name'] = $menu_detail['menu_name'];
            $list[$i]['price'] = $menu_detail['price'];
            $list[$i]['discount'] = $menu_detail['discount'];
            $i++;
        }
        return $list;
    }
    public function getCourierDetailById($courier_id)
    {
        $result = $this->db->get_where('courier',['courier_id'=>$courier_id]);
        return $result->row_array();
    }
    public function getOrderDetailByUniqueId($unique_id) {
        $result = $this->db->get_where('restaurant_order_details', ['unique_order_id' => $unique_id]);
        return $result->row_array();
    }
    public function getRestaurantDetailById($restaurant_id)
    {
        $result = $this->db->get_where('restaurant',['restaurant_id'=>$restaurant_id]);
        return $result->row_array();
    }
    /////////Restaurant Order Functions End
	
	////////store order function start
	 public function getStoreOrderData() {
        $this->db->select('o.order_id,o.order_unique_id,o.total_amount,o.status,o.order_date,o.order_time,od.product_id,od.product_sku,
		od.price,od.qty,u.user_id,u.user_name,u.email');
        $this->db->from('store_order o');
        $this->db->join('store_order_detail od', 'o.order_unique_id=od.order_unique_id');
		$this->db->join('user u','o.user_id=u.user_id');
        $this->db->where('o.status', 'Processing');
		$this->db->group_by('o.order_unique_id');
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
        return $query->result_array();
         
    }
	public function getStoreOrderDetailByUniqueId($unique_id)
	{
		$result = $this->db->get_where('store_order_detail',['order_unique_id'=>$unique_id]);
		return $result->result_array();
	}
	public function getPriceDetailByUniqueId($unique_id)
	{
		$result = $this->db->get_where('store_order',['order_unique_id'=>$unique_id]);
		return $result->row_array();
	}
	public function getProductDetailById($product_id)
	{
		$query = $this->db->get_where('product',['product_id'=>$product_id]);
		return $query->row_array();
	}
	/////////store order function end
	/////////Restaurant Delivered rder Function
        
        public function getRestaurantDeliveredOrderData() {
        $this->db->select('o.order_id,o.total_amount,o.order_status,o.order_date,o.order_time,r.restaurant_name,r.latitude,r.longitude,r.restaurant_id,u.user_name');
        $this->db->from('restaurant_orders o');
        $this->db->join('restaurant r', 'r.restaurant_id=o.restaurant_id');
        $this->db->join('user u', 'o.user_id=u.user_id');
        $this->db->where('o.order_status', 'Delivered');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getRestaurantCancelOrderData() {
        $this->db->select('o.order_id,o.total_amount,o.order_status,o.order_date,o.order_time,r.restaurant_name,r.latitude,r.longitude,r.restaurant_id,u.user_name');
        $this->db->from('restaurant_orders o');
        $this->db->join('restaurant r', 'r.restaurant_id=o.restaurant_id');
        $this->db->join('user u', 'o.user_id=u.user_id');
        $this->db->where('o.order_status', 'Cancel');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getStoreDeliveredOrderData() {
        $this->db->select('o.order_id,o.order_unique_id,o.total_amount,o.status,o.order_date,o.order_time,od.product_id,od.product_sku,
		od.price,od.qty,u.user_id,u.user_name,u.email');
        $this->db->from('store_order o');
        $this->db->join('store_order_detail od', 'o.order_unique_id=od.order_unique_id');
        $this->db->join('user u', 'o.user_id=u.user_id');
        $this->db->where('o.status', 'Delivered');
        $this->db->group_by('o.order_unique_id');
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
    public function getStoreCanceledOrderData() {
        $this->db->select('o.order_id,o.order_unique_id,o.total_amount,o.status,o.order_date,o.order_time,od.product_id,od.product_sku,
		od.price,od.qty,u.user_id,u.user_name,u.email');
        $this->db->from('store_order o');
        $this->db->join('store_order_detail od', 'o.order_unique_id=od.order_unique_id');
        $this->db->join('user u', 'o.user_id=u.user_id');
        $this->db->where('o.status', 'Cancel');
        $this->db->group_by('o.order_unique_id');
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
	
}
