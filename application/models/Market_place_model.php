<?php

/**
 * Description of market_place_model
 *
 * @author Manish Khandelwal
 */
class Market_place_model extends CI_Model {

    
    public function getMarketPlaceCategoryById($id) {
        $query = $this->db->get_where('market_place_category', ['market_place_category_id' => $id]);
        return $query->row_array();
    }

    public function getAllMarketPlaceCategory() {
        $query = $this->db->get('market_place_category');
        return $query->result_array();
    }

    public function doAddMarketPlaceCategory() {
        $data = array(
            'category_name' => $this->security->xss_clean($this->input->post('category_name'))
        );
        $this->db->insert('market_place_category', $data);
        return $this->db->insert_id();
    }

    public function doEditMarketPlaceCategory($id) {
        $data = array('category_name' => $this->security->xss_clean($this->input->post('category_name')));
        $this->db->update('market_place_category', $data, ['market_place_category_id' => $id]);
        return $this->db->affected_rows();
    }

    public function changeCategoryStatus($category_id, $status) {
        $this->db->update('market_place_category', ['is_active' => $status], ['market_place_category_id' => $category_id]);
        return $this->db->affected_rows();
    }

    //Restaurant 

    public function getRestaurantByPartnerId($partner_id) {
        $query = $this->db->get_where('restaurant', ['partner_id' => $partner_id]);
        return $query->result_array();
    }

    public function getAllProduct() {
        $this->db->select('p.first_name,p.last_name,mpc.category_name,mpp.*');
        $this->db->from('market_place_product mpp');
        $this->db->join('market_place_category mpc', 'mpc.market_place_category_id=mpp.market_place_category_id');
        $this->db->join('partner p', 'p.partner_id=mpp.partner_id');
        $this->db->group_by('mpp.market_place_product_id');
        $query = $this->db->get('market_place_product');
        return $query->result_array();
    }

    public function getAllActiveMarketPlaceCategory() {
        $query = $this->db->get_where('market_place_category', ['is_active' => 'Active']);
        return $query->result_array();
    }

    public function getActivePartner() {
        $this->db->select('first_name,last_name,partner_id');
        $query = $this->db->get_where('partner', ['is_active' => 'Active']);
        return $query->result_array();
    }

    public function doAddProduct($image_url) {
        $data = array(
            'product_name' => $this->security->xss_clean($this->input->post('product_name')),
            'image_url' => $image_url,
            'market_place_category_id' => $this->security->xss_clean($this->input->post('market_place_category_id')),
            'partner_id' => $this->security->xss_clean($this->input->post('partner_id')),
            'price' => $this->security->xss_clean($this->input->post('price')),
            'description' => $this->input->post('description'),
        );
        $this->db->insert('market_place_product', $data);
        return $this->db->insert_id();
    }

    public function getProductById($id) {
        $query = $this->db->get_where('market_place_product', ['market_place_product_id' => $id]);
        return $query->row_array();
    }

    public function doEditProduct($id, $image_url) {
        $data = array(
            'product_name' => $this->security->xss_clean($this->input->post('product_name')),
            'image_url' => $image_url,
            'market_place_category_id' => $this->security->xss_clean($this->input->post('market_place_category_id')),
            'partner_id' => $this->security->xss_clean($this->input->post('partner_id')),
            'price' => $this->security->xss_clean($this->input->post('price')),
            'description' => $this->input->post('description'),
        );
        $this->db->update('market_place_product', $data, ['market_place_product_id' => $id]);
        return $this->db->affected_rows();
    }

    public function changeProductStatus($id, $status) {
        $this->db->update('market_place_product', ['is_active' => $status], ['market_place_product_id' => $id]);
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
            'description' => $this->input->post('description')
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
            'description' => $this->input->post('description')
        );
        $this->db->update('menu', $data, ['menu_id' => $menu_id]);
        return $this->db->affected_rows();
    }
    
    public function changeRestaurantMenuStatus($menu_id,$status){
        $this->db->update('menu', ['is_active' => $status], ['menu_id' => $menu_id]);
        return $this->db->affected_rows();
    }
      

}
