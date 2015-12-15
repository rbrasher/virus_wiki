<?php
class Admin_model extends CI_Model {

    public function __construct() {
        $this->load->database();
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
    
    public function set_source($file) {
        $data = array(
            'name'              =>      $this->input->post('source_name'),
            'website'           =>      $this->input->post('source_website'),
            'logo'              =>      $file[0],
            'created_by'        =>      $this->session->userdata('username')   
        );
        return $this->db->insert('sources', $data);
    }
    
    public function update_sources($id) {
        $this->name = $this->input->post('source_name');
        $this->website = $this->input->post('source_website');

        $this->db->update('sources', $this, array('id' => $id));
    }
    
    public function remove_source($id) {
        $this->db->delete('sources', array('id' => $id));
    }
    
    
    //Categories
    public function get_categories($id = FALSE) {
        if($id === FALSE) {
            $this->db->select('*')->from('categories')->order_by('name', 'ASC');
            $query = $this->db->get();
            return $query->result_array();
        }

        $query = $this->db->get_where('categories', array('id' => $id));
        return $query->row_array();
    }
    
    public function set_category() {
        $data = array(
            'name'              =>      $this->input->post('category_name'),
            'created_by'        =>      $this->session->userdata('username')   
        );
        return $this->db->insert('categories', $data);
    }

    public function update_category($id) {
        $this->name = $this->input->post('category_name');

        $this->db->update('categories', $this, array('id' => $id));
    }
    

    //insert any new category parsed from rss feed
    public function insert_category($category) {

        $data = array(
            'name' => $category,
            'created_by' => 'cron'
        );
        return $this->db->insert('categories', $data);
    }
    
    public function remove_category($id) {
        $this->db->delete('categories', array('id' => $id));
    }
    
    public function count_categories($name) {
        $query = $this->db->query("SELECT * from `categories` WHERE name = '$name'");
        return $query->num_rows();
    }
    
    
    
    //Users
    public function get_users($id = FALSE) {
        if($id === FALSE) {
            $this->db->select('*')->from('wiki_users')->order_by('last_name', 'ASC');
            $query = $this->db->get();
            return $query->result_array();
        }
        
        $query = $this->db->get_where('wiki_users', array('id' => $id));
        return $query->row_array();
    }
    
    
    public function update_user($id) {
        $this->first_name = $this->input->post('user_first_name');
        $this->last_name = $this->input->post('user_last_name');
        $this->username = $this->input->post('user_username');
        $this->password = $this->input->post('user_password');
        $this->email_address = $this->input->post('user_email');
        $this->admin = $this->input->post('chk_admin');

        $this->db->update('wiki_users', $this, array('id' => $id));
    }
    
    public function remove_user($id) {
        $this->db->delete('wiki_users', array('id' => $id));
    }
    
    
    
    
    

    //insert viruses parsed from rss feed
    public function insert_virus($item) {

        $data = array(
            'category'      => $item['category'],
            'title'         => $item['title'],
            'pub_date'      => $item['pub_date'],
            'link'          => $item['link'],
            'description'   => $item['description'],
            'created_by'    => 'cron'
        );
        return $this->db->insert('virus_definitions', $data);
    }

    
    public function count($slug) {
        $query = $this->db->query("SELECT * from `virus_definitions` WHERE title = '$slug'");
        return $query->num_rows();
    }

}
?>