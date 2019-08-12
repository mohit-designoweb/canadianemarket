<?php

error_reporting(0);
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

    public function getCountryCode() {
        $query = $this->db->get('countries');
        return $query->result_array();
    }

    public function login() {
        $data = array(
            'email' => $this->security->xss_clean($this->input->post('email_id')),
            'password' => $this->security->xss_clean(hash('sha256', $this->input->post('password')))
        );
        $result = $this->db->get_where('user', $data);
        return $result->row_array();
    }

    public function getCountry() {
        $query = $this->db->get('country');
        return $query->result_array();
    }

    public function getCityByCountry($country_id) {
        $query = $this->db->get_where('city', ['country_id' => $country_id]);
        return $query->result_array();
    }

    public function registerForm($unique_id) {
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
        $user_id = $this->db->insert_id();
        $this->db->insert('address', ['user_id' => $user_id]);
        $this->db->insert('user_payment_data', ['user_id' => $user_id]);
        return $this->db->affected_rows();
    }

    public function doUploadProfileImage($user_id, $image_name) {
        $data = array(
            'image_url' => $image_name
        );
        $this->db->update('user', $data, ['user_id' => $user_id]);
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
        $this->db->insert('partner_query', $data);
        return $this->db->insert_id();
    }

    public function doUpdatePartner($id) {
        $otp = $this->input->post('otp');
        $query = $this->db->get_where('partner_query', ['otp' => $otp, 'partner_query_id' => $id]);
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
        $query = $this->db->get_where('courier_query', ['courier_query_id' => $id, 'otp' => $otp]);
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

    public function getTotalRestaurantByCatId($category_id) {
        $this->db->select('count(restaurant_id) as total');
        $query = $this->db->get_where('restaurant', ['restaurant_category_id' => $category_id]);

        return $query->row_array();
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

    public function getRestaurantByCategoryId($category_id) {
        $result = $this->db->get_where('restaurant', ['restaurant_category_id' => $category_id]);
        return $result->result_array();
    }

    public function getLimitedActiveRestaurant($limit, $start, $restaurant_category) {
        $this->db->select('rc.category_name,r.image_url,r.restaurant_name,r.address,r.latitude,r.longitude,r.opening_time_from,r.opening_time_to,r.delivery_time,r.is_open');
        $this->db->from('restaurant r');
        $this->db->join('restaurant_category rc', 'r.restaurant_category_id=rc.restaurant_category_id');
        $this->db->where('r.is_active', 'Active');
        $this->db->where('r.restaurant_category_id', $restaurant_category);
        $this->db->order_by('r.is_open', 'Enable');
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
        $this->db->select('rc.category_name,r.image_url,r.restaurant_name,r.address,r.latitude,r.longitude,r.opening_time_from,r.opening_time_to,r.delivery_time,r.is_open');
        $this->db->from('restaurant r');
        $this->db->join('restaurant_category rc', 'r.restaurant_category_id=rc.restaurant_category_id');
        $this->db->where('r.is_active', 'Active');
        $this->db->like('r.restaurant_name', $search_val);
        $this->db->order_by('r.is_open', 'Enable');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getMostViewedActiveRestaurant($limit, $start, $restaurant_category) {
        $this->db->select('rc.category_name,r.image_url,r.restaurant_name,r.address,r.latitude,r.longitude,r.opening_time_from,r.opening_time_to,r.delivery_time,r.is_open');
        $this->db->from('restaurant r');
        $this->db->join('restaurant_category rc', 'r.restaurant_category_id=rc.restaurant_category_id');
        $this->db->where('r.is_active', 'Active');
        $this->db->where('r.restaurant_category_id', $restaurant_category);
        $this->db->order_by('r.is_open', 'Enable');
        $this->db->order_by('r.visit_count', 'DESC');

        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getNewActiveRestaurant($limit, $start, $restaurant_category) {
        $this->db->select('rc.category_name,r.image_url,r.restaurant_name,r.address,r.latitude,r.longitude,r.opening_time_from,r.opening_time_to,r.delivery_time,r.is_open');
        $this->db->from('restaurant r');
        $this->db->join('restaurant_category rc', 'r.restaurant_category_id=rc.restaurant_category_id');
        $this->db->join('partner p', 'r.partner_id=p.partner_id');
        $this->db->where('r.is_active', 'Active');
        $this->db->where('r.restaurant_category_id', $restaurant_category);
        $this->db->order_by('r.is_open', 'Enable');
        $this->db->order_by('r.insert_date', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getOldActiveRestaurant($limit, $start, $restaurant_category) {
        $this->db->select('r.insert_date,rc.category_name,r.image_url,r.restaurant_name,r.address,r.latitude,r.longitude,r.opening_time_from,r.opening_time_to,r.partner_id,r.delivery_time,r.is_open');
        $this->db->from('restaurant r');
        $this->db->join('restaurant_category rc', 'r.restaurant_category_id=rc.restaurant_category_id');
        $this->db->join('partner p', 'r.partner_id=p.partner_id');
        $this->db->where('r.is_active', 'Active');
        $this->db->where('r.restaurant_category_id', $restaurant_category);
        $this->db->where('p.is_active', 'Active');
        $this->db->order_by('r.is_open', 'Enable');
        $this->db->order_by('r.insert_date');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getFreeDeliveryRestaurant($limit, $start, $restaurant_category) {
        $this->db->select('rc.category_name,r.image_url,r.restaurant_name,r.address,r.latitude,r.longitude,r.opening_time_from,r.opening_time_to,r.delivery_time,r.is_open');
        $this->db->from('restaurant r');
        $this->db->join('restaurant_category rc', 'r.restaurant_category_id=rc.restaurant_category_id');

        $this->db->join('partner p', 'r.partner_id=p.partner_id');
        $this->db->where('r.is_active', 'Active');
        $this->db->where('r.delivery_charge', 0);
        $this->db->where('r.restaurant_category_id', $restaurant_category);
        $this->db->where('p.is_active', 'Active');
        $this->db->order_by('r.is_open', 'Enable');
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
        $query = $this->db->get_where('coupon', $data);
        return $query->row_array();
    }

    public function get_tax_rate() {
        $query = $this->db->get('tax');
        return $query->row_array();
    }

    public function discount_by_point() {
        $this->db->update('user', ['credit_point' => $point], ['unique_id' => $unique_id]);
        return $this->db->affected_rows();
    }

    // Store Function 

    public function getStoreCount() {
        $this->db->select('count(store_id) as count');
        $query = $this->db->get_where('store', ['is_active' => 'Active']);
        return $query->row_array();
    }

    public function getAllStoreCategory() {
        $query = $this->db->get_where('category', ['is_active' => 'Active']);
        return $query->result_array();
    }

    public function getProductByStoreId($category_id) {
        $this->db->select('c.category_name,c.category_id,s.store_id,s.latitude,s.longitude,ss.shop_section_id,count(p.product_id) as total');
        $this->db->from('category c');
        $this->db->join('store s', 'c.category_id=s.category_id');
        $this->db->join('shop_section ss', 's.store_id=ss.store_id');
        $this->db->join('product p', 'p.shop_section_id=ss.shop_section_id');

        $this->db->where('c.category_id', $category_id);
        $this->db->where('p.is_active', 'Active');
        $this->db->group_by('s.category_id', $category_id);
        $query = $this->db->get();
        return $query->row_Array();
    }

    public function getStoreCountByStoreCategoryId($store_category) {
        $this->db->select('count(store_id) as count');
        $query = $this->db->get_where('store', ['is_active' => 'Active', 'category_id' => $store_category]);
        return $query->row_array();
    }

    public function getLimitedActiveStore($limit, $start, $store_category) {
        $this->db->select('c.category_name,s.image_url,s.store_name,s.address,s.latitude,s.longitude,s.opening_time_from,s.opening_time_to,s.estimated_delivery_time,s.is_status,s.partner_id');
        $this->db->from('store s');
        $this->db->join('category c', 's.category_id=c.category_id');
        $this->db->join('partner p', 's.partner_id=p.partner_id');
        $this->db->where('s.is_active', 'Active');
        $this->db->where('p.is_active', 'Active');
        $this->db->where('c.category_id', $store_category);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getStoreByCategoryId($category_id) {
        $this->db->select('s.*');
        $this->db->from('store s');
        $this->db->join('partner p', 's.partner_id=p.partner_id');
        $this->db->where('s.category_id', $category_id);
        $this->db->where('p.is_active', 'Active');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getStoreIdByStoreName($store_name) {
        $query = $this->db->get_where('store', ['store_name' => $store_name]);
        return $query->row_array();
    }

    public function getShopSectionByStoreId($store_id) {
        $query = $this->db->get_where('shop_section', ['store_id' => $store_id, 'is_active' => 'Active']);
        return $query->result_array();
    }

    public function getProductCountByShopSectionId($shop_section) {
        $this->db->select('count(product_id) as count');
        $query = $this->db->get_where('product', ['is_active' => 'Active', 'shop_section_id' => $shop_section]);
        return $query->row_array();
    }

    public function updateStoreVisitCount($store_id) {
        $points = 1;
        $this->db->set('visit_count', 'visit_count + ' . (int) $points, FALSE);
        $this->db->where('store_id', $store_id);
        $this->db->update('store');
        return $this->db->affected_rows();
    }

    public function getLimitedActiveProduct($limit, $start, $shop_section) {
        $this->db->select('s.store_name,p.*,pi.image_url');
        $this->db->from('product p');
        $this->db->join('store s', 's.store_id=p.store_id');
        $this->db->join('product_image pi', 'pi.product_id=p.product_id');
        $this->db->where('p.is_active', 'Active');
        $this->db->where('p.shop_section_id', $shop_section);
        $this->db->group_by('p.product_id');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getProductIdByProductName($product_name) {
        $this->db->select('s.store_name,s.description as store_description,s.image_url as store_image,p.*,pi.image_url');
        $this->db->from('product p');
        $this->db->join('store s', 's.store_id=p.store_id');
        $this->db->join('product_image pi', 'pi.product_id=p.product_id');
        $this->db->where('p.product_name', $product_name);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getProductDetailByProductId($product_id) {
        $this->db->select('s.store_name,sc.shop_section_name,s.image_url as store_image,p.*');
        $this->db->from('product p');
        $this->db->join('store s', 's.store_id=p.store_id');
        $this->db->join('shop_section sc', 'p.shop_section_id=sc.shop_section_id');
        $this->db->where('p.product_id', $product_id);
        $query = $this->db->get();
        return $query->row_array();
    }

//    public function getSpecificationByProductId($product_id) {
//        $this->db->select('sg.group_id,sg.group_name');
//        $this->db->from('product_group_mapping pgm');
//        $this->db->join('specification_group sg', 'pgm.group_id=sg.group_id');
//        $this->db->where('pgm.product_id', $product_id);
//        $query = $this->db->get();
//        return $query->result_array();
//    }
//    public function getProductSkuByProductId($product_id) {
//        $this->db->select('*');
//        $this->db->from('product_sku');
//        $this->db->where('product_id', $product_id);
//        $this->db->where('is_active', 'Active');
//        $query = $this->db->get();
//        return $query->result_array();
//    }

    public function getMostViewedActiveStore($limit, $start, $store_category) {
        $this->db->select('c.category_name,s.image_url,s.store_name,s.address,s.latitude,s.longitude,s.opening_time_from,s.opening_time_to,s.estimated_delivery_time,s.is_status,s.partner_id');
        $this->db->from('store s');
        $this->db->join('category c', 's.category_id=c.category_id');
        $this->db->join('partner p', 's.partner_id=p.partner_id');
        $this->db->where('s.is_active', 'Active');
        $this->db->where('c.category_id', $store_category);
        $this->db->where('p.is_active', 'Active');
        $this->db->order_by('s.visit_count', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getNewActiveStore($limit, $start, $store_category) {
        $this->db->select('c.category_name,s.image_url,s.store_name,s.address,s.latitude,s.longitude,s.opening_time_from,s.opening_time_to,s.estimated_delivery_time,s.is_status,s.partner_id');
        $this->db->from('store s');
        $this->db->join('category c', 's.category_id=c.category_id');
        $this->db->join('partner p', 's.partner_id=p.partner_id');
        $this->db->where('s.is_active', 'Active');
        $this->db->where('c.category_id', $store_category);
        $this->db->where('p.is_active', 'Active');
        $this->db->order_by('s.visit_count', 'DESC');
        $this->db->order_by('s.insert_date', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getOldActiveStore($limit, $start, $store_category) {
        $this->db->select('c.category_name,s.image_url,s.store_name,s.address,s.latitude,s.longitude,s.opening_time_from,s.opening_time_to,s.estimated_delivery_time,s.is_status,s.partner_id');
        $this->db->from('store s');
        $this->db->join('category c', 's.category_id=c.category_id');
        $this->db->join('partner p', 's.partner_id=p.partner_id');
        $this->db->where('s.is_active', 'Active');
        $this->db->where('c.category_id', $store_category);
        $this->db->where('p.is_active', 'Active');
        $this->db->order_by('s.visit_count', 'DESC');
        $this->db->order_by('s.insert_date');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getFreeDeliveryStore($limit, $start, $store_category) {
        $this->db->select('c.category_name,s.image_url,s.store_name,s.address,s.latitude,s.longitude,s.opening_time_from,s.opening_time_to,s.estimated_delivery_time,s.is_status,s.partner_id');
        $this->db->from('store s');
        $this->db->join('category c', 's.category_id=c.category_id');
        $this->db->join('partner p', 's.partner_id=p.partner_id');
        $this->db->where('s.is_active', 'Active');
        $this->db->where('c.category_id', $store_category);
        $this->db->where('p.is_active', 'Active');
        $this->db->where('s.delivery_charge', 0);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getStoreBySearch($limit, $start, $search_val) {
        $this->db->select('c.category_name,s.image_url,s.store_name,s.address,s.latitude,s.longitude,s.opening_time_from,s.opening_time_to,s.estimated_delivery_time,s.is_status,s.partner_id');
        $this->db->from('store s');
        $this->db->join('category c', 's.category_id=c.category_id');
        $this->db->join('partner p', 's.partner_id=p.partner_id');
        $this->db->where('s.is_active', 'Active');
        $this->db->where('p.is_active', 'Active');
        $this->db->like('s.store_name', $search_val);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getProductsByShopSectionId($shop_section_id) {
        $query = $this->db->get_where('product', ['shop_section_id' => $shop_section_id, 'is_active' => 'Active']);
        return $query->result_array();
    }

    public function getActiveHighToLowPriceProduct($limit, $start, $shop_section) {
        $this->db->select('s.store_name,p.*,pi.image_url');
        $this->db->from('product p');
        $this->db->join('store s', 's.store_id=p.store_id');
        $this->db->join('product_image pi', 'pi.product_id=p.product_id');
        $this->db->where('p.is_active', 'Active');
        $this->db->where('p.shop_section_id', $shop_section);
        $this->db->limit($limit, $start);
        $this->db->order_by('p.price', 'DESC');
        $this->db->group_by('p.product_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getActiveLowToHighPriceProduct($limit, $start, $shop_section) {
        $this->db->select('s.store_name,p.*,pi.image_url');
        $this->db->from('product p');
        $this->db->join('store s', 's.store_id=p.store_id');
        $this->db->join('product_image pi', 'pi.product_id=p.product_id');
        $this->db->where('p.is_active', 'Active');
        $this->db->where('p.shop_section_id', $shop_section);
        $this->db->limit($limit, $start);
        $this->db->order_by('p.price', 'ASC');
        $this->db->group_by('p.product_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getActiveNewProduct($limit, $start, $shop_section) {
        $this->db->select('s.store_name,p.*,pi.image_url');
        $this->db->from('product p');
        $this->db->join('store s', 's.store_id=p.store_id');
        $this->db->join('product_image pi', 'pi.product_id=p.product_id');
        $this->db->where('p.is_active', 'Active');
        $this->db->where('p.shop_section_id', $shop_section);
        $this->db->limit($limit, $start);
        $this->db->order_by('p.insert_date', 'ASC');
        $this->db->group_by('p.product_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    /*  public function getProductBySearch($limit, $start, $search_val){
      $this->db->select('s.store_name,p.*');
      $this->db->from('product p');
      $this->db->join('store s', 's.store_id=p.store_id');
      $this->db->where('p.is_active', 'Active');
      $this->db->like('p.product_name', $search_val);
      $this->db->limit($limit, $start);
      $query = $this->db->get();
      return $query->result_array();
      } */

    //// Market place


    public function getStoreIdBycategoryId($category_id) {
        $this->db->select('store_id');
        $query = $this->db->get_where('store', ['category_id' => $category_id, 'is_active' => 'Active']);
        return $query->result_array();
    }

    public function getProductCountByStoreIds($store_ids) {
        $this->db->select('count(product_id) as count');
        $this->db->from('product');
        foreach ($store_ids as $store_id) {
            $this->db->or_where('store_id', $store_id['store_id']);
        }
        $this->db->where('is_active', 'Active');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getLimitedActiveMarketPlaceProduct($limit, $start, $store_ids) {
        $i = 0;
        $store_id_list_array = [];
        foreach ($store_ids as $store_id) {
            $store_id_list_array[$i] = $store_id['store_id'];
            $i++;
        }
        $store_id_list = implode(",", $store_id_list_array);
        $this->db->select('p.*,s.store_name,pi.image_url');
        $this->db->from('product p');
        $this->db->join('store s', 's.store_id=p.store_id');
        $this->db->join('product_image pi', 'pi.product_id=p.product_id');
        $this->db->where('p.is_active', 'Active');
        $this->db->where_in('p.store_id', $store_id_list);
        $this->db->limit($limit, $start);
        $this->db->group_by('p.product_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getProductBySearch($limit, $start, $store_ids, $search_Val) {
        $i = 0;
        $store_id_list_array = [];
        foreach ($store_ids as $store_id) {
            $store_id_list_array[$i] = $store_id['store_id'];
            $i++;
        }
        $store_id_list = implode(",", $store_id_list_array);
        $this->db->select('p.*,s.store_name,pi.image_url');
        $this->db->from('product p');
        $this->db->join('store s', 's.store_id=p.store_id');
        $this->db->join('product_image pi', 'pi.product_id=p.product_id');
        $this->db->where('p.is_active', 'Active');
        $this->db->where_in('p.store_id', $store_id_list);
        $this->db->like('p.product_name', $search_Val);
        $this->db->limit($limit, $start);
        $this->db->group_by('p.product_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getProductByLowToHigh($limit, $start, $store_ids) {
        $i = 0;
        $store_id_list_array = [];
        foreach ($store_ids as $store_id) {
            $store_id_list_array[$i] = $store_id['store_id'];
            $i++;
        }
        $store_id_list = implode(",", $store_id_list_array);
        $this->db->select('p.*,s.store_name,pi.image_url');
        $this->db->from('product p');
        $this->db->join('store s', 's.store_id=p.store_id');
        $this->db->join('product_image pi', 'pi.product_id=p.product_id');
        $this->db->where('p.is_active', 'Active');
        $this->db->where_in('p.store_id', $store_id_list);
        $this->db->order_by('p.price');
        $this->db->limit($limit, $start);
        $this->db->group_by('p.product_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getProductByHighToLow($limit, $start, $store_ids) {
        $i = 0;
        $store_id_list_array = [];
        foreach ($store_ids as $store_id) {
            $store_id_list_array[$i] = $store_id['store_id'];
            $i++;
        }
        $store_id_list = implode(",", $store_id_list_array);
        $this->db->select('p.*,s.store_name,pi.image_url');
        $this->db->from('product p');
        $this->db->join('store s', 's.store_id=p.store_id');
        $this->db->join('product_image pi', 'pi.product_id=p.product_id');
        $this->db->where('p.is_active', 'Active');
        $this->db->where_in('p.store_id', $store_id_list);
        $this->db->order_by('p.price', "desc");
        $this->db->limit($limit, $start);
        $this->db->group_by('p.product_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getStoreDetailById($store_id) {
        $query = $this->db->get_where('store', ['store_id' => $store_id]);
        return $query->row_array();
    }

    /////////////Get Page content function

    public function getTermsPageContent() {
        $result = $this->db->get('terms_condition');
        return $result->row_array();
    }

    public function getPrivacyPageContent() {
        $result = $this->db->get('privacy_policy');
        return $result->row_array();
    }

    public function getHelpPageContent() {
        $result = $this->db->get('terms_condition');
        return $result->row_array();
    }

    public function getActiveJobCategory() {
        $result = $this->db->get_where('job_category', ['is_active' => 'Active']);
        return $result->result_array();
    }

    public function getJobType() {
        $result = $this->db->get('job_type');
        return $result->result_array();
    }

    public function getHelpCategory() {
        $result = $this->db->get_where('help_category', ['is_active' => 'Active']);
        return $result->result_array();
    }

    public function help_category_wrapper($id) {
        $result = $this->db->get_where('help', ['help_category_id' => $id]);
        return $result->row_array();
    }

    public function getAllActiveJob() {
        $result = $this->db->get_where('job_detail', ['is_active' => 'Active']);
        return $result->result_array();
    }

    public function getJobDetailByJobName($alias) {
        $result = $this->db->get_where('job_detail', ['alias' => $alias]);
        return $result->row_array();
    }

    public function jobEnquiry($job_id, $resume_name) {
        $data = array(
            'job_id' => $job_id,
            'resume_url' => $resume_name,
            'first_name' => $this->security->xss_clean($this->input->post('job_first_name')),
            'last_name' => $this->security->xss_clean($this->input->post('job_last_name')),
            'email' => $this->security->xss_clean($this->input->post('job_email')),
            'cover_letter' => $this->security->xss_clean($this->input->post('job_cover_letter')),
        );
        $this->db->insert('job_enquiry', $data);
        return $this->db->last_query();
    }

    ///////career job filter functions
    public function getJobLocation() {
        $this->db->get_where('');
    }

    public function getFilteredJobtype($id) {
        $result = $this->db->get_where('job_type', ['job_category_id' => $id]);
        return $result->result_array();
    }

    public function getFilteredJobCity($id) {
        $result = $this->db->get_where('job_detail', ['job_type_id' => $id]);
        return $result->result_array();
    }

    public function getCategoryIdByName($cat_name) {
        $result = $this->db->get_where('job_category', ['job_category_name' => $cat_name]);
        return $result->row_array();
    }

    public function getTypeIdByName($type_name) {
        $result = $this->db->get_where('job_type', ['job_type_name' => $type_name]);
        return $result->row_array();
    }

    public function getFilteredJobs($cat_id, $type_id, $location_name, $search_val = NULL) {
        // $result = $this->db->get_where('job_detail',['job_category_id'=>$cat_id,'job_type_id'=>$type_id,'job_location'=>$location_name]);
        $this->db->select('*');
        $this->db->from('job_detail');
        $this->db->where(['job_category_id' => $cat_id, 'job_type_id' => $type_id, 'job_location' => $location_name]);
        $this->db->like('job_detail.designation_name', $search_val);
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }

    public function varify_emailid() {
        $query = $this->db->get_where('user', ['email' => $this->input->post('regiter_email'), 'source' => 'self']);
        return $query->row_array();
    }

    public function do_reset_password() {
        $user_id = $this->input->post('user_id');
        $password = $this->input->post('password');
        $this->db->update('user', ['password' => $password], ['user_id' => $user_id]);
        return $this->db->affected_row();
    }

//    public function getSingleProductSkuByProductId($product_id) {
//        $query = $this->db->get_where('product_sku', ['product_id' => $product_id, 'stock' => 'InStock']);
//        return $query->row_array();
//    }
//    public function getSingleProductSkuByProductSkuId($product_sku_id){
//        $query = $this->db->get_where('product_sku', ['product_sku_id' => $product_sku_id, 'stock' => 'InStock']);
//        return $query->row_array();
//    }

    public function getProductSkuMappingByProductSkuId($product_id) {
        $this->db->select('sg.group_name,pgm.group_value');
        $this->db->from('specification_group sg');
        $this->db->join('product_group_mapping pgm', 'pgm.group_id = sg.group_id');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getProductImagesByProductSkuId($product_id) {
        $query = $this->db->get_where('product_image', ['product_id' => $product_id]);
        return $query->result_array();
    }

    public function getProductSkuByProductSkuId($product_sku_id) {
        $query = $this->db->get_where('product_sku', ['product_sku_id' => $product_sku_id]);
        return $query->row_array();
    }

    ////gift amount function

    public function giftcard_random_data() {
        $str = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNIPQRSTUVWXYZ';
        $nstr = str_shuffle($str);
        $unique_id = substr($nstr, 0, 6);
        return $unique_id;
    }

    public function getActiveGiftAmounts() {
        $this->db->from('gift_card_amount');
        $this->db->where(['is_active' => 'Active']);
        $this->db->order_by('amount asc');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function insertIntoGiftcard($gift_detail) {
        if (!empty($gift_detail['address'])) {
            $address = $gift_detail['address'];
        } else {
            $address = $gift_detail['emailid'];
        }
        $data = array(
            'gifter_uniqueid' => $gift_detail['unique_id'],
            'receiver_name' => $gift_detail['receiver_name'],
            'delivery_type' => $gift_detail['address_type'],
            'address' => $address,
            'card_value' => $gift_detail['gift_amount'],
            'gifter_name' => $gift_detail['gifter_name'],
            'message' => $gift_detail['message'],
            'coupon_code' => $this->giftcard_random_data()
        );

        $this->db->insert('gift_card', $data);
        return $this->db->insert_id();
    }

    public function insert($data) {

        $this->db->insert('gift_orders', $data);
        return $this->db->insert_id();
    }

    //// restaurant slider function

    public function getAllrestaurantSlider() {
        $result = $this->db->get_where('restaurant_slider', ['is_active' => 'Active']);
        return $result->result_array();
    }

    public function get_address_by_userid($user_id) {
        $query = $this->db->get_where('address', ['user_id' => $user_id]);
        return $query->row_array();
    }

    public function doadd_address_details($user_id) {
        $data = array(
            'first_name' => $this->security->xss_clean($this->input->post('fname')),
            'last_name' => $this->security->xss_clean($this->input->post('lname')),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'company_name' => $this->security->xss_clean($this->input->post('cmpny')),
            'country' => $this->security->xss_clean($this->input->post('country')),
            'city' => $this->security->xss_clean($this->input->post('town')),
            'address' => $this->security->xss_clean($this->input->post('address')),
            'address2' => $this->security->xss_clean($this->input->post('address2')),
            'province' => $this->security->xss_clean($this->input->post('province')),
            'pin_code' => $this->security->xss_clean($this->input->post('pcode')),
            'phone' => $this->security->xss_clean($this->input->post('phone'))
        );
        $this->db->update('address', $data, ['user_id' => $user_id]);
//        return $this->db->affected_rows();
        return true;
    }

    public function get_payment_card_data_user_id($user_id) {
        $query = $this->db->get_where('user_payment_data', ['user_id' => $user_id]);
        return $query->row_array();
    }

    public function save_user_payment_data($user_id) {

        $payment_data = array(
            'card_holder' => $this->security->xss_clean($this->input->post('card_holder')),
            'card_number' => $this->security->xss_clean($this->input->post('card_number')),
            'month' => $this->security->xss_clean($this->input->post('month')),
            'year' => $this->security->xss_clean($this->input->post('year'))
        );

        $this->db->update('user_payment_data', $payment_data, ['user_id' => $user_id]);
//        return $this->db->affected_rows();
        return true;
    }

    public function restaurant_order_place($order_data) {
        $this->db->insert('restaurant_orders', $order_data);
        return $this->db->insert_id();
    }

    public function restaurant_order_details($order_detail) {
        $this->db->insert('restaurant_order_details', $order_detail);
        return $this->db->insert_id();
    }

    public function get_orderdata_by_order_id($order_id) {
        $query = $this->db->get_where('restaurant_orders', ['order_id' => $order_id]);
        return $query->row_array();
    }

    public function getProductBySku($product_id) {
        $this->db->select('pi.image_url,p.product_name,p.price,p.discount,s.store_name');
        $this->db->from('product p');
        $this->db->join('product_image pi', 'pi.product_id=p.product_id');
        $this->db->join('store s', 'p.store_id=s.store_id');
        $this->db->where('p.product_id', $product_id);
        $this->db->group_by('p.product_id');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getServiceFeeBySku($product_id) {
        $this->db->select('s.service_fee');
        $this->db->from('product p');
        $this->db->join('store s', 'p.store_id=s.store_id');
        $this->db->where('p.product_id', $product_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getSkuMappingBySku($product_id) {
        $this->db->select('gs.group_name,pgm.group_id,pgm.group_value');
        $this->db->from('specification_group gs');
        $this->db->join('product_group_mapping pgm', 'pgm.group_id=gs.group_id');
        $this->db->where('pgm.product_id', $product_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllSpecification() {
        $query = $this->db->get('specification_group');
        return $query->result_array();
    }

    public function store_order_place($order_data) {
        $this->db->insert('store_order', $order_data);
        return $this->db->insert_id();
    }

    public function get_store_orderdata_by_id($store_order_id) {
        $query = $this->db->get_where('store_order', ['order_id' => $store_order_id]);
        return $query->row_array();
    }

    public function storeorder_detail($store_order_detail) {
        $this->db->insert('store_order_detail', $store_order_detail);
        return $this->db->insert_id();
    }

    public function get_product_detail_byid($product_id) {
        $query = $this->db->get_where('product', ['product_id' => $product_id]);
        return $query->row_array();
    }
   
    public function getactive_store_active_order($user_id) {
        $this->db->select('order_id,order_unique_id,status,order_date,total_amount');
        $query = $this->db->get_where('store_order', ['user_id' => $user_id, 'status' => 'processing']);
        return $query->result_array();
    }

    public function getactive_restaurant_active_order($user_id) {
        $this->db->select('restaurant_id,menu_id,unique_order_id,total_amount,order_status,order_date');
        $query = $this->db->get_where('restaurant_orders', ['user_id' => $user_id, 'order_status' => 'processing']);
        return $query->result_array();
    }

    public function getStoreOrderedProductByOrderUniqueId($order_unique_id) {
        $this->db->select('p.product_id,p.product_name,p.price,pi.image_url,s.store_name');
        $this->db->from('store_order_detail sod');
        $this->db->join('product p', 'p.product_id=sod.product_id');
        $this->db->join('product_image pi', 'pi.product_id=p.product_id');
        $this->db->join('store s', 's.store_id=p.store_id');
        $this->db->where('sod.order_unique_id', $order_unique_id);
        $this->db->group_by('p.product_id');
        $query = $this->db->get();
        return $query->result_array();
    }

//    public function getProductskuDataByProductskuId($product_sku){
//        $this->db->select('product_sku_id,product_id');
//        $query = $this->db->get_where('product_sku', ['sku'=>$product_sku]);
//        return $query->row_array();
//    }

    public function getProductskuMappingDataByProductskuId($product_id) {
        $this->db->select('sg.group_name,pgm.group_value');
        $this->db->from('product_group_mapping pgm');
        $this->db->join('specification_group sg', 'sg.group_id=pgm.group_id');
        $this->db->where('pgm.product_id', $product_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getRestaurantOrderedProductByOrderUniqueId($restaurant_id) {
        $this->db->select('restaurant_name');
        $query = $this->db->get_where('restaurant', ['restaurant_id' => $restaurant_id]);
        return $query->row_array();
    }

    public function getRestaurantOrderedMenuByMenuId($menu_id) {
        $this->db->select('menu_name, image_url, price');
        $query = $this->db->get_where('menu', ['menu_id' => $menu_id]);
        return $query->row_array();
    }

    public function get_store_complete_order($user_id) {
        $this->db->select('order_id,order_unique_id,status,order_date,total_amount');
        $query = $this->db->get_where('store_order', ['user_id' => $user_id, 'status' => 'Delivered']);
        return $query->result_array();
    }

    public function get_restaurant_complete_order_byuser($user_id) {
        $this->db->select('restaurant_id,menu_id,unique_order_id,total_amount,order_status,order_date');
        $query = $this->db->get_where('restaurant_orders', ['user_id' => $user_id, 'order_status' => 'Delivered']);
        return $query->result_array();
    }

    public function get_store_cancel_order($user_id) {
        $this->db->select('order_id,order_unique_id,status,order_date,total_amount');
        $query = $this->db->get_where('store_order', ['user_id' => $user_id, 'status' => 'Cancel']);
        return $query->result_array();
    }

    public function get_restaurant_cancel_order_byuser($user_id) {
        $this->db->select('restaurant_id,menu_id,unique_order_id,total_amount,order_status,order_date');
        $query = $this->db->get_where('restaurant_orders', ['user_id' => $user_id, 'order_status' => 'Cancel']);
        return $query->result_array();
    }

    public function get_store_return_order($user_id) {
        $this->db->select('order_id,order_unique_id,status,order_date,total_amount');
        $query = $this->db->get_where('store_order', ['user_id' => $user_id, 'status' => 'Return']);
        return $query->result_array();
    }

    public function get_restaurant_return_order_byuser($user_id) {
        $this->db->select('restaurant_id,menu_id,unique_order_id,total_amount,order_status,order_date');
        $query = $this->db->get_where('restaurant_orders', ['user_id' => $user_id, 'order_status' => 'Return']);
        return $query->result_array();
    }

    public function store_order_cancel($order_unique_id) {
        $this->db->update('store_order', ['status' => 'Cancel'], ['order_unique_id' => $order_unique_id]);
        return $this->db->affected_rows();
    }

    public function restaurant_order_cancel($order_unique_id) {
        $this->db->update('restaurant_orders', ['order_status' => 'Cancel'], ['unique_order_id' => $order_unique_id]);
        return $this->db->affected_rows();
    }

    public function getRestaurantReviewRestaurantId($restaurent_id) {
        $this->db->select('rr.rating, rr.created, u.user_name,u.image_url');
        $this->db->from('restaurant_review rr');
        $this->db->join('user u', 'u.user_id = rr.user_id');
        $this->db->where('rr.restaurent_id', $restaurent_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function doAddStoreRateReview($user_id, $product_id) {
        $data = array(
            'user_id' => $user_id,
            'product_id' => $product_id,
            'review' => $this->security->xss_clean($this->input->post('review')),
            'rating' => $this->input->post('rating'),
            'created' => date('d-m-Y H:i:s'),
        );
        $this->db->insert('store_review', $data);
        return $this->db->insert_id();
    }

    public function getStoreReviewByProductId($product_id) {
        //echo $product_id;exit();
        $this->db->select('p.rating, p.created, p.review, p.is_approve, u.user_name,u.image_url');
        $this->db->from('store_review p');
        $this->db->join('user u', 'u.user_id = p.user_id');
        $this->db->where('p.product_id', $product_id);
        $this->db->where('p.is_approve', 'Approved');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function doAddReview($user_id, $restaurent_id) {
        $data = array(
            'restaurent_id' => $restaurent_id,
            'user_id' => $user_id,
            'rating' => $this->input->post('rating'),
            'created' => date('d-m-Y H:i:s')
        );

        $this->db->insert('restaurant_review', $data);
        return $this->db->insert_id();
    }

    public function doAddStoreReview($user_id, $store_id) {
        $data = array(
            'store_id' => $store_id,
            'user_id' => $user_id,
            'review' => $this->security->xss_clean($this->input->post('review')),
            'rating' => $this->input->post('rating'),
            'created' => date('d-m-Y H:i:s')
        );

        $this->db->insert('storereview', $data);
        return $this->db->insert_id();
    }

    public function getRelatedProductByShopSectionId($shop_section_id) {
        $this->db->select('s.store_name,p.*,pi.image_url');
        $this->db->from('product p');
        $this->db->join('store s', 's.store_id=p.store_id');
        $this->db->join('product_image pi', 'pi.product_id=p.product_id');
        $this->db->where('p.is_active', 'Active');
        $this->db->where('p.shop_section_id', $shop_section_id);
        $this->db->order_by('rand()');
        $this->db->limit(6);
        $this->db->group_by('p.product_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getProductSku($group_name) {

        $this->db->from('product_sku_group_mapping');
        $this->db->where_in('group_value', $group_name);
        $query = $this->db->get();
        return $query->result_array();
    }

    // Add review and rating Function


    public function getAvarageRating($product_id) {
        $this->db->select('AVG(rating) as rating');
        $query = $this->db->get_where('store_review', ['product_id' => $product_id]);
        return $query->row_array();
    }

    public function getAllRating($product_id) {
        $query = $this->db->get_where('store_review', ['product_id' => $product_id]);
        return $query->result_array();
    }

    public function getStoreAvarageRating($store_id) {
        $this->db->select('AVG(rating) as rating');
        $query = $this->db->get_where('storereview', ['store_id' => $store_id]);
        return $query->row_array();
    }

    public function countStoreReview($store_id) {
        $this->db->select('count(*) as total');
        $this->db->where('review !=', '');
        $this->db->where('store_id', $store_id);
        $query = $this->db->get('storereview');
        //echo $this->db->last_query(); die;
        return $query->row_array();
    }

    public function getStoreAllRating($store_id) {
        $query = $this->db->get_where('storereview', ['store_id' => $store_id]);
        return $query->result_array();
    }

    public function doSubscribe() {
        date_default_timezone_set('Asia/Kolkata');
        $data = array(
            'user_email' => $this->security->xss_clean($this->input->post('postdata')),
            'created' => date('Y-m-d,h:i:s A')
        );
        $this->db->insert('user_subscribe', $data);
        return $this->db->insert_id();
    }

    public function checkProductWishlist($productid, $userid) {
        $check_query = $this->db->get_where('store_product_wishlist', ['user_id' => $userid, 'product_id' => $productid]);
        if ($check_query->num_rows() >= 1) {
            $this->db->delete('store_product_wishlist', ['user_id' => $userid, 'product_id' => $productid]);
            return $this->db->affected_rows();
        }
    }

    public function addStoreProductWishlist($productid, $userid) {

        $data = array(
            'user_id' => $userid,
            'product_id' => $productid,
            'date' => date('Y-m-d H:i:s A')
        );
        $query = $this->db->insert('store_product_wishlist', $data);
        //return $query->insert_id();
        return 1;
    }

    public function do_search_data() {
        $enterdata = $this->input->post('search');
        $this->db->select('rc.category_name, r.restaurant_name,r.address,r.country,r.state,r.city,r.opening_time_from,r.opening_time_to');
        $this->db->from('restaurant_category rc');
        $this->db->join('restaurant r', 'r.restaurant_category_id = rc.restaurant_category_id');
        $this->db->where('rc.is_active', 'Active');
        $this->db->like('rc.category_name', $enterdata, 'both');
        $this->db->like('rc.restaurant_name', $enterdata, 'both');
        $query = $this->db->get();
        $query->result_array();
    }

    //      Get all restaurant and store for searching 

    public function getAllRestaurant() {
        $this->db->select('latitude,longitude');
        $query = $this->db->get('restaurant');
        return $query->result_array();
    }

    public function getAllStore() {
        $this->db->select('latitude,longitude');
        $query = $this->db->get('store');
        return $query->result_array();
    }

    public function getRestaurantWishlist($menu_id, $user_id) {
        $query = $this->db->get_where('restaurant_wishlist', ['menu_id' => $menu_id, 'user_id' => $user_id]);
        return $query->row_array();
    }

    public function checkRestaurantWishlist($menu_id, $userid) {
        $check_query = $this->db->get_where('restaurant_wishlist', ['user_id' => $userid, 'menu_id' => $menu_id]);
        if ($check_query->num_rows() >= 1) {
            $this->db->delete('restaurant_wishlist', ['user_id' => $userid, 'menu_id' => $menu_id]);
            return $this->db->affected_rows();
        }
    }

    public function addRestaurantWishlist($menu_id, $userid) {

        $data = array(
            'user_id' => $userid,
            'menu_id' => $menu_id,
            'date' => date('Y-m-d H:i:s A')
        );
        $this->db->insert('restaurant_wishlist', $data);
        return 1;
    }

    public function getStoreProductWishlist($product_id, $user_id) {

        $query = $this->db->get_where('store_product_wishlist', ['product_id' => $product_id, 'user_id' => $user_id]);
        return $query->row_array();
    }

    public function getRelatedProductWishlist($user_id) {
        $query = $this->db->get_where('store_product_wishlist', ['user_id' => $user_id]);
        return $query->result_array();
    }

    public function getRestaurantWishlistByUserId($user_id) {
        $this->db->select('r.restaurant_name,r.image_url, r.address,r.speciality,r.opening_time_from,r.opening_time_to');
        $this->db->from('restaurant_wishlist rw');
        $this->db->join('menu m', 'm.menu_id = rw.menu_id');
        $this->db->join('restaurant r', 'r.restaurant_id = m.restaurant_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getStoreProductWishlistByUserId($user_id) {
        $this->db->select('p.product_name,pi.image_url, p.price,s.store_name,s.address');
        $this->db->from('store_product_wishlist spw');
        $this->db->join('product p', 'p.product_id = spw.product_id');
        $this->db->join('product_image pi', 'pi.product_id = p.product_id');
        $this->db->join('store s', 's.store_id = p.store_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function do_search_restaurantdata($entereddata) {

        $this->db->select('rc.category_name,r.restaurant_id,r.restaurant_name,r.address,r.opening_time_from,r.opening_time_to');
        $this->db->from('restaurant_category rc');
        $this->db->join('restaurant r', 'r.restaurant_category_id = rc.restaurant_category_id');
        $this->db->where('rc.is_active', 'Active');
        $this->db->like('rc.category_name', $entereddata, 'both');
        $this->db->or_like('r.restaurant_name', $entereddata, 'both');
        $this->db->limit(5);
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }

    public function do_search_productdata($entereddata) {

        $this->db->select('s.store_name,s.address,s.opening_time_from,s.opening_time_to,p.product_id,p.product_name,p.image_url,price,discount');
        $this->db->from('product p');
        $this->db->join('store s', 's.store_id = p.store_id');
        $this->db->where('s.is_active', 'Active');
        $this->db->where('s.is_status', 'Active');
        $this->db->where('p.is_active', 'Active');
        $this->db->like('s.store_name', $entereddata, 'both');
        $this->db->or_like('p.product_name', $entereddata, 'both');
        $this->db->limit(5);
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }

    public function do_product_reorder($user_id, $product_uniqueid) {
        $data = array(
            'product_order_uniqueid' => $product_uniqueid,
            'user_id' => $user_id,
            'date' => $this->security->xss_clean($this->input->post('product_reorder_date')),
            'time' => $this->security->xss_clean($this->input->post('product_reorder_time')),
        );

        $this->db->insert('product_reorders', $data);
        return $this->db->insert_id();
    }

    public function do_restaurant_reorder($user_id, $restaurant_uniqueid) {
        $data = array(
            'restaurant_order_uniqueid' => $restaurant_uniqueid,
            'user_id' => $user_id,
            'date' => $this->security->xss_clean($this->input->post('restaurant_reorder_date')),
            'time' => $this->security->xss_clean($this->input->post('restaurant_reorder_time')),
        );
        $this->db->insert('restaurant_reorders', $data);
        return $this->db->insert_id();
    }

    public function get_unique_order_id_byproductid($item_id) {
        $this->db->select('order_unique_id');
        $query = $this->db->get_where('store_order_detail', ['product_id' => $item_id]);
        return $query->row_array();
    }

    public function update_store_status($user_id, $orderid) {
        $this->db->update('store_order', ['status' => 'Return'], ['user_id' => $user_id, 'order_unique_id' => $orderid]);
        return $this->db->affected_rows();
    }

    public function update_restaurant_status($restaurant_id, $user_id) {
        $this->db->update('restaurant_orders', ['order_status' => 'Return'], ['user_id' => $user_id, 'restaurant_id' => $restaurant_id]);
        return $this->db->affected_rows();
    }

    // For front end city listing
    public function getAllCities() {
        $query = $this->db->get('city');
        return $query->result_array();
    }

    public function getCityNameByCityId($city_id) {
        $query = $this->db->get_where('city', ['city_id' => $city_id]);
        return $query->row_array();
    }

    public function insert_user_activationcode($activationcode, $result) {
        $data = array(
            'user_id' => $result['user_id'],
            'activationcode' => $activationcode
        );
        $this->db->insert('user_email_verify', $data);
        return $this->db->insert_id();
    }

    public function doChangeForgotPasswordUser() {
        $data = array(
            'password' => hash('sha256', $this->security->xss_clean($this->input->post('password'))),
        );
        $id = $this->security->xss_clean($this->input->post('userid'));
        $this->db->update('user', $data, ['user_id' => $id, 'source' => 'self']);
        return $this->db->affected_rows();
    }

    public function update_user_email_status($user_id, $activationcode) {

        $query = $this->db->get_where('user_email_verify', ['user_id' => $user_id, 'activationcode' => $activationcode, 'status' => 'Inactive']);

        if (!empty($query->row_array())) {
            $this->db->update('user_email_verify', ['status' => 'Active'], ['user_id' => $user_id, 'activationcode' => $activationcode]);
            return $this->db->affected_rows();
        } else {
            return false;
        }
    }

    public function getToppingdata() {
        $query = $this->db->get('toppings');
        return $query->result_array();
    }

    public function getMenuIdByRestaurantId($restaurant_id) {
        $this->db->select('menu_id');
        $query = $this->db->get_where('menu', ['restaurant_id' => $restaurant_id]);
        return $query->result_array();
    }
    
    public function getUserAddress($user_id) {
        $query = $this->db->get_where('user_search_address', ['user_id' => $user_id]);
        return $query->result_array();
    }
    
    public function saveUserAddress($user_id, $user_address) {
        $data = array(
            'user_id' => $user_id,
            'address' => $user_address
        );
        $this->db->insert('user_search_address', $data);
        return $this->db->insert_id();
    }
    
    public function get_productid_by_skuid($sku){
        $query = $this->db->get_where('product_sku', ['sku'=>$sku]);
        return $query->row_array();
    }
}
