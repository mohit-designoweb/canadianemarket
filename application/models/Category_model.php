<?php

/**
 * Description of Store_model
 *
 * @author Mohit Kant Gupta
 */
class Category_model extends CI_Model {

// Category Models

    public function getAllCategory() {
        $query = $this->db->get('category');
        return $query->result_array();
    }

    public function getCategoryById($id) {
        $query = $this->db->get_where('category', ['category_id' => $id]);
        return $query->row_array();
    }
	public function getSubscriber() {
        $this->db->order_by('id','DESC');   
        $query = $this->db->get('user_subscribe');
        return $query->result_array();
    }

    public function doAddCategory() {
        $data = array(
            'category_name' => $this->security->xss_clean($this->input->post('category_name'))
        );
        $this->db->insert('category', $data);
        return $this->db->insert_id();
    }

    public function doEditCategory($id) {
        $data = array('category_name' => $this->security->xss_clean($this->input->post('category_name')));
        $this->db->update('category', $data, ['category_id' => $id]);
        return $this->db->affected_rows();
    }

    public function changeCategoryStatus($category_id, $status) {
        $this->db->update('category', ['is_active' => $status], ['category_id' => $category_id]);
        return $this->db->affected_rows();
    }
	
	 public function changeStoreStatusOpenOrClose($id, $status) {
        $this->db->update('store', ['is_status' => $status], ['store_id' => $id]);
        return $this->db->affected_rows();
    }

//   Store Models

    private function serviceProviderId() {
        $email = $this->session->userdata('email');
        $this->db->select('id');
        $query = $this->db->get_where('service_provider', ['email' => $email]);
        return $query->row_array();
    }

    public function getCountry() {
        $query = $this->db->get('countries');
        return $query->result_array();
    }

    public function getCity($state_id) {
        $query = $this->db->get_where('cities', ['state_id' => $state_id]);
        return $query->result_array();
    }

    public function getState($country_id) {
        $query = $this->db->get_where('states', ['country_id' => $country_id]);
        return $query->result_array();
    }

    public function getAllActiveCategory() {
        $query = $this->db->get_where('category', ['is_active' => 'Active']);
        return $query->result_array();
    }

    public function getStore() {
        $query = $this->db->get('store');
        return $query->result_array();
    }
	public function getProductDetailsByProductId($product_id) {
         $this->db->select('product_name');
        $query = $this->db->get_where('product', ['product_id' => $product_id]);
        return $query->row_array();
    }
	
	
    
    public function getUserDetailsByUserId($user_id) {
         $this->db->select('user_name');
        $query = $this->db->get_where('user', ['user_id' => $user_id]);
        return $query->row_array('user_name');
    }
	
	public function changeStoreReviewStatus($id, $status) {
        $this->db->update('store_review', ['is_approve' => $status], ['review_id' => $id]);
        return $this->db->affected_rows();
    }
    public function changeRestaurantReviewStatus($id, $status) {
        $this->db->update('restaurant_review', ['is_approve' => $status], ['restaurent_rev_rat_id' => $id]);
        return $this->db->affected_rows();
    }
	 public function getRestaurantDetailsByRestaurantId($restaurant_id) {
        $this->db->select('restaurant_name');
        $query = $this->db->get_where('restaurant', ['restaurant_id' => $restaurant_id]);
        return $query->row_array();
    }

    public function getStoreByPartnerId($partner_id) {
        $query = $this->db->get_where('store', ['partner_id' => $partner_id]);
        return $query->result_array();
    }
	
