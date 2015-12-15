<?php
class Base_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_viruses($name = FALSE) {
        if($name === FALSE) {
            $this->db->select('*')->from('threats')->where('approved', TRUE);
            $query = $this->db->get();
            return $query->result_array();
        }
        
        $query = $this->db->query("SELECT * FROM `threats` WHERE `alias` = '$name' LIMIT 1");
        return $query->row_array();
    }
    
    public function get_virus_by_id($id) {
        $query = $this->db->query("SELECT * FROM `threats` WHERE `id` = $id");
        return $query->row_array();
    }
    
    public function get_viruses_for_queue($id = FALSE) {
        if($id === FALSE) {
            $this->db->select('*')->from('threats')->where('approved', FALSE);//->order_by('name', 'ASC');
            $query = $this->db->get();
            return $query->result_array();
        }
        
        $query = $this->db->get_where('threats', array('id' => $id));
        return $query->row_array();
        
    }
    
    public function get_comments($virus_id = FALSE) {
        if($virus_id === FALSE) {
            $this->db->query("SELECT * FROM `comments` WHERE `approved` = 1 ORDER BY `created_date` DESC");
            $query = $this->db->get();
            return $query->result_array();
        }
        
        $query = $this->db->query("SELECT * FROM `comments` WHERE `virus_id` = $virus_id AND `approved` = 1 ORDER BY `created_date` DESC");
        return $query->result_array();
    }
    
//    public function set_virus() {
//        
//        $data = array(
//            'category'                  =>      $this->input->post('virus_category'),
//            'title'                     =>      $this->input->post('virus_title'),
//            'pub_date'                  =>      $this->input->post('virus_pub_date'),
//            'link'                      =>      $this->input->post('virus_link'),
//            'description'               =>      $this->input->post('virus_description'),
//            'occurrences'                =>      (integer) $this->input->post('virus_occurences'),
//            'additional_details'        =>      $this->input->post('virus_additional_details'),
//            'repair'                    =>      $this->input->post('virus_repair'),
//            'source_id'                 =>      (integer) $this->input->post('virus_source'),
//            'related_links'             =>      $this->input->post('virus_related_links'),
//            'approved'                  =>      false,
//            'approved_by'               =>      NULL,
//            'created_by'                =>      $this->session->userdata('username')   
//        );
//        return $this->db->insert('virus_definitions', $data);
//    }
    
    public function approve($id, $user) {
        $this->approved = TRUE;
        $this->approved_by = $user;
        
        $this->db->update('threats', $this, array('id' => $id));
    }
    
    public function update_threat() {
        //$this->id = $this->input->post('threat_id');
        $this->summary = $this->input->post('threat_summary');
        $this->description = $this->input->post('threat_description');
        $this->additional_details = $this->input->post('threat_additional_details');
        $this->repair = $this->input->post('threat_repair');
        $this->related_links = $this->input->post('threat_related_links');
        $this->occurences = (integer) $this->input->post('threat_occurrences');
        $this->total_devices = (integer) $this->input->post('threat_total_devices');
        $this->approved = FALSE;
        $this->approved_by = NULL;
        $this->created_by = $this->session->userdata('username');

        $this->db->update('threats', $this, array('id' => $this->input->post('threat_id')));
    }

    public function remove_threat($id) {
        $this->db->delete('threats', array('id' => $id));
    }
    
    
    public function remap_threat($id) {
        $this->new_category = $this->input->post('new_category');
        $this->new_name = $this->input->post('new_name');
        $this->new_group = $this->input->post('new_group');
        $this->modified = 1;
        $this->approved = 0;
        $this->approved_by = NULL;
        
        $this->db->update('threats', $this, array('id' => $id));
    }
    
    public function getFullModified() {
        $query = $this->db->query("SELECT `id`, `engine`, `threat`, `category`, `new_category`, `name`, `new_name`, `group`, `new_group` FROM `threats` WHERE `modified` = 1");
        return $query->result_array();
    }
    
    public function getModified() {
        $query = $this->db->query("SELECT `engine`, `threat`, `category`, `new_category`, `name`, `new_name`, `group`, `new_group` FROM `threats` WHERE `modified` = 1");
        return $query->result_array();
    }
    
    public function getModifiedRow() {
        $query = $this->db->query("SELECT  `id`, `engine`, `threat`, `category`, `new_category`, `name`, `new_name`, `group`, `new_group` FROM `threats` WHERE `modified` = 1");
        return $query->row_array();
    }
    
    public function resetModified() {
        $this->db->query("UPDATE `threats` SET `modified` = 0 WHERE `modified` = 1");
    }
    
    
    
    //re-mapping functions
    public function remap_all($results) {

        $id = $results['id'];
        $engine = $results['engine'];
        $threat = $results['threat'];
        $new_category = $results['new_category'];
        $new_name = $results['new_name'];
        $new_group = $results['new_group'];
        $alias = 'Armor.';
        
        
        if(isset($new_category) && strlen($new_category) > 0 && $new_category !== NULL) {
            $alias .= urlencode($new_category) . '.';
            $this->db->query("UPDATE `threats` SET `category` = '$new_category', `new_category` = NULL WHERE `id` = $id");
        }
        
        if(isset($new_name) && strlen($new_name) > 0 && $new_name !== NULL) {
            $this->db->query("UPDATE `threats` SET `name` = '$new_name', `new_name` = NULL WHERE `id` = $id");
            $alias .= urlencode($new_name);
        }
        
        if(isset($new_group) && strlen($new_group) > 0 && $new_group !== NULL) {
            $this->db->query("UPDATE `threats` SET `group` = '$new_group', `new_group` = NULL WHERE `id` = $id");
        }

        $this->db->query("UPDATE `threats` SET `alias` = '$alias' WHERE `id` = $id");
        
    }
    
    
    public function postAudit($results) {
        $data = array(
            'threat_id'             =>  $results['id'],
            'engine'                =>  $results['engine'],
            'threat'                =>  $results['threat'],
            'category'              =>  $results['category'],
            'new_category'          =>  $results['new_category'],
            'name'                  =>  $results['name'],
            'new_name'              =>  $results['new_name'],
            'group'                 =>  $results['group'],
            'new_group'             =>  $results['new_group'],
            'remap_by'              =>  $this->session->userdata('username')  
        );
        $this->db->insert('remap_audit', $data);    
    }
    
    //Used to return all armor threats mapped to threat
    public function getAssignments($threat) {
        $query = $this->db->query("SELECT `id`, `engine`, `threat`, `category`, `name`, `group`, `alias` FROM `threats` WHERE `threat` = '$threat'");
        return $query->result_array();
    }
    
    public function getAliases($alias) {
        $query = $this->db->query("SELECT `id`, `engine`, `threat`, `category`, `name`, `group`, `alias` FROM `threats` WHERE `alias` = '$alias'");
        return $query->result_array();
    }
    
    

    
    public function count($slug) {
        $query = $this->db->query("SELECT * from `threats` WHERE name = '$slug'");
        return $query->num_rows();
    }
    
    //Search
    public function search_by_title($keyword) {
        $query = $this->db->query("SELECT * from `threats` WHERE `alias` LIKE '%$keyword%' AND `approved` = 1");
        return $query->result_array();
    }
    
    
    
    
    //Sources
    public function get_sources($id = FALSE) {
        if($id === FALSE) {
            $this->db->select('*')->from('sources')->order_by('name', 'ASC');
            $query = $this->db->get();
            return $query->result_array();
        }
        
        $query = $this->db->get_where('sources', array('id' => $id));
        return $query->row_array();
    }
    
    
    //Categories
    public function get_categories($name = FALSE) {
        if($name === FALSE) {
            $this->db->select('*')->from('categories')->where('name', $name)->order_by('name', 'ASC');
            $query = $this->db->get();
            return $query->result_array();
        }

        $query = $this->db->get_where('categories', array('name' => $name));
        return $query->row_array();
    }

