<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Product_model extends CI_Model {

    public function getProductBySectionId($store_id, $shop_section_id) {
        $this->db->select('s.shop_section_name,p.*');
        $this->db->from('product p');
        $this->db->join('shop_section s', 's.shop_section_id=p.shop_section_id');
        $this->db->where('p.shop_section_id', $shop_section_id);
        $this->db->where('p.store_id', $store_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function doAddProduct($store_id, $shop_section_id, $image_url) {
        $data = array(
            'shop_section_id' => $shop_section_id,
            'store_id' => $store_id,
            'image_url' => $image_url,
            'product_name' => $this->security->xss_clean($this->input->post('product_name')),
            'description' => $this->input->post('description'),
            'price' => $this->security->xss_clean($this->input->post('price')),
            'discount' => $this->security->xss_clean($this->input->post('discount')),
			'emarket_point' => $this->security->xss_clean($this->input->post('emarket_point')),
        );
        $this->db->insert('product', $data);
        return $this->db->insert_id();
    }

    public function getProductById($product_id) {
        $query = $this->db->get_where('product', ['product_id' => $product_id]);
        return $query->row_array();
    }

    public function doEditProduct($image_url, $product_id) {
        $data = array(
            'image_url' => $image_url,
            'product_name' => $this->security->xss_clean($this->input->post('product_name')),
            'description' => $this->input->post('description'),
            'price' => $this->security->xss_clean($this->input->post('price')),
            'discount' => $this->security->xss_clean($this->input->post('discount')),
			'emarket_point' => $this->security->xss_clean($this->input->post('emarket_point')),
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

    public function doAddProductSku($product_id) {
        $data = array(
            'product_id' => $product_id,
            'sku' => $this->security->xss_clean($this->input->post('sku')),
        );
        $this->db->insert('product_sku', $data);
        return $this->db->insert_id();
    }

    public function addProductSkuImage($image, $result) {
        $data = array(
            'product_sku_id' => $result,
            'image_url' => $image
        );
        $this->db->insert('product_image', $data);
        return $this->db->insert_id();
    }

    public function getProductSkuByProductSkuId($product_sku_id) {
        $query = $this->db->get_where('product_sku', ['product_sku_id' => $product_sku_id]);
        return $query->row_array();
    }

    public function getProductSkuImages($product_sku_id) {
        $query = $this->db->get_where('product_image', ['product_sku_id' => $product_sku_id]);
        return $query->result_array();
    }

    public function doDeleteProductSkuImage($image_id) {
        $this->db->delete('product_image', ['image_id' => $image_id]);
        return $this->db->affected_rows();
    }

    public function doEditProductSku($product_sku_id) {
        $data = array(
            'sku' => $this->security->xss_clean($this->input->post('sku')),
        );
        $this->db->update('product_sku', $data, ['product_sku_id' => $product_sku_id]);
        return $this->db->affected_rows();
    }

    public function deleteAllProductSkuImage($product_sku_id) {
        $this->db->delete('product_image', ['product_sku_id' => $product_sku_id]);
        return $this->db->affected_rows();
    }

    public function changeProductSkuStatus($product_sku_id, $status) {
        $this->db->update('product_sku', ['is_active' => $status], ['product_sku_id' => $product_sku_id]);
        return $this->db->affected_rows();
    }

    public function doAddProductGroupMapping($group_id, $group_value, $product_sku_id) {
        $data = array(
            'product_sku_id' => $product_sku_id,
            'group_id' => $group_id,
            'group_value' => $group_value,
        );
        $this->db->insert('product_sku_group_mapping', $data);
        return $this->db->insert_id();
    }

    public function doUpdateProductGroupMapping($mapping_id, $group_id, $group_value) {
        $data = array(
            'group_id' => $group_id,
            'group_value' => $group_value,
        );
        $this->db->update('product_sku_group_mapping',$data,['sku_mapping_id'=>$mapping_id]);
        return $this->db->affected_rows();
    }

    public function getProductSkuGroupMappingByProductSkuId($product_sku_id) {
        $query = $this->db->get_where('product_sku_group_mapping', ['product_sku_id' => $product_sku_id]);
        return $query->result_array();
    }

    public function getSpecification() {
        $query = $this->db->get('specification_group');
        return $query->result_array();
    }

    public function getActiveSpecification() {
        $query = $this->db->get_where('specification_group', ['is_active' => 'Active']);
        return $query->result_array();
    }

    public function add_product_group_mapping($spec, $result) {
        $data = array(
            'group_id' => $spec,
            'product_id' => $result
        );
        $this->db->insert('product_group_mapping', $data);
        return $this->db->insert_id();
    }

    public function getProductGroupingMappingByProductId($product_id) {
        $query = $this->db->get_where('product_group_mapping', ['product_id' => $product_id]);
        return $query->result_array();
    }

    public function removeProductGroupMapping($mapping_id) {
        $this->db->delete('product_group_mapping', ['mapping_id' => $mapping_id]);
        return $this->db->affected_rows();
    }

    public function updateProductGroupMapping($specification, $mapping_id) {
        $this->db->update('product_group_mapping', ['group_id' => $specification], ['mapping_id' => $mapping_id]);
        return $this->db->affected_rows();
    }

    public function getSpecificationByProductId($product_id) {
        $this->db->select('pg.group_id,sg.group_name');
        $this->db->from('product_group_mapping pg');
        $this->db->join('specification_group sg', 'sg.group_id=pg.group_id');
        $this->db->where('pg.product_id', $product_id);
        $result = $this->db->get();
        return $result->result_array();
    }

//    public function getSpecificationById($id) {
//        $query = $this->db->get_where('specification_group', ['group_id' => $id]);
//        return $query->row_array();
//    }
//
//    public function doAddSpecification() {
//        $data = array(
//            'group_name' => $this->security->xss_clean($this->input->post('group_name'))
//        );
//        $this->db->insert('specification_group', $data);
//        return $this->db->insert_id();
//    }
//
//    public function doEditSpecification($id) {
//        $data = array(
//            'group_name' => $this->security->xss_clean($this->input->post('group_name'))
//        );
//        $this->db->update('specification_group', $data, ['group_id' => $id]);
//        return $this->db->affected_rows();
//    }
//
//    public function doChangeSpecificationStatus($id) {
//        $query = $this->db->get_where('specification_group', ['group_id' => $id]);
//        $row = $query->row_array();
//        if ($row['is_active'] == "Inactive") {
//            $up = $this->db->update('specification_group', ['is_active' => 'Active'], ['group_id' => $id]);
//        } else {
//            $up = $this->db->update('specification_group', ['is_active' => 'Inactive'], ['group_id' => $id]);
//        }
//        return true;
//    }
//    public function getSubcategoryByProductId($id) {
//        $this->db->select('category_id');
//        $query = $this->db->get_where('product', ['product_id' => $id]);
//        $row = $query->row_array();
//        $query1 = $this->db->get_where('subcategory', ['category_id' => $row['category_id']]);
//        return $query1->result_array();
//    }
//
//    public function doAddProduct() {
//        $data = array(
//            'shop_section_id' => $this->security->xss_clean($this->input->post('shop_section_id')),
//            'store_id' => $this->security->xss_clean($this->input->post('store_id')),
//            'product_name' => $this->security->xss_clean($this->input->post('product_name')),
//            'description' => $this->input->post('description'),
//            'sku' => $this->security->xss_clean($this->input->post('sku')),
//        );
//        $this->db->insert('product', $data);
//        return $this->db->insert_id();
//    }
//
//    public function addProductSku($product_id, $sku) {
//        $data = array(
//            'product_id' => $product_id,
//            'sku' => $sku
//        );
//        $this->db->insert('product_sku', $data);
//        return $this->db->insert_id();
//    }
//
//    public function addProductGroupMapping($product_sku_id, $key, $group_val_arr) {
//        $data = array(
//            'product_sku_id' => $product_sku_id,
//            'group_id' => $key,
//            'group_value' => $group_val_arr
//        );
//        $this->db->insert('product_group_mapping', $data);
//        return $this->db->insert_id();
//    }
//
//    public function doEditProduct($small_image, $large_image, $id) {
//        // echo $id;die;
//        $data = array(
//            'category_id' => $this->security->xss_clean($this->input->post('store_category_id')),
//            'store_id' => $this->security->xss_clean($this->input->post('store_id')),
//            'product_name' => $this->security->xss_clean($this->input->post('product_name')),
//            'description' => $this->input->post('description'),
//            'price' => $this->security->xss_clean($this->input->post('price')),
//            'sku' => $this->security->xss_clean($this->input->post('sku')),
//            'small_image' => $small_image,
//            'large_image' => $large_image
//        );
//        $this->db->update('product', $data, ['product_id' => $id]);
//        return $id;
//    }
//
//    public function getSkuByProductId($id) {
//        $query = $this->db->get_where('product_sku', ['product_id' => $id]);
//        return $query->result_array();
//    }
//
//    public function doAddSku($id) {
//        $group_value = $this->input->post('group_value');
//        $group_id = $this->input->post('group_id');
//
////       $count = count($group_id);
//        $counts = array_count_values($group_id);
//        $a = 0;
//        foreach (array_unique($group_id) as $s) {
//            $a++;
//        }
//        $sr = 1;
//        $total = 0;
//        foreach ($counts as $key => $count) {
////            echo $key."=>".$count."<br>";
//            if ($sr == 1) {
//                $first_val = $count;
//            } else {
//                $total = $total + $first_val * $count;
////            $total = $total + $total;
//            }
//            $sr++;
//        }
////        echo $total;
////       print_r($counts);
//        $sk = "";
//        for ($i = 0; $i < $total; $i++) {
//            $this->db->insert('product_sku', ['product_id' => $id, 'sku' => 'sku']);
//            $sku_id1 = $this->db->insert_id();
//            $sk .= $sku_id1 . ",";
//            $sku_id = substr($sk, 0, -1);
//        }
////        $sku_id= substr($sku_id, 0,-1);
//        $sku_id = explode(',', $sku_id);
////        print_r($sku_id);
////        die;
//        for ($i = 0; $i < count($group_id); $i++) {
//            foreach ($sku_id as $sku_id1) {
//                $this->db->insert('product_group_mapping', ['product_sku_id' => $sku_id1, 'group_id' => $group_id[$i], 'group_value' => $group_value[$i]]);
//            }
//        }
//    }
//
//    public function doChangeProductStatus($id) {
//        $query = $this->db->get_where('product', ['product_id' => $id]);
//        $row = $query->row_array();
//        if ($row['is_active'] == "Inactive") {
//            $up = $this->db->update('product', ['is_active' => 'Active'], ['product_id' => $id]);
//        } else {
//            $up = $this->db->update('product', ['is_active' => 'Inactive'], ['product_id' => $id]);
//        }
//        return true;
//    }
//    public function doChangeProduct($store_id) {
//        $this->db->select('s.store_name,sc.*,p.*');
//        $this->db->from('store s');
//        $this->db->join('shop_section sc', 'sc.store_id = s.store_id');
//        $this->db->join('product p', 'p.shop_section_id = sc.shop_section_id');
//        if (!empty($store_id)) {
//            $this->db->where('p.store_id', $store_id);
//        }
//        $query = $this->db->get();
//        return $query->result_array();
//    }
//
//    public function doChangeProductByCategory($category_id, $store_id) {
//        $this->db->select('s.store_name,sc.*,p.*');
//        $this->db->from('store s');
//        $this->db->join('shop_section sc', 'sc.store_id = s.store_id');
//        $this->db->join('product p', 'p.shop_section_id = sc.shop_section_id');
//        $this->db->where('p.store_id', $store_id);
//        if (!empty($category_id)) {
//            $this->db->where('p.category_id', $category_id);
//        }
//        $query = $this->db->get('');
//        return $query->result_array();
//    }
//
//    public function getProduct() {
//        if ($this->session->userdata('user_type') == 'Service_provider') {
//            $id = $this->serviceProviderId();
//            $this->db->select('s.store_name,sc.*,p.*');
//            $this->db->from('store s');
//            $this->db->join('shop_section sc', 'sc.store_id = s.store_id');
//            $this->db->join('product p', 'p.shop_section_id = sc.shop_section_id');
//            $this->db->where('s.service_provider_id', $id['id']);
//            $query = $this->db->get('');
//        } else {
//            $this->db->select('s.store_name,sc.*,p.*');
//            $this->db->from('store s');
//            $this->db->join('shop_section sc', 'sc.store_id = s.store_id');
//            $this->db->join('product p', 'p.shop_section_id = sc.shop_section_id');
//            $query = $this->db->get('');
//        }
////        echo $this->db->last_query(); die;
//        return $query->result_array();
//    }
//
//    public function getProductById($id) {
//        $this->db->select('s.store_name,sc.*,p.*');
//        $this->db->from('store s');
//        $this->db->join('shop_section sc', 'sc.store_id = s.store_id');
//        $this->db->join('product p', 'p.category_id = sc.shop_section_id');
//        $this->db->where('p.product_id', $id);
//        $query = $this->db->get();
//        return $query->row_array();
//    }
}
