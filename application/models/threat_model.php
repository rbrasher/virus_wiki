<?php
class Threat_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    
    public function get_viruses($slug = FALSE) {
        if($slug === FALSE) {
            $this->db->select('*')->from('threats')->order_by('name', 'ASC');
            $query = $this->db->get();
            return $query->result_array();
        }
        
        $query = $this->db->query("SELECT * from `threats` WHERE name = '$slug'");
        return $query->row_array();
    }
            
    //used to insert a virus definition from a feed
    public function insert_virus($threat) {

        $data = array(
            'engine'                => $threat['Engine'],
            'threat'                => $threat['Threat'],
            'category'              => $threat['Category'],
            'new_category'           => NULL,
            'name'                  => $threat['Name'],
            'new_name'               => NULL,
            'group'                 => $threat['Group'],
            'new_group'              => NULL,
            'modified'              => 0,
            'alias'                 => 'Armor.' . urlencode($threat['Category']) . '.' . urlencode($threat['Name']),
            'created_by'            => 'cron'
        );
        return $this->db->insert('threats', $data);
    }
    
    public function count($slug) {
        $query = $this->db->query("SELECT * from `threats` WHERE threat = '$slug'");
        return $query->num_rows();
    }
    
    //Search
    public function search_by_title($keyword) {
        $query = $this->db->query("SELECT * from `threats` WHERE name LIKE '%$keyword%'");
        return $query->result_array();
    }
    
    public function getModified() {
        $query = $this->db->query("SELECT `engine`, `threat`, `category`, `new_category`, `name`, `new_name`, `group`, `new_group` FROM `threats` WHERE `modified` = 1");
        return $query->result_array();
    }
    
    public function resetModified() {
        $this->db->query("UPDATE `threats` SET `modified` = 0 WHERE `modified` = 1");
    }
    
    public function getModifiedCount() {
        $query = $this->db->query("SELECT * FROM `threats` WHERE `modified` = 1");
        return $query->num_rows();
    }
    
    public function getSummary($new_name) {
        $query = $this->db->query("SELECT `summary` FROM `threats` WHERE `new_name` = $new_name LIMIT 1");
        return $query->result_array();
    }
    
    
    
    //re-mapping functions
    public function remap_name($new_map_keyword, $new_name) {
        $query = $this->db->query("SELECT * from `threats` WHERE name LIKE '%$new_map_keyword%'");
        $changes = $query->result_array();
        
        foreach ($changes as $change) {
            $id = $change['id'];
            
            $this->db->query("UPDATE `threats` SET `new_name` = '$new_name', `modified` = 1 WHERE `id` = $id");
        }
    }
    
    public function remap_category($new_map_keyword, $new_category) {
        $query = $this->db->query("SELECT * from `threats` WHERE name LIKE '%$new_map_keyword%'");
        $changes = $query->result_array();
        
        foreach ($changes as $change) {
            $id = $change['id'];
            
            $this->db->query("UPDATE `threats` SET `new_category` = '$new_category', `modified` = 1 WHERE `id` = $id");
        }
    }
    
    public function remap_group($new_map_keyword, $new_group) {
        $query = $this->db->query("SELECT * from `threats` WHERE name LIKE '%$new_map_keyword%'");
        $changes = $query->result_array();
        
        foreach ($changes as $change) {
            $id = $change['id'];
            
            $this->db->query("UPDATE `threats` SET `new_group` = '$new_group', `modified` = 1 WHERE `id` = $id");
        }
    }

}
?>
