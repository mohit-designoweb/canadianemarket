<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Product_model extends CI_Model {
    
    public function getProductBySectionId($store_id) {
        $this->db->select('*');
        $this->db->from('product p');
        $this->db->join('shop_section s', 's.shop_section_id=p.shop_section_id');
        $this->db->where('p.store_id', $store_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    

    public function doAddProduct() {
        $data = array(
            'store_id' => $this->input->post('store_id'),
            'product_name' => $this->security->xss_clean($this->input->post('product_name')),
            'description' => $this->input->post('description'),
            'price' => $this->security->xss_clean($this->input->post('price')),
            'discount' => $this->security->xss_clean($this->input->post('discount')),
            'sku' => $this->security->xss_clean($this->input->post('sku')),
	    'emarket_point' => $this->security->xss_clean($this->input->post('emarket_point')),
            'shop_section_id' => $this->security->xss_clean($this->input->post('shop_section_id')),
        );
        $this->db->insert('product', $data);
        return $this->db->insert_id();
    }
    
    public function addProductImage($image, $result) {
        $data = array(
            'product_id' => $result,
            'image_url' => $image
        );
        $this->db->insert('product_image', $data);
        return $this->db->insert_id();
    }
    
    public function getProductAllImages($product_id){
        $this->db->select('image_url');
        $query = $this->db->get_where('product_image',['product_id'=>$product_id]);
        return $query->row_array();
    }
    
    public function getProductImagesById($product_id){
        $this->db->select('image_id, image_url');
        $query = $this->db->get_where('product_image',['product_id'=>$product_id]);
        return $query->result_array();
    }

    public function getProductById($product_id) {
        $query = $this->db->get_where('product', ['product_id' => $product_id]);
        return $query->row_array();
    }

    public function doEditProduct($product_id) {
        $data = array(
            'store_id' => $this->input->post('store_id'),
            'product_name' => $this->security->xss_clean($this->input->post('product_name')),
            'description' => $this->input->post('description'),
            'price' => $this->security->xss_clean($this->input->post('price')),
            'discount' => $this->security->xss_clean($this->input->post('discount')),
            'sku' => $this->security->xss_clean($this->input->post('sku')),
	    'emarket_point' => $this->security->xss_clean($this->input->post('emarket_point')),
            'shop_section_id' => $this->security->xss_clean($this->input->post('shop_section_id')),
        );
        
        $this->db->update('product', $data, ['product_id' => $product_id]);
        return $this->db->affected_rows();
    }

    public function changeProductStatus($product_id, $status) {
        $this->db->update('product', ['is_active' => $status], ['product_id' => $product_id]);
        return $this->db->affected_rows();
    }

    public function getProductSkuByproductId($product_id) {
        $this->db->select('p.product_name,ps.*');
        $this->db->from('product_sku ps');
        $this->db->join('product p', 'p.product_id=ps.product_id');
        $this->db->where('p.product_id', $product_id);
        $query = $this->db->get();
        return $query->result_array();
    }

//    public function doAddProductSku($product_id) {
//        $data = array(
//            'product_id' => $product_id,
//            'sku' => $this->security->xss_clean($this->input->post('sku')),
//        );
//        $this->db->insert('product_sku', $data);
//        return $this->db->insert_id();
//    }

    public function addProductSkuImage($image, $result) {
        $data = array(
            'product_id' => $result,
            'image_url' => $image
        );
        $this->db->insert('product_image', $data);
        return $this->db->insert_id();
    }

    // public function getProductSkuByProductSkuId($product_sku_id) {
    //     $query = $this->db->get_where('product_sku', ['product_sku_id' => $product_sku_id]);
    //     return $query->row_array();
    // }

    // public function getProductImages($product_id) {
    //    $query = $this->db->get_where('product_image', ['product_id' => $product_id]);
    //    return $query->result_array();
    // }
    

    public function doDeleteProductImage($image_id) {
        $this->db->delete('product_image', ['image_id' => $image_id]);
        return $this->db->affected_rows();
    }

    public function deleteAllProductImage($product_id) {
        $this->db->delete('product_image', ['product_id' => $product_id]);
        return $this->db->affected_rows();
    }

    // public function doEditProductSku($product_sku_id) {
    //     $data = array(
    //         'sku' => $this->security->xss_clean($this->input->post('sku')),
    //     );
    //     $this->db->update('product_sku', $data, ['product_sku_id' => $product_sku_id]);
    //     return $this->db->affected_rows();
    // }

    

    // public function changeProductSkuStatus($product_sku_id, $status) {
    //     $this->db->update('product_sku', ['is_active' => $status], ['product_sku_id' => $product_sku_id]);
    //     return $this->db->affected_rows();
    // }

    // public function doAddProductGroupMapping($group_id, $group_value, $product_sku_id) {
    //     $data = array(
    //         'product_sku_id' => $product_sku_id,
    //         'group_id' => $group_id,
    //         'group_value' => $group_value,
    //     );
    //     $this->db->insert('product_sku_group_mapping', $data);
    //     return $this->db->insert_id();
    // }

    // public function doUpdateProductGroupMapping($mapping_id, $group_id, $group_value) {
    //     $data = array(
    //         'group_id' => $group_id,
    //         'group_value' => $group_value,
    //     );
    //     $this->db->update('product_sku_group_mapping',$data,['sku_mapping_id'=>$mapping_id]);
    //     return $this->db->affected_rows();
    // }

    // public function getProductSkuGroupMappingByProductSkuId($product_sku_id) {
    //     $query = $this->db->get_where('product_sku_group_mapping', ['product_sku_id' => $product_sku_id]);
    //     return $query->result_array();
    // }

    public function getSpecification() {
        $query = $this->db->get('specification_group');
        return $query->result_array();
    }

    public function getActiveSpecification() {
        $query = $this->db->get_where('specification_group', ['is_active' => 'Active']);
        return $query->result_array();
    }
    
    public function getFilterProductCategory($store_id) {
        $query = $this->db->get_where('shop_section', ['store_id'=>$store_id,'is_active' => 'Active']);
        return $query->result_array();
    }

//    public function add_product_group_mapping($spec, $result) {
//        $data = array(
//            'group_id' => $spec,
//            'product_id' => $result
//        );
//        $this->db->insert('product_group_mapping', $data);
//        return $this->db->insert_id();
//    }
    
    public function add_product_group_mapping($product_id, $group_id, $value) {

        $data = array(
            'product_id' => $product_id,
            'group_id' => $group_id,
            'group_value' => $value,
        );
        $this->db->insert('product_group_mapping', $data);
        return $this->db->insert_id();
    }
    
    public function getProductGroupingMappingByProductId($product_id) {
        $query = $this->db->get_where('product_group_mapping', ['product_id' => $product_id]);
        return $query->result_array();
    }
    
    public function updateProductGroupMapping($mapping_id, $specification, $specifications_value) {
        
        $this->db->update('product_group_mapping', ['group_id' => $specification, 'group_value' => $specifications_value], ['sku_mapping_id'=>$mapping_id]);
        return $this->db->affected_rows();
    }
    
    public function removeProductGroupMapping($mapping_id) {
        $this->db->delete('product_group_mapping', ['mapping_id' => $mapping_id]);
        return $this->db->affected_rows();
    }
    
    public function checkAlreadyExistData($product_name, $sku){
        $this->db->from('product');
        $this->db->where('product_name',$product_name);
        $this->db->or_where('sku',$sku);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function uploadProductcsvFile($data){
        $this->db->insert('product',$data);
        return $this->db->insert_id();
    }
    
    public function getCategoryName($category_name){
        $this->db->select('shop_section_id,shop_section_name');
        $query = $this->db->get_where('shop_section', ['shop_section_name'=>$category_name]);
        return $query->row_array();
    }
    
    public function getStoreName($store_name){
        $this->db->select('store_id,store_name');
        $query = $this->db->get_where('store', ['store_name'=>$store_name]);
        return $query->row_array();
    }
    
    public function getGroupName($group_name){
        $this->db->select('group_id,group_name');
        $query = $this->db->get_where('specification_group', ['group_name'=>$group_name]);
        return $query->row_array();
    }
    
    public function uploadProductskuDetails($data){
        $this->db->insert('product_group_mapping',$data);
        return $this->db->insert_id();
    }

    public function getSpecificationByProductId($product_id) {
        $this->db->select('pg.group_id,sg.group_name');
        $this->db->from('product_group_mapping pg');
        $this->db->join('specification_group sg', 'sg.group_id=pg.group_id');
        $this->db->where('pg.product_id', $product_id);
        $result = $this->db->get();
        return $result->result_array();
    }
    
    public function getProductDataByStoreId($store_id){
        $this->db->select('p.*,ss.shop_section_name,s.store_name');
        $this->db->from('product p');
        $this->db->join('shop_section ss', 'ss.shop_section_id=p.shop_section_id');
        $this->db->join('store s', 's.store_id=p.store_id');
        $this->db->where('p.store_id', $store_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getProductSKUMappings($product_id){
        $this->db->select('sg.group_name, pgm.group_value');
        $this->db->from('product_group_mapping pgm');
        $this->db->join('specification_group sg','sg.group_id = pgm.group_id');
        $this->db->where('pgm.product_id', $product_id);
        $query = $this->db->get();
        return $query->result_array();
    }
}
