<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed extends CI_Controller {
    
    public function  __construct() {
        parent::__construct();
//        if(isset($_SERVER['REMOTE_ADDR'])) {
//            die('Command Line Only');
//        }
//        parent::Controller();
    }

    public function index()
    {
        //$this->output->enable_profiler(TRUE);
        $this->load->model('threat_model');
        
        //$threats = json_decode(file_get_contents('http://avapincus.cloudapp.net/get'), TRUE);
        //print_r($threats);//die();
        //echo count($threats);die();
        
//        $rc = 1;
//        foreach($threats as $threat) {
//            $this->threat_model->insert_virus($threat);
//            $rc++;
//        }

        //echo $rc . ' new threats have been added to the database.';
        
        echo 'Feed is currently disabled.';
    }

}