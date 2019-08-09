<?php

/**
 * Description of Language_model
 *
 * @author Mohit Kant Gupta
 */
class Language_model extends CI_Model {

    public function getLanguageById($id) {
        $query = $this->db->get_where('lang', ['language_id' => $id]);
        return $query->row_array();
    }
    
    public function getAllLanguage() {
        $query = $this->db->get('lang');
        return $query->result_array();
    }
    
    public function doAddLanguage() {
        $language = $this->input->post('language_name');
        $fields = array(
            $language => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            )
        );
        $this->dbforge->add_column('text', $fields);
        $data = array(
            'language' => $this->security->xss_clean($language)
        );
        $this->db->insert('lang', $data);
        return $this->db->insert_id();
    }

    public function doEditLanguage($id) {
        $data = array(
            'language' => $this->security->xss_clean($this->input->post('language_name'))
        );
        $this->db->update('lang', $data, ['language_id' => $id]);
        return $this->db->affected_rows();
    }
    
    public function changeLanguageStatus($language_id,$status){
        $this->db->update('lang', ['is_active' => $status], ['language_id' => $language_id]);
        return $this->db->affected_rows();
    }
    
    public function getTextById($id) {
        $query = $this->db->get_where('text', ['text_id' => $id]);
        return $query->row_array();
    }
    
    public function getAllText() {
        $query = $this->db->get('text');
        return $query->result_array();
    }
    
    public function doAddText() {
        $data = array(
            'text' => $this->security->xss_clean($this->input->post('text'))
        );
        $this->db->insert('text', $data);
        return $this->db->insert_id();
    }
    
    public function doEditText($id) {
        $data = array(
            'text' => $this->security->xss_clean($this->input->post('text'))
        );
        $this->db->update('text', $data, ['text_id' => $id]);
        return $this->db->affected_rows();
    }
    
    public function changeLanguageTextStatus($text_id, $status){
         $this->db->update('text', ['is_active' => $status], ['text_id' => $text_id]);
        return $this->db->affected_rows();
    }
    
     public function add_text_lang($id, $language) {
        $data = [];
        for ($i = 0; $i < count($language); $i++) {
            $field = $language[$i];
            $data[$field] = $this->input->post($field);
        }
        $this->db->update('text', $data, ['text_id' => $id]);
        return $this->db->affected_rows();
    }

}
