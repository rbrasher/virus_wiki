<?php
class Login extends CI_Controller {
    function index() {
        $this->load->view('header');
        $this->load->view('login_form');
        $this->load->view('footer');
    }

    function validate_credentials() {
        $this->load->model('user_model');
        $query = $this->user_model->validate();
        $admin = $this->user_model->is_admin();
        
        if($query)      //if the user's credentials validated
        {
            if($admin) {
                $data = array(
                    'username'      =>  $this->input->post('username'),
                    'logged_in'     =>  true,
                    'admin'         =>  true
                );
            } else {
                $data = array(
                    'username'      =>  $this->input->post('username'),
                    'logged_in'     =>  true,
                    'admin'         =>  false
                );
            }
            
            $this->session->set_userdata($data);
            redirect(base_url());
            //redirect('admin');
        }    
        else
        {
            redirect('login');
        }
    }

    function signup() {
        $this->load->view('header');
        $this->load->view('signup_form');
        $this->load->view('footer');
    }

    function create_user() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('first_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'trim|required|matches[password]');

        if($this->form_validation->run() == FALSE) {
            $this->load->view('header');
            $this->load->view('signup_form');
            $this->load->view('footer');
        } else {
            $this->load->model('user_model');
            $this->user_model->create_user();

            $this->load->view('header');
            $this->load->view('signup_successful');
            $this->load->view('footer');
        }
    }
}

?>
