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
            'about' => $this->input->post('about'),
            'address' => $this->security->xss_clean($this->input->post('address')),
            'speciality' => $this->security->xss_clean($this->input->post('speciality')),
            'delivery_charge' => $this->security->xss_clean($this->input->post('delivery_charge')),
            'opening_time_from' => $this->security->xss_clean($this->input->post('opening_time_from')),
            'opening_time_to' => $this->security->xss_clean($this->input->post('opening_time_to')),
            'service_fee' => $this->security->xss_clean($this->input->post('service_fee'))
        );
        $this->db->insert('restaurant', $data);
        return $this->db->insert_id();
    }

    public function getRestaurantById($id) {
        $query = $this->db->get_where('restaurant', ['restaurant_id' => $id]);
        return $query->row_array();
    }

    public function doEditRestaurant($id, $image_url) {
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
            'about' => $this->input->post('about'),
            'address' => $this->security->xss_clean($this->input->post('address')),
            'speciality' => $this->security->xss_clean($this->input->post('speciality')),
            'delivery_charge' => $this->security->xss_clean($this->input->post('delivery_charge')),
            'opening_time_from' => $this->security->xss_clean($this->input->post('opening_time_from')),
            'opening_time_to' => $this->security->xss_clean($this->input->post('opening_time_to')),
            'service_fee' => $this->security->xss_clean($this->input->post('service_fee'))
        );
        $this->db->update('restaurant', $data, ['restaurant_id' => $id]);
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

    public function getRestaurantMenuCategoryById($menu_category_id) {
        $query = $this->db->get_where('menu_category', ['menu_category_id' => $menu_category_id]);
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

    public function getRestaurantMenu($restaurant_id, $menu_category_id) {
        $this->db->select('m.*,mc.menu_category_name');
        $this->db->from('menu m');
        $this->db->join('menu_category mc', 'mc.menu_category_id=m.menu_category_id');
        $this->db->where('m.restaurant_id', $restaurant_id);
        $this->db->where('m.menu_category_id', $menu_category_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function doAddRestaurantMenu($restaurant_id, $menu_category_id, $image_url) {
        $data = array(
            'menu_category_id' => $menu_category_id,
            'restaurant_id' => $restaurant_id,
            'image_url' => $image_url,
            'menu_name' => $this->security->xss_clean($this->input->post('menu_name')),
            'price' => $this->security->xss_clean($this->input->post('price')),
            'discount' => $this->security->xss_clean($this->input->post('discount')),
            'description' => $this->input->post('description'),
			'emarket_point'=>$this->security->xss_clean($this->input->post('emarket_point')),
            'is_special'=> $this->input->post('is_special')
        );
        $this->db->insert('menu', $data);
        return $this->db->insert_id();
    }
    
    public function getRestaurantMenuById($menu_id){
        $query=$this->db->get_where('menu',['menu_id'=>$menu_id]);
        return $query->row_array();
    }
    
    public function doEditRestaurantMenu($menu_id, $image_url){
        $data = array(
            'image_url' => $image_url,
            'menu_name' => $this->security->xss_clean($this->input->post('menu_name')),
            'price' => $this->security->xss_clean($this->input->post('price')),
            'discount' => $this->security->xss_clean($this->input->post('discount')),
            'description' => $this->input->post('description'),
			'emarket_point'=>$this->security->xss_clean($this->input->post('emarket_point')),
            'is_special'=> $this->input->post('is_special')
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

}
