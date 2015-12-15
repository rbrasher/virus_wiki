<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function  __construct() {
        parent::__construct();
        $this->load->model('base_model');
        $this->logged_in();
    }

    public function index()
    {
        $data['username'] = $this->session->userdata('username');
        $data['is_admin'] = $this->session->userdata('admin');
        $data['items'] = $this->base_model->get_viruses();
        
        $data['qvs'] = $this->base_model->get_viruses_for_queue();
        $data['qcs'] = $this->base_model->get_comments_for_queue();
        
        $this->load->view('header', $data);
        $this->load->view('home');
        $this->load->view('footer');
    }

    public function view($name) {
        $data['username'] = $this->session->userdata('username');
        $data['is_admin'] = $this->session->userdata('admin');
        $data['item'] = $this->base_model->get_viruses($name);
        
        if(isset($data['item']['id'])) {
            $id = $data['item']['id'];
            $data['comments'] = $this->base_model->get_comments($id);
        } else {
            $data['comments'] = array();
        }
        
        
        $this->load->view('header', $data);
        $this->load->view('virus');
        $this->load->view('footer');
    }
    
    public function view_by_id($id) {
        $data['username'] = $this->session->userdata('username');
        $data['is_admin'] = $this->session->userdata('admin');
        $data['item'] = $this->base_model->get_virus_by_id($id);
        
        if(isset($data['item']['id'])) {
            $id = $data['item']['id'];
            $data['comments'] = $this->base_model->get_comments($id);
        } else {
            $data['comments'] = array();
        }
        
        
        $this->load->view('header', $data);
        $this->load->view('virus_by_id');
        $this->load->view('footer');
    }
    
    public function viewrelated($id) {
        $data['username'] = $this->session->userdata('username');
        $data['is_admin'] = $this->session->userdata('admin');
        
        $key = $this->base_model->get_virus_by_id($id);
        
        $data['engine'] = $key['engine'];
        $data['threat'] = $key['threat'];
        
        $file = 'http://avapincus.cloudapp.net/related?engine=' . urlencode($data['engine']) . '&threat=' . urlencode($data['threat']);
        
        $data['related_threats'] = json_decode(file_get_contents($file), TRUE);
        
        $this->load->view('header', $data);
        $this->load->view('relatedthreats');
        $this->load->view('footer');
    }
    
    public function getAssignmentsByThreat($threat) {
        $data['username'] = $this->session->userdata('username');
        $data['is_admin'] = $this->session->userdata('admin');
        
        
        $data['assignments'] = $this->base_model->getAssignments($threat);
        $data['threat'] = $threat;
        
        $this->load->view('header', $data);
        $this->load->view('assignments');
        $this->load->view('footer');
    }
    
    public function getThreatsByAlias($alias) {
        $data['username'] = $this->session->userdata('username');
        $data['is_admin'] = $this->session->userdata('admin');
        
        
        $data['aliases'] = $this->base_model->getAliases($alias);
        $data['armor_alias'] = $alias;
        
        $this->load->view('header', $data);
        $this->load->view('aliases');
        $this->load->view('footer');
    }
    
    
    
//    public function add_virus_definition() {
//        $this->load->library('form_validation');
//        
//        $data['username'] = $this->session->userdata('username');
//        $data['is_admin'] = $this->session->userdata('admin');
//        $data['categories'] = $this->base_model->get_categories();
//        $data['sources'] = $this->base_model->get_sources();
//        
//        $this->form_validation->set_rules('virus_category', 'Virus Category', 'required');
//        $this->form_validation->set_rules('virus_title', 'Virus Title', 'required');
//        $this->form_validation->set_rules('virus_description', 'Virus Definition', 'required');
//
//        if($this->form_validation->run() === FALSE) {
//            $this->load->view('header', $data);
//            $this->load->view('add_virus_definition');
//            $this->load->view('footer');
//        } else {
//            $this->base_model->set_virus();
//            redirect(base_url());
//        }
//    }

    public function edit_threat_definition($id) {
        $data['username'] = $this->session->userdata('username');
        $data['is_admin'] = $this->session->userdata('admin');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('threat_engine', 'Threat Engine', 'required');

        if($this->form_validation->run() === FALSE) {
            $data['virus'] = $this->base_model->get_virus_by_id($id);
            
            $this->load->view('header', $data);
            $this->load->view('edit_threat');
            $this->load->view('footer');
        } else {
            $this->base_model->update_threat();

            redirect(base_url());
        }
    }
    
    public function approve_threat($id) {
        $this->base_model->approve($id, $this->session->userdata('username'));
        redirect(base_url());
    }
    
    public function delete_threat($id) {
        $this->base_model->remove_threat($id);
        redirect(base_url());
    }
    
    
    public function remap_threat($id) {
        $data['username'] = $this->session->userdata('username');
        $data['is_admin'] = $this->session->userdata('admin');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('engine', 'Threat Engine', 'required');

        if($this->form_validation->run() === FALSE) {
            $data['threat'] = $this->base_model->get_virus_by_id($id);
            $this->load->view('header', $data);
            $this->load->view('remap_threat');
            $this->load->view('footer');
        } else {
            $this->base_model->remap_threat($id);
            $this->postModified();
            redirect(base_url());
        }
    }
    
    public function getModified() {
        $results = $this->base_model->getModified();

        $postdata = array();
        $postdata = json_encode($results, true);
        
        echo $postdata;
    }
    
    public function postModified() {
        
        $this->load->helper('app_log');

        $results = $this->base_model->getModified();
        $updates = $this->base_model->getModifiedRow();
        
        $urltopost = 'http://avapincus.cloudapp.net/update';
        $datatopost = json_encode($results);
        
        //set curl options
        $ch = curl_init($urltopost);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datatopost);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $returndata = curl_exec($ch);
        
        if($returndata !== '[]') {
            app_log('<br />ERROR:<br />' . $returndata . '<br />Posted: ' . date('m-d-Y H:i:s'));
            //return false;
        } else {
            $this->base_model->remap_all($updates);
            $this->base_model->postAudit($updates);
            $this->base_model->resetModified();
            //return true;
        }
    }

    
    
    
    
    //comment functions
    public function add_comment($id) {
        $this->base_model->insert_comment($id);

        redirect(base_url().'view/'.$id);

    }
    
    public function approve_comment($id) {
        $this->base_model->approve_comment($id, $this->session->userdata('username'));
        redirect(base_url());
    }
    
    public function delete_comment($id) {
        $this->base_model->remove_comment($id);
        redirect(base_url());
    }
    
    
    
    
    //Search function
    public function search_by_title() {
        $data['username'] = $this->session->userdata('username');
        $data['is_admin'] = $this->session->userdata('admin');
        
        $keyword = $this->input->post('search_box');
        $data['results'] = $this->base_model->search_by_title($keyword);

        $this->load->view('header', $data);
        $this->load->view('search');
        $this->load->view('footer');
    }
    
    
    
    
    
    
    
    
    //used to send summary and link to app - DO NOT REMOVE OR MODIFY
    public function getSummary($name) {
        $data = $this->base_model->get_summary($name);
        if(count($data) == 0) {
            $data = array(
                'summary'   =>  ''
            );
        }
        $link = array(
            'link'  =>  base_url().'view/' . $name
        );
        
        $postdata = array_merge($data, $link);
        echo json_encode($postdata);
    }
    
    
    
    
//    //USER
    function logged_in() {
        $logged_in = $this->session->userdata('logged_in');

//        if(!isset($logged_in) || $logged_in != true) {
//            redirect(base_url() . 'login');
//        }
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