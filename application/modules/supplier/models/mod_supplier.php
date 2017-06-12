<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_supplier extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }
    
    public function get_status($id){
        $this->db->where('supId', $id);
        $query = $this->db->get(PREFIX_TBL.'suppliers');
        if($query->num_rows() > 0){
            $row = $query->row();
            return $row->supStatus;
        }else{
            return NULL;
        }
    }
    
    public function update_status($id, $status){
        $this->db->where('supId', $id);
        return $this->db->update(PREFIX_TBL.'suppliers', array('supStatus'=>$status));
    }
    
    public function delete($id){
        $this->db->where('supId', $id);
        return $this->db->update(PREFIX_TBL.'suppliers', array('supIsDeleted'=>1));
    }
    
    public function get_supplier_detail($sup_id){
        $this->db->where('supId',$sup_id);
        $this->db->limit(1);
        return $this->db->get(PREFIX_TBL.'suppliers')->row_array();
    }
}
