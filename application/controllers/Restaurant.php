<?php

/**
 * Description of Restaurant
 *
 * @author Mohit Kant Gupta
 */
class Restaurant extends CI_Controller {

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
        $data['title'] = 'Restaurant';
        $data['countries'] = $this->getFilterCountry();
        $data['restaurant_count'] = $this->ecommerce_model->getRestaurantCount();
        $data['nameAndCoutns'] = $this->resCategoryAndCount();
        $data['sliders'] = $this->ecommerce_model->getAllrestaurantSlider();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/restaurant/restaurant-listing');
        $this->load->view('front/commons/footer');
    }

  /* public function resCategoryAndCount() {
        $i = 0;
        $list = [];
        $categories = $this->ecommerce_model->getAllRestaurantCategory();
        foreach ($categories as $category) {
            $category_id = $category['restaurant_category_id'];
            $restaurants = $this->ecommerce_model->getRestaurantByCategoryId($category_id);
            $restaurant = $this->getCategoryDistanceData($restaurants);
            $total = count($restaurant);
            if ($total != 0) {
                $list[$i]['restaurant_category_id'] = $category_id;
                $list[$i]['category_name'] = $category['category_name'];
                $list[$i]['total'] = $total;
            }
            $i++;
        }

        return $list;
    }*/
	public function resCategoryAndCount() {
        $i = 0;
        $list = [];
        $categories = $this->ecommerce_model->getAllRestaurantCategory();
        foreach ($categories as $category) {
            $category_id = $category['restaurant_category_id'];
            $restaurants = $this->ecommerce_model->getRestaurantByCategoryId($category_id);

            $restaurant = $this->getCategoryDistanceData($restaurants);
            $total = count($restaurant);
            if ($total != 0) {
                $list[$i]['restaurant_category_id'] = $category_id;
                $list[$i]['category_name'] = $category['category_name'];
                $list[$i]['total'] = $total;
            }
            $i++;
        }

        return $list;
    }

     public function getCategoryDistanceData($restaurants) {
        $list = [];
        $i = 0;

       $latitude = $this->input->cookie('latitude',true);
       $longitude = $this->input->cookie('longitude',true);
       // echo $latitude.$longitude; 
        foreach ($restaurants as $restaurant) {
            $distance = round($this->distance($latitude, $longitude, $restaurant['latitude'], $restaurant['longitude'], "K"), 1);
           //  echo $distance; die;
            if ($distance <= 30) {
               
                $list[$i]['image_url'] = $restaurant['image_url'];
                $list[$i]['restaurant_name'] = $restaurant['restaurant_name'];
                $list[$i]['address'] = $restaurant['address'];
                $list[$i]['opening_time_from'] = $restaurant['opening_time_from'];
                $list[$i]['opening_time_to'] = $restaurant['opening_time_to'];
                $list[$i]['distance'] = $distance;
            }
            $i++;
        }
        return $list;
    }

    public function get_restaurant_wrapper($restaurant_category, $start = null) {
        $this->output->set_content_type('application/json');
        if (!empty($start)) {
            $srt = $start;
        } else {
            $srt = 0;
        }

        $count = $this->ecommerce_model->getRestaurantCountByRestaurantCategoryId($restaurant_category);
        $this->load->library('pagination');
        $config = array();

        $config["base_url"] = base_url('/restaurant/get-restaurant-wrapper/' . $restaurant_category);
        $config["total_rows"] = $count['count'];
        $config["per_page"] = 30;
//        $config["use_page_numbers"] = False;

        $config["full_tag_open"] = '<ul>';
        $config["full_tag_close"] = '</ul>';

        $config["first_tag_open"] = '<li class="pagination-link">';
        $config["fist_tag_close"] = '</li>';

        $config["num_tag_open"] = '<li class="pagination-link">';
        $config["num_tag_close"] = '</li>';

        $config["cur_tag_open"] = '<li><a href="javascript:void(0)" class="active">';
        $config["cur_tag_close"] = '</a></li>';

        $config["next_tag_open"] = '<li class="pagination-link">';
        $config["next_tag_close"] = '</li>';

        $config["prev_tag_open"] = '<li class="pagination-link">';
        $config["prev_tag_close"] = '</li>';

        $config["last_tag_open"] = '<li class="pagination-link">';
        $config["last_tag_close"] = '</li>';

        $this->pagination->initialize($config);

        $data['links'] = $this->pagination->create_links();

        $restaurant = $this->getFilteredRestaurant($config["per_page"], $srt, $restaurant_category);
	
        $data['restaurants'] = $this->getDistanceData($restaurant);
		
        $data['restaurant_category'] = $restaurant_category;
        $content_wrapper = $this->load->view('front/restaurant/restaurant-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function getFilteredRestaurant($per_page, $srt, $restaurant_category) {
        $search_val = $this->input->post('search_val');
        $filter_val = $this->input->post('filter_val');
        if (!empty($filter_val)) {
            if ($filter_val == 'most_viewed') {
                $restaurant = $this->ecommerce_model->getMostViewedActiveRestaurant($per_page, $srt, $restaurant_category);
            } else if ($filter_val == 'new_restaurant') {
                $restaurant = $this->ecommerce_model->getNewActiveRestaurant($per_page, $srt, $restaurant_category);
            }else if ($filter_val == 'old_restaurant') {
                $restaurant = $this->ecommerce_model->getOldActiveRestaurant($per_page, $srt, $restaurant_category);
            }
            else if ($filter_val == 'free_delivery') {
                $restaurant = $this->ecommerce_model->getFreeDeliveryRestaurant($per_page, $srt, $restaurant_category);
            }
        } else if (!empty($search_val)) {
            $restaurant = $this->ecommerce_model->getRestaurantBySearch($per_page, $srt, $search_val);
        } else {
            $restaurant = $this->ecommerce_model->getLimitedActiveRestaurant($per_page, $srt, $restaurant_category);
        }

        return $restaurant;
    }

    public function getDistanceData($restaurants) {

        $list = [];
        $i = 0;

        $latitude = $this->input->cookie('latitude', true);
        $longitude = $this->input->cookie('longitude', true);

        foreach ($restaurants as $restaurant) {
            $distance = round($this->distance($latitude, $longitude, $restaurant['latitude'], $restaurant['longitude'], "K"), 1);
            if ($distance <= 30) {
                $list[$i]['category_name'] = $restaurant['category_name'];
                $list[$i]['image_url'] = $restaurant['image_url'];
                $list[$i]['restaurant_name'] = $restaurant['restaurant_name'];
                $list[$i]['address'] = $restaurant['address'];
                $list[$i]['opening_time_from'] = $restaurant['opening_time_from'];
                $list[$i]['opening_time_to'] = $restaurant['opening_time_to'];
				$list[$i]['is_open'] = $restaurant['is_open'];
                $list[$i]['distance'] = $distance;
            }
            $i++;
        }

        return $list;
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

    public function restaurant($restaurant_name) {
        $restaurant = $this->ecommerce_model->getRestaurantIdByRestaurantName(str_replace('-', ' ', $restaurant_name));
        $this->getDataByUniqueId();
        $data['title'] = 'Restaurant';
        if (!empty($this->session->userdata('latitude')) & !empty($this->session->userdata('longitude'))) {
            $latitude = $this->session->userdata('latitude');
            $longitude = $this->session->userdata('longitude');
            $restaurant['distance'] = round($this->distance($latitude, $longitude, $restaurant['latitude'], $restaurant['longitude'], "K"), 1);
        }
        
		$data['user_data'] =$user_data= $this->getDataByUniqueId();
        $data['wishlist'] = $this->ecommerce_model->getRestaurantWishlist($restaurant['restaurant_id'],$user_data['user_id']);
		$data['countries'] = $this->getFilterCountry();
        $data['restaurant'] = $restaurant;
        $data['special_menus'] = $this->ecommerce_model->getSpecialRestaurantMenu($restaurant['restaurant_id']);
        $data['restaurant_menus'] = $this->ecommerce_model->getRestaurantMenuByRestaurantId($restaurant['restaurant_id']);
        $data['item_count'] = $this->ecommerce_model->getItemCountByRestaurantId($restaurant['restaurant_id']);
        $this->ecommerce_model->updateVisitCount($restaurant['restaurant_id']);
        $data['review_details'] = $this->ecommerce_model->getRestaurantReviewRestaurantId($restaurant['restaurant_id']);
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/restaurant/restaurant-detail');
        $this->load->view('front/commons/footer');
    }

    public function getRestaurantMenu($menu_category_id, $restaurant_id) {
        $this->output->set_content_type('application/json');
        $data['restaurant_id'] = $restaurant_id;
        $data['menus'] = $this->ecommerce_model->getMenuByMenuCategoryId($menu_category_id);
        $content_wrapper = $this->load->view('front/restaurant/menu-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
	
    public function checkCart() {
        $restaurant_id = $this->input->post('restaurant_id');
        $flag = 0;
        if (!empty($carts = $this->cart->contents())) {
            $carts = $this->cart->contents();
            foreach ($carts as $cart) {
                if ($cart['restaurant_id'] != $restaurant_id | $cart['module'] != 'restaurant') {
                    $flag = 1;
                    break;
                }
            }
        }
        if ($flag == 1) {
            return 1;
        } else {
            return 0;
        }
    }
	
    public function addToCartMenu() {
        $this->output->set_content_type('application/json');
        $this->load->library('cart');

        $check = $this->checkCart();

        if ($check) {
            $this->cart->destroy();
        }

        $data = array(
            'id' => $this->input->post('id'),
            'qty' => $this->input->post('qty'),
            'price' => $this->input->post('price'),
            'name' => $this->input->post('name'),
            'size' => $this->input->post('size'),
            'restaurant_id' => $this->input->post('restaurant_id'),
            'module' => $this->input->post('module')
        );
        $this->cart->insert($data);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

    public function removeFromCart($row_id) {
        $this->output->set_content_type('application/json');
        $this->cart->update(['rowid' => $row_id, 'qty' => 0]);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

    public function get_order_wrapper() {
        $this->output->set_content_type('application/json');
        $restaurant_id = $this->input->post('restaurant_id');
        $data['user_data'] = $this->getDataByUniqueId();
        $data['restaurant'] = $this->ecommerce_model->getRestaurantByRestaurantId($restaurant_id);
        $data['tax_rate'] = $this->ecommerce_model->get_tax_rate();
        $content_wrapper = $this->load->view('front/restaurant/order-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'order_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function get_special_menu_wrapper($restaurant_id) {
        $this->output->set_content_type('application/json');
        $data['restaurant_id'] = $restaurant_id;
        $data['special_menus'] = $this->ecommerce_model->getSpecialRestaurantMenu($restaurant_id);
        $content_wrapper = $this->load->view('front/restaurant/special-menu-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'special_menu_wrapper' => $content_wrapper]));
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
                $this->session->set_userdata('coupon', $result);
                $restaurant_id = $this->input->post('restaurant_id');
                $data['user_data'] = $this->getDataByUniqueId();
                $data['tax_rate'] = $this->ecommerce_model->get_tax_rate();
                $data['restaurant'] = $this->ecommerce_model->getRestaurantByRestaurantId($restaurant_id);
                $content_wrapper = $this->load->view('front/restaurant/order-wrapper', $data, true);
                $this->output->set_output(json_encode(['result' => 1, 'order_wrapper' => $content_wrapper]));
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
        $this->session->unset_userdata('coupon');
        $data['user_data'] = $this->getDataByUniqueId();
        $restaurant_id = $this->input->post('restaurant_id');
        $data['tax_rate'] = $this->ecommerce_model->get_tax_rate();
        $data['restaurant'] = $this->ecommerce_model->getRestaurantByRestaurantId($restaurant_id);
        $content_wrapper = $this->load->view('front/restaurant/order-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'order_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function emarket_points($restaurant_id) {
        $this->output->set_content_type('application/json');
        $check = $this->input->post('check');
        if ($check == '1') {
            $this->session->set_userdata('check', '1');
        } else if ($check == '0') {
            $this->session->unset_userdata('check');
        }
        $data['user_data'] = $this->getDataByUniqueId();
        $data['tax_rate'] = $this->ecommerce_model->get_tax_rate();
        $data['restaurant'] = $this->ecommerce_model->getRestaurantByRestaurantId($restaurant_id);
        $content_wrapper = $this->load->view('front/restaurant/order-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'order_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function check_delivery_type($restaurant_id) {
        $this->output->set_content_type('application/json');
        $delivery_type = $this->input->post('delivery_type');
//      $this->session->unset_userdata('delivery_type');
        $this->session->set_userdata('delivery_type', $delivery_type);
		$data['countries'] = $this->ecommerce_model->getCountry();
        $data['cities'] = $this->getCities();
        $data['user_data'] = $this->getDataByUniqueId();
        $data['tax_rate'] = $this->ecommerce_model->get_tax_rate();
        $data['restaurant'] = $this->ecommerce_model->getRestaurantByRestaurantId($restaurant_id);
        $content_wrapper = $this->load->view('front/restaurant/order-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'order_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    public function apply_tip($restaurant_name) {
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
        $restaurant =  $this->ecommerce_model->getRestaurantIdByRestaurantName(str_replace('-', ' ', $restaurant_name));
        $data['restaurant'] = $this->ecommerce_model->getRestaurantByRestaurantId($restaurant['restaurant_id']);
        $content_wrapper = $this->load->view('front/restaurant/order-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'order_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function checkout_continue($restaurant_name) {
        $this->output->set_content_type('application/json');
        $restaurant_cart = [];
        $restaurant_cart['total_items'] = $this->input->post('total_items');
        $restaurant_cart['subtotal'] = $this->input->post('subtotal');
        $restaurant_cart['discount'] = $this->input->post('discount');
        $restaurant_cart['discounted_total'] = $this->input->post('discounted_total');
        $restaurant_cart['taxed_price'] = $this->input->post('taxed_price');
        $restaurant_cart['credit_points'] = $this->input->post('credit_points');
        $restaurant_cart['service_fee'] = $this->input->post('service_fee');
        $restaurant_cart['delivery_type'] = $this->input->post('delivery_type');
        $restaurant_cart['tip'] = $this->input->post('user_tip_val');
        $restaurant_cart['total'] = $this->input->post('total');
        $restaurant_cart['final_total'] = $this->input->post('final_total');

        $this->session->set_userdata('restaurant_cart', $restaurant_cart);
        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('restaurant/delivery/' . $restaurant_name)]));
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

    public function checkout_details($restaurant_name) {
        if (empty($this->session->userdata('restaurant_cart'))) {
            redirect(base_url('restaurant/' . $restaurant_name));
        }
        $data['title'] = 'Restaurant';
		$data['countries'] = $this->ecommerce_model->getCountry();
        $data['cities'] = $this->getCities();
        $data['restaurant'] = $this->ecommerce_model->getRestaurantIdByRestaurantName(str_replace('-',' ',$restaurant_name));
        $data['restaurant_cart'] = $this->session->userdata('restaurant_cart');
        $data['user_data'] = $user_data = $this->getDataByUniqueId();
		$data['user_address'] = $this->getUserAddress();
        $data['shipping_address'] = $this->ecommerce_model->get_address_by_userid($user_data['user_id']);
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/restaurant/shipping-detail');
        $this->load->view('front/commons/footer');
    }

    public function doadd_address_details() {
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
        $this->form_validation->set_rules('term_agree', 'Term and Condition', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $order_note = $this->security->xss_clean($this->input->post('phone'));
        $this->session->set_userdata('order_note', $order_note);
        $restaurant_name = $this->input->post('restaurant_name');
        $user_data = $this->getDataByUniqueId();
        $result = $this->ecommerce_model->doadd_address_details($user_data['user_id']);
        if (!empty($result)) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('restaurant/payment/'. str_replace(' ', '-', $restaurant_name))]));
            return FALSE;
        }
    }

    public function payment_details($restaurant_name) {
        if (empty($this->session->userdata('restaurant_cart'))) {
            redirect(base_url('site'));
        }
        $data['title'] = 'Restaurant';
		$data['countries'] = $this->ecommerce_model->getCountry();
        $data['cities'] = $this->getCities();
        $data['restaurant_name'] = $restaurant_name;
        $data['user_data'] = $user_data = $this->getDataByUniqueId();
        $data['userpayment_data'] = $this->ecommerce_model->get_payment_card_data_user_id($user_data['user_id']);
        $data['restaurant_cart'] = $this->session->userdata('restaurant_cart');
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/restaurant/payment');
        $this->load->view('front/commons/footer');
    }

    public function do_final_payment() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('card_holder', 'Name on card', 'trim|required');
        $this->form_validation->set_rules('card_number', 'Card Numbefr', 'trim|required|numeric');
        $this->form_validation->set_rules('month', 'Expiration Months', 'trim|required');
        $this->form_validation->set_rules('year', 'Expiration Year', 'trim|required');
        $this->form_validation->set_rules('card_code', 'Card security code', 'trim|required|numeric');
//        $this->form_validation->set_rules('payment_method', 'Payment Method', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $payment_data = array(
            'stripetoken' => $this->input->post('stripeToken')
        );
        $user_data = $this->getDataByUniqueId();
        $this->ecommerce_model->save_user_payment_data($user_data['user_id']);
        $this->session->set_userdata('payment_data', $payment_data);
        $restaurant_name = $this->input->post('restaurant_name');
        redirect('restaurant/do-secure-stripe-payment/'.str_replace(' ','-',$restaurant_name));
//        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('restaurant/do-secure-stripe-payment')]));
//        return FALSE;
    }

    public function uniqueId() {
        $str = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNIPQRSTUVWXYZ';
        $nstr = str_shuffle($str);
        $unique_id = substr($nstr, 0, 14);
        return $unique_id;
    }

    public function stripe_payment($restaurant_name) {
        if (empty($this->session->userdata('payment_data')) || empty($this->session->userdata('restaurant_cart')) || empty($this->cart->contents())) {
            redirect(base_url('restaurant/' . $restaurant_name));
        }
        
        $menu_id = array();
        $menu_name = array();
        foreach ($this->cart->contents() as $menu) {
            array_push($menu_id, preg_replace('/(?<!\ )[A-Z]/', ' $0', $menu['id']));
            array_push($menu_name, preg_replace('/(?<!\ )[A-Z]/', ' $0', $menu['name']));
        }
      
        $user_data = $this->getDataByUniqueId();
        $restaurant_cart = $this->session->userdata('restaurant_cart');
        $payment_data = $this->session->userdata('payment_data');
        $user_points = $this->session->userdata('check');
        $restaurant = $this->ecommerce_model->getRestaurantIdByRestaurantName(str_replace('-', ' ',$restaurant_name));

        require_once('application/libraries/stripe-php/init.php');
        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));

        $charge = \Stripe\Charge::create([
                    "amount" => str_replace(',','',strtok($restaurant_cart['final_total'], '.')),
                    "currency" => "usd",
                    "source" => $payment_data['stripetoken'],
                    "description" => "Test payment for Gift Card"
        ]);
        $chargeJson = $charge->jsonSerialize();

        /*  for insert data in database start */
        $menu_name = implode(",", $menu_name);
        $menu_id = implode(",", $menu_id);
        $restaurant_id = $restaurant['restaurant_id'];
        $item_price = round($restaurant_cart['final_total']);
        $currency = "usd";
        $order_id = $this->uniqueId();
        $amount = $chargeJson['amount'];
        $txn_id = $chargeJson['balance_transaction'];
        $currency = $chargeJson['currency'];
        $status = $chargeJson['status'];

        $order_data = array(
            'user_id' => $user_data['user_id'],
            'restaurant_id' => $restaurant_id,
            'menu_id' => $menu_id,
            'unique_order_id' => $order_id,
            'txn_id' => $txn_id,
            'total_amount' => $amount,
            'order_type' => 1,
            'order_note' => $this->session->userdata('order_note'),
            'order_date' => date('d-m-Y'),
            'order_time' => date('H:i:s')
        );

        $restaurant_order_id = $this->ecommerce_model->restaurant_order_place($order_data);
        $orderdata = $this->ecommerce_model->get_orderdata_by_order_id($restaurant_order_id);
        $unique_order_id = $orderdata['unique_order_id'];       
        if(!empty($unique_order_id)){
            $this->session->set_flashdata('success', 'Payment made successfully.');
            redirect(base_url('restaurant/order-detail/'.$unique_order_id));
        }
    }
    
    public function cash_on_delivery($restaurant_name){
        $this->output->set_content_type('application/json');
        if (empty($this->session->userdata('restaurant_cart')) || empty($this->cart->contents())) {
            redirect(base_url('restaurant/' . $restaurant_name));
        }
        
        $menu_id = array();
        $menu_name = array();
        foreach ($this->cart->contents() as $menu) {
            array_push($menu_id, preg_replace('/(?<!\ )[A-Z]/', ' $0', $menu['id']));
            array_push($menu_name, preg_replace('/(?<!\ )[A-Z]/', ' $0', $menu['name']));
        }
      
        $user_data = $this->getDataByUniqueId();
        $restaurant_cart = $this->session->userdata('restaurant_cart');
        
        $restaurant = $this->ecommerce_model->getRestaurantIdByRestaurantName(str_replace('-', ' ',$restaurant_name));
        
        $order_data = array(
            'user_id' => $user_data['user_id'],
            'restaurant_id' => $restaurant['restaurant_id'],
            'menu_id' => implode(",", $menu_id),
            'unique_order_id' => $this->uniqueId(),
            'txn_id' => '0',
            'total_amount' => $restaurant_cart['final_total'],
            'order_type' => 0,
            'order_note' => $this->session->userdata('order_note'),
            'order_date' => date('d-m-Y'),
            'order_time' => date('H:i:s')
        );
       
        $restaurant_order_id = $this->ecommerce_model->restaurant_order_place($order_data);
        $orderdata = $this->ecommerce_model->get_orderdata_by_order_id($restaurant_order_id);
        $unique_order_id = $orderdata['unique_order_id'];
        if(!empty($unique_order_id)){
//            $this->session->set_flashdata('success', 'Payment made successfully.');
//            redirect(base_url('restaurant/payment-success/'.$unique_order_id));
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('restaurant/order-detail/'.$unique_order_id)]));
            return FALSE;
        }
    }
    
    public function order_detail_submit($unique_order_id){
        if(!empty($this->cart->contents())){
            $restaurant_cart = $this->session->userdata('restaurant_cart');
            $user_points = $this->session->userdata('check');
            $order_detail = array(
                'unique_order_id' => $unique_order_id,
                'sub_total' => $restaurant_cart['subtotal'],
                'discount_price' => $restaurant_cart['discount'],
                'tax' => $restaurant_cart['taxed_price'],
                'service_fee' => $restaurant_cart['service_fee'],
                'is_use_points' => $user_points,
                'credit_point' => $restaurant_cart['credit_points'],
                'delivery_charge' => $restaurant_cart['delivery_type'],
                'tip' => $restaurant_cart['tip']
            );
            $order_detail_id = $this->ecommerce_model->restaurant_order_details($order_detail);
            if(!empty($order_detail_id)){
                redirect(base_url('restaurant/payment-success/'.$unique_order_id));
            }
        }
    }

    public function success_order($unique_order_id) {

            $this->session->unset_userdata('coupon');
            $this->session->unset_userdata('check');
            $this->session->unset_userdata('delivery_type');
            $this->session->unset_userdata('payment_data');
            $this->session->unset_userdata('restaurant_cart');
            $this->session->unset_userdata('order_note');
            $this->session->unset_userdata('tip');
            $this->session->unset_userdata('tip_value');
            $this->cart->destroy();
			$data['countries'] = $this->ecommerce_model->getCountry();
			$data['cities'] = $this->getCities();
			$data['countries'] = $this->ecommerce_model->getCountry();
			$data['cities'] = $this->getCities();
            $data['user_data'] = $this->getDataByUniqueId();
            $this->load->view('front/commons/header',$data);
            $this->load->view('front/restaurant/success-order');
            $this->load->view('front/commons/footer');
    }
	
	public function restaurantProductWishlist($restaurant_id, $user_id) {
        $this->output->set_content_type('application/json');
        $checkingResponse = $this->ecommerce_model->checkRestaurantWishlist($restaurant_id, $user_id);
        if ($checkingResponse) {
            $this->output->set_output(json_encode(['result' => 1]));
            return FALSE;
        } else {
            $response = $this->ecommerce_model->addRestaurantWishlist($restaurant_id, $user_id);
            $this->output->set_output(json_encode(['result' => 1]));
            return FALSE;
        }
    }
	
    
}
