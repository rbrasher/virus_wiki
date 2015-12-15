<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wiki extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $this->load->model('admin_model');
        
        //$file = 'http://10.15.22.84:8585/api/values/?id=7F888C6E-9D81-4F50-B3FA-2EB932F858F8'; //param id = unique virus id (used to update occurrences)
        $file = 'http://10.15.22.84:8585/api/values/'; //used to return all virus records
        
        $results = json_decode(file_get_contents($file));
        
        print_r($results);
        die();
        
        $rc = 0;
        $this->benchmark->mark('parse_start');
        
        foreach($results as $result) {
            $result['xref_id'] = '';
            $result['title'] = '';
            $result['pub_date'] = '';
            $result['description'] = '';
            $result['additional_details'] = '';
            $result['repair'] = '';
            $result['occurences'] = (integer)$number;
            $result['total_devices'] = (integer)$total_devices;
            $result['trend_direction'] = (integer)$trend;
            $result['source_id'] = (integer)$source_id;
            $result['related_link'] = '';
            $result['approved'] = 1;
            $result['approved_by'] = 'cron';
            $result['created_by'] = 'cron';
        }
        
        $count = $this->admin_model->count($title);

        if($count == 0) {
            $this->admin_model->insert_virus($new_virus);
            $rc++;
        }
        
        $this->benchmark->mark('parse_end');
        
        echo $rc . ' new viruses have been added to the database. Elapsed Time: ' . $this->benchmark->elapsed_time('parse_start', 'parse_end');
    }
}
