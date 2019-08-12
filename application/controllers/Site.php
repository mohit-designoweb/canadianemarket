<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Site extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['ecommerce_model', 'payments_model']);
        $this->load->config('facebook');
        $this->load->helper('cookie');
    }

    private function getFilteredGiftAmount() {
        $list = [' ' => '----Select Gift Card Amount----'];
        $amounts = $this->ecommerce_model->getActiveGiftAmounts();
        foreach ($amounts as $amount) {
            $list[$amount['amount']] = $amount['amount'];
        }
        return $list;
    }

    public function getFilterCountry() {
        $countries = $this->ecommerce_model->getCountry();
        $list = ['' => 'Select Country'];
        foreach ($countries as $country) {
            $list[$country['country_id']] = $country['country_name'];
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

    public function unset_cookies() {
        delete_cookie('latitude');
        delete_cookie('longitude');
        delete_cookie('country_id');
        delete_cookie('city_id');
        delete_cookie('address');
        return 1;
    }

    public function index() {
        $data['user_data'] = $this->getDataByUniqueId();
        $data['countries'] = $this->getFilterCountry();
        $data['all_cities'] = $this->ecommerce_model->getAllCities();
        $data['title'] = 'Home';
        $data['map_search'] = '1';
        $this->unset_cookies();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/index');
        $this->load->view('front/commons/footer');
    }

    public function set_city($city_id) {
        $this->output->set_content_type('application/json');
        // echo $city_id;
        // die;

        $city = $this->ecommerce_model->getCityNameByCityId($city_id);
        $country = $this->ecommerce_model->getCountryByCityId($city_id);

        // print_r($city);
        // print_r($country);
        // die;
        $geocode_stats = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyCda3VpSiUTaG60fI3sH4Ch2L1ch0Fo06A&address=" . $city['city_name'] . "&sensor=false");

        $output_deals = json_decode($geocode_stats);

        $latLng = $output_deals->results[0]->geometry->location;

        $latitude = $latLng->lat;
        $longitude = $latLng->lng;

        $lat = array(
            'name' => 'latitude',
            'value' => $latitude,
            'expire' => '36000000',
        );
        $this->input->set_cookie($lat);

        $long = array(
            'name' => 'longitude',
            'value' => $longitude,
            'expire' => '36000000',
        );
        $this->input->set_cookie($long);

        $count = array(
            'name' => 'country_id',
            'value' => $country['country_id'],
            'expire' => '36000000',
        );
        $this->input->set_cookie($count);

        $cit = array(
            'name' => 'city_id',
            'value' => $city_id,
            'expire' => '36000000',
        );
        $this->input->set_cookie($cit);

        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('store')]));
        return FALSE;
    }

    public function getCityByCountry() {
        $this->output->set_content_type('application/json');
        $country_id = $this->input->post('country_id');
        $city_id = $this->input->cookie('city_id', true);
        $cities = $this->ecommerce_model->getCityByCountry($country_id);
        $html = '<option value="">Select City</option>';
        foreach ($cities as $city) {
            $html .= '<option value=' . $city['city_id'];
            if (!empty($city_id)) {
                if ($city_id == $city['city_id']) {
                    $html .= ' selected';
                }
            }
            $html .= '>' . $city['city_name'] . '</option>';
        }
        $this->output->set_output(json_encode(['result' => 1, 'content' => $html]));
        return FALSE;
    }

    public function setCityData() {
        $this->output->set_content_type('application/json');
        $city_id = $this->input->post('city_id');
        $cookie = array(
            'name' => 'city_id',
            'value' => $city_id,
            'expire' => '36000000',
        );
        $this->input->set_cookie($cookie);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

    public function setUserLocation() {
        $this->output->set_content_type('application/json');
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');

        $cookie = array(
            'name' => 'latitude',
            'value' => $latitude,
            'expire' => '36000000',
        );
        $this->input->set_cookie($cookie);
        $cookie2 = array(
            'name' => 'longitude',
            'value' => $longitude,
            'expire' => '36000000',
        );
        $this->input->set_cookie($cookie2);
        $result = $this->checkNearByRestaurantStore();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => 0]));
            return FALSE;
        }
    }

    public function checkNearByRestaurantStore() {
        $latitude = $this->input->cookie('latitude', true);
        $longitude = $this->input->cookie('longitude', true);
        $restaurants = $this->ecommerce_model->getAllRestaurant();

        $i = 0;
        foreach ($restaurants as $restaurant) {
            $distance = round($this->distance($latitude, $longitude, $restaurant['latitude'], $restaurant['longitude'], "K"), 1);
            if ($distance <= 30) {
                $i++;
            }
            if ($i > 0) {
                break;
            }
        }
        $stores = $this->ecommerce_model->getAllStore();
        foreach ($stores as $store) {
            $distance = round($this->distance($latitude, $longitude, $store['latitude'], $store['longitude'], "K"), 1);
            if ($distance <= 30) {
                $i++;
            }
            if ($i > 0) {
                break;
            }
        }
        if ($i > 0) {
            return 1;
        } else {
            return 0;
        }
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

    public function setAddress() {
        $this->output->set_content_type('application/json');
        $user_data = $this->getDataByUniqueId();
        $address = $this->input->post('address');
        $cookie = array(
            'name' => 'address',
            'value' => $address,
            'expire' => '36000000',
        );
        $this->input->set_cookie($cookie);
        if (!empty($user_data['user_id'])) {
            $result = $this->ecommerce_model->saveUserAddress($user_data['user_id'], $address);
        }
        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('store')]));
        return FALSE;
    }

    public function aboutus() {
        $data['title'] = 'About us';
        $data['countries'] = $this->getFilterCountry();
        $data['user_data'] = $this->getDataByUniqueId();
        $data['all_languages'] = $this->ecommerce_model->getLanguage();
        $data['text_langs'] = $this->getLanguage();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/aboutus');
        $this->load->view('front/commons/footer');
    }

    public function career_detail($alias) {
        $data['title'] = 'Career Details';
        $data['countries'] = $this->getFilterCountry();
        $data['job_detail'] = $this->ecommerce_model->getJobDetailByJobName($alias);
        $data['user_data'] = $this->getDataByUniqueId();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/career-detail');
        $this->load->view('front/commons/footer');
    }

    public function career() {
        $data['title'] = 'Career';
        $data['countries'] = $this->getFilterCountry();
        $data['user_data'] = $this->getDataByUniqueId();
        $data['job_categories'] = $this->ecommerce_model->getActiveJobCategory();
        $data['job_type'] = $this->ecommerce_model->getJobType();
        $data['all_jobs'] = $this->ecommerce_model->getAllActiveJob();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/career', $data);
        $this->load->view('front/commons/footer');
    }

    public function courier() {
        $data['title'] = 'Courier';
        $data['user_data'] = $this->getDataByUniqueId();
        $data['countries'] = $this->getFilterCountry();
        $data['country_code'] = $this->ecommerce_model->getCountryCode();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/courier');
        $this->load->view('front/commons/footer');
    }

    public function partner_with_us() {
        $data['title'] = 'Patrner with us';
        $data['user_data'] = $this->getDataByUniqueId();
        $data['countries'] = $this->getFilterCountry();
        $data['country_code'] = $this->ecommerce_model->getCountryCode();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/partner-withus');
        $this->load->view('front/commons/footer');
    }

    public function help() {
        $data['title'] = 'Help';
        $data['user_data'] = $this->getDataByUniqueId();
        $data['categories'] = $this->ecommerce_model->getHelpCategory();
        $data['countries'] = $this->getFilterCountry();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/help', $data);
        $this->load->view('front/commons/footer');
    }

    public function help_category_wrapper() {
        $id = $this->input->post('cat_id');
        $this->output->set_content_type('application/json');
        $data['result'] = $this->ecommerce_model->help_category_wrapper($id);
        $content_wrapper = $this->load->view('front/help-content-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function privacy() {
        $data['user_data'] = $this->getDataByUniqueId();
        $data['title'] = 'Privacy';
        $data['content'] = $this->ecommerce_model->getPrivacyPageContent();
        $data['countries'] = $this->getFilterCountry();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/privacy', $data);
        $this->load->view('front/commons/footer');
    }

    public function terms() {
        $data['user_data'] = $this->getDataByUniqueId();
        $data['title'] = 'Terms and condition';
        $data['content'] = $this->ecommerce_model->getTermsPageContent();
        $data['countries'] = $this->getFilterCountry();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/terms', $data);
        $this->load->view('front/commons/footer');
    }

    public function tracking() {
        $data['user_data'] = $this->getDataByUniqueId();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/tracking');
        $this->load->view('front/commons/footer');
    }

    public function uniqueId() {
        $str = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNIPQRSTUVWXYZ';
        $nstr = str_shuffle($str);
        $unique_id = substr($nstr, 0, 14);
        return $unique_id;
    }

    public function doAddPartnerWithUs() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_message('is_unique', 'This User Alredy Registered With Us');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[partner_query.email]');
        $this->form_validation->set_rules('store_name', 'Store Name', 'required');
        $this->form_validation->set_rules('address1', 'Address', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('zipcode', 'Zip Code', 'required');
//        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('country_code', 'Country Code', 'required');
        $this->form_validation->set_rules('phone_no', 'Phone Number', 'required|max_length[10]');
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $otp = rand(1000, 9999);
        $country_code = $this->security->xss_clean(explode(',', $this->input->post('country_code')));
        $phone_no = $this->security->xss_clean($this->input->post('phone_no'));
        $country_code = $country_code[0];
        $usermobile = '+' . $country_code . $phone_no;
        $this->load->library('Tw');
        $this->tw->sendSms($usermobile, $otp);
        $result = $this->ecommerce_model->doAddPartnerWithUs($otp);
        if ($result) {
            $this->session->set_userdata('partnerId', $result);
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Recoed Inserted Successfully']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Please Fill All Field', 'url' => base_url('site/partner_with_us')]));
            return FALSE;
        }
    }

    public function doCheckPartnerOtp() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('otp', 'OTP', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->ecommerce_model->doUpdatePartner(($this->session->userdata('partnerId')));
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('site/partner-with-us'), 'msg' => 'Registration Successfully!!']));
            $this->session->unset_userdata('partnerId');
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Enter Valid OTP']));
            return FALSE;
        }
    }

    public function doAddCourier() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_message('is_unique', 'This User Alredy Registered With Us');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[courier_query.email]');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|max_length[10]');
        $this->form_validation->set_rules('store_address1', 'Address', 'required');
        $this->form_validation->set_rules('store_address2', 'Address', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('zipcode', 'Zip Code', 'required');
//        $this->form_validation->set_rules('country_code', 'Country Code', 'required');
//        $this->form_validation->set_rules('country', 'Country', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $otp = rand(1000, 9999);
        $country_code = $this->security->xss_clean(explode(',', $this->input->post('country_code')));
        $phone_no = $this->security->xss_clean($this->input->post('phone'));
        $country_code = $country_code[0];
        $usermobile = '+' . $country_code . $phone_no;
        $this->load->library('Tw');
        $this->tw->sendSms($usermobile, $otp);
        $result = $this->ecommerce_model->doAddCourier($otp);
        if ($result) {
            $this->session->set_userdata('courierId', $result);
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Recoed Inserted Successfully']));
            //$this->email($email, 'Canadian e-market admin login password', $Genpassword);
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Please Fill All Field', 'url' => base_url('site/courier')]));
            return FALSE;
        }
    }

    public function doCheckCourierOtp() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('courireOtp', 'OTP', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->ecommerce_model->doUpdateCourier(($this->session->userdata('courierId')));
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('site/courier'), 'msg' => 'Registration Successfully!!']));
            $this->session->unset_userdata('courierId');
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Enter Valid OTP']));
            return FALSE;
        }
    }

    public function sendOTP($phone_no, $otp) {
        
    }

    public function email($to, $subject, $messgage) {
        $this->email->from('canadianemarket@gmail.com');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($messgage);
        $this->email->send();
        return FALSE;
    }

    public function saveUrl() {
        $this->output->set_content_type('application/json');
        $postUrl = $this->input->post('postUrl');
        $this->session->set_userdata('postUrl', $postUrl);
        // echo $this->session->userdata('postUrl'); exit;
        $this->output->set_output(json_encode(['result' => 1, 'url' => $postUrl]));
        return FALSE;
    }

    public function jobEnquiry() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('job_first_name', 'First Name', 'required');
        $this->form_validation->set_rules('job_last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('job_email', 'Email', 'required');
        $this->form_validation->set_rules('job_cover_letter', 'Cover Letter', 'required');
        $job_alias = $this->input->post('job_alias');
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'url' => base_url('career-detail/' . $job_alias), 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $job_id = $this->input->post('job_id');
        if (!empty($_FILES['job_file']['name'])) {

            $resume_name = $this->doUploadResume();
        }
        $result = $this->ecommerce_model->jobEnquiry($job_id, $resume_name);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('career-detail/' . $job_alias), 'msg' => 'Applied For Job Successfully!!']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Enter All Detils Correctly']));
            return FALSE;
        }
    }

    function doUploadResume() {
        $config = array(
            'upload_path' => "./uploads/job_resume/",
            'allowed_types' => "jpeg|jpg|pdf|doc",
            'file_name' => rand(11111, 99999),
            'max_size' => "3048" // Can be set to particular file size , here it is 2 MB(2048 Kb)
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('job_file')) {
            $data = $this->upload->data();
            return $data['file_name'];
        } else {
            $this->session->set_userdata('error', ['file' => $this->upload->display_errors()]);
            return 0;
        }
    }

    //////////career job filter functions/////
    public function getFilteredJobtype($id) {
        $this->output->set_content_type('application/json');
        $data['job_type'] = $this->ecommerce_model->getFilteredJobtype($id);
        $content_wrapper = $this->load->view('front/jobType-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function getFilteredJobCity($id) {
        $this->output->set_content_type('application/json');
        $data['job_locations'] = $this->ecommerce_model->getFilteredJobCity($id);
        $content_wrapper = $this->load->view('front/jobLocation-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function getAllFilterId() {
        $this->output->set_content_type('application/json');
        $cat_name = $this->input->post('cat');
        $type_name = $this->input->post('type');
        $location_name = $this->input->post('location');
        $search_val = $this->input->post('search_val');
        $cat_id = $this->ecommerce_model->getCategoryIdByName($cat_name);
        $type_id = $this->ecommerce_model->getTypeIdByName($type_name);
        $cat_id = $cat_id['job_category_id'];
        $type_id = $type_id['job_type_id'];
        $data['all_jobs'] = $this->ecommerce_model->getFilteredJobs($cat_id, $type_id, $location_name, $search_val);
        $content_wrapper = $this->load->view('front/jobListingl-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function getFilteredJobs($cat_id, $type_id, $location_name, $search_val = NULL) {
        $this->output->set_content_type('application/json');
        $data['all_jobs'] = $this->ecommerce_model->getFilteredJobs($cat_id, $type_id, $location_name, $search_val = NULL);
        $content_wrapper = $this->load->view('front/jobListingl-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    ////////////////gift card functions
    public function gift_amount_validation() {
        if ($this->input->post('gift_amount') === ' ') {
            $this->form_validation->set_message('gift_amount_validation', 'Please Select Gift Amount');
            return FALSE;
        } else {
            return true;
        }
    }

    public function gift_card() {
        $data['title'] = 'Gift Card';
        $data['user_data'] = $this->getDataByUniqueId();
        $data['countries'] = $this->getFilterCountry();
        $data['gift_amounts'] = $this->getFilteredGiftAmount();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/giftcard');
        $this->load->view('front/commons/footer');
    }

    public function giftCard() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('receiver_name', 'Receiver Name', 'required');
        $this->form_validation->set_rules('receiver_address', 'Receiver Address', '');
        $this->form_validation->set_rules('emailid', 'Receiver Address', '');
        $this->form_validation->set_rules('gifter_name', 'Gifer Name', 'required');
        $this->form_validation->set_rules('gift_amount', 'Gift Amount', 'callback_gift_amount_validation');
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array(), 'url' => base_url('site/gift-card')]));
            return FALSE;
        }

        $gift_detail = $this->input->post(['receiver_name', 'unique_id', 'gifter_name', 'gift_amount', 'address_type', 'receiver_address', 'emailid', 'message']);
        $this->session->set_userdata('gift_detail', $gift_detail);
        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('site/payment')]));
        return FALSE;
    }

    public function payment() {
        $data['title'] = "Payment";
        $data['user_data'] = $this->getDataByUniqueId();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/payment');
        $this->load->view('front/commons/footer');
    }

    public function stripe_payment() {
        $gift_detail = $this->session->userdata('gift_detail');
        require_once('application/libraries/stripe-php/init.php');

        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));

        $charge = \Stripe\Charge::create([
                    "amount" => $gift_detail['gift_amount'],
                    "currency" => "usd",
                    "source" => $this->input->post('stripeToken'),
                    "description" => "Test payment for Gift Card"
        ]);
        $chargeJson = $charge->jsonSerialize();
        /*  for insert data in database start */
        $item_name = "Premium Script Webpreparations";
        $item_number = "PS123456";
        $item_price = $gift_detail['gift_amount'];
        $currency = "usd";
        $order_id = $this->uniqueId();

        $amount = $chargeJson['amount'];
        $txn_id = $chargeJson['balance_transaction'];
        $currency = $chargeJson['currency'];
        $status = $chargeJson['status'];

        $result = $this->ecommerce_model->insertIntoGiftcard($gift_detail);

        $insert_data = array(
            'card_num' => $this->input->post('card_number'),
            'card_cvc' => $this->input->post('card_code'),
            'card_exp_month' => $this->input->post('month'),
            'card_exp_year' => $this->input->post('year'),
            'item_name' => $item_name,
            'item_number' => $item_number,
            'item_price' => $item_price,
            'item_price_currency' => $currency,
            'paid_amount' => $amount,
            'paid_amount_currency' => $currency,
            'payment_status' => $status,
            'created_by' => 1,
            'created_date' => date('Y-m-d H:i:s'),
            'txn_id' => $txn_id,
            'gift_card_id' => $result
        );


        $result = $this->ecommerce_model->insert($insert_data);

        /*  for insert data in database close */
        $this->session->set_userdata('payment_id', $result);
        $this->session->set_flashdata('success', 'Payment made successfully.');
        redirect(base_url('site/confirm-order'));
    }

    public function confirm_order() {
        $data['user_data'] = $this->getDataByUniqueId();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/confirm-order');
        $this->load->view('front/commons/footer');
    }

    public function subscription() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('postdata', 'Email', 'required|valid_email|is_unique[`user_subscribe.user_email]');

        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->ecommerce_model->doSubscribe();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Thanks For Subscribe !!!']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Error In Subscribing']));
            return FALSE;
        }
    }

    public function do_search_data() {
        $this->output->set_content_type('application/json');
        $list = array();
        $restaurantdatas = $this->ecommerce_model->do_search_restaurantdata($this->input->post('postdata'));
        $productdatas = $this->ecommerce_model->do_search_productdata($this->input->post('postdata'));
        $i = 0;
        foreach ($restaurantdatas as $restaurantdata) {
            $list[$i]['category_name'] = $restaurantdata['category_name'];
            $list[$i]['restaurant_id'] = $restaurantdata['restaurant_id'];
            $list[$i]['restaurant_name'] = $restaurantdata['restaurant_name'];
            $list[$i]['address'] = $restaurantdata['address'];
            $list[$i]['opening_time_from'] = $restaurantdata['opening_time_from'];
            $list[$i]['opening_time_to'] = $restaurantdata['opening_time_to'];
            $i++;
        }
        foreach ($productdatas as $productdata) {
            $list[$i]['store_name'] = $productdata['store_name'];
            $list[$i]['address'] = $productdata['address'];
            $list[$i]['opening_time_from'] = $productdata['opening_time_from'];
            $list[$i]['opening_time_to'] = $productdata['opening_time_to'];
            $list[$i]['product_id'] = $productdata['product_id'];
            $list[$i]['product_name'] = $productdata['product_name'];
            $list[$i]['image_url'] = $productdata['image_url'];
            $list[$i]['price'] = $productdata['price'];
            $list[$i]['discount'] = $productdata['discount'];
            $i++;
        }
        $data['lists'] = $list;
        if (!empty($data['lists'])) {
            $search_wrapper = $this->load->view('front/search-wrapper', $data, true);
            $this->output->set_output(json_encode(['result' => 1, 'search_wrapper' => $search_wrapper]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Result Not Found Here']));
            return FALSE;
        }
    }

}
