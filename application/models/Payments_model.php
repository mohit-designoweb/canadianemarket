
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//This is the Book Model for CodeIgniter CRUD using Ajax Application.
class Payments_model extends CI_Model
{
 var $table = 'orders';
 
 // for construct
 public function __construct()
 {
 parent::__construct();
 }
    /* for insert payment details in database start*/
 public function insert($data)
 {   //print_r($data);
 $this->db->insert($this->table, $data);
 return $this->db->insert_id();
 }
 public function getPaymentDetail($payment_id)
 {
     $result = $this->db->get_where('orders',['payment_id'=>$payment_id]);
     return $result->row_array();
 }


 /* for insert payment details in database close*/
 
}