<?php
class Mod_global extends CI_Model {

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}
	
	
	
	/*
	 * function insert_row()
	 */
	public function insert_rows($table,$data){
	 	return $this->db->insert(PREFIX_TBL.$table,$data);;
	}
        
        /*
	 * function insert_batch()
	 */
	public function insert_batch($table,$data){
	 	return $this->db->insert_batch(PREFIX_TBL.$table,$data);;
	}
	
	/*
	 * function insert_rows_get_last_id()
	 */
	public function insert_rows_get_last_id($table, $data){
            if($this->db->insert(PREFIX_TBL.$table, $data)){
                return $this->db->insert_id();
            }
            return false;
	}
	
	/*
	 * function update_row()
	 */
	public function update_row($table, $where, $data){
		$this->db->set($data);
                if($where != NULL){
                    foreach($where as $field => $value){
                        $this->db->where($field,$value);
                    }
                }
		
		return $this->db->update(PREFIX_TBL.$table);
	}
	
	/*
	 * function update_row_batch()
	 * 
	 */
	public function update_row_batch($table, $id, $data){
		$this->db->update_batch(PREFIX_TBL.$table,$data,$id);
	}
	
	/*
	 * function delete_rows()
	 * 
	 */
	public function delete_rows($table, $where = NULL){
            if($where != NULL){
                foreach($where as $field => $value){
                    $this->db->where($field, $value);
                }
            }
            return $this->db->delete(PREFIX_TBL.$table);
	}
	
	/*
	 * function select_row_array()
	 */
	public function select_row_array($table, $where){
            $this->db->where($where);
            $query = $this->db->get(PREFIX_TBL.$table);
            return $query->result_array();
	}
	
	/*
	 * function select_row_array()
	 */
	public function select_row_array_once($table, $where){
		$this->db->where($where);
		$query = $this->db->get(PREFIX_TBL.$table);
		return $query->row();
	}
        
        /*
         * function select_where_in()
         */
	public function select_where_in($table, $where_in){
            $this->db->where_in('cusId', $where_in);
            $query = $this->db->get(PREFIX_TBL.$table);
            return $query->result();
        }
        
	/*
	 * function select_rows()
	 */
	public function select_rows($table, $where = NULL){
		$query = NULL;
		if($where != NULL){
			$this->db->where($where);
			$query = $this->db->get(PREFIX_TBL.$table);
		}else{
			$query = $this->db->get(PREFIX_TBL.$table);
		}
		return $query;
	}
        
        /*
	 * function select_rows_join()
	 */
	public function select_rows_join($table, $joins = NULL, $where = NULL){
		$query = NULL;
                $this->db->select('*');
                $this->db->from(PREFIX_TBL.$table);
                if($joins != NULL){
                    foreach($joins as $table=>$join_value){
                        $this->db->join(PREFIX_TBL.$table,PREFIX_TBL.$join_value[0].'='.PREFIX_TBL.$join_value[1],'inner');
                    }
                }
		if($where != NULL){
			$this->db->where($where);
			$query = $this->db->get();
		}else{
			$query = $this->db->get();
		}
		return $query;
	}
	
	/*
	 * function get_last_id()
	 */
	public function get_last_id($table, $id){
            $this->db->select_max($id);
	    $result= $this->db->get(PREFIX_TBL.$table)->row_array();
	    return $result[$id];
	}
	
	/*
	 * function get_string_value()
	 */
	public function get_string_value($table, $id, $field){
            $this->db->select_max($id);
	    $result = $this->db->get(PREFIX_TBL.$table)->row_array();
	    return $result[$field];
	}
        
        /*
         * function get_field_string
         */
        public function get_field_string($table, $field, $where = NULL){
            if($where != NULL){
                foreach($where as $key=>$value){
                    $this->db->where($key, $value);
                }
            }
            $this->db->limit(1);
            $query = $this->db->get(PREFIX_TBL.$table)->row();
            return $query->$field;
        }
	
	/*
	 * function validate_row()
	 */
	public function validate_row($table, $where){
		$this->db->where($where);
		$query = $this->db->get(PREFIX_TBL.$table);
		$rows = $query->num_rows();
		if($rows == 0){
			return FALSE;
		}else {
			return TRUE;
		}
	}
        
        /*
         * function check_item_exist($id)
         */
        public function check_item_exist($table,$fields){
            if(is_array($fields)){
                foreach($fields as $key => $value){
                    $this->db->where($key, $value);
                }
                return $this->db->get(PREFIX_TBL.$table)->num_rows();
            }
            return 0;
        }
	
}