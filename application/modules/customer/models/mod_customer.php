<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_customer extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }
    
    public function get_status($id){
        $this->db->where('cusId', $id);
        $query = $this->db->get(PREFIX_TBL.'customers');
        if($query->num_rows() > 0){
            $row = $query->row();
            return $row->cusStatus;
        }else{
            return NULL;
        }
    }
    
    public function update_status($id, $status){
        $this->db->where('cusId', $id);
        return $this->db->update(PREFIX_TBL.'customers', array('cusStatus'=>$status));
    }
    
    public function delete($id){
        $this->db->where('cusId', $id);
        return $this->db->update(PREFIX_TBL.'customers', array('cusIsDeleted'=>1));
    }
    
    public function get_customer_detail($cus_id){
        $this->db->where('cusId',$cus_id);
        $this->db->limit(1);
        return $this->db->get(PREFIX_TBL.'customers')->row_array();
    }
}
