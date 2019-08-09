<?php

/**
 * Description of service_provider_model
 *
 * @author Mohit Kant Gupta
 */
class Courier_model extends CI_Model {

    public function getCourier() {
        $query = $this->db->get('courier');
        return $query->result_array();
    }
    public function getCourierEnquiry()
    {
        $query = $this->db->get('courier_query');
        return $query->result_array();
    }
    
     public function getCourierById($id) {
        $query = $this->db->get_where('courier', ['courier_id' => $id]);
        return $query->row_array();
    }
    
    public function doAddCourier($image_url) {
        $password = $this->security->xss_clean(hash('sha256', $password));
        $data = array(
            'first_name' => $this->security->xss_clean($this->input->post('first_name')),
            'last_name' => $this->security->xss_clean($this->input->post('last_name')),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'image_url' => $image_url,
            'password' =>$this->security->xss_clean(hash('sha256',$this->input->post('password'))),
            'address1' => $this->security->xss_clean($this->input->post('store_address1')),
            'address2' => $this->security->xss_clean($this->input->post('store_address2')),
            'city' => $this->security->xss_clean($this->input->post('city')),
            'state' => $this->security->xss_clean($this->input->post('state')),
            'zipcode' => $this->security->xss_clean($this->input->post('zipcode')),
            'country' => $this->security->xss_clean($this->input->post('country')),
            'phone' => $this->security->xss_clean($this->input->post('phone_no')),
        );
        $this->db->insert('courier', $data);
        return $this->db->insert_id();
    }
    
     public function doEditCourier($id,$image_url) {
       $data = array(
            'first_name' => $this->security->xss_clean($this->input->post('first_name')),
            'last_name' => $this->security->xss_clean($this->input->post('last_name')),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'image_url' => $image_url,
            'address1' => $this->security->xss_clean($this->input->post('store_address1')),
            'address2' => $this->security->xss_clean($this->input->post('store_address2')),
            'city' => $this->security->xss_clean($this->input->post('city')),
            'state' => $this->security->xss_clean($this->input->post('state')),
            'zipcode' => $this->security->xss_clean($this->input->post('zipcode')),
            'country' => $this->security->xss_clean($this->input->post('country')),
            'phone' => $this->security->xss_clean($this->input->post('phone_no'))
        );
        $this->db->update('courier', $data, ['courier_id' => $id]);
        return $this->db->affected_rows();
    }
    
    public function doDeleteCourier($id)
    {
        $this->db->delete('courier',['courier_id'=>$id]);
        return $this->db->affected_rows();
    }
    public function changeStatus($id, $status) {
        $this->db->update('courier', ['is_active' => $status], ['courier_id' => $id]);
        return $this->db->affected_rows();
    }
     public function viewCourierEnquiry($id)
    {
        $query = $this->db->get_where('courier_query', ['courier_query_id'=>$id]);
        return $query->row_array();
    }
	////Courier Order Detail Function Start From Here
    public function setCourierLocation($latitude, $longitude, $id) {
        $data = array(
            'latitude' => $latitude,
            'longitude' => $longitude
        );
        $this->db->update('courier', $data, ['courier_id' => $id]);
        return $this->db->affected_rows();
    }

    public function startService($id, $now) {

        $this->db->update('courier', ['service_status' => 'Active', 'service_start_time' => $now], ['courier_id' => $id]);
        return $this->db->affected_rows();
    }

    public function endService($id) {
        $this->db->update('courier', ['service_status' => 'Inactive'], ['courier_id' => $id]);
        return $this->db->affected_rows();
    }

    public function getRestaurantOrderDetail($id) {
        $this->db->select('restaurant_order_id,status');
        $result = $this->db->get_where('courier_order_mapping', ['courier_id' => $id,'rejected_by_courier'=>'No']);
        return $result->result_array();
    }

    public function getSingleRestaurantOrderDetail($id) {
        $this->db->select('restaurant_order_id,status');
        $result = $this->db->get_where('courier_order_mapping', ['courier_id' => $id]);
        return $result->row_array();
    }

