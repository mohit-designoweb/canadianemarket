<?php

/**
 * Description of PartnerRestaurant
 *
 * @author Manish Khandelwal
 */
class PartnerOrder extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model', 'partner_model','restaurant_model']);
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
        $data['title'] = 'Restaurant';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $data['is_admin']=$this->session->userdata('is_admin');
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/partner-sidebar', $data);
        $this->load->view('admin/partner-order-management/view-order');
        $this->load->view('admin/commons/footer');
    }

    public function get_partner_restaurant_order_wrapper() {
        $this->output->set_content_type('application/json');
		
		$partner = $this->getUserData();
		$data['orders']=$this->partner_model->getOrderData($partner['partner_id']);
		
		
		//$restaurant = $this->partner_model->getSelectedAllRestaurantByPartnerId($partner['partner_id']);
	//	echo '<pre>';
	//	print_r($orders);
	//	echo '</pre>';
		//die;
		
       // $orders = $this->partner_model->getRestaurantOrderByPartnerId($restaurant_id);
		//$data['order_detail'] = $this->getOrderDetail($orders);
		
        $content_wrapper = $this->load->view('admin/partner-order-management/order-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
	
	public function getOrderDetail($orders)
	{
		$length = count($orders);
		$order_detail = [];
		
		for($i=0;$i<$length;$i++)
		{
			$order_id = $orders[$i]['order_id'];
			$rest_id = $orders[$i]['restaurant_id'];
			$user_id = $orders[$i]['user_id'];
			$menu_id = $orders[$i]['menu_id'];
			$order_info = $this->partner_model->getOrderDetailById($order_id);
			$rest_info = $this->partner_model->getRestDetailById($rest_id);
			$user_info = $this->partner_model->getUserDetailById($user_id);
			$menu = $this->partner_model->getMenuDetailById($menu_id);
			$order_detail[$i] = array_merge($rest_info,$user_info,$menu,$order_info);
		}
		$this->session->set_userdata('order_Detail',$order_detail);
		return $order_detail;
	}
	
	public function viewOrderDetail($id,$restaurant_id=NULL) {
        if(!empty($restaurant_id))
        {
        $restaurant_detail = $this->partner_model->getRestaurantDetailById($restaurant_id);
        $this->session->set_userdata('restaurant_id',$restaurant_detail['restaurant_id']);
        $this->session->set_userdata('restaurant_latitude',$restaurant_detail['latitude']);
        $this->session->set_userdata('restaurant_longitude',$restaurant_detail['longitude']);
        }
        $data['order_detail1'] = $this->partner_model->getOrderDetailById($id);
        $data['user_info'] = $this->partner_model->getUserDetailById($data['order_detail1']['user_id']);
        $data['menu'] = $this->partner_model->getMenuDetailById($data['order_detail1']['menu_id']);
        $data['order_detail'] = $this->partner_model->getOrderDetailByUniqueId($data['order_detail1']['unique_order_id']);
        $data['couriers'] = $this->getAllActiveCourier();
        $data['detail'] = $this->session->userdata('order_Detail');
        $data['user'] = $this->getUserData();
        $data['title'] = 'Order Detail';
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/partner-sidebar', $data);
        $this->load->view('admin/partner-order-management/add-order');
        $this->load->view('admin/commons/footer');
    }

    public function updateOrderStatus($id) {
        $this->output->set_content_type('application/json');
        $status = $this->input->post('status');
        $result = $this->partner_model->updateOrderStatus($status, $id);
        $this->output->set_output(json_encode(['url' => base_url('partner/viewOrderDetail/' . $id . "/".$this->session->userdata('restaurant_id'))]));
        return false;
    }

    public function courier() {
        if ($this->input->post('courier_name') === "----SELECT Courier----") {
            $this->form_validation->set_message('courier_name', 'Please Select Courier');
            return false;
        } else {
            return true;
        }
    }

    public function allotOrderToCourier($id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('courier_name', 'Courier Name', 'required|callback_courier');
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'url' => base_url('partner/viewOrderDetail/' . $id. "/".$this->session->userdata('restaurant_id')), 'errors' => $this->form_validation->error_array()]));
            return false;
        }
        $courier_id = $this->input->post('courier_name');
        
        $result = $this->partner_model->allotOrderToCourier($courier_id, $id);
        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('partner/viewOrderDetail/' . $id. "/".$this->session->userdata('restaurant_id')),'url2'=>base_url('courier/view-order')]));
        return false;
    }

   

}
