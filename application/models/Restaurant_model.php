<?php

/**
 * Description of Restaurant_model
 *
 * @author Mohit Kant Gupta
 */
class Restaurant_model extends CI_Model {

    //Restaurant Category
    public function getRestaurantCategoryById($id) {
        $query = $this->db->get_where('restaurant_category', ['restaurant_category_id' => $id]);
        return $query->row_array();
    }

    public function getAllRestaurantCategory() {
        $query = $this->db->get('restaurant_category');
        return $query->result_array();
    }

    public function doAddCategory() {
        $data = array(
            'category_name' => $this->security->xss_clean($this->input->post('category_name'))
        );
        $this->db->insert('restaurant_category', $data);
//        $this->db->last_query(); die;
        return $this->db->insert_id();
    }

    public function doEditRestaurantCategory($id) {
        $data = array('category_name' => $this->security->xss_clean($this->input->post('category_name')));
        $this->db->update('restaurant_category', $data, ['restaurant_category_id' => $id]);
        return $this->db->affected_rows();
    }

    public function changeCategoryStatus($category_id, $status) {
        $this->db->update('restaurant_category', ['is_active' => $status], ['restaurant_category_id' => $category_id]);
        return $this->db->affected_rows();
    }
	
    public function changeAdminRestaurantStatusOpenOrClose($id, $status) {
        $this->db->update('restaurant', ['is_open' => $status], ['restaurant_id' => $id]);
        return $this->db->affected_rows();
    }
    
    public function changeAdminRestaurantDeliveryChargeOnOrOff($id, $status) {
        $this->db->update('restaurant', ['restaurant_delivery_charge' => $status], ['restaurant_id' => $id]);
        return $this->db->affected_rows();
    }
    
    public function changeAdminRestaurantDeliveryChargeType($id, $status) {
        $this->db->update('restaurant', ['apply_delivery_charge' => $status], ['restaurant_id' => $id]);
        return $this->db->affected_rows();
    }
    //Restaurant 

    public function getRestaurantByPartnerId($partner_id) {
        $query = $this->db->get_where('restaurant', ['partner_id' => $partner_id]);
        return $query->result_array();
    }

    public function getAllRestaurant() {
        $this->db->select('p.first_name,p.last_name,rc.category_name,r.*');
        $this->db->from('restaurant r');
        $this->db->join('restaurant_category rc', 'rc.restaurant_category_id=r.restaurant_category_id');
        $this->db->join('partner p', 'p.partner_id=r.partner_id');
        $this->db->group_by('r.restaurant_id');
        $query = $this->db->get('restaurant');
        return $query->result_array();
    }

    public function getAllActiveCategory() {
        $query = $this->db->get_where('restaurant_category', ['is_active' => 'Active']);
        return $query->result_array();
    }

    public function getActivePartner() {
        $this->db->select('first_name,last_name,partner_id');
        $query = $this->db->get_where('partner', ['is_active' => 'Active']);
        return $query->result_array();
    }

    public function doAddRestaurant($image_url) {
        $data = array(
            'restaurant_name' => $this->security->xss_clean($this->input->post('restaurant_name')),
            'image_url' => $image_url,
            'restaurant_category_id' => $this->security->xss_clean($this->input->post('restaurant_category_id')),
            'partner_id' => $this->security->xss_clean($this->input->post('partner_id')),
            'city' => $this->security->xss_clean($this->input->post('city')),
            'country' => $this->security->xss_clean($this->input->post('country')),
            'state' => $this->security->xss_clean($this->input->post('state')),
            'latitude' => $this->security->xss_clean($this->input->post('latitude')),
            'longitude' => $this->security->xss_clean($this->input->post('longitude')),
            'description' => $this->input->post('description'),
            'return_policy' => $this->input->post('return_policy'),
            'about' => $this->input->post('about'),
            'address' => $this->security->xss_clean($this->input->post('address')),
            'speciality' => $this->security->xss_clean($this->input->post('speciality')),
            'restaurant_delivery_charge' => $this->security->xss_clean($this->input->post('restaurant_delivery_charge')),
            'apply_delivery_charge' => $this->security->xss_clean($this->input->post('apply_delivery_charge')),
            'delivery_charge' => $this->security->xss_clean($this->input->post('delivery_charge')),
            'opening_time_from' => $this->security->xss_clean($this->input->post('opening_time_from')),
            'opening_time_to' => $this->security->xss_clean($this->input->post('opening_time_to')),
            'service_fee' => $this->security->xss_clean($this->input->post('service_fee')),
            'delivery_time' => $this->security->xss_clean($this->input->post('estimated_delivery_time')),
            'tax_province' => $this->security->xss_clean($this->input->post('tax_province')),
            'driver_instuction' => $this->security->xss_clean($this->input->post('driver_instuction'))
        );
        $this->db->insert('restaurant', $data);
        $restaurant_id = $this->db->insert_id();
        $bank_data = array(
            'restaurant_id' => $restaurant_id
        );
        $this->db->insert('restaurant_bank',$bank_data);
        return $this->db->insert_id();
    }

