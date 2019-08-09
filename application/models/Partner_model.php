<?php

/**
 * Description of service_provider_model
 *
 * @author Mohit Kant Gupta
 */
class Partner_model extends CI_Model {

    public function getPartner() {
//        $this->db->select('c.name AS country_name,s.name AS state_name,city.name AS city_name,sp.*');
//        $this->db->from('countries c');
//        $this->db->join('states s', 's.country_id = c.id');
//        $this->db->join('cities city', 'city.state_id = s.id');
//        $this->db->join('service_provider sp', 'sp.city = city.id');
        $query = $this->db->get('partner');
        return $query->result_array();
    }

    public function getPartnerById($id) {
        $query = $this->db->get_where('partner', ['partner_id' => $id]);
        return $query->row_array();
    }

    public function doAddPartner($image_url) {
        $data = array(
            'first_name' => $this->security->xss_clean($this->input->post('first_name')),
            'last_name' => $this->security->xss_clean($this->input->post('last_name')),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'image_url' => $image_url,
            'password' => $this->security->xss_clean(hash('sha256',$this->input->post('password'))),
            'address1' => $this->security->xss_clean($this->input->post('store_address1')),
            'address2' => $this->security->xss_clean($this->input->post('store_address2')),
            'city' => $this->security->xss_clean($this->input->post('city')),
            'state' => $this->security->xss_clean($this->input->post('state')),
            'zipcode' => $this->security->xss_clean($this->input->post('zipcode')),
            'country' => $this->security->xss_clean($this->input->post('country')),
            'phone_no' => $this->security->xss_clean($this->input->post('phone_no')),
            'is_active' => 1
        );
        $this->db->insert('partner', $data);
       /* $val = array(
            'store_name' => $this->security->xss_clean($this->input->post('store_name')),
            'partner_id' => $this->db->insert_id()
        );
        $this->db->insert('store', $val);*/
        return $this->db->insert_id();
    }

