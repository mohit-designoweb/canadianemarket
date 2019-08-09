<?php

/**
 * Description of Cart
 *
 * @author Mohit Kant Gupta
 */
class Cart extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ecommerce_model');
        $this->load->config('facebook');
    }

    public function getDataByUniqueId() {
        if (!empty($this->session->userdata('unique_id'))) {
            $unique_id = $this->session->userdata('unique_id');
            $data = $this->ecommerce_model->getDataByUniqueId($unique_id);
            return $data;
        }
    }
    
    public function getFilterCountry(){
        $countries=$this->ecommerce_model->getCountry();
        $list=[''=>'Select Country'];
        foreach($countries as $country){
            $list[$country['country_id']]=$country['country_name'];
        }
        return $list;
    }
	
    public function getCities() {
        if (!empty($this->input->cookie('country_id', true))) {
            $country_id = $this->input->cookie('country_id', true);
            $cities = $this->ecommerce_model->getCityByCountry($country_id);
            return $cities;
        } else {
            return null;
        }
    }

    public function index() {
        $data['user_data'] = $this->getDataByUniqueId();
        $data['title'] = 'Cart';
		$data['countries'] = $this->getFilterCountry();
        $data['cities'] = $this->getCities();
        $data['cart_data'] = $this->cartDetails();
        $data['specifications'] = $this->ecommerce_model->getAllSpecification();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/cart/cart');
        $this->load->view('front/commons/footer');
    }

    public function cartDetails() {
        $list = [];
        if (!empty($this->cart->contents())) {
            foreach ($this->cart->contents() as $cart) {
                $list[$cart['id']]['product'] = $this->ecommerce_model->getProductBySku($cart['id']);
                $list[$cart['id']]['sku_mapping'] = $this->ecommerce_model->getSkuMappingBySku($cart['id']);
            }
        }
        return $list;
    }

    public function removeFromCart($rowId) {
        $this->output->set_content_type('application/json');
        $this->cart->update(['rowid' => $rowId, 'qty' => 0]);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

    public function changeQty($rowId) {
        $this->output->set_content_type('application/json');
        $qty = $this->input->post('qty');
        $this->cart->update(['rowid' => $rowId, 'qty' => $qty]);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

    public function get_order_wrapper() {
        $this->output->set_content_type('application/json');
        $data['user_data'] = $this->getDataByUniqueId();
        $data['tax_rate'] = $this->ecommerce_model->get_tax_rate();
        $service_fee;
        if (!empty($this->cart->contents())) {
            foreach ($this->cart->contents() as $cart) {
                $service_fee = $this->ecommerce_model->getServiceFeeBySku($cart['id']);
                break;
            }
        }
        $this->session->set_userdata('service_fee', $service_fee['service_fee']);
        $content_wrapper = $this->load->view('front/cart/order-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function applyCoupon() {
        $this->output->set_content_type('application/json');
        if (!empty($this->cart->contents())) {
            $this->form_validation->set_rules('coupon', 'Coupon', 'required');
            if ($this->form_validation->run() === FALSE) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
                return FALSE;
            }
            $result = $this->ecommerce_model->checkCoupon();
            if ($result) {
                $this->session->set_userdata('store_coupon', $result);
                $data['user_data'] = $this->getDataByUniqueId();
                $data['tax_rate'] = $this->ecommerce_model->get_tax_rate();
                $content_wrapper = $this->load->view('front/cart/order-wrapper', $data, true);
                $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
                return FALSE;
            } else {
                $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Invalid Coupon Code']));
                return FALSE;
            }
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Please Fill The Cart First']));
            return FALSE;
        }
    }

    public function removeCoupon() {
        $this->output->set_content_type('application/json');
        $this->session->unset_userdata('store_coupon');
        $data['user_data'] = $this->getDataByUniqueId();
        $data['tax_rate'] = $this->ecommerce_model->get_tax_rate();
        $content_wrapper = $this->load->view('front/cart/order-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function emarket_points() {
        $this->output->set_content_type('application/json');
        $check = $this->input->post('check');
        if ($check == '1') {
            $this->session->set_userdata('check', '1');
        } else if ($check == '0') {
            $this->session->unset_userdata('check');
        }
        $data['user_data'] = $this->getDataByUniqueId();
        $data['tax_rate'] = $this->ecommerce_model->get_tax_rate();
        $content_wrapper = $this->load->view('front/cart/order-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function apply_tip() {
        $this->output->set_content_type('application/json');
        $tip = $this->input->post('tip');
        $tip_value = $this->input->post('tip_value');
        $this->session->set_userdata('tip', $tip);
        if (!empty($tip_value)) {
            $this->session->set_userdata('tip_value', $tip_value);
        } else {
            $this->session->unset_userdata('tip_value');
        }
        $data['user_data'] = $this->getDataByUniqueId();
        $data['tax_rate'] = $this->ecommerce_model->get_tax_rate();
        $content_wrapper = $this->load->view('front/cart/order-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function checkout_continue() {
        $this->output->set_content_type('application/json');
        $store_cart = [];
        $store_cart['total_items'] = $this->input->post('total_items');
        $store_cart['subtotal'] = $this->input->post('subtotal');
        $store_cart['discount'] = $this->input->post('discount');
        $store_cart['discounted_total'] = $this->input->post('discounted_total');
        $store_cart['taxed_price'] = $this->input->post('taxed_price');
        $store_cart['credit_points'] = $this->input->post('credit_points');
        $store_cart['service_fee'] = $this->input->post('service_fee');
        $store_cart['tip'] = $this->input->post('user_tip_val');
        $store_cart['delivery_type'] = $this->input->post('delivery_type');
        $store_cart['total'] = $this->input->post('total');
        $store_cart['final_total'] = $this->input->post('final_total');
        $this->session->set_userdata('store_cart', $store_cart);
        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('delivery')]));
        return FALSE;
    }
	
	public function getUserAddress()
	{
		$list = [];
		$i = 0;
		$list = [''=>'----SELECT ADDRESS----'];
		$user_data = $this->getDataByUniqueId();
		$addresses = $this->ecommerce_model->getUserAddress($user_data['user_id']);
		foreach($addresses as $address)
		{
			$list[$address['address_id']] = $address['address'];
		}
		return $list;
	}


    public function delivery() {
        if (empty($this->session->userdata('store_cart'))) {
            redirect(base_url('cart'));
        }
        if (empty($this->session->userdata('unique_id'))) {
            redirect(base_url('cart'));
        }
        $data['title'] = 'delivery';
        $data['store_cart'] = $this->session->userdata('store_cart');
		$data['countries'] = $this->getFilterCountry();
        $data['user_data'] = $user_data = $this->getDataByUniqueId();
		$data['user_address'] = $this->getUserAddress();
        $data['shipping_address'] = $this->ecommerce_model->get_address_by_userid($user_data['user_id']);
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/cart/shipping-detail');
        $this->load->view('front/commons/footer');
    }

    public function do_add_address() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required');
        $this->form_validation->set_rules('cmpny', 'Company name', 'trim');
        $this->form_validation->set_rules('country', 'Country Name', 'trim|required');
        $this->form_validation->set_rules('town', 'City Name', 'trim|required');
       // $this->form_validation->set_rules('address', 'Address', 'trim|required');
	   $this->form_validation->set_rules('address_id','Address','required');
        $this->form_validation->set_rules('province', 'Province', 'trim|required');
        $this->form_validation->set_rules('pcode', 'Pin Code', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
        $this->form_validation->set_rules('order_note', 'Delivery Order notes', 'trim');
        $this->form_validation->set_rules('terms', 'Terms and condition', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $user_data = $this->getDataByUniqueId();
        $result = $this->ecommerce_model->doadd_address_details($user_data['user_id']);
        if (!empty($result)) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('payment')]));
            return FALSE;
        }
    }

    public function payment() {
        if (empty($this->session->userdata('store_cart'))) {
            redirect(base_url('cart'));
        }
        if (empty($this->session->userdata('unique_id'))) {
            redirect(base_url('cart'));
        }
		$data['countries'] = $this->getFilterCountry();
        $data['title'] = 'Payment';
        $data['user_data'] = $user_data = $this->getDataByUniqueId();
        $data['userpayment_data'] = $this->ecommerce_model->get_payment_card_data_user_id($user_data['user_id']);
        $data['store_cart'] = $this->session->userdata('store_cart');
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/cart/payment');
        $this->load->view('front/commons/footer');
    }

    public function do_payment() {
        $this->output->set_content_type('application/json');
        $payment_data = array(
            'stripetoken' => $this->input->post('stripeToken')
        );
//        $payment_data = array(
//            'stripetoken' => $this->input->post('stripeToken'),
//            'card_holder' => $this->security->xss_clean($this->input->post('card_holder')),
//            'card_number' => $this->security->xss_clean($this->input->post('card_number')),
//            'months' => $this->security->xss_clean($this->input->post('month')),
//            'years' => $this->security->xss_clean($this->input->post('year')),
//            'card_code' => $this->security->xss_clean($this->input->post('card_code')),
//        );
        $user_data = $this->getDataByUniqueId();
        $this->ecommerce_model->save_user_payment_data($user_data['user_id']);
        $this->session->set_userdata('payment_data', $payment_data);
        redirect(base_url('cart/stripe-payment'));
        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('cart/stripe-payment')]));
        return FALSE;
    }

    public function uniqueId() {
        $str = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNIPQRSTUVWXYZ';
        $nstr = str_shuffle($str);
        $unique_id = substr($nstr, 0, 14);
        return $unique_id;
    }

    public function stripe_payment() {
        if (empty($this->session->userdata('payment_data')) || empty($this->session->userdata('store_cart')) || empty($this->cart->contents())) {
            redirect(base_url('cart'));
        }
        // Payment Section 
        $store_cart = $this->session->userdata('store_cart');
        $payment_data = $this->session->userdata('payment_data');

        require_once('application/libraries/stripe-php/init.php');
        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));

        $charge = \Stripe\Charge::create([
                    "amount" => str_replace(',','',strtok($store_cart['final_total'], '.')),
                    "currency" => "usd",
                    "source" => $payment_data['stripetoken'],
                    "description" => "Test payment for Gift Card"
        ]);
        $chargeJson = $charge->jsonSerialize();
        $user_data = $this->getDataByUniqueId();


        /*  for insert data in database start */
