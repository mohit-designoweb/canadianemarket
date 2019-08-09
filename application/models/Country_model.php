<?php

/**
 * Description of service_provider_model
 *
 * @author Rajesh kumar yadav
 */
class Country_model extends CI_Model {

    public function getCountry() {
        $query = $this->db->get('country');
        return $query->result_array();
    }

    public function getCountryById($id) {
        $query = $this->db->get_where('country', ['country_id' => $id]);
        return $query->row_array();
    }

    public function doAddCountry() {
        $data = array(
            'country_name' => $this->security->xss_clean($this->input->post('country_name'))
        );
        $this->db->insert('country', $data);
        return $this->db->insert_id();
    }

    public function doEditCountry($id) {
        $data = array(
            'country_name' => $this->security->xss_clean($this->input->post('country_name'))
        );
        $this->db->update('country', $data, ['country_id' => $id]);
        return $this->db->affected_rows();
    }

    public function doDeleteCountry($id) {
        $this->db->delete('country', ['country_id' => $id]);
        return $this->db->affected_rows();
    }

    public function changeStatus($id, $status) {
        $this->db->update('country', ['is_active' => $status], ['country_id' => $id]);
        return $this->db->affected_rows();
    }

//// City model...........

    public function getAllCity() {
        $this->db->select('*');
        $this->db->from('city c');
        $this->db->join('country co', 'co.country_id=c.country_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getCitiesById($cities_id) {
        $result = $this->db->get_where('city', ['city_id' => $cities_id]);
        return $result->row_array();
    }

    public function getCitiesByCountryId($country_id) {
        $result = $this->db->get_where('city', ['country_id' => $country_id]);
        return $result->result_array();
    }

    public function doAddCity($image_url) {
        $data = array(
            'city_name' => $this->security->xss_clean($this->input->post('city_name')),
            'country_id' => $this->security->xss_clean($this->input->post('country_id')),
            'image_url' => $image_url
        );
        $this->db->insert('city', $data);
        return $this->db->insert_id();
    }

    public function doEditCities($cities_id,$image_url) {
        $data = array(
            'city_name' => $this->security->xss_clean($this->input->post('city_name')),
            'country_id' => $this->security->xss_clean($this->input->post('country_id')),
            'image_url' => $image_url
        );
        $this->db->update('city', $data, ['city_id' => $cities_id]);
        return $this->db->affected_rows();
    }

    public function changeCitiesStatus($cities_id, $status) {
        $this->db->update('city', ['is_active' => $status], ['city_id' => $cities_id]);
        return $this->db->affected_rows();
    }

///////!!!!!!!!!!    
}