    public function getRestaurantById($id) {
        $this->db->select('*');
        $this->db->from('restaurant r');
        $this->db->join('restaurant_bank rb','rb.restaurant_id = r.restaurant_id');
        $this->db->where('r.restaurant_id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function doEditRestaurantInfo($id, $image_url) {
        $data = array(
            'image_url' => $image_url,
            'restaurant_name' => $this->security->xss_clean($this->input->post('restaurant_name')),
            'restaurant_category_id' => $this->security->xss_clean($this->input->post('restaurant_category_id')),
            'partner_id' => $this->security->xss_clean($this->input->post('partner_id')),
            'speciality' => $this->security->xss_clean($this->input->post('speciality')),
            'description' => $this->input->post('description'),
            'return_policy' => $this->input->post('return_policy')
        );
        
        $this->db->update('restaurant', $data, ['restaurant_id' => $id]);
        return $this->db->affected_rows();
    }
    
    public function doEditRestaurantAddress($id) {
        $data = array(
            'address' => $this->security->xss_clean($this->input->post('address')),
            'country' => $this->security->xss_clean($this->input->post('country')),
            'state' => $this->security->xss_clean($this->input->post('state')),
            'city' => $this->security->xss_clean($this->input->post('city')),
            'latitude' => $this->security->xss_clean($this->input->post('latitude')),
            'longitude' => $this->security->xss_clean($this->input->post('longitude'))
        );
        
        $this->db->update('restaurant', $data, ['restaurant_id' => $id]);
        return $this->db->affected_rows();
    }
    
    public function doEditRestaurantOperation($id) {
        $data = array(
            'delivery_time' => $this->security->xss_clean($this->input->post('estimated_delivery_time')),
            'opening_time_from' => $this->security->xss_clean($this->input->post('opening_time_from')),
            'opening_time_to' => $this->security->xss_clean($this->input->post('opening_time_to')),
        );
        
        $this->db->update('restaurant', $data, ['restaurant_id' => $id]);
        return $this->db->affected_rows();
    }
    
    public function doEditRestaurantTaxDelivery($id) {
        $data = array(
            'driver_instuction' => $this->security->xss_clean($this->input->post('driver_instuction')),
            'service_fee' => $this->security->xss_clean($this->input->post('service_fee')),
            'tax_province' => $this->security->xss_clean($this->input->post('tax_province')),
            'delivery_charge' => $this->security->xss_clean($this->input->post('custom_charge'))
        );
        
        $this->db->update('restaurant', $data, ['restaurant_id' => $id]);
        return $this->db->affected_rows();
    }
    
    public function doEditRestaurantBank($id) {
        $data = array(
            'account_holder' => $this->security->xss_clean($this->input->post('holder_name')),
            'account_number' => $this->security->xss_clean($this->input->post('account_number')),
            'ifsc_code' => $this->security->xss_clean($this->input->post('ifsc_code')),
            'bank_name' => $this->security->xss_clean($this->input->post('bank_name')),
            'branch_name' => $this->security->xss_clean($this->input->post('branch_name')),
            'bank_address' => $this->security->xss_clean($this->input->post('bank_address')),

        );

        $this->db->update('restaurant_bank', $data, ['restaurant_id' => $id]);
        return $this->db->affected_rows();
    }
    

    public function changeRestaurantStatus($id, $status) {
        $this->db->update('restaurant', ['is_active' => $status], ['restaurant_id' => $id]);
        return $this->db->affected_rows();
    }

    public function getRestaurantCategoryMenuByRestaurantId($restaurant_id) {
        $this->db->select('r.restaurant_id,r.restaurant_name,m.menu_category_id,m.menu_category_name,m.is_active');
        $this->db->from('menu_category m');
        $this->db->join('restaurant r', 'r.restaurant_id=m.restaurant_id');
        $this->db->where('m.restaurant_id', $restaurant_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function doAddRestaurantMenuCategory($restaurant_id) {
        $data = array(
            'menu_category_name' => $this->security->xss_clean($this->input->post('menu_category_name')),
            'restaurant_id' => $restaurant_id
        );
        $this->db->insert('menu_category', $data);
        return $this->db->insert_id();
    }

    public function getRestaurantMenuCategoryById($restaurant_id, $menu_category_id) {
        $query = $this->db->get_where('menu_category', ['restaurant_id'=>$restaurant_id,'menu_category_id' => $menu_category_id]);
        return $query->row_array();
    }

    public function doEditRestaurantMenuCategory($menu_category_id) {
        $data = array(
            'menu_category_name' => $this->security->xss_clean($this->input->post('menu_category_name'))
        );
        $this->db->update('menu_category', $data, ['menu_category_id' => $menu_category_id]);
        return $this->db->affected_rows();
    }

    public function changeRestaurantMenuCategoryStatus($menu_category_id, $status) {
        $this->db->update('menu_category', ['is_active' => $status], ['menu_category_id' => $menu_category_id]);
        return $this->db->affected_rows();
    }

    public function getRestaurantMenu($restaurant_id) {
        $this->db->select('m.*,mc.menu_category_name');
        $this->db->from('menu m');
        $this->db->join('menu_category mc', 'mc.menu_category_id=m.menu_category_id');
        $this->db->where('m.restaurant_id', $restaurant_id);
//        $this->db->where('m.menu_category_id', $menu_category_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function doAddRestaurantMenu($restaurant_id, $image_url) {
        $data = array(
            'menu_category_id' => $this->security->xss_clean($this->input->post('menu_category')),
            'restaurant_id' => $restaurant_id,
            'image_url' => $image_url,
            'menu_name' => $this->security->xss_clean($this->input->post('menu_name')),
            'price' => $this->security->xss_clean($this->input->post('price')),
            'discount' => $this->security->xss_clean($this->input->post('discount')),
            'description' => $this->input->post('description'),
	    'emarket_point'=>$this->security->xss_clean($this->input->post('emarket_point')),
            'is_special'=> $this->input->post('is_special'),
            'spicy'=> $this->input->post('spicy'),
            'topping'=> $this->input->post('topping')
        );
        
        $this->db->insert('menu', $data);
        return $this->db->insert_id();
    }
    
    public function getRestaurantMenuById($restaurant_id, $menu_id){
        $query=$this->db->get_where('menu',['restaurant_id'=>$restaurant_id,'menu_id'=>$menu_id]);
        return $query->row_array();
    }
    
    public function doEditRestaurantMenu($menu_id, $image_url){
        $data = array(
            'image_url' => $image_url,
            'menu_name' => $this->security->xss_clean($this->input->post('menu_name')),
            'price' => $this->security->xss_clean($this->input->post('price')),
            'menu_category_id' => $this->security->xss_clean($this->input->post('menu_category')),
            'discount' => $this->security->xss_clean($this->input->post('discount')),
            'description' => $this->input->post('description'),
	    'emarket_point'=>$this->security->xss_clean($this->input->post('emarket_point')),
            'is_special'=> $this->input->post('is_special'),
            'spicy'=> $this->input->post('spicy'),
            'topping'=> $this->input->post('topping')
        );
        
        $this->db->update('menu', $data, ['menu_id' => $menu_id]);
        return $this->db->affected_rows();
    }
    
    public function changeRestaurantMenuStatus($menu_id,$status){
        $this->db->update('menu', ['is_active' => $status], ['menu_id' => $menu_id]);
        return $this->db->affected_rows();
    }
    
    public function getSlider() {
        $result = $this->db->get('restaurant_slider');
        return $result->result_array();
    }

    public function doAddSlider($image_url) {
        $data = array(
            'image_url' => $image_url
        );
        $this->db->insert('restaurant_slider', $data);
        return $this->db->insert_id();
    }

    public function doDeleteSlider($id) {
        $this->db->delete('restaurant_slider', ['slider_id' => $id]);
        return $this->db->affected_rows();
    }

    public function changeStatus($id, $status) {
        $this->db->update('restaurant_slider', ['is_active' => $status], ['slider_id' => $id]);
        return $this->db->affected_rows();
    }
    
    public function getAllTaxProvice() {
        
        $query = $this->db->get('tax_province');
        return $query->result_array();
    }
    
    public function getOrderFulfilmentTime() {
        
        $query = $this->db->get('order_fulfilment_time');
        return $query->result_array();
    }
    
    public function getActiveMenuCategory(){
        $query = $this->db->get_where('menu_category', ['is_active'=>'Active']);
        return $query->result_array();
    }
    
    public function checkAlreadyExistMenu($menu_name){
        $query = $this->db->get_where('menu', ['menu_name'=>$menu_name]);
        return $query->row_array();
    }
    
    public function getMenuCategoryName($menu_category_name){
        $this->db->select('menu_category_id');
        $query = $this->db->get_where('menu_category', ['menu_category_name'=>$menu_category_name]);
        return $query->row_array();
    }
    
    public function getRestaurantName($restaurant_name){
        $this->db->select('restaurant_id,restaurant_name');
        $query = $this->db->get_where('restaurant', ['restaurant_name'=>$restaurant_name]);
        return $query->row_array();
    }
    
    public function uploadMenucsvFile($data){
        $this->db->insert('menu', $data);
        return $this->db->insert_id();
    }
    
    public function getMenuDataByRestaurantData($restaurant_id){
        $this->db->select('m.*,mc.menu_category_name,r.restaurant_name');
        $this->db->from('menu m');
        $this->db->join('menu_category mc', 'mc.menu_category_id=m.menu_category_id');
        $this->db->join('restaurant r', 'r.restaurant_id=m.restaurant_id');
        $this->db->where('m.restaurant_id', $restaurant_id);
        $query = $this->db->get();
        return $query->result_array();
    }
}
