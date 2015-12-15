<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Threat extends CI_Controller {
    
    public function  __construct() {
        parent::__construct();
        $this->load->model('threat_model');
        $this->logged_in();
    }

    public function index()
    {
        $this->output->enable_profiler(TRUE);
        $data['username'] = $this->session->userdata('username');
        $data['is_admin'] = $this->session->userdata('admin');
        $data['items'] = $this->threat_model->get_viruses();
        $data['remap_keyword'] = '';
        
        $this->load->view('header', $data);
        $this->load->view('threats');
        $this->load->view('footer');
    }

    public function search_by_title() {
        $data['username'] = $this->session->userdata('username');
        $data['is_admin'] = $this->session->userdata('admin');
        
        $data['keyword'] = $this->input->post('remap_keyword');
        $data['items'] = $this->threat_model->search_by_title($data['keyword']);

        $this->load->view('header', $data);
        $this->load->view('threats');
        $this->load->view('footer');
    }
    
    public function remap_virus() {
        $data['username'] = $this->session->userdata('username');
        $data['is_admin'] = $this->session->userdata('admin');
        
        $new_map_keyword = $this->input->post('new_remap_keyword');
        $new_category = $this->input->post('new_category');
        $new_name = $this->input->post('new_name');
        $new_group = $this->input->post('new_group');
        
        //remap category
        if(isset($new_category) && strlen($new_category) > 0) {
            $this->threat_model->remap_category($new_map_keyword, $new_category);
        }
        
        //remap name
        if(isset($new_name) && strlen($new_name) > 0) {
            $this->threat_model->remap_name($new_map_keyword, $new_name);
        }
        
        //remap group
        if(isset($new_group) && strlen($new_group) > 0) {
            $this->threat_model->remap_group($new_map_keyword, $new_group);
        }
        
        redirect(base_url() . 'threat');
    }
    
    
    
    public function getModified() {
        //$this->load->helper('app_log');
        
        $this->output->enable_profiler(TRUE);
        
        $results = $this->threat_model->getModified();

        $postdata = array();
        $postdata = json_encode($results, true);
        
        echo $postdata;
        
        //app_log('<br /><br />' . $postdata . ' - ' . date('m-d-Y H:i:s'));
    }
    
    public function postModified() {
        $this->load->helper('app_log');

        $results = $this->threat_model->getModified();

        $urltopost = 'http://avapincus.cloudapp.net/update';
        $datatopost = json_encode($results);
        //print_r($datatopost);die();
        
        //set curl options
        $ch = curl_init($urltopost);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datatopost);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $returndata = curl_exec($ch);
        
        if($returndata !== '[]') {
            app_log('<br />ERROR:<br />' . $returndata . '<br />Posted: ' . date('m-d-Y H:i:s'));
            return false;
        } else {
            $this->threat_model->resetModified();
            return true;
        }
    }
    
   
    
    
//    //USER
    function logged_in() {
        $logged_in = $this->session->userdata('logged_in');

        if(!isset($logged_in) || $logged_in != true) {
            redirect(base_url() . 'login');
        }
    }

    function logout() {
        $data = array(
            'username'      =>  '',
            'logged_in'     =>  false,
            'admin'         =>  false
        );

        $this->session->unset_userdata($data);
        redirect(base_url());
    }
    
}