    public function doEditPartner($id, $image_url) {
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
            'phone_no' => $this->security->xss_clean($this->input->post('phone_no'))
        );
        $this->db->update('partner', $data, ['partner_id' => $id]);
        return $this->db->affected_rows();
    }
    
    public function doUpdatePartnerPassword($partnerid){
        $data = array(
        'password' => $this->security->xss_clean(hash('sha256',$this->input->post('password')))
        );
         $this->db->update('partner', $data, ['partner_id' => $partnerid]);
        return $this->db->affected_rows();
    }


    public function changeStatus($id, $status) {
        $this->db->update('partner', ['is_active' => $status], ['partner_id' => $id]);
        return $this->db->affected_rows();
    }

    public function viewPartnerEnquiry($id) {
        $query = $this->db->get_where('partner_query', ['partner_query_id' => $id]);
        return $query->row_array();
    }

    public function getPartnerEnquiry() {
        $query = $this->db->get('partner_query');
        return $query->result_array();
    }
    
    //Partner Store function(Whern partner will login)
    
    public function getPartnerId($email)
    {
        $result = $this->db->get_where('partner',['email'=>$email]);
        return $result->row_array();
    }
    
    public function getStoreByPartnerId($partner_id)
    {
       $result = $this->db->get_where('store',['partner_id'=>$partner_id]);
       return $result->result_array();
    }
    
    public function changeStoreStatus($id,$status)
    {
        $this->db->update('store',['is_active'=>$status],['store_id'=>$id]);
        return $this->db->affected_rows();
    }
    
    public function getStoreById($id)
    {
        $result = $this->db->get_where('store',['store_id'=>$id]);
        return $result->row_array();
    }
    
    public function doEditPartnerStore($id,$image_url)
    {
        $data = array(
            'image_url'=>$image_url,
            'country'=>$this->security->xss_clean($this->input->post('country')),
            'state'=>$this->security->xss_clean($this->input->post('state')),
            'city'=>$this->security->xss_clean($this->input->post('city')),
            'description'=>$this->security->xss_clean($this->input->post('description')),
        );
        $this->db->update('store',$data,['store_id'=>$id]);
        return $this->db->affected_rows();
    }
    
    //Partner restaurant function(Whern partner will login)
    
    public function getRestaurantByPartnerId($partner_id)
    {
         $result = $this->db->get_where('restaurant',['partner_id'=>$partner_id]);
         return $result->result_array();
    }
    public function getRestaurantById($id)
    {
        $result = $this->db->get_where('restaurant',['restaurant_id'=>$id]);
        return $result->row_array();
    }
     public function getActivePartner() {
        $this->db->select('first_name,last_name,partner_id');
        $query = $this->db->get_where('partner', ['is_active' => 'Active']);
        return $query->result_array();
    }
    public function getAllActiveCategory() {
        $query = $this->db->get_where('restaurant_category', ['is_active' => 'Active']);
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
    public function doEditPartnerRestaurant($id,$image_url)
    {
       $data = array(
           'image_url'=>$image_url,
           'restaurant_name'=>$this->security->xss_clean($this->input->post('restaurant_name')),
           'country'=>$this->security->xss_clean($this->input->post('country')),
           'state'=>$this->security->xss_clean($this->input->post('state')),
           'city'=>$this->security->xss_clean($this->input->post('city')),
           'description'=>$this->security->xss_clean($this->input->post('description')),
           'about'=>$this->security->xss_clean($this->input->post('about')),
           'address'=>$this->security->xss_clean($this->input->post('address')),
           'speciality'=>$this->security->xss_clean($this->input->post('speciality')),
           'delivery_charge'=>$this->security->xss_clean($this->input->post('delivery_charge')),
           'opening_time_from'=>$this->security->xss_clean($this->input->post('opening_time_from')),
           'opening_time_to'=>$this->security->xss_clean($this->input->post('opening_time_to')),
           'latitude'=>$this->security->xss_clean($this->input->post('latitude')),
           'longitude'=>$this->security->xss_clean($this->input->post('longitude')),
		   'service_fee' => $this->security->xss_clean($this->input->post('service_fee'))
       ); 
       $this->db->update('restaurant',$data,['restaurant_id'=>$id]);
       return $this->db->affected_rows();
    }
    
    public function changePartnerRestaurantStatus($id,$status)
    {
        $this->db->update('restaurant',['is_active'=>$status],['restaurant_id'=>$id]);
        return $this->db->affected_rows();
    }
     //Partner market product function(Whern partner will login)
    
    public function getAllActiveProductCategory()
    {
        $result = $this->db->get_where('market_place_category',['is_active'=>'Active']);
        return $result->result_array();
    }
    public function getProductByPartnerId($id)
    {
        $result = $this->db->get_where('market_place_product',['partner_id'=>$id]);
        return $result->result_array();
    }
    public function changePartnerProductStatus($id,$status)
    {
        $this->db->update('market_place_product',['is_active'=>$status],['market_place_product_id'=>$id]);
        return $this->db->affected_rows();
    }
    public function getPartnerProductById($id)
    {
        $result = $this->db->get_where('market_place_product',['market_place_product_id'=>$id]);
        return $result->row_array();
    }
    public function doAddPartnerProduct($image_url,$partner_id)
    {
        $data = array(
            'partner_id'=>$partner_id,
            'image_url'=>$image_url,
            'market_place_category_id'=>$this->security->xss_clean($this->input->post('market_place_category_id')),
            'product_name'=>$this->security->xss_clean($this->input->post('product_name')),
            'price'=>$this->security->xss_clean($this->input->post('price')),
            'description'=>$this->security->xss_clean($this->input->post('description')),
        );
        $this->db->insert('market_place_product',$data);
        return $this->db->insert_id();
    }
    public function doEditPartnerProduct($id,$image_url)
    {
        $data = array(
            'image_url'=>$image_url,
            'product_name'=>$this->security->xss_clean($this->input->post('product_name')),
            'price'=>$this->security->xss_clean($this->input->post('price')),
            'description'=>$this->security->xss_clean($this->input->post('description')),
        );
        $this->db->update('market_place_product',$data,['market_place_product_id'=>$id]);
        return $this->db->affected_rows();
    }
    public function doDeletePartnerProduct($id)
    {
        $this->db->delete('market_place_product',['market_place_product_id'=>$id]);
        return $this->db->affected_rows();
       
    }
    public function getRestaurantMenuCategoryById($menu_category_id)
    {
        $result = $this->db->get_where('menu_category',['menu_category_id'=>$menu_category_id]);
        return $result->row_array();
    }
    public function getRestaurantCategoryMenuByRestaurantId($restaurant_id)
    {
        $result = $this->db->get_where('menu_category',['restaurant_id'=>$restaurant_id]);
        return $result->result_array();
    }
    public function doAddPartnerRestaurantMenuCategory($restaurant_id)
    {
        $data = array(
            'menu_category_name'=>$this->security->xss_clean($this->input->post('menu_category_name')),
            'restaurant_id'=>$restaurant_id
        );
        $this->db->insert('menu_category',$data);
        return $this->db->insert_id();
    }
    public function doEditPartnerRestaurantMenuCategory($menu_category_id)
    {
        $data = array(
            'menu_category_name'=>$this->security->xss_clean($this->input->post('menu_category_name'))
        );
        $this->db->update('menu_category',$data,['menu_category_id'=>$menu_category_id]);
        return $this->db->affected_rows();
    }
    public function changePartnerRestaurantMenuCategoryStatus($menu_category_id, $status)
    {
        $this->db->update('menu_category',['is_active'=>$status],['menu_Category_id'=>$menu_category_id]);
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
    public function getRestaurantMenuById($menu_id){
        $query=$this->db->get_where('menu',['menu_id'=>$menu_id]);
        return $query->row_array();
    }
    public function doEditPartnerRestaurantMenu($menu_id, $image_url){
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
     public function changePartnerRestaurantMenuStatus($menu_id,$status){
        $this->db->update('menu', ['is_active' => $status], ['menu_id' => $menu_id]);
        return $this->db->affected_rows();
    }
	/////Partner Order Managemetn Functions
	public function getAllRestaurantByPartnerId($id)
	{

		$result = $this->db->get_where('restaurant',['partner_id'=>$id]);
		return $result->result_array();
		
	}
	public function getRestaurantOrderByPartnerId($restaurant_id)
	{
		$list = [];
		$j=0;
		foreach($restaurant_id as $resId)
		{
			$result = $this->db->get_where('restaurant_orders',['restaurant_id'=>$resId['restaurant_id']]);
			$resultArray = $result->result_array();
			$length = count($resultArray);
			for($i=0;$i<$length;$i++)
			{
				$list[$j]['order_id']=$resultArray[$i]['order_id'];
				$list[$j]['user_id']=$resultArray[$i]['user_id'];
				$list[$j]['restaurant_id']=$resultArray[$i]['restaurant_id'];
				$list[$j]['menu_id']=$resultArray[$i]['menu_id'];
				$j++;
			}
		}
		return $list;
		
		
	}

	public function getRestDetailById($rest_id)
	{
		$result = $this->db->get_where('restaurant',['restaurant_id'=>$rest_id]);
		$detail = $result->row_array();
		$rest_arr=[];
			$rest_arr[0]=$detail['restaurant_name'];
			$rest_arr[1]=$detail['address'];
			$rest_arr[2]=$detail['latitude'];
			$rest_arr[3]=$detail['longitude'];
			return $rest_arr;
		
	}
	public function getUserDetailById($user_id)
	{
		$result = $this->db->get_where('user',['user_id'=>$user_id]);
		return $result->row_array();
	}
	public function getMenuDetailById($menu_id)
	{
		$list = [];
		$i=0;
		$menu_id = explode(",",$menu_id);
		foreach($menu_id as $id)
		{
			$result = $this->db->get_where('menu',['menu_id'=>$id]);
			$menu_detail = $result->row_array();
			$list[$i]['image_url'] = $menu_detail['image_url'];
			$list[$i]['menu_name'] = $menu_detail['menu_name'];
			$list[$i]['price'] = $menu_detail['price'];
			$list[$i]['discount'] = $menu_detail['discount'];
			$i++;
		}
		return $list;
	}
	public function getOrderDetailById($order_id)
	{
		$result = $this->db->get_where('restaurant_orders',['order_id'=>$order_id]);
		return $result->row_array();
	}
	
	public function getSelectedAllRestaurantByPartnerId($partner_id){
		$this->db->select('restaurant_name,address,latitude,longitude');
		$query=$this->db->get_where('restaurant',['partner_id'=>$partner_id]);
		return $query->result_array();
	}
	
	public function getOrderData($partner_id) {
        $this->db->select('o.order_id,o.total_amount,o.order_status,o.order_date,o.order_time,r.restaurant_name,r.latitude,r.longitude,r.restaurant_id');
        $this->db->from('restaurant_orders o');
        $this->db->join('restaurant r', 'r.restaurant_id=o.restaurant_id');
        $this->db->where('r.partner_id', $partner_id);
        //$this->db->where('o.order_status', 'Processing');
        $query = $this->db->get();
        return $query->result_array();
    }
	 public function getOrderDetailByUniqueId($unique_id) {
        $result = $this->db->get_where('restaurant_order_details', ['unique_order_id' => $unique_id]);
        return $result->row_array();
    }

    public function updateOrderStatus($status, $id) {
        $this->db->update('restaurant_orders', ['order_status' => $status], ['order_id' => $id]);
        return $this->db->affected_rows();
    }

      public function getAllActiveCourier() {
        $result = $this->db->get_where('courier', ['is_active' => 'Active', 'is_available' => 'Yes', 'service_status' => 'Active']);
        return $result->result_array();
    }
	public function checkCourierAgentStatus($courier_id) {
        $query = $this->db->get_where('courier', ['is_active' => 'Active', 'is_available' => 'Yes', 'courier_id' => $courier_id]);
//        echo $this->db->last_query(); die;
        return $query->row_array();
    }
    public function allotOrderToCourier($courier_id, $id) {
        $data = array(
            'courier_id'=>$courier_id,
            'restaurant_order_id'=>$id,
            'order_date'=>date('d/m/y'),
            'order_time'=>date('h:i:s')
        );
        $this->db->insert('courier_order_mapping',$data);
        return $this->db->insert_id();
    }
    public function getRestaurantDetailById($restaurant_id)
    {
        $result = $this->db->get_where('restaurant',['restaurant_id'=>$restaurant_id]);
        return $result->row_array();
    }
	 public function getCourierDetailById($courier_id) {
        $result = $this->db->get_where('courier', ['courier_id' => $courier_id]);
        return $result->row_array();
    }

    public function outForDelivery($order_id) {
        $this->db->update('restaurant_orders', ['order_status' => 'OutForDelivery'], ['order_id' => $order_id]);
        return $this->db->affected_rows();
    }
	 public function insertOrderCancelReason($id)
    { 
        $data = array(
            'order_cancel_reason' => $this->input->post('order-cancel')
        );
        $query = $this->db->update('restaurant_orders',$data,['order_id'=>$id]);
        return $this->db->affected_rows();
    }
    public function insertOrderPreparedTime($id)
    { 
        $data = array(
            'order_prepared_time' => $this->input->post('order-time')
        );
        $query = $this->db->update('restaurant_orders',$data,['order_id'=>$id]);
        return $this->db->affected_rows();
    }
    /// Mohit function start////
    
    public function checkForCourierConfirmation($order_id){
        $query=$this->db->get_where('restaurant_orders',['order_id'=>$order_id]);
        return $query->row_array();
    }

    ///////model for csv file import for partner!!!!!!!!!!!!!!!!!!!!!!!!!!!!
     public function checkData($first_name, $email)
    {
        $result = $this->db->get_where('partner', ['first_name' => $first_name, 'email' => $email]);
        return $result->num_rows();
    }
    public function uploadData($data)
    {
       $this->db->insert('partner', $data);       
    }
    
    ///store order functions
    public function getStoreOrderData($partner_id) {
        $this->db->select('o.order_id,o.order_unique_id,o.total_amount,o.status,o.order_date,o.order_time,od.product_id,od.product_sku,
		od.price,od.qty,od.order_unique_id,u.user_id,u.user_name,u.email,p.store_id,s.store_name');
        $this->db->from('store_order o');
        $this->db->join('store_order_detail od', 'o.order_unique_id=od.order_unique_id');
	$this->db->join('user u','o.user_id=u.user_id');
        $this->db->join('product p','p.product_id=od.product_id');
        $this->db->join('store s','s.partner_id='.$partner_id);
        $this->db->where('o.status', 'Processing');
	$this->db->group_by('o.order_unique_id');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getStorerderDetailById($unique_order_id)
    {
        $query = $this->db->get_where('store_order',['order_unique_id'=>$unique_order_id]);
        return $query->row_array();
    }
    public function getOrderedProductDetailDetailById($unique_order_id)
    {
        $query  = $this->db->get_where('store_order_detail',['order_unique_id'=>$unique_order_id]);
        return $query->result_array();
    }
    public function getProductDetailByProductId($product_id)
    {
        $query = $this->db->get_where('product',['product_id'=>$product_id]);
        return $query->row_array();
    }
}
