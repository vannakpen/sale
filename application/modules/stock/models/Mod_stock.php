<?php

class Mod_stock extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    protected function get_parent_item(&$input, &$output, $parent_id) {
        foreach ($input as $key => $item)
            if ($item->stoIteParentId == $parent_id) {
                $output[] = $item;
                unset($input[$key]);
                // Sort nested!!
                $this->get_parent_item($input, $output, $item->stoIteParentId);
            }
    }

    public function sort_parent_tree($parentId = null) {
        $tree = array();
        $this->db->where('stoIteType', 2);
        $query = $this->db->get(PREFIX_TBL . 'stocks_items');
        $items = $query->result();
        //$this->get_parent_item($items, $tree, $parentId);
        return $items;
    }

    public function select_rows_filter($filter = NULL) {
        $query1 = NULL;
        $query2 = NULL;
        if ($filter == NULL) {
            $this->db->select('stoIteId,stoIteParentId,stoIteCode,stoIteName,stoIteGroup,stoIteType,stoIteClass,stoIteDescription,stoIteStatus,stoIteInvIcon,stoIteInvType');
            $this->db->from(PREFIX_TBL.'stocks_items');
            $this->db->join(PREFIX_TBL . 'stocks_items_inventories',PREFIX_TBL.'stocks_items.stoIteId='.PREFIX_TBL . 'stocks_items_inventories.stoIteInvStoIteId','inner');
            $this->db->where(array('stoIteStatus'=>1,'stoIteIsDeleted'=>0));
            $query1 = $this->db->get()->result_array();
        } else {
            if($filter['type'] == '1'){
                $this->db->select('stoIteId,stoIteParentId,stoIteCode,stoIteName,stoIteGroup,stoIteType,stoIteClass,stoIteDescription,stoIteStatus,stoIteInvIcon,stoIteInvType');
                $this->db->from(PREFIX_TBL.'stocks_items');
                $this->db->join(PREFIX_TBL . 'stocks_items_inventories',PREFIX_TBL.'stocks_items.stoIteId='.PREFIX_TBL . 'stocks_items_inventories.stoIteInvStoIteId','inner');
                if($filter['status'] != NULL){
                    $this->db->where(array(PREFIX_TBL . 'stocks_items.stoIteStatus'=>1,'stoIteIsDeleted'=>0));
                }
                $query1 = $this->db->get()->result_array();
            }else{
                $this->db->select('stoIteId,stoIteParentId,stoIteCode,stoIteName,stoIteGroup,stoIteType,stoIteClass,stoIteDescription,stoIteStatus');
                $this->db->from(PREFIX_TBL.'stocks_items');
                $this->db->join(PREFIX_TBL . 'stocks_items_services',PREFIX_TBL.'stocks_items.stoIteId='.PREFIX_TBL . 'stocks_items_services.stoIteSerStoIteId','inner');
                if($filter['status'] != NULL){
                    $this->db->where(array(PREFIX_TBL . 'stocks_items.stoIteStatus'=>1,'stoIteIsDeleted'=>0));
                }
                $query1 = $this->db->get()->result_array();
            }
        }
        //return (array_merge((array)$query1, (array)$query2));
        //var_dump($query1); die;
        return $query1;
    }
    
    public function insert_measure($data, $item_id){
        $this->db->select_max('stoIteMeaId');
        $arr_last_id = $this->db->get(PREFIX_TBL.'stocks_items_measures')->row_array();
        $last_id = 1;
        if(count($arr_last_id) > 0) {
            $last_id = $arr_last_id['stoIteMeaId']+1;
        }
        $arr_data = NULL;
        if(count($data) > 0){
            $parent_id = NULL;
            $tem_ite_mea_id = NULL;
            $tem_arr_id = NULL;
            //var_dump($data); echo '<p></p>';
            foreach($data as $row => $value){
                //$last_id++;
                $data[$row]->tem_id = $value->sto_ite_mea_id;
                $data[$row]->id = $last_id;
                $tem_parent_id = $value->sto_ite_mea_parent_id;
                //var_dump($tem_parent_id); die;
                if($tem_parent_id != "0"){
                   foreach($data as $row_id => $value_id){
                       if($data[$row_id]->sto_ite_mea_id == $tem_parent_id){
                           $data[$row]->parent_id = $value_id->id;
                           break;
                       }
                   } 
                }else{
                    $data[$row]->parent_id = NULL;
                }
                $last_id++;
                $arr_data = array(
                    'stoIteMeaId' => $data[$row]->id,
                    'stoIteMeaName' => $data[$row]->sto_ite_mea_name,
                    'stoIteMeaParentId' => $data[$row]->parent_id,
                    'stoIteMeaUnit' => $data[$row]->sto_ite_mea_unit,
                    'stoIteMeaPrice' => (($data[$row]->sto_ite_mea_price != '0')?$data[$row]->sto_ite_mea_price:NULL),
                    'stoIteMeaStoIteId' => $item_id
                );
                $this->db->insert(PREFIX_TBL.'stocks_items_measures', $arr_data);
            }
            return TRUE;
        }
        return FALSE;
    }
    
    /*
    * function select_rows_join()
    */
    public function select_measure($id){
            return $this->db->query('SELECT parent.*, child.stoIteMeaName as `parentName` FROM `'.PREFIX_TBL.'stocks_items_measures` as `parent` LEFT JOIN `'.PREFIX_TBL.'stocks_items_measures` as `child` ON `parent`.`stoIteMeaParentId`=`child`.`stoIteMeaId` WHERE `parent`.`stoIteMeaStoIteId` = '.$id.' ORDER BY parent.stoIteMeaId');
    }
    
    public function get_status($id){
        $this->db->where('stoIteId', $id);
        $query = $this->db->get(PREFIX_TBL.'stocks_items');
        if($query->num_rows() > 0){
            $row = $query->row();
            return $row->stoIteStatus;
        }else{
            return NULL;
        }
    }
    
    public function update_status($id, $status){
        $this->db->where('stoIteId', $id);
        return $this->db->update(PREFIX_TBL.'stocks_items', array('stoIteStatus'=>$status));
    }
    
    public function delete($id){
//        $this->db->where('stoIteMeaStoIteId', $id);
//        $this->db->delete(PREFIX_TBL.'stocks_items_measures');
//        
//        $this->db->where('stoIteInvStoIteId', $id);
//        $this->db->delete(PREFIX_TBL.'stocks_items_inventories');
//        
//        $this->db->where('stoIteSerStoIteId', $id);
//        $this->db->delete(PREFIX_TBL.'stocks_items_services');
        
        $this->db->where('stoIteId', $id);
        return $this->db->update(PREFIX_TBL.'stocks_items', array('stoIteIsDeleted'=>1));
    }
    
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
    
    public function get_last_measure_name($sto_ite_id){
        $this->db->where('stoIteMeaStoIteId',$sto_ite_id);
        $this->db->order_by("stoIteMeaId", "desc");
        $this->db->limit(1);
        return $this->db->get(PREFIX_TBL.'stocks_items_measures')->row();
    }
    
    public function get_item_detail($type, $sto_ite_id){
        $query = NULL;
        if($type == '1'){
            $this->db->select('*');
            $this->db->from(PREFIX_TBL.'stocks_items');
            $this->db->join(PREFIX_TBL.'stocks_items_inventories','stoIteId=stoIteInvStoIteId','inner');
            $this->db->where('stoIteId',$sto_ite_id);
            $this->db->limit(1);
            $query = $this->db->get()->row_array();
        }elseif($type == '2'){
            $this->db->select('*');
            $this->db->from(PREFIX_TBL.'stocks_items');
            $this->db->join(PREFIX_TBL.'stocks_items_services','stoIteId=stoIteSerStoIteId','inner');
            $this->db->where('stoIteId',$sto_ite_id);
            $this->db->limit(1);
            $query = $this->db->get()->row_array();
        }
        return $query;
    }
}
?>