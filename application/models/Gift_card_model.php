<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Gift_card_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }
    public function getAllCardAmount()
    {
        $result = $this->db->get_where('gift_card_amount');
        return $result->result_array();
    }
    
    public function doAddGiftCardAmount()
    {
        $data = array(
            'amount' => $this->security->xss_clean($this->input->post('card_amount'))
        );
        $this->db->insert('gift_card_amount',$data);
        return $this->db->insert_id();
    }
    public function getAmountById($id)
    {
        $result = $this->db->get_where('gift_card_amount',['amount_id'=>$id]);
        return $result->row_array();
    }
    public function doEditGiftCardAmount($id)
    {
       $data = array(
            'amount' => $this->security->xss_clean($this->input->post('card_amount'))
        );
        $this->db->update('gift_card_amount',$data,['amount_id'=>$id]);
        return $this->db->affected_rows();
    }
    public function doDeleteAmountById($id)
    {
        $this->db->delete('gift_card_amount',['amount_id'=>$id]);
        return $this->db->affected_rows();
    }
    public function doChangeAmountStatus($id,$status)
    {
        $this->db->update('gift_card_amount',['is_active'=>$status],['amount_id'=>$id]);
        return $this->db->affected_rows();
    }
    
    public function getAllGiftCard()
    {
        $result = $this->db->get('gift_card');
        return $result->result_array();
    }
    
    public function doDeleteGiftCard($id)
    {
        $this->db->delete('gift_card',['gift_card_id'=>$id]);
        
        return $this->db->affected_rows();
    }
    
}