	  public function getStoreReview() {
//        $query = $this->db->get('store_review');
//        
//        return $query->result_array();
        $this->db->select('sr.*,p.product_name,u.user_name');
        $this->db->from('store_review sr');
        $this->db->join('product p', 'p.product_id = sr.product_id');
        $this->db->join('user u', 'u.user_id = sr.user_id');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getRestaurantReview() {
        
        $this->db->select('rr.*,r.restaurant_name,u.user_name');
        $this->db->from('restaurant_review rr');
         $this->db->join('restaurant r', 'r.restaurant_id = rr.restaurent_id');
        $this->db->join('user u', 'u.user_id = rr.user_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getActivePartner() {
        $this->db->select('first_name,last_name,partner_id');
        $query = $this->db->get_where('partner', ['is_active' => 'Active']);
        return $query->result_array();
    }

    public function getStoreById($id) {
        $query = $this->db->get_where('store', ['store_id' => $id]);
        return $query->row_array();
    }

    public function doAddStore($image_url) {
        $data = array(
            'store_name' => $this->security->xss_clean($this->input->post('store_name')),
            'image_url' => $image_url,
            'category_id' => $this->security->xss_clean($this->input->post('category_id')),
            'partner_id' => $this->security->xss_clean($this->input->post('partner_id')),
            'city' => $this->security->xss_clean($this->input->post('city')),
            'country' => $this->security->xss_clean($this->input->post('country')),
            'state' => $this->security->xss_clean($this->input->post('state')),
            'delivery_charge' => $this->security->xss_clean($this->input->post('delivery_charge')),
            'opening_time_from' => $this->security->xss_clean($this->input->post('opening_time_from')),
            'opening_time_to' => $this->security->xss_clean($this->input->post('opening_time_to')),
            'latitude'=>$this->security->xss_clean($this->input->post('latitude')),
            'longitude'=>$this->security->xss_clean($this->input->post('longitude')),
            'description' => $this->security->xss_clean($this->input->post('description')),
            'address'=> $this->security->xss_clean($this->input->post('address'))
        );
        $this->db->insert('store', $data);
        return $this->db->insert_id();
    }

    public function changeStoreStatus($id, $status) {
        $this->db->update('store', ['is_active' => $status], ['store_id' => $id]);
        return $this->db->affected_rows();
    }

    public function doEditStore($id, $image_url) {
        $data = array(
            'store_name' => $this->security->xss_clean($this->input->post('store_name')),
            'image_url' => $image_url,
            'category_id' => $this->security->xss_clean($this->input->post('category_id')),
            'partner_id' => $this->security->xss_clean($this->input->post('partner_id')),
            'city' => $this->security->xss_clean($this->input->post('city')),
            'country' => $this->security->xss_clean($this->input->post('country')),
            'state' => $this->security->xss_clean($this->input->post('state')),
            'delivery_charge' => $this->security->xss_clean($this->input->post('delivery_charge')),
            'opening_time_from' => $this->security->xss_clean($this->input->post('opening_time_from')),
            'opening_time_to' => $this->security->xss_clean($this->input->post('opening_time_to')),
            'latitude'=>$this->security->xss_clean($this->input->post('latitude')),
            'longitude'=>$this->security->xss_clean($this->input->post('longitude')),
            'description' => $this->input->post('description'),
            'address'=> $this->security->xss_clean($this->input->post('address'))
        );
        $this->db->update('store', $data, ['store_id' => $id]);
        return $this->db->affected_rows();
    }

    public function getShopSectionById($id) {
        $query = $this->db->get_where('shop_section', ['shop_section_id' => $id]);
        return $query->row_array();
    }

    public function getShopSection() {
        $this->db->select('s.store_name,sc.*');
        $this->db->from('shop_section sc');
        $this->db->join('store s', 's.store_id=sc.store_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllActiveStores() {
        $query = $this->db->get_where('store', ['is_active' => 'Active']);
        return $query->result_array();
    }

    public function doAddShopSection() {
        $data = array(
            'store_id' => $this->security->xss_clean($this->input->post('store_id')),
            'shop_section_name' => $this->security->xss_clean($this->input->post('shop_section_name'))
        );
        $this->db->insert('shop_section', $data);
		//echo $this->db->last_query(); die;
        return $this->db->insert_id();
    }

    public function doChangeCategoryStatus($shop_section_id, $status) {
        $this->db->update('shop_section', ['is_active' => $status], ['shop_section_id' => $shop_section_id]);
        return $this->db->affected_rows();
    }
    
    public function getActiveStoreByServiceProviderId($service_provider_id) {
        $query = $this->db->get_where('store', ['service_provider_id' => $service_provider_id]);
        return $query->result_array();
    }
    
    public function doEditShopSection($id) {
        $data = array(
            'store_id' => $this->security->xss_clean($this->input->post('store_id')),
            'shop_section_name' => $this->security->xss_clean($this->input->post('shop_section_name'))
        );
        $this->db->update('shop_section', $data, ['shop_section_id' => $id]);
        return $this->db->affected_rows();
    }
    
    public function getShopSectionByServiceProviderId($service_provider_id){
        $this->db->select('s.store_name,sc.*');
        $this->db->from('shop_section sc');
        $this->db->join('store s','s.store_id=sc.store_id');
        $this->db->where('s.service_provider_id',$service_provider_id);
        $query=$this->db->get();
        return $query->result_array();
    }
	
	public function getAllSpecification(){
        $query = $this->db->get('specification_group');
        return $query->result_array();
    }
    
    public function do_add_specification(){
        $data = array(
            'group_name' => $this->security->xss_clean($this->input->post('group_name'))
        );
        $this->db->insert('specification_group', $data);
        return $this->db->insert_id();
    }
    
    public function do_edit_specification($id){
        $data = array('group_name' => $this->security->xss_clean($this->input->post('group_name')));
        $this->db->update('specification_group', $data, ['group_id' => $id]);
        return $this->db->affected_rows();
    }
    
    public function get_specification_by_id($id) {
        $query = $this->db->get_where('specification_group', ['group_id' => $id]);
        return $query->row_array();
    }
    
    public function change_specification_status($group_id, $status){
        $this->db->update('specification_group', ['is_active' => $status], ['group_id' => $group_id]);
        return $this->db->affected_rows();
    }
	/////////////partner shop section function
    
    public function getAllActiveStoresByPartnerId($partner_id)
    {
        $result = $this->db->get_where('store',['partner_id'=>$partner_id,'is_active'=>'Active']);
        return $result->result_array();
    }
     public function doEditPartnerShopSection($id) {
        $data = array(
            'store_id' => $this->security->xss_clean($this->input->post('store_id')),
            'shop_section_name' => $this->security->xss_clean($this->input->post('shop_section_name'))
        );
        $this->db->update('shop_section', $data, ['shop_section_id' => $id]);
        return $this->db->affected_rows();
    }

}