    public function getRestaurantUserDetail($order_id) {
        $this->db->select('r.restaurant_name,ro.order_id,ro.order_date,ro.order_time,ro.total_amount,rod.sub_total,com.courier_order_mapping_id,com.order_date,com.order_time,com.status');
        $this->db->from('restaurant_orders ro');
        $this->db->join('restaurant r', 'ro.restaurant_id=r.restaurant_id');
        $this->db->join('restaurant_order_details rod', 'ro.unique_order_id=rod.unique_order_id');
        $this->db->join('courier_order_mapping com', 'com.restaurant_order_id=ro.order_id');
        $this->db->where('ro.order_id', $order_id['restaurant_order_id']);
        $this->db->group_by('r.restaurant_id');
        $result = $this->db->get();
        return $result->row_array();
    }
    
    public function getSingleRestaurantUserDetail($restaurant_order_id) {
        $this->db->select('r.restaurant_name,ro.order_id,ro.order_date,ro.order_time,ro.total_amount,rod.sub_total,com.courier_order_mapping_id,com.order_date,com.order_time,com.status');
        $this->db->from('restaurant_orders ro');
        $this->db->join('restaurant r', 'ro.restaurant_id=r.restaurant_id');
        $this->db->join('restaurant_order_details rod', 'ro.unique_order_id=rod.unique_order_id');
        $this->db->join('courier_order_mapping com', 'com.restaurant_order_id=ro.order_id');
        $this->db->where('ro.order_id', $restaurant_order_id);
        $this->db->where('com.status', '0');
        $this->db->group_by('r.restaurant_id');
        $result = $this->db->get();
        return $result->row_array();
    }

    public function getOrderDetailById($order_id) {
        $result = $this->db->get_where('restaurant_orders', ['order_id' => $order_id]);
        return $result->row_array();
    }

    public function getUserDetailById($user_id) {
        $result = $this->db->get_where('user', ['user_id' => $user_id]);
        return $result->row_array();
    }

    public function getOrderDetailByUniqueId($unique_id) {
        $result = $this->db->get_where('restaurant_order_details', ['unique_order_id' => $unique_id]);
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

    public function updateCourierOrderMappingStatus($courier_order_mapping_id) {
        $this->db->update('courier_order_mapping', ['status' => '1'], ['courier_order_mapping_id' => $courier_order_mapping_id]);
        return $this->db->affected_rows();
    }

    public function getOrderDateTime($id) {
        $result = $this->db->get_where('courier_order_mapping', ['restaurant_order_id' => $id]);
        return $result->row_array();
    }

    public function updateCourierAvailableStatus($id, $status) {
        $this->db->update('courier', ['is_available' => $status], ['courier_id' => $id]);
        return $this->db->affected_rows();
    }

    public function updateOrderAcceptedStatus($mapping_id,$status) {
        $this->db->update('courier_order_mapping', ['order_accepted_status' => $status], ['courier_order_mapping_id' => $mapping_id]);
        return $this->db->affected_rows();
    }

    public function updateCourierDeliveryStatus($id) {
        $this->db->update('courier_order_mapping', ['order_delivery_status' => 'yes'], ['courier_order_mapping_id' => $id]);
        return $this->db->affected_rows();
    }

    public function updateOrderStatusInRestaurant($order_id) {
        $this->db->update('restaurant_orders', ['order_status' => 'Delivered'], ['order_id' => $order_id]);
        return $this->db->affected_rows();
    }

    public function restaurantOrderAcceptedStatus($restaurant_order_id, $status, $courier_id) {
        $this->db->update('restaurant_orders', ['order_status' => $status, 'courier_id' => $courier_id], ['order_id' => $restaurant_order_id]);
        return $this->db->affected_rows();
    }

    public function updateOrderReceivedStatus($courier_order_mapping_id) {
        $this->db->update('courier_order_mapping', ['order_received' => 'Yes'], ['courier_order_mapping_id' => $courier_order_mapping_id]);
        return $this->db->affected_rows();
    }
    
    /// Mohit's Functions
    
    public function orderRejectedByCourier($mapping_id){
        $this->db->update('courier_order_mapping', ['rejected_by_courier' => 'yes'], ['courier_order_mapping_id' => $mapping_id]);
        return $this->db->affected_rows();
    }
    
    public function checkOrderStatus($order_id){
        $query=$this->db->get_where('restaurant_orders',['order_id'=>$order_id,'order_status'=>'OutForDelivery']);
        return $query->row_array();
    }
    //password change function
     public function doUpdateCourierPassword($courierId){
        $data = array(
        'password' => $this->security->xss_clean(hash('sha256',$this->input->post('password')))
        );
        $this->db->update('courier', $data, ['courier_id' => $courierId]);
        return $this->db->affected_rows();
    }
    
    
}