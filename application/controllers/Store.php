<?php

/**
 * Description of Store
 *
 * @author Mohit Kant Gupta
 */
class Store extends CI_Controller {

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
        $data['title'] = 'Store';
        $data['countries'] = $this->getFilterCountry();
        $data['store_count'] = $this->ecommerce_model->getStoreCount();
        $data['categories'] = $this->storeCategoryAndCount();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/store/stores');
        $this->load->view('front/commons/footer');
    }

    public function storeCategoryAndCount() {
        $i = 0;
        $list = [];
        $categories = $this->ecommerce_model->getAllStoreCategory();

        foreach ($categories as $category) {
            $stores = $this->ecommerce_model->getStoreByCategoryId($category['category_id']);
            $store = $this->getCategoryDistanceData($stores);
            $total = count($store);
            if ($total != 0) {
                $list[$i]['store_category_id'] = $category['category_id'];
                $list[$i]['category_name'] = $category['category_name'];
                $list[$i]['total'] = $total;
            }
            $i++;
        }
        return $list;
    }

    public function getCategoryDistanceData($stores) {
        $list = [];
        $i = 0;

        $latitude = $this->input->cookie('latitude', true);
        $longitude = $this->input->cookie('longitude', true);

        foreach ($stores as $store) {
            $distance = round($this->distance($latitude, $longitude, $store['latitude'], $store['longitude'], "K"), 1);
            if ($distance <= 30) {
                $list[$i]['store_id'] = $store['store_id'];
            }
            $i++;
        }
        return $list;
    }

    public function get_store_wrapper($store_category, $start = null) {

        $this->output->set_content_type('application/json');
        if (!empty($start)) {
            $srt = $start;
        } else {
            $srt = 0;
        }

        $count = $this->ecommerce_model->getStoreCountByStoreCategoryId($store_category);
        $this->load->library('pagination');
        $config = array();

        $config["base_url"] = base_url('/store/get-store-wrapper/' . $store_category);
        $config["total_rows"] = $count['count'];
        $config["per_page"] = 12;
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

        $store = $this->getFilteredStore($config["per_page"], $srt, $store_category);

        $data['stores'] = $this->getDistanceData($store);

        $data['store_category'] = $store_category;
        $content_wrapper = $this->load->view('front/store/store-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function getFilteredStore($per_page, $srt, $store_category) {
        $search_val = $this->input->post('search_val');
        $filter_val = $this->input->post('filter_val');
        if (!empty($filter_val)) {
            if ($filter_val == 'most_viewed') {
                $store = $this->ecommerce_model->getMostViewedActiveStore($per_page, $srt, $store_category);
            } else if ($filter_val == 'review_score') {
                $store = $this->ecommerce_model->getActiveStoreByReviewScore($per_page, $srt, $store_category);
            } else if ($filter_val == 'free_delivery') {
                $store = $this->ecommerce_model->getFreeDeliveryStore($per_page, $srt, $store_category);
            }
            else if ($filter_val == 'new_store') {
                $store = $this->ecommerce_model->getNewActiveStore($per_page, $srt, $store_category);
            }
            else if ($filter_val == 'old_store') {
                $store = $this->ecommerce_model->getOldActiveStore($per_page, $srt, $store_category);
            }
        } else if (!empty($search_val)) {
            $store = $this->ecommerce_model->getStoreBySearch($per_page, $srt, $search_val);
        } else {
            $store = $this->ecommerce_model->getLimitedActiveStore($per_page, $srt, $store_category);
        }
        return $store;
    }

    public function getDistanceData($stores) {
        $list = [];
        $i = 0;
        $latitude = $this->input->cookie('latitude', true);
        $longitude = $this->input->cookie('longitude', true);

        foreach ($stores as $store) {
            $list[$i]['category_name'] = $store['category_name'];
            $list[$i]['image_url'] = $store['image_url'];
            $list[$i]['store_name'] = $store['store_name'];
            $list[$i]['address'] = $store['address'];
            $list[$i]['distance'] = round($this->distance($latitude, $longitude, $store['latitude'], $store['longitude'], "K"), 1);
            $list[$i]['opening_time_from'] = $store['opening_time_from'];
            $list[$i]['opening_time_to'] = $store['opening_time_to'];
            $list[$i]['estimated_delivery_time'] = $store['estimated_delivery_time'];
			$list[$i]['is_status'] = $store['is_status'];
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

    public function store($store_name) {
        $store = $this->ecommerce_model->getStoreIdByStoreName(str_replace('-', ' ', $store_name));
        $data['user_data'] = $this->getDataByUniqueId();
        $data['title'] = 'Store';
        $data['countries'] = $this->getFilterCountry();
        $latitude = $this->input->cookie('latitude', true);
        $longitude = $this->input->cookie('longitude', true);
        $store['distance'] = round($this->distance($latitude, $longitude, $store['latitude'], $store['longitude'], "K"), 1);
        $data['store'] = $store;
        $data['shop_sections'] = $this->shopSectionCount($store['store_id']);
        $data['ratings'] = $this->ecommerce_model->getStoreAllRating($store['store_id']);
        $data['review_count'] = $this->ecommerce_model->countStoreReview($store['store_id']);
        $data['average_rating'] = $this->ecommerce_model->getStoreAvarageRating($store['store_id']);
        $this->ecommerce_model->updateStoreVisitCount($store['store_id']);
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/store/store-listing');
        $this->load->view('front/commons/footer');
    }

    public function shopSectionCount($store_id) {
        $i = 0;
        $list = [];
        $shop_sections = $this->ecommerce_model->getShopSectionByStoreId($store_id);

        foreach ($shop_sections as $shop_section) {
            $products = $this->ecommerce_model->getProductsByShopSectionId($shop_section['shop_section_id']);
            $shopSection = $this->getShopSectionData($products);

            $total = count($shopSection);
            if ($total != 0) {
                $list[$i]['shop_section_id'] = $shop_section['shop_section_id'];
                $list[$i]['shop_section_name'] = $shop_section['shop_section_name'];
                $list[$i]['total'] = $total;
            }
            $i++;
        }
        return $list;
    }

    public function getShopSectionData($products) {
        $list = [];
        $i = 0;
        foreach ($products as $product) {
            $list[$i]['product_id'] = $product['product_id'];
            $i++;
        }
        return $list;
    }

    public function get_product_wrapper($shop_section, $start = null) {
        $this->output->set_content_type('application/json');
        if (!empty($start)) {
            $srt = $start;
        } else {
            $srt = 0;
        }
		$list = array();
        $data['user_data'] = $user_data = $this->getDataByUniqueId();

        $count = $this->ecommerce_model->getProductCountByShopSectionId($shop_section);
        $this->load->library('pagination');
        $config = array();

        $config["base_url"] = base_url('/store/get-shop-section-wrapper/' . $shop_section);
        $config["total_rows"] = $count['count'];
        $config["per_page"] = 12;
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

        $data['products'] = $this->getFilteredProduct($config["per_page"], $srt, $shop_section);

        $data['shop_section_id'] = $shop_section;
		
	$i=0;
        foreach($data['products'] as $product){
            $list[$i]['store_name']= $product['store_name'];
            $list[$i]['product_id']= $product['product_id'];
            $list[$i]['shop_section_id']= $product['shop_section_id'];
            $list[$i]['store_id']= $product['store_id'];
            $list[$i]['image_url']= $product['image_url'];
            $list[$i]['product_name']= $product['product_name'];
            $list[$i]['description']= $product['description'];
            $list[$i]['price']= $product['price'];
            $list[$i]['discount']= $product['discount'];
            $list[$i]['emarket_point']= $product['emarket_point'];
            $list[$i]['is_active']= $product['is_active'];
            
            $wishlist = $this->ecommerce_model->getStoreProductWishlist($product['product_id'],$user_data['user_id']);
            $list[$i]['user_id']= $wishlist['user_id'];
            $list[$i]['product_wish']= $wishlist['product_id'];
            $i++;
        }
        $data['shop_section_id'] = $shop_section;        
        $data['products'] = $list;

        $content_wrapper = $this->load->view('front/store/product-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function getFilteredProduct($per_page, $srt, $shop_section) {
        $search_val = $this->input->post('search_val');
        $filter_val = $this->input->post('filter_val');
        if (!empty($filter_val)) {
            if ($filter_val == 'price_hi_low') {
                $product = $this->ecommerce_model->getActiveHighToLowPriceProduct($per_page, $srt, $shop_section);
            } else if ($filter_val == 'price_low_hi') {
                $product = $this->ecommerce_model->getActiveLowToHighPriceProduct($per_page, $srt, $shop_section);
            }else if ($filter_val == 'free_delivery') {
                $product = $this->ecommerce_model->getFreeDeliveryProduct($per_page, $srt, $shop_section);
            }
            else if($filter_val=='new_product'){
                $product = $this->ecommerce_model->getActiveNewProduct($per_page, $srt, $shop_section);
            }
        } else if (!empty($search_val)) {
           $product = $this->ecommerce_model->getStoreProductBySearch($per_page, $srt,$shop_section, $search_val);
        } else {
            $product = $this->ecommerce_model->getLimitedActiveProduct($per_page, $srt, $shop_section);
        }
        return $product;
    }

        public function product($product_name) {
	    $wishlistProduct = [];
        $i = 0;
        $data['product'] = $product = $this->ecommerce_model->getProductIdByProductName(str_replace('-', ' ', $product_name));
        $data['user_data'] = $this->getDataByUniqueId();

        $data['title'] = 'Store';
        $relatedProductwishlist = $this->ecommerce_model->getRelatedProductWishlist($data['user_data']['user_id']);
        foreach ($relatedProductwishlist as $relProWishlist) {
            $wishlistProduct[$i] = $relProWishlist['product_id'];
            $i++;
        }

        $data['relProWishlist'] = $wishlistProduct;
        $data['related_products'] = $this->ecommerce_model->getRelatedProductByShopSectionId($product['shop_section_id']);
        
        $data['ratings'] = $this->ecommerce_model->getAllRating($product['product_id']);
        $data['review_details'] = $this->ecommerce_model->getStoreReviewByProductId($product['product_id']);

        $data['countries'] = $this->getFilterCountry();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/product/product');
        $this->load->view('front/commons/footer');
    }

//    public function getFilteredProductSku($product_sku_id) {
//        $list = [];
//        $product_sku_mappings = $this->ecommerce_model->getProductSkuMappingByProductSkuId($product_sku_id);
//        foreach ($product_sku_mappings as $mapping) {
//            $list[$mapping['group_id']] = $mapping['group_value'];
//        }
//        return $list;
//    }

    public function get_product_detail_wrapper($product_id) {
        $this->output->set_content_type('application/json');
        $data['user_data'] = $user_data = $this->getDataByUniqueId();
        $data['product'] = $this->ecommerce_model->getProductDetailByProductId($product_id);
        $data['wishlist'] = $this->ecommerce_model->getStoreProductWishlist($product_id,$user_data['user_id']);
        $data['average_rating'] = $this->ecommerce_model->getAvarageRating($product_id);
        $data['ratings'] = $this->ecommerce_model->getAllRating($product_id);
        $data['product_mappings'] = $this->ecommerce_model->getProductSkuMappingByProductSkuId($product_id);
        $data['product_images'] = $this->ecommerce_model->getProductImagesByProductSkuId($product_id);
        $content_wrapper = $this->load->view('front/product/product-detail-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

//    public function getProductSku($product_skus) {
//        $lists = [];
//        $i = 0;
//        foreach ($product_skus as $product_sku) {
//            $products = $this->ecommerce_model->getProductSkuMappingByProductSkuId($product_sku['product_sku_id']);
//            foreach ($products as $product) {
//                $lists[$i][$product['group_id']] = $product['group_value'];
//                $i++;
//            }
//        }
//        $skus = [];
//        foreach ($lists as $values) {
//            foreach ($values as $key => $value) {
//                if (!empty($skus[$key])) {
//                    if (array_key_exists($key, $skus)) {
//                        $value .= ',' . $skus[$key];
//                        $skus[$key] = $value;
//                    }
//                } else {
//                    $skus[$key] = $value;
//                }
//            }
//        }
//        $sku_keys = array_keys($skus);
//        $new_lists = [];
//
//        foreach ($sku_keys as $sku_key) {
//            $new_lists[$sku_key] = explode(',', $skus[$sku_key]);
//        }
//        $sku_lists = [];
//        $i = 0;
//        foreach ($new_lists as $n_list) {
//            $sku_lists[$sku_keys[$i]] = array_unique($n_list);
//            $i++;
//        }
//        return $sku_lists;
//    }
//
//    public function changeSku() {
//        $this->output->set_content_type('application/json');
//        $product_id = $this->input->post('product_id');
//        $group_names = $this->input->post('group_name');
//		
//        $count = count($group_names);
//        $results = $this->ecommerce_model->getProductSku($group_names);
//
//        $product_sku_id;
//
//        if ($count == 1) {
//            foreach ($results as $result) {
//                $product = $this->ecommerce_model->getProductSkuByProductSkuId($result['product_sku_id']);
//                if ($product['product_id'] == $product_id) {
//                    $product_sku_id = $product['product_sku_id'];
//                    break;
//                }
//            }
//        } else {
//            $product_sku_id = $this->getSkuOnChange($results);
//        }
//        if (!empty($product_sku_id)) {
//            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('store/get-product-detail-wrapper/' . $product_id . '/' . $product_sku_id)]));
//            return FALSE;
//        } else {
//            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Sorry, there no more product is available for this size']));
//            return FALSE;
//        }
//    }
//
//    public function getSkuOnChange($results) {
//        $flag = 0;
//        $count = count($results);
//        $product_sku_id;
//        for ($i = 0; $i < $count; $i++) {
//            $sku_id = $results[$i]['product_sku_id'];
//            for ($j = $i + 1; $j < $count - $i; $j++) {
//                if ($sku_id == $results[$j]['product_sku_id']) {
//                    $product_sku_id = $sku_id;
//                }
//                if (!empty($product_sku_id)) {
//                    $flag = 1;
//                    break;
//                }
//            }
//            if ($flag == 1) {
//                break;
//            }
//        }
//        
//        if(!empty($product_sku_id)){
//            return $product_sku_id;
//        }else{
//            return null;
//        }
//        
//    }

    public function checkCart() {
        $flag = 0;
        if (!empty($carts = $this->cart->contents())) {
            $carts = $this->cart->contents();
            foreach ($carts as $cart) {
                if ($cart['module'] != 'store') {
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

    public function addToCartStore() {
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
            'module' => $this->input->post('module')
        );
        $this->cart->insert($data);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

    public function doAddStoreRateReview($product_id) {
        $this->output->set_content_type('application/json');
        $data = $this->getDataByUniqueId();
        $user_id = $data['user_id'];
        $this->form_validation->set_rules('review', 'Review', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->ecommerce_model->doAddStoreRateReview($user_id, $product_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1,  'url' =>base_url('store'), 'msg' => 'Thanks for the review']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Review did not added sucessfully']));
            return FALSE;
        }
    }
    
    public function storeProductWishlist($product_id, $user_id) {
        $this->output->set_content_type('application/json');
        $checkingResponse = $this->ecommerce_model->checkProductWishlist($product_id, $user_id);
        if ($checkingResponse) {
            $this->output->set_output(json_encode(['result' => 1, 'msg'=> 'Product successfully deleted from wishlist!.']));
            return FALSE;
        } else {
            $response = $this->ecommerce_model->addStoreProductWishlist($product_id, $user_id);
            $this->output->set_output(json_encode(['result' => 1, 'msg'=> 'Product successfully added to wishlist!.']));
            return FALSE;
        }
    }
    
}
