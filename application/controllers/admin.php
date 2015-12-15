<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
    var $upload_path;
    
    public function  __construct() {
        parent::__construct();
        $this->load->model('admin_model');
        $this->logged_in();
        
        $this->upload_path = realpath(APPPATH . '../images/sources');
    }

    public function index()
    {
        $data['username'] = $this->session->userdata('username');
        $data['is_admin'] = $this->session->userdata('admin');
        
        //$data['sources'] = $this->admin_model->get_sources();
        //$data['categories'] = $this->admin_model->get_categories();
        $data['users'] = $this->admin_model->get_users();
        
        $this->load->view('admin_header', $data);
        $this->load->view('admin');
        $this->load->view('admin_footer');
    }

    //Sources
    public function add_source() {
        $this->load->library('form_validation');
        
        $data['username'] = $this->session->userdata('username');
        $data['is_admin'] = $this->session->userdata('admin');

        $this->form_validation->set_rules('source_name', 'Soruce Name', 'required');
        $this->form_validation->set_rules('source_website', 'Source Website', 'required');

        if($this->form_validation->run() === FALSE) {
            $this->load->view('admin_header', $data);
            $this->load->view('add_source');
            $this->load->view('admin_footer');
        } else {
            
            $file_name = array();
            //handle file uploads
            if($this->input->post('submit')) {
                foreach($_FILES as $file) {
                    array_push($file_name, $file['name']);
                }
                $this->do_upload();
            }
            
            $this->admin_model->set_source($file_name);
            redirect('../admin');
        }
    }
    
    public function edit_source($id) {
        $this->load->library('form_validation');
        
        $data['username'] = $this->session->userdata('username');
        $data['is_admin'] = $this->session->userdata('admin');
        
        $this->form_validation->set_rules('source_name', 'Soruce Name', 'required');
        $this->form_validation->set_rules('source_website', 'Source Website', 'required');

        if($this->form_validation->run() === FALSE) {
            $data['source'] = $this->admin_model->get_sources($id);

            $this->load->view('admin_header', $data);
            $this->load->view('edit_source');
            $this->load->view('admin_footer');
        } else {
            $this->admin_model->update_sources($id);

            redirect('../admin');
        }
    }
    
    public function delete_source($id) {
        $this->admin_model->remove_source($id);
        redirect('../admin');
    }
    
    
    
    //Categories
    public function add_category() {
        $this->load->library('form_validation');
        
        $data['username'] = $this->session->userdata('username');
        $data['is_admin'] = $this->session->userdata('admin');
        
        $this->form_validation->set_rules('category_name', 'Category Name', 'required');

        if($this->form_validation->run() === FALSE) {
            $this->load->view('admin_header', $data);
            $this->load->view('add_category');
            $this->load->view('admin_footer');
        } else {
            $this->admin_model->set_category();
            redirect('../admin');
        }
    }
    
    public function edit_category($id) {
        $this->load->library('form_validation');
        
        $data['username'] = $this->session->userdata('username');
        $data['is_admin'] = $this->session->userdata('admin');
        
        $this->form_validation->set_rules('category_name', 'Category Name', 'required');

        if($this->form_validation->run() === FALSE) {
            $data['category'] = $this->admin_model->get_categories($id);
            
            $this->load->view('admin_header', $data);
            $this->load->view('edit_category');
            $this->load->view('admin_footer');
        } else {
            $this->admin_model->update_category($id);
            redirect('../admin');
        } 
    }
    
    public function delete_category($id) {
        $this->admin_model->remove_category($id);
        redirect('../admin');
    }
    
    //Viruses
    public function add_virus_definition() {
        $this->load->library('form_validation');
        
        $data['username'] = $this->session->userdata('username');
        $data['is_admin'] = $this->session->userdata('admin');
        $data['categories'] = $this->base_model->get_categories();
        $data['sources'] = $this->base_model->get_sources();
        
        $this->form_validation->set_rules('virus_category', 'Virus Category', 'required');
        $this->form_validation->set_rules('virus_title', 'Virus Title', 'required');
        $this->form_validation->set_rules('virus_description', 'Virus Definition', 'required');

        if($this->form_validation->run() === FALSE) {
            $this->load->view('header', $data);
            $this->load->view('add_virus_definition');
            $this->load->view('footer');
        } else {
            $this->base_model->set_virus();
            redirect(base_url());
        }
    }

    public function edit_virus_definition($id) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('virus_title', 'Virus Title', 'required');
        $this->form_validation->set_rules('virus_description', 'Virus Definition', 'required');

        if($this->form_validation->run() === FALSE) {
            $data['virus'] = $this->base_model->get_viruses($id);
            $data['categories'] = $this->base_model->get_categories();
            $data['sources'] = $this->base_model->get_sources();
            
            $this->load->view('header', $data);
            $this->load->view('edit_virus');
            $this->load->view('footer');
        } else {
            $this->base_model->update_virus();

            redirect(base_url());
        }
    }

    public function delete_virus($id) {
        $this->admin_model->remove_virus($id);
        redirect('../admin');
    }
    
    
    public function search_by_title() {
        $data['username'] = $this->session->userdata('username');
        $data['is_admin'] = $this->session->userdata('admin');
        
        $keyword = $this->input->post('search_box');
        $data['results'] = $this->base_model->search_by_title($keyword);

        $this->load->view('admin_header', $data);
        $this->load->view('search');
        $this->load->view('admin_footer');
    }
    
    
    
    //Users
    public function edit_user($id) {
        $this->load->library('form_validation');
        
        $data['username'] = $this->session->userdata('username');
        $data['is_admin'] = $this->session->userdata('admin');
        
        $this->form_validation->set_rules('user_first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('user_last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('user_username', 'UserName', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('user_email', 'Email Address', 'trim|required|valid_email');

        if($this->form_validation->run() === FALSE) {
            $data['user'] = $this->admin_model->get_users($id);

            $this->load->view('admin_header', $data);
            $this->load->view('edit_user');
            $this->load->view('admin_footer');
        } else {
            $this->admin_model->update_user($id);

            redirect('../admin');
        }
    }
    
    public function delete_user($id) {
        $this->admin_model->remove_user($id);
        redirect('../admin');
    }
 
    
    
    //handle upload
    function do_upload()
    {
        $config = array(
            'allowed_types'     => 'jpg|jpeg|gif|png',
            'upload_path'       => $this->upload_path,
            'remove_spaces'     => true
        );

        $this->load->library('upload');

        foreach($_FILES as $key => $value)
        {
            if( ! empty($key))
            {

            $this->upload->initialize($config);

                if ( ! $this->upload->do_upload($key))
                {
                    print_r($errors[] = $this->upload->display_errors());
                }
                else
                {

                }
            }
        }
    }
    
    

    //USER
    function logged_in() {
        $logged_in = $this->session->userdata('logged_in');

        if(!isset($logged_in) || $logged_in != true) {
            redirect('../login');
        }
    }

    function logout() {
        $data = array(
            'username'      =>  '',
            'logged_in'     =>  false
        );

        $this->session->unset_userdata($data);
        redirect(base_url());
    }
}