//    public function update_categories() {
//        $this->name = $this->input->post('name');
//
//        $this->db->update('categories', $this, array('id' => $this->input->post('id')));
//    }

    //insert any new category parsed from rss feed
//    public function insert_category($category) {
//
//        $data = array(
//            'name' => $category,
//            'created_by' => 'cron'
//        );
//        return $this->db->insert('categories', $data);
//    }
//    
//    public function remove_category($id) {
//        $this->db->delete('categories', array('id' => $id));
//    }
    
//    public function count_categories($name) {
//        $query = $this->db->query("SELECT * from `categories` WHERE name = '$name'");
//        return $query->num_rows();
//    }
    
    //used to insert a comment
    public function insert_comment($id) {

        $data = array(
            'virus_id'      => $id,
            'comment'       => $this->input->post('user_comment'),
            'approved'      => 0,
            'approved_by'   => NULL,
            'created_by'    => $this->session->userdata('username')
        );
        return $this->db->insert('comments', $data);
    }
    
    public function get_comments_for_queue($id = FALSE) {
        if($id === FALSE) {
            $this->db->select('*')->from('comments')->where('approved', FALSE);//->order_by('name', 'ASC');
            $query = $this->db->get();
            return $query->result_array();
        }
        
        $query = $this->db->get_where('comments', array('id' => $id));
        return $query->row_array();  
    }
    
    public function approve_comment($id, $user) {
        $this->approved = TRUE;
        $this->approved_by = $user;
        
        $this->db->update('comments', $this, array('id' => $id));
    }
    
    public function remove_comment($id) {
        $this->db->delete('comments', array('id' => $id));
    }
    
   public function get_summary($name) {
        $query = $this->db->query("SELECT `summary` FROM `threats` WHERE `alias` = '$name'");
       
        return $query->row_array();
    }

}
?>
