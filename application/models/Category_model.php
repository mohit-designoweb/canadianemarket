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
    
    public function changeStoreDeliveryChargeOnOrOff($id, $status) {
        if($status === "OFF"){
            $this->db->update('store', ['store_delivery_charge' => $status, 'apply_delivery_charge'=>'Default', 'delivery_charge'=>''], ['store_id' => $id]);
            return $this->db->affected_rows();
        }else{
            $this->db->update('store', ['store_delivery_charge' => $status], ['store_id' => $id]);
            return $this->db->affected_rows();
        }
    }
    
    public function StoreDeliveryChargeType($id, $status) {
        if($status === "Default"){
            $this->db->update('store', ['apply_delivery_charge' => $status, 'delivery_charge'=>''], ['store_id' => $id]);
            return $this->db->affected_rows();
        }else{
            $this->db->update('store', ['apply_delivery_charge' => $status], ['store_id' => $id]);
            return $this->db->affected_rows();
        }
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
        $this->db->select('s.store_id,s.image_url,s.store_name,s.description,s.city,c.category_name');
        $this->db->from('store s');
        $this->db->join('category c', 'c.category_id = s.category_id');
        $query = $this->db->get();
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
        $this->db->select('*');
        $this->db->from('store s');
        $this->db->join('store_bank sb', 'sb.store_id = s.store_id');
        $this->db->where('s.store_id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function doAddStore($image_url) {
        $data = array(
            'image_url' => $image_url,
            'store_name' => $this->security->xss_clean($this->input->post('store_name')),
            'category_id' => $this->security->xss_clean($this->input->post('category_id')),
            'partner_id' => $this->security->xss_clean($this->input->post('partner_id')),
            'country' => $this->security->xss_clean($this->input->post('country')),
            'state' => $this->security->xss_clean($this->input->post('state')),
            'city' => $this->security->xss_clean($this->input->post('city')),
            'tax_province'=> $this->security->xss_clean($this->input->post('tax_province')),
            'description' => $this->security->xss_clean($this->input->post('description')),
            'return_policy'=> $this->security->xss_clean($this->input->post('return_policy')),
            'opening_time_from' => $this->security->xss_clean($this->input->post('opening_time_from')),
            'opening_time_to' => $this->security->xss_clean($this->input->post('opening_time_to')),
            'address'=> $this->security->xss_clean($this->input->post('address')),
            'latitude'=>$this->security->xss_clean($this->input->post('latitude')),
            'longitude'=>$this->security->xss_clean($this->input->post('longitude')),
            'store_delivery_charge'=> $this->security->xss_clean($this->input->post('store_delivery_charge')),
            'apply_delivery_charge' => $this->security->xss_clean($this->input->post('apply_delivery_charge')),
            'delivery_charge' => $this->security->xss_clean($this->input->post('delivery_charge')),
            'store_notice'=> $this->security->xss_clean($this->input->post('store_notice')),
            'estimated_delivery_time'=> $this->security->xss_clean($this->input->post('estimated_delivery_time'))
        );
        
        
        $this->db->insert('store', $data);
        $store_id = $this->db->insert_id();
        $this->db->insert('store_bank',['store_id'=>$store_id]);
        return $this->db->insert_id();
    }
    
    public function doEditStoreInfo($id, $image_url) {
        $data = array(
            'store_name' => $this->security->xss_clean($this->input->post('store_name')),
            'image_url' => $image_url,
            'category_id' => $this->security->xss_clean($this->input->post('category_id')),
            'partner_id' => $this->security->xss_clean($this->input->post('partner_id')),
            'description' => $this->security->xss_clean($this->input->post('description')),
            'return_policy'=> $this->security->xss_clean($this->input->post('return_policy'))
        );
        
        $this->db->update('store', $data, ['store_id' => $id]);
        return $this->db->affected_rows();
    }
    
    public function doEditStoreAddress($id) {
        $data = array(
            'city' => $this->security->xss_clean($this->input->post('city')),
            'country' => $this->security->xss_clean($this->input->post('country')),
            'state' => $this->security->xss_clean($this->input->post('state')),
            'latitude'=>$this->security->xss_clean($this->input->post('latitude')),
            'longitude'=>$this->security->xss_clean($this->input->post('longitude')),
            'address'=> $this->security->xss_clean($this->input->post('address'))
        );
        
        $this->db->update('store', $data, ['store_id' => $id]);
        return $this->db->affected_rows();
    }
    
    public function doEditStoreOperation($id) {
        
        $data = array(
            'opening_time_from' => $this->security->xss_clean($this->input->post('opening_time_from')),
            'opening_time_to' => $this->security->xss_clean($this->input->post('opening_time_to')),
            'store_notice' => $this->security->xss_clean($this->input->post('store_notice'))
        );
        
        $this->db->update('store', $data, ['store_id' => $id]);
        return $this->db->affected_rows();
    }
    
    public function doEditStoreDeliveryTax($id) {
        
        $data = array(
            'delivery_charge' => $this->security->xss_clean($this->input->post('custom_charge')),
            'driver_instuction' => $this->security->xss_clean($this->input->post('driver_instuction')),
            'tax_province' => $this->security->xss_clean($this->input->post('tax_province')),
            'estimated_delivery_time' => $this->security->xss_clean($this->input->post('estimated_delivery_time'))
        );
        
        $this->db->update('store', $data, ['store_id' => $id]);
        return $this->db->affected_rows();
    }
    
    public function doEditStoreBank($id) {
        
        $data = array(
            'account_holder' => $this->security->xss_clean($this->input->post('holder_name')),
            'account_number' => $this->security->xss_clean($this->input->post('account_number')),
            'ifsc_code' => $this->security->xss_clean($this->input->post('ifsc_code')),
            'bank_name' => $this->security->xss_clean($this->input->post('bank_name')),
            'branch_name' => $this->security->xss_clean($this->input->post('branch_name')),
            'bank_address' => $this->security->xss_clean($this->input->post('bank_address')),
        );
        $this->db->update('store_bank', $data, ['store_id' => $id]);
        return $this->db->affected_rows();
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

    public function getShopSectionById($store_id, $id) {
        $query = $this->db->get_where('shop_section', ['shop_section_id' => $id, 'store_id'=>$store_id]);
        return $query->row_array();
    }

    public function getShopSection($store_id) {
        $this->db->select('s.store_id,s.store_name,sc.*');
        $this->db->from('shop_section sc');
        $this->db->join('store s', 's.store_id=sc.store_id');
        $this->db->where('s.store_id',$store_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllActiveStores() {
        $query = $this->db->get_where('store', ['is_active' => 'Active']);
        return $query->result_array();
    }
    
    public function getAllTaxProvice() {
        
        $query = $this->db->get('tax_province');
        return $query->result_array();
    }
    
    public function getOrderFulfilmentTime() {
        
        $query = $this->db->get('order_fulfilment_time');
        return $query->result_array();
    }
    
    public function doAddShopSection() {
        $data = array(
            'store_id' => $this->security->xss_clean($this->input->post('store_id')),
            'shop_section_name' => $this->security->xss_clean($this->input->post('shop_section_name'))
        );
       
        $this->db->insert('shop_section', $data);
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
    
    public function getShopSectionByServiceProviderId($store_id, $service_provider_id){
        $this->db->select('s.store_id,s.store_name,sc.*');
        $this->db->from('shop_section sc');
        $this->db->join('store s','s.store_id=sc.store_id');
        $this->db->where('s.service_provider_id',$service_provider_id);
        $this->db->where('s.store_id',$store_id);
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
    
    public function getAllTopping(){
        $query = $this->db->get('toppings');
        return $query->result_array();
    }
    
    public function get_topping_by_id($id) {
        $query = $this->db->get_where('toppings', ['id' => $id]);
        return $query->row_array();
    }
    
    public function do_add_topping(){
        $data = array(
            'topping_name' => $this->security->xss_clean($this->input->post('topping_name'))
        );
        $this->db->insert('toppings', $data);
        return $this->db->insert_id();
    }
    
    public function do_edit_topping($id){
        $data = array('topping_name' => $this->security->xss_clean($this->input->post('topping_name')));
        $this->db->update('toppings', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
    
    public function change_topping_status($group_id, $status){
        $this->db->update('toppings', ['is_active' => $status], ['id' => $group_id]);
        return $this->db->affected_rows();
    }
}
