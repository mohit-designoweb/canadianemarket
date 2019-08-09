<?php

/**
 * Description of MarketPlace
 *
 * @author Mohit Kant Gupta
 */
class MarketPlace extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ecommerce_model');
        $this->load->config('facebook');
    }
    
    public function getFilterCountry(){
        $countries=$this->ecommerce_model->getCountry();
        $list=[''=>'Select Country'];
        foreach($countries as $country){
            $list[$country['country_id']]=$country['country_name'];
        }
        return $list;
    }

    public function getDataByUniqueId() {
        if (!empty($this->session->userdata('unique_id'))) {
            $unique_id = $this->session->userdata('unique_id');
            $data = $this->ecommerce_model->getDataByUniqueId($unique_id);
            return $data;
        }
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
        $data['title'] = 'Market Place';
		$data['countries'] = $this->getFilterCountry();
        $data['categories'] = $this->storeCategoryAndCount();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/market-place/market-place', $data);
        $this->load->view('front/commons/footer');
    }
	 public function storeCategoryAndCount() {
        $i = 0;
        $list = [];
        $categories = $this->ecommerce_model->getAllStoreCategory();
        foreach ($categories as $category) {
        $stores = $this->ecommerce_model->getProductByStoreId($category['category_id']);
        $distance = $this->geCategorytDistanceData($stores['latitude'],$stores['longitude']);
        if($distance<=30){
//        echo "<pre>";
//        print_r($stores);
//        echo "<pre>";die;
//            $store = $this->getCategoryDistanceData($stores);
//            $total = count($store);
//            if ($total != 0) {
            if($stores['total']>=1){
                $list[$i]['category_name'] = $stores['category_name'];
                $list[$i]['category_id'] = $stores['category_id'];
                $list[$i]['total'] = $stores['total'];
            }
            $i++;
        }
        }
        return $list;
    }
	public function geCategorytDistanceData($lat,$lng) {
        $latitude = $this->input->cookie('latitude',true);
        $longitude = $this->input->cookie('longitude',true);
      //  echo $latitude.$longitude; die;
        $distance = round($this->distance($latitude, $longitude, $lat, $lng, "K"), 1);
        return $distance;
           
    }

    public function get_market_place_wrapper($category_id, $start = null) {
        $data['user_data'] = $user_data= $this->getDataByUniqueId();
        $this->output->set_content_type('application/json');
        $list = array();
        if (!empty($start)) {
            $srt = $start;
        } else {
            $srt = 0;
        }

        $store_ids= $this->ecommerce_model->getStoreIdBycategoryId($category_id);
//        print_r($store_ids);
        
//        foreach($store_ids as $store_id){
//            print_r($store_id);
//        }
//        
//        die;
        
        $count = $this->ecommerce_model->getProductCountByStoreIds($store_ids);
        
        
        $this->load->library('pagination');
        $config = array();

        $config["base_url"] = base_url('/marketPlace/get-market-place-wrapper/' . $category_id);
        $config["total_rows"] = $count['count'];
        $config["per_page"] = 12;

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

        $data['products'] = $this->getFilteredProduct($config["per_page"], $srt, $category_id);
        
        $i = 0;
        foreach ($data['products'] as $product) {
            $list[$i]['store_name'] = $product['store_name'];
            $list[$i]['product_id'] = $product['product_id'];
            $list[$i]['shop_section_id'] = $product['shop_section_id'];
            $list[$i]['store_id'] = $product['store_id'];
            $list[$i]['image_url'] = $product['image_url'];
            $list[$i]['product_name'] = $product['product_name'];
            $list[$i]['description'] = $product['description'];
            $list[$i]['price'] = $product['price'];
            $list[$i]['discount'] = $product['discount'];
            $list[$i]['emarket_point'] = $product['emarket_point'];
            $list[$i]['is_active'] = $product['is_active'];

            $wishlist = $this->ecommerce_model->getStoreProductWishlist($product['product_id'],$user_data['user_id']);
            
            $list[$i]['user_id'] = $wishlist['user_id'];
            $list[$i]['product_wish'] = $wishlist['product_id'];
            $i++;
            
        }
        $data['products'] = $list;
//        echo "<pre>";
//        print_r($data['products']);exit();
        
        $content_wrapper = $this->load->view('front/market-place/market-place-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
     public function getFilteredProduct($per_page, $srt, $category_id) {
         
        $search_value = $this->input->post('search_val');
        $filter_data = $this->input->post('filter_val');
        $store_ids= $this->ecommerce_model->getStoreIdBycategoryId($category_id);
        $store_ids = $this->getDistanceData($store_ids);
//        echo "<pre>";
//        print_r($store_ids);
//        echo "<pre>";die;
        if(!empty($filter_data))
        {
            if($filter_data == "low-to-high")
            {
                $product = $this->ecommerce_model->getProductByLowToHigh($per_page, $srt, $store_ids);
            }
            else if($filter_data == "high-to-low")
            {
                 $product = $this->ecommerce_model->getProductByHighToLow($per_page, $srt, $store_ids);
            }
        }
        else if(!empty($search_value))
        {
            $product = $this->ecommerce_model->getProductBySearch($per_page, $srt, $store_ids,$search_value);
        }
       
        else
        {
          
        $product = $this->ecommerce_model->getLimitedActiveMarketPlaceProduct($per_page, $srt, $store_ids);
        }
       
        return $product;
    }
    public function getDistanceData($store_ids) {

        $list = [];
        $i = 0;
        $latitude = $this->input->cookie('latitude',true);
        $longitude = $this->input->cookie('longitude',true);
        foreach ($store_ids as $store_id) {
            $store_detail = $this->ecommerce_model->getStoreDetailById($store_id['store_id']);
            $distance = round($this->distance($latitude, $longitude, $store_detail['latitude'], $store_detail['longitude'], "K"), 1);
            if ($distance <= 30) {
                $list[$i]['store_id'] = $store_detail['store_id'];
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
    
    public function product($product_name) {
        $data['product'] = $product = $this->ecommerce_model->getProductIdByProductName(str_replace('-', ' ', $product_name));
        $data['product_sku'] = $product_sku = $this->ecommerce_model->getSingleProductSkuByProductId($product['product_id']);
        $data['user_data'] = $this->getDataByUniqueId();
        $data['title'] = 'Store';
		$data['countries'] = $this->getFilterCountry();
        $data['user_data'] = $this->getDataByUniqueId();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/product/product');
        $this->load->view('front/commons/footer');
    }

}
