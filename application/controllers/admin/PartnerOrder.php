<?php

/**
 * Description of PartnerRestaurant
 *
 * @author Manish Khandelwal
 */
class PartnerOrder extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model', 'partner_model', 'restaurant_model']);
        if (empty($this->session->userdata('email_partner'))) {
            redirect(base_url('partner'));
        }
        $this->is_partner = $this->session->userdata('is_partner');
    }

    public function getUserData() {
        $email = $this->session->userdata('email_partner');
        return $this->admin_model->getUserdata($this->is_partner, $email);
    }

    private function filteredPartner() {
        $list = ['' => 'Select the Partner'];
        $partners = $this->partner_model->getActivePartner();
        foreach ($partners as $partner) {
            $list[$partner['partner_id']] = $partner['first_name'] . ' ' . $partner['last_name'];
        }
        return $list;
    }

    private function getFilteredCategories() {
        $list = ['' => '--Select The Category--'];
        $categories = $this->partner_model->getAllActiveCategory();
        foreach ($categories as $category) {
            $list[$category['restaurant_category_id']] = $category['category_name'];
        }
        return $list;
    }

    public function index() {
        $data['title'] = 'Restaurant Orders';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $data['is_admin'] = $this->session->userdata('is_admin');
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/partner-sidebar', $data);
        $this->load->view('admin/partner-order-management/view-order');
        $this->load->view('admin/commons/footer');
    }

    public function get_partner_restaurant_order_wrapper() {
        $this->output->set_content_type('application/json');
        $partner = $this->getUserData();
        $data['orders'] = $this->partner_model->getOrderData($partner['partner_id']);
        $content_wrapper = $this->load->view('admin/partner-order-management/order-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    private function getAllActiveCourier() {
        $list = ['' => '---SELECT COURIERS---'];
        $couriers = $this->partner_model->getAllActiveCourier();
		
        $filtered_couriers = $this->getDistanceData($couriers);
        foreach ($filtered_couriers as $courier) {
            $list[$courier['courier_id']] = $courier['courier_name']."  -  ".$courier['distance']." K.M Away";
        }
        return $list;
    }
    public function getDistanceData($couriers) {
        $list = [];
        $i = 0;
        $latitude = $this->session->userdata('restaurant_latitude');
        $longitude = $this->session->userdata('restaurant_longitude');

        foreach ($couriers as $courier) {
            $list[$i]['courier_id'] = $courier['courier_id'];
            $list[$i]['name'] = $courier['first_name']." ".$courier['last_name'];
            $list[$i]['distance'] = round($this->distance($latitude, $longitude, $courier['latitude'], $courier['longitude'], "K"), 1);
            $i++;
        }

        $list;
        $newList = [];
        $j = 0;
        foreach ($list as $resByDis) {
            if ($resByDis['distance'] <= 30) {
                $newList[$j]['courier_id'] = $resByDis['courier_id'];
                $newList[$j]['courier_name'] = $resByDis['name'];;
                $newList[$j]['distance'] = $resByDis['distance'];
                $j++;
            }
        }
        return $newList;
    }
    public function distance($lat1, $lon1, $lat2, $lon2, $unit) {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }

//    public function getOrderDetail($orders) {
//        $length = count($orders);
//        $order_detail = [];
//
//        for ($i = 0; $i < $length; $i++) {
//            $order_id = $orders[$i]['order_id'];
//            $rest_id = $orders[$i]['restaurant_id'];
//            $user_id = $orders[$i]['user_id'];
//            $menu_id = $orders[$i]['menu_id'];
//            $order_info = $this->partner_model->getOrderDetailById($order_id);
//            $rest_info = $this->partner_model->getRestDetailById($rest_id);
//            $user_info = $this->partner_model->getUserDetailById($user_id);
//            $menu = $this->partner_model->getMenuDetailById($menu_id);
//            $order_detail[$i] = array_merge($rest_info, $user_info, $menu, $order_info);
//        }
//        $this->session->set_userdata('order_Detail', $order_detail);
//        return $order_detail;
//    }

     public function viewOrderDetail($id, $restaurant_id = NULL) {
        if (!empty($restaurant_id)) {
            $restaurant_detail = $this->partner_model->getRestaurantDetailById($restaurant_id);
            $this->session->set_userdata('restaurant_id', $restaurant_detail['restaurant_id']);
            $this->session->set_userdata('restaurant_latitude', $restaurant_detail['latitude']);
            $this->session->set_userdata('restaurant_longitude', $restaurant_detail['longitude']);
        }
        $data['order_detail1'] = $this->partner_model->getOrderDetailById($id);
        $data['user_info'] = $this->partner_model->getUserDetailById($data['order_detail1']['user_id']);
        $data['menu'] = $this->partner_model->getMenuDetailById($data['order_detail1']['menu_id']);
        // $data['courier'] = $this->partner_model->getCourierDetailById($data['order_detail1']['courier_id']);
        $data['order_detail'] = $this->partner_model->getOrderDetailByUniqueId($data['order_detail1']['unique_order_id']);
        if ($data['order_detail1']['courier_id'] != "") {
            $data['courierDetail'] = $this->partner_model->getCourierDetailById($data['order_detail1']['courier_id']);
        }
        $data['order_id'] = $id;
        $data['couriers'] = $this->getAllActiveCourier();
        $data['detail'] = $this->session->userdata('order_Detail');
        $data['user'] = $this->getUserData();
        $data['title'] = 'Restaurant Orders';
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/partner-sidebar', $data);
        $this->load->view('admin/partner-order-management/add-order');
        $this->load->view('admin/commons/footer');
    }

    public function getCourierStatusWrapper($id) {
        $this->output->set_content_type('application/json');
        $data['order_detail'] = $order_detail = $this->partner_model->getOrderDetailById($id);
        $data['order_id'] = $id;
        if ($order_detail['order_status'] == "Processing") {
            $courier_wrapper = $this->load->view('admin/partner-order-management/includes/courier-processing-wrapper', $data, true);
            $this->output->set_output(json_encode(['result' => 1, 'courier_wrapper' => $courier_wrapper]));
            return false;
        }
        if ($order_detail['order_status'] == "Dispatched") {
            $data['couriers'] = $this->getAllActiveCourier();
            $courier_wrapper = $this->load->view('admin/partner-order-management/includes/courier-dispatched-wrapper', $data, true);
            $this->output->set_output(json_encode(['result' => 1, 'courier_wrapper' => $courier_wrapper]));
            return false;
        }
        if ($order_detail['order_status'] == "Accepted") {
            $courier_wrapper = $this->load->view('admin/partner-order-management/includes/courier-accepted-wrapper', $data, true);
            $this->output->set_output(json_encode(['result' => 1, 'courier_wrapper' => $courier_wrapper]));
            return false;
        }
        if ($order_detail['order_status'] == "OutForDelivery") {
            $courier_wrapper = $this->load->view('admin/partner-order-management/includes/courier-out-for-delivery-wrapper', $data, true);
            $this->output->set_output(json_encode(['result' => 1, 'courier_wrapper' => $courier_wrapper]));
            return false;
        }
    }

    public function updateOrderStatus($id) {
        $this->output->set_content_type('application/json');
        $status = $this->input->post('status');
        $this->partner_model->updateOrderStatus($status, $id);
        $data['order_id'] = $id;
        $data['couriers'] = $this->getAllActiveCourier();
        $courier_wrapper = $this->load->view('admin/partner-order-management/includes/courier-dispatched-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'courier_wrapper' => $courier_wrapper]));
//        $this->output->set_output(json_encode(['url' => base_url('partner/viewOrderDetail/' . $id . "/".$this->session->userdata('restaurant_id'))]));
        return false;
    }

    public function ip_details($IPaddress) {
        $ipInfo = file_get_contents('http://ip-api.com/json/' . $IPaddress);
        $ipInfo = json_decode($ipInfo);
        $timezone = $ipInfo->timezone;
        date_default_timezone_set($timezone);
        return date_default_timezone_get();
    }

    public function allotOrderToCourier($id) {
        $this->output->set_content_type('application/json');
        $time_zone = $this->ip_details('223.190.127.98'); //$_SERVER['REMOTE_ADDR']
        date_default_timezone_set($time_zone);
        $courier_id = $this->input->post('courier_id');
        $status = $this->partner_model->checkCourierAgentStatus($courier_id);
        $data['order_id'] = $id;
        if ($status) {
            $this->partner_model->allotOrderToCourier($courier_id, $id);
            $courier_wrapper = $this->load->view('admin/partner-order-management/includes/courier-waiting-wrapper', $data, true);
            $this->output->set_output(json_encode(['result' => 1, 'courier_wrapper' => $courier_wrapper]));
            return false;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Sorry!! This courier agent is not available']));
            return false;
        }
    }

    public function checkForCourierConfirmation($order_id) {
        $this->output->set_content_type('application/json');
        $order = $this->partner_model->checkForCourierConfirmation($order_id);
        $data['order_id'] = $order_id;
        if ($order['order_status'] == 'Accepted') {
            $courier_wrapper = $this->load->view('admin/partner-order-management/includes/courier-accepted-wrapper', $data, true);
            $this->output->set_output(json_encode(['result' => 1, 'courier_wrapper' => $courier_wrapper]));
            return false;
        }
        if ($order['order_status'] == 'Rejected') {
            $this->partner_model->changeOrderStatusToDispatched($order_id);
            $data['couriers'] = $this->getAllActiveCourier();
            $courier_wrapper = $this->load->view('admin/partner-order-management/includes/courier-dispatched-wrapper', $data, true);
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Current courier agent is busy.Please select the other agent', 'courier_wrapper' => $courier_wrapper]));
            return false;
        } else {
            $this->output->set_output(json_encode(['result' => 0]));
            return false;
        }
    }

    public function outForDelivery($order_id) {
        $this->output->set_content_type('application/json');
        $this->partner_model->outForDelivery($order_id);
        $data['order_id']=$order_id;
        $courier_wrapper = $this->load->view('admin/partner-order-management/includes/courier-out-for-delivery-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'courier_wrapper' => $courier_wrapper]));
        return false;
    }
     public function store_order()
    {
        $data['title'] = 'Store Orders';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $data['is_admin'] = $this->session->userdata('is_admin');
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/partner-sidebar', $data);
        $this->load->view('admin/partner-store-order-management/view-order');
        $this->load->view('admin/commons/footer');
    }
     public function get_partner_store_order_wrapper() {
        $this->output->set_content_type('application/json');
        $partner = $this->getUserData();
        $data['orders'] = $this->partner_model->getStoreOrderData($partner['partner_id']);
        $content_wrapper = $this->load->view('admin/partner-store-order-management/order-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
     public function viewStoreOrderDetail($unique_order_id) {
         $list = [];
         $i = 0;
        $data['price_detail'] = $this->partner_model->getStorerderDetailById($unique_order_id);
        $data['user_info'] = $this->partner_model->getUserDetailById($data['price_detail']['user_id']);
        $ordered_product_details = $this->partner_model->getOrderedProductDetailDetailById($unique_order_id);
        foreach($ordered_product_details as $product)
        {
            $product_detail = $this->partner_model->getProductDetailByProductId($product['product_id']);
            $list[$i]['product_image'] = $product_detail['image_url'];
            $list[$i]['product_name'] = $product_detail['product_name'];
            $list[$i]['sku'] = $product['product_sku'];
            $list[$i]['price'] = $product_detail['price'];
            $list[$i]['qty'] = $product['qty'];
            $i++;
        }
        $data['order_details'] = $list;
        $data['order_id'] = $id;
        $data['couriers'] = $this->getAllActiveCourier();
        $data['detail'] = $this->session->userdata('order_Detail');
        $data['user'] = $this->getUserData();
        $data['title'] = 'Store Orders';
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/partner-sidebar', $data);
        $this->load->view('admin/partner-store-order-management/add-order');
        $this->load->view('admin/commons/footer');
    }

}