//        $item_name = implode(",", $product_name);
//        $item_number = implode(",", $product_id);
//        $item_price = round($restaurant_cart['final_total']);
//        $currency = "usd";
        $order_id = $this->uniqueId();
        $amount = $chargeJson['amount'];
        $txn_id = $chargeJson['balance_transaction'];
//        $currency = $chargeJson['currency'];
//        $status = $chargeJson['status'];



        $order_data = array(
            'order_unique_id' => $order_id,
            'user_id' => $user_data['user_id'],
            'txn_id' => $txn_id,
            'total_amount' => $amount,
            'discount' => $store_cart['discount'],
            'tax' => $store_cart['taxed_price'],
            'service_fee' => $store_cart['service_fee'],
            'credit_points' => $store_cart['credit_points'],
            'delivery_charge' => $store_cart['taxed_price'],
            'order_type' => 'Credit',
            'order_date' => date('d-m-Y'),
            'order_time' => date('H:i:s'),
            'tip' => $store_cart['tip'],
        );
        
        $store_order_id = $this->ecommerce_model->store_order_place($order_data);
        $orderdata = $this->ecommerce_model->get_store_orderdata_by_id($store_order_id);
        $unique_order_id = $orderdata['order_unique_id'];
        /*  for insert data in database close */
        if(!empty($unique_order_id)){
            $this->session->set_flashdata('success', 'Payment made successfully.');
            redirect(base_url('cart/storeorder-detail/'.$unique_order_id));
        }
    }
    
    
    public function cash_on_delivery(){
        $this->output->set_content_type('application/json');
        if (empty($this->session->userdata('store_cart')) || empty($this->cart->contents())) {
            redirect(base_url('cart'));
        }
        $store_cart = $this->session->userdata('store_cart');
        
        $order_id = $this->uniqueId();
        $user_data = $this->getDataByUniqueId();
   
        $order_data = array(
            'order_unique_id' => $order_id,
            'user_id' => $user_data['user_id'],
            'txn_id' => 0,
            'total_amount' => $store_cart['final_total'],
            'discount' => $store_cart['discount'],
            'tax' => $store_cart['taxed_price'],
            'service_fee' => $store_cart['service_fee'],
            'credit_points' => $store_cart['credit_points'],
            'delivery_charge' => $store_cart['taxed_price'],
            'order_type' => 'Cod',
            'order_date' => date('d-m-Y'),
            'order_time' => date('H:i:s'),
            'tip' => $store_cart['tip'],
        );
       
        $store_order_id = $this->ecommerce_model->store_order_place($order_data);
        $orderdata = $this->ecommerce_model->get_store_orderdata_by_id($store_order_id);
        $unique_order_id = $orderdata['order_unique_id'];
        if(!empty($unique_order_id)){
//            $this->session->set_flashdata('success', 'Payment made successfully.');
//            redirect(base_url('restaurant/payment-success/'.$unique_order_id));
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('cart/storeorder-detail/'.$unique_order_id)]));
            return FALSE;
        }
    }
   
    public function storeorder_detail($unique_order_id){
        if (empty($this->session->userdata('store_cart')) || empty($this->cart->contents())) {
            redirect(base_url('cart'));
        }
        
        foreach ($this->cart->contents() as $products) {
            $productdata = $this->ecommerce_model->get_productid_by_skuid($products['id']);
            $store_order_detail =  array(
                'order_unique_id' => $unique_order_id,
                'product_id' => $productdata['product_id'],
                'price' => $products['price'],
                'qty' => $products['qty'],
            );
            
            $this->ecommerce_model->storeorder_detail($store_order_detail);
        }
        redirect((base_url('cart/success-order/'.$unique_order_id)));
    }

    public function success_order($unique_order_id) {
        $this->session->unset_userdata('payment_data');
        $this->session->unset_userdata('store_cart');
        $this->session->unset_userdata('tip');
        $this->session->unset_userdata('tip_value');
        $this->session->unset_userdata('store_coupon');
        $this->session->unset_userdata('check');
        $this->cart->destroy();
        $data['title'] = 'Success Order';
		$data['countries'] = $this->ecommerce_model->getCountry();
        $data['cities'] = $this->getCities();
        $data['user_data'] = $this->getDataByUniqueId();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/cart/success-order');
        $this->load->view('front/commons/footer');
    }

}
