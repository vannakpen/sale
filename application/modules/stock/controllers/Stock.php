<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata['user_info']){
            $this->session->set_flashdata('redirect_back_url',base_url(uri_string()));
            redirect(base_url());
        }
        $this->load->model('../mod_global');
        $this->load->model('mod_stock');
        $this->lang->load('label', $this->session->userdata('site_lang'));
        $this->lang->load('dashboard', $this->session->userdata('site_lang'));
        $this->lang->load('table', $this->session->userdata('site_lang'));
        $this->lang->load('message', $this->session->userdata('site_lang'));
    }

    public function index() {
        redirect(base_url('stock/view'));
    }

    public function add_new() {
        $data['user_info'] = json_decode($this->session->userdata['user_info']);
        $this->load->view('../../views/master/index', $data);
    }

    public function view() {
        $filter = NULL;
        if($this->input->post('btn_filter')){
            $filter['type'] = $this->input->post('filter_type');
            $filter['status'] = $this->input->post('check_filter_status');
            $this->session->set_flashdata('filter', $filter);
        }else{
            if($this->session->flashdata('filter')){
                $filter = $this->session->flashdata('filter');
                $this->session->keep_flashdata('filter');
            }
        }
        $data['stock_item_data'] = $this->mod_stock->select_rows_filter($filter);
        $data['filter'] = $filter;
        $data['user_info'] = json_decode($this->session->userdata['user_info']);
        $this->load->view('../../views/master/index', $data);
    }

    public function save() {
        if(!($this->input->post('submit_type')))redirect(base_url('stock/view'));
        $submit_type = $this->input->post('submit_type');
        
        $sto_ite_inv_type = $this->input->post('sto_ite_inv_type');
        $sto_ite_code = $this->input->post('sto_ite_code');
        $sto_ite_name = $this->input->post('sto_ite_name');
        $sto_ite_group = $this->input->post('sto_ite_group');
        $sto_ite_type = $this->input->post('sto_ite_type');
        $sto_ite_class = $this->input->post('sto_ite_class');
        $sto_ite_inv_icon = $this->input->post('sto_ite_inv_icon');
        $sto_ite_inv_year = $this->input->post('tab_sto_ite_inv_year');
        $sto_ite_inv_expiration = $this->input->post('sto_ite_inv_expiration');
        $sto_ite_inv_series = $this->input->post('sto_ite_inv_series');
        $sto_ite_inv_batch = $this->input->post('sto_ite_inv_batch');
        $sto_ite_inv_serial = $this->input->post('sto_ite_inv_serial');
        $sto_ite_inv_min_stock_alert = $this->input->post('sto_ite_inv_min_stock_alert');
        $sto_ite_description = $this->input->post('sto_ite_description');
        $sto_ite_parent_id = NULL;
        if($this->input->post('sto_ite_id')){
            $sto_ite_id = $this->input->post('sto_ite_id');
            $sto_ite_status = (($this->input->post('sto_ite_status') != NULL)?1:0);
            //edit stock item
            $arr_data = array(
                'stoIteParentId' => $sto_ite_parent_id,
                'stoIteCode' => $sto_ite_code,
                'stoIteName' => $sto_ite_name,
                'stoIteGroup' => $sto_ite_group,
                'stoIteType' => (($sto_ite_type == 'inventory')?1:(($sto_ite_type == 'service')?2:0)),
                'stoIteClass' => $sto_ite_class,
                'stoIteDescription' => $sto_ite_description,
                'stoIteStatus' => $sto_ite_status
            );
            $this->mod_global->update_row('stocks_items', array('stoIteId'=>$sto_ite_id), $arr_data);
            //edit stock item inventory
            if($_FILES['sto_ite_inv_icon']['name'] != ''){
                $check_inv_icon = $this->mod_global->get_field_string('stocks_items_inventories', 'stoIteInvIcon', array('stoIteInvStoIteId'=>$sto_ite_id));
                //check to remove old icon
                if($check_inv_icon != NULL && file_exists(UPLOAD_INVENTORY_ICON_PATH.$check_inv_icon)){
                    unlink(UPLOAD_INVENTORY_ICON_PATH.$check_inv_icon);
                    unlink(UPLOAD_INVENTORY_ICON_PATH.substr($check_inv_icon,0,strpos($check_inv_icon, '.')).'_thumb'.substr($check_inv_icon,strpos($check_inv_icon, '.')));
                }
                //upload new icon
                $config['encrypt_name'] = TRUE;
                $config['upload_path']          = UPLOAD_INVENTORY_ICON_PATH;
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = ICON_MAX_SIZE;
                $config['max_width']            = ICON_MAX_WIDTH;
                $config['max_height']           = ICON_MAX_HEIGHT;
                $this->load->library('upload', $config);
                $upload_data = NULL;
                if ( ! $this->upload->do_upload('sto_ite_inv_icon'))
                {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('msg_warning', $error);
                }else{
                    $upload_data = $this->upload->data();
                    //resize:
                    $config['image_library'] = 'gd2';
                    $config['create_thumb'] = TRUE;
                    $config['source_image'] = $upload_data['full_path'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width']     = ICON_THUMB_WIDTH;
                    $config['height']   = ICON_THUMB_HEIGHT;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                }
                $arr_stock_inventory_items = array(
                    'stoIteInvIcon' => (($upload_data == NULL)?NULL:$upload_data['file_name']),
                    'stoIteInvType' => $sto_ite_inv_type,
                    'stoIteInvYear' => (($sto_ite_inv_year == 0)?NULL:$sto_ite_inv_year),
                    'stoIteInvExpiration' => (($sto_ite_inv_expiration == '')?NULL:date('Y-n-d', strtotime($sto_ite_inv_expiration))),
                    'stoIteInvSeries' => (($sto_ite_inv_series == '')?NULL:$sto_ite_inv_series),
                    'stoIteInvBatch' => (($sto_ite_inv_batch == '')?NULL:$sto_ite_inv_batch),
                    'stoIteInvSerial' => (($sto_ite_inv_serial == '')?NULL:$sto_ite_inv_serial),
                    'stoIteInvMinStockAlert' => (($sto_ite_inv_min_stock_alert == '')?NULL:$sto_ite_inv_min_stock_alert)
                );
                if($this->mod_global->update_row('stocks_items_inventories', array('stoIteInvStoIteId'=>$sto_ite_id), $arr_stock_inventory_items)){
                    $this->session->set_flashdata('msg_success',$this->lang->line('msg_save_success'));
                }else{
                    $this->session->set_flashdata('msg_danger',$this->lang->line('msg_save_fail'));
                }
            }
            
        }else{            
            $sto_ite_mer_id = json_decode($this->session->userdata['user_info'])->merUseMerBraId;
            
            $measure_items = (array)json_decode($this->input->post('measure_items'));
            //insert to stock item
            $arr_stock_items = array(
                'stoIteMerId' => $sto_ite_mer_id,
                'stoIteParentId' => $sto_ite_parent_id,
                'stoIteCode' => $sto_ite_code,
                'stoIteName' => $sto_ite_name,
                'stoIteGroup' => $sto_ite_group,
                'stoIteType' => (($sto_ite_type == 'inventory')?1:(($sto_ite_type == 'service')?2:0)),
                'stoIteClass' => $sto_ite_class,
                'stoIteDescription' => $sto_ite_description,
                'stoIteStatus' => 1
            );
            $last_id = $this->mod_global->insert_rows_get_last_id('stocks_items',$arr_stock_items);
            if($last_id == FALSE){
                $this->session->set_flashdata('msg_danger',$this->lang->line('msg_save_fail'));
                if($submit_type == 'save'){
                    redirect(base_url('stock/view'));
                }else{
                    redirect(base_url('stock/add-new'));
                }
            }
            //insert into inventory
            $config['encrypt_name'] = TRUE;
            $config['upload_path']          = UPLOAD_INVENTORY_ICON_PATH;
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = ICON_MAX_SIZE;
            $config['max_width']            = ICON_MAX_WIDTH;
            $config['max_height']           = ICON_MAX_HEIGHT;
            $this->load->library('upload', $config);
            $upload_data = NULL;
            if ( ! $this->upload->do_upload('sto_ite_inv_icon'))
            {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('msg_warning', $error);
            }else{
                $upload_data = $this->upload->data();
                //resize:
                $config['image_library'] = 'gd2';
                $config['create_thumb'] = TRUE;
                $config['source_image'] = $upload_data['full_path'];
                $config['maintain_ratio'] = TRUE;
                $config['width']     = ICON_THUMB_WIDTH;
                $config['height']   = ICON_THUMB_HEIGHT;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
            }
            $arr_stock_inventory_items = array(
                'stoIteInvStoIteId' => $last_id,
                'stoIteInvIcon' => (($upload_data == NULL)?NULL:$upload_data['file_name']),
                'stoIteInvType' => $sto_ite_inv_type,
                'stoIteInvYear' => (($sto_ite_inv_year == 0)?NULL:$sto_ite_inv_year),
                'stoIteInvExpiration' => (($sto_ite_inv_expiration == '')?NULL:date('Y-n-d', strtotime($sto_ite_inv_expiration))),
                'stoIteInvSeries' => (($sto_ite_inv_series == '')?NULL:$sto_ite_inv_series),
                'stoIteInvBatch' => (($sto_ite_inv_batch == '')?NULL:$sto_ite_inv_batch),
                'stoIteInvSerial' => (($sto_ite_inv_serial == '')?NULL:$sto_ite_inv_serial),
                'stoIteInvMinStockAlert' => (($sto_ite_inv_min_stock_alert == '')?NULL:$sto_ite_inv_min_stock_alert)
            );

            if(count($measure_items) > 0){
                $this->mod_stock->insert_measure($measure_items, $last_id);
            }
            if($this->mod_global->insert_rows('stocks_items_inventories', $arr_stock_inventory_items)){
               $this->session->set_flashdata('msg_success',$this->lang->line('msg_save_success'));
            }else{
               $this->session->set_flashdata('msg_danger',$this->lang->line('msg_save_fail')); 
            }
        }
        if($submit_type == 'save'){
            redirect(base_url('stock/view'));
        }else{
            redirect(base_url('stock/add-new'));
        }
    }
    
    public function update_status($id){
        if($this->session->flashdata('filter')){
            $this->session->keep_flashdata('filter');
        }
        if(!is_numeric($id)) redirect(base_url('stock/view'));
        $get_status = $this->mod_stock->get_status($id);
        $status = FALSE;
        if($get_status == NULL){
            $this->session->set_flashdata('msg_danger',$this->lang->line('msg_transaction_fail'));
            redirect(base_url('stock/view'));
        }else if($get_status == 1){
            $status = $this->mod_stock->update_status($id,0);
        }else{
            $status = $this->mod_stock->update_status($id,1);
        }
        if($status){
            $this->session->set_flashdata('msg_success',$this->lang->line('msg_transaction_success'));
        }else{
            $this->session->set_flashdata('msg_danger',$this->lang->line('msg_transaction_fail'));
        }
        redirect(base_url('stock/view'));
    }
    
    public function delete($id, $type){
        if($this->session->flashdata('filter')){
            $this->session->keep_flashdata('filter');
        }
        if(!is_numeric($id) || !is_numeric($type)) redirect(base_url('stock/view'));
//        //remove item
//        if($type == 1){
//            $arr_result = $this->mod_global->select_row_array_once('stocks_items_inventories', array('stoIteInvStoIteId' => $id));
//            if(count($arr_result) > 0){
//                $file_name = $arr_result->stoIteInvIcon;
//                if($file_name != NULL && file_exists(UPLOAD_INVENTORY_ICON_PATH.$file_name)){
//                    unlink(UPLOAD_INVENTORY_ICON_PATH.$file_name);
//                    unlink(UPLOAD_INVENTORY_ICON_PATH.substr($file_name,0,strpos($file_name, '.')).'_thumb'.substr($file_name,strpos($file_name, '.')));
//                }
//            }
//        }
        if($this->mod_stock->delete($id)){
            $this->session->set_flashdata('msg_success',$this->lang->line('msg_transaction_success'));
        }else{
            $this->session->set_flashdata('msg_danger',$this->lang->line('msg_transaction_fail'));
        }
        redirect(base_url('stock/view'));
    }
    
    public function edit($id){
        if(!is_numeric($id) || $this->mod_global->check_item_exist('stocks_items',array('stoIteId'=>$id)) == 0) redirect(base_url('stock/view'));
        $data['user_info'] = json_decode($this->session->userdata['user_info']);
        $item_row = $this->mod_global->select_rows('stocks_items',array('stoIteId'=>$id));
        //echo count((array)$data['item']); die;
        if(count($item_row) > 0 && $item_row->row()->stoIteType == 1){
            $join = array(
                'stocks_items_inventories' => array('stocks_items.stoIteId','stocks_items_inventories.stoIteInvStoIteId')
            );
            $data['item_inventory'] = $this->mod_global->select_rows_join('stocks_items',$join,array('stoIteInvStoIteId'=>$id))->row();
            $data['item_measure'] = $this->mod_stock->select_measure($id);
        }elseif(count($item_row) > 0 && $item_row->row()->stoIteType == 2){
            $join = array(
                'stocks_items_services' => array('stocks_items.stoIteId','stocks_items_services.stoIteSerStoIteId')
            );
            $data['item_service'] = $this->mod_global->select_rows_join('stocks_items', $join,array('stoIteSerStoIteId'=>$id))->row();
        }
        $this->load->view('../../views/master/index', $data);
    }

    protected function tree_parent_output($parentId = null) {
        $output = $this->mod_stock->sort_parent_tree($parentId);
        $html = '<ul>';
        $sub_tree_html = '';
        $close_tag = 0;
        foreach ($output as $key => $item) {
            if ($item->stoIteParentId == NULL) {
                $html .= '<li data-id="' . $item->stoIteId . '">' . $item->stoIteName;
                $html .= $this->nested_tree($output, $item->stoIteParentId, $item->stoIteId, $sub_tree_html, $close_tag);
                $html .= '</li>';
            }
            $html = $sub_tree_html . '<br/>';
        }
        return $html;
    }

    protected function nested_tree($output, $parentId, $id, &$html, &$close_tag = 0, $check_state = TRUE) {
        $tem_id = $id;
        foreach ($output as $key => $item) {
            if ($item->stoIteParentId == $id) {

                if ($check_state == TRUE) {
                    $html .= '<ul><li data-id="' . $item->stoIteId . '">' . $item->stoIteName;
                    $close_tag++;
                    $html .= $this->nested_tree($output, $item->stoIteParentId, $item->stoIteId, $html, $close_tag, FALSE);
                } else {
                    $html .= '</li></ul>';
                    $html .= '<ul><li data-id="' . $item->stoIteId . '">' . $item->stoIteName;
                    $html .= $this->nested_tree($output, $item->stoIteParentId, $item->stoIteId, $html, $close_tag, TRUE);
                }
            }
            $tem_id = $item->stoIteId;
        }
    }

    public function ajax_select_item_type() {
        $type = $this->input->get('type');
        $html = '';
        if ($type == 'service') {
            $parent = '';
            //echo $this->tree_parent_output();
            $html = '<div class="row">
					<div id="dropDownButton">
			          <div style="border: none;" id="jqxTree">
			                ' . $this->tree_parent_output() . '
			            </div>
			         </div>
			      </div>';
        } else if ($type == 'inventory') {
            $html = '<div class="row">
					<label for="icon"> ' . $this->lang->line('tab_sto_ite_inv_icon') . ' :</label>
					<input type="file" class="form-control" name="sto_ite_inv_icon" id="tab_sto_ite_inv_icon" />
				</div>
				<div class="row">
					<label for="year"> ' . $this->lang->line('tab_sto_ite_inv_year') . ' :</label>
					<select class="form-control" id="tab_sto_ite_inv_year" name="tab_sto_ite_inv_year"></select>
				</div>
				<div class="row">
					<label for="expiration"> ' . $this->lang->line('tab_sto_ite_inv_expiration') . ' :</label>
					<div class="xdisplay_inputx form-group has-feedback">
			            <input name="tab_sto_ite_inv_expiration" id="tab_sto_ite_inv_expiration" type="text" class="form-control has-feedback-left" id="single_cal3" placeholder="" aria-describedby="inputSuccess2Status3">
			            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
			            <span id="inputSuccess2Status3" class="sr-only">(success)</span>
			        </div>
				</div>
				<div class="row">
					<label for="batch"> ' . $this->lang->line('tab_sto_ite_inv_batch') . ' :</label>
					<input type="text" class="form-control" name="tab_sto_ite_inv_batch" id="tab_sto_ite_inv_batch" />
				</div>
				<div class="row">
					<label for="icon"> ' . $this->lang->line('tab_sto_ite_inv_serial') . ' :</label>
					<input type="text" class="form-control" name="tab_sto_ite_inv_serial" id="tab_sto_ite_inv_serial" />
				</div>
				<div class="row">
					<label for="min_stock_alert"> ' . $this->lang->line('tab_sto_ite_inv_min_stock_alert') . ' :</label>
					<input type="number" class="form-control" name="tab_sto_ite_inv_min_stock_alert" id="tab_sto_ite_inv_min_stock_alert" />
				</div>
		      	<div class="row">
					<label for="description"> ' . $this->lang->line('tab_sto_ite_description') . ' :</label>
					<textarea id="tab_sto_ite_description" name="sto_ite_description" class="form-control" rows="3" placeholder="" style="margin: 0px -19.375px 0px 0px;"></textarea>
				</div>
				<div class="row">
					<label for="status"> ' . $this->lang->line('tab_sto_ite_status') . ' :</label>
					<div>
						<input id="tab_sto_ite_status" name="tab_sto_ite_status" type="checkbox" class="js-switch" checked />
					</div>
				</div>';
        }
        echo $html;
    }
    
    public function ajax_update_measure(){
        if($this->input->post('data')){
            $data = json_decode($this->input->post('data'));
            if($data->action == 'update' && $data->stoIteMeaId != ''){
                $where = array('stoIteMeaId' => $data->stoIteMeaId);
                $data_update = array(
                    'stoIteMeaName' => $data->stoIteMeaName,
                    'stoIteMeaCode' => $data->stoIteMeaCode,
                    'stoIteMeaUnit' => $data->stoIteMeaUnit,
                    'stoIteMeaPrice' => $data->stoIteMeaPrice
                );
                if($this->mod_global->update_row('stocks_items_measures', $where, $data_update) == TRUE){
                    $measure_rows = $this->mod_stock->select_measure($data->stoIteMeaStoIteId);
                    if(count($measure_rows) > 0){
                        $str_json = '';
                        $first = TRUE;
                        foreach($measure_rows->result() as $row){
                            if($first == TRUE){
                                $str_json .= '{"sto_ite_mea_id":"' . $row->stoIteMeaId . '","sto_ite_mea_sub_measure_of":"' . (($row->parentName=='')?$this->lang->line('lab_none'):$row->parentName) . '", "sto_ite_mea_name":"' . $row->stoIteMeaName . '","sto_ite_mea_code":"' . $row->stoIteMeaCode . '", "sto_ite_mea_is_default":"' . $row->stoIteMeaIsDefault . '", "sto_ite_mea_parent_id":"' . $row->stoIteMeaParentId . '", "sto_ite_mea_unit":"' . $row->stoIteMeaUnit . '", "sto_ite_mea_price":"' . $row->stoIteMeaPrice . '", "sto_ite_mea_sto_ite_id":"'.$row->stoIteMeaStoIteId.'"}';
                                $first = FALSE;
                            }else{
                                $str_json .= ' ,{"sto_ite_mea_id":"' . $row->stoIteMeaId . '","sto_ite_mea_sub_measure_of":"' . (($row->parentName=='')?$this->lang->line('lab_none'):$row->parentName) . '", "sto_ite_mea_name":"' . $row->stoIteMeaName . '","sto_ite_mea_code":"' . $row->stoIteMeaCode . '", "sto_ite_mea_is_default":"' . $row->stoIteMeaIsDefault . '","sto_ite_mea_parent_id":"' . $row->stoIteMeaParentId . '","sto_ite_mea_unit":"' . $row->stoIteMeaUnit . '","sto_ite_mea_price":"' . $row->stoIteMeaPrice . '", "sto_ite_mea_sto_ite_id":"'.$row->stoIteMeaStoIteId.'"}';
                            }
                        }
                        echo $str_json; die;
                    }
                }else{
                    echo 'NULL'; die;
                }
            }else{
                $data_insert = array(
                    'stoIteMeaName' => $data->stoIteMeaName,
                    'stoIteMeaParentId' => (($data->stoIteMeaParentId != 0)?$data->stoIteMeaParentId:NULL),
                    'stoIteMeaUnit' => $data->stoIteMeaUnit,
                    'stoIteMeaPrice' => $data->stoIteMeaPrice,
                    'stoIteMeaStoIteId' => $data->stoIteMeaStoIteId
                );
                if($this->mod_global->insert_rows('stocks_items_measures', $data_insert) == TRUE){
                    $measure_rows = $this->mod_stock->select_measure($data->stoIteMeaStoIteId);
                    if(count($measure_rows) > 0){
                        $str_json = '';
                        $first = TRUE;
                        foreach($measure_rows->result() as $row){
                            if($first == TRUE){
                                $str_json .= '{"sto_ite_mea_id":"' . $row->stoIteMeaId . '","sto_ite_mea_sub_measure_of":"' . (($row->parentName=='')?$this->lang->line('lab_none'):$row->parentName) . '", "sto_ite_mea_name":"' . $row->stoIteMeaName . '", "sto_ite_mea_code":"' . $row->stoIteMeaCode . '", "sto_ite_mea_is_default":"' . $row->stoIteMeaIsDefault . '", "sto_ite_mea_parent_id":"' . $row->stoIteMeaParentId . '","sto_ite_mea_unit":"' . $row->stoIteMeaUnit . '","sto_ite_mea_price":"' . $row->stoIteMeaPrice . '", "sto_ite_mea_sto_ite_id":"'.$row->stoIteMeaStoIteId.'"}';
                                $first = FALSE;
                            }else{
                                $str_json .= ' ,{"sto_ite_mea_id":"' . $row->stoIteMeaId . '","sto_ite_mea_sub_measure_of":"' . (($row->parentName=='')?$this->lang->line('lab_none'):$row->parentName) . '", "sto_ite_mea_name":"' . $row->stoIteMeaName . '", "sto_ite_mea_code":"' . $row->stoIteMeaCode . '", "sto_ite_mea_is_default":"' . $row->stoIteMeaIsDefault . '", "sto_ite_mea_parent_id":"' . $row->stoIteMeaParentId . '","sto_ite_mea_unit":"' . $row->stoIteMeaUnit . '","sto_ite_mea_price":"' . $row->stoIteMeaPrice . '", "sto_ite_mea_sto_ite_id":"'.$row->stoIteMeaStoIteId.'"}';
                            }
                        }
                        echo $str_json; die;
                    }else{
                        echo ''; die;
                    }
                }else{
                    echo ''; die;
                }
            }            
        }else{
            echo ''; die;
        }
    }
    
    public function ajax_remove_measure(){
        if($this->input->post('data')){
            $data = json_decode($this->input->post('data'));
            $this->mod_global->delete_rows('stocks_items_measures',array('stoIteMeaId'=>$data->stoIteMeaId));
            $measure_rows = $this->mod_stock->select_measure($data->stoIteMeaStoIteId);
            if(count($measure_rows) > 0){
                $str_json = '';
                $first = TRUE;
                foreach($measure_rows->result() as $row){
                    if($first == TRUE){
                        $str_json .= '{"sto_ite_mea_id":"' . $row->stoIteMeaId . '","sto_ite_mea_sub_measure_of":"' . (($row->parentName=='')?$this->lang->line('lab_none'):$row->parentName) . '", "sto_ite_mea_name":"' . $row->stoIteMeaName . '", "sto_ite_mea_code":"' . $row->stoIteMeaCode . '", "sto_ite_mea_is_default":"' . $row->stoIteMeaIsDefault . '", "sto_ite_mea_parent_id":"' . $row->stoIteMeaParentId . '","sto_ite_mea_unit":"' . $row->stoIteMeaUnit . '","sto_ite_mea_price":"' . $row->stoIteMeaPrice . '", "sto_ite_mea_sto_ite_id":"'.$row->stoIteMeaStoIteId.'"}';
                        $first = FALSE;
                    }else{
                        $str_json .= ' ,{"sto_ite_mea_id":"' . $row->stoIteMeaId . '","sto_ite_mea_sub_measure_of":"' . (($row->parentName=='')?$this->lang->line('lab_none'):$row->parentName) . '", "sto_ite_mea_name":"' . $row->stoIteMeaName . '", "sto_ite_mea_code":"' . $row->stoIteMeaCode . '", "sto_ite_mea_is_default":"' . $row->stoIteMeaIsDefault . '", "sto_ite_mea_parent_id":"' . $row->stoIteMeaParentId . '","sto_ite_mea_unit":"' . $row->stoIteMeaUnit . '","sto_ite_mea_price":"' . $row->stoIteMeaPrice . '", "sto_ite_mea_sto_ite_id":"'.$row->stoIteMeaStoIteId.'"}';
                    }
                }
                echo $str_json; die;
            }else{
                echo ''; die;
            }
        }else{
            echo ''; die;
        }
        
    }
    
    public function ajax_get_last_measure(){
        $obj_measure = $this->mod_stock->get_last_measure_name($this->input->post('stoIteId'));
        echo '{"stoIteMeaId":"'.$obj_measure->stoIteMeaId.'","stoIteMeaName":"'.$obj_measure->stoIteMeaName.'"}';
    }
    
    public function ajax_get_stock_item_detail(){
        if($this->input->post('sto_ite_id')){
            $type = $this->input->post('type');
            $sto_ite_id = $this->input->post('sto_ite_id');
            $arr_item_detail = $this->mod_stock->get_item_detail($type, $sto_ite_id);
            $html = '';
            if($type == '1'){
                $arr_measure_list = $this->mod_stock->select_measure($sto_ite_id)->result_array();
                $html_measure = '<table class="table" id="measure_data">
                                    <tr>
                                        <th>'.$this->lang->line('tab_sto_ite_mea_name').'</th>
                                        <th>'.$this->lang->line('tab_sto_ite_mea_code').'</th>
                                        <th>'.$this->lang->line('tab_sto_ite_mea_parent_id').'</th>
                                        <th>'.$this->lang->line('tab_sto_ite_mea_unit').'</th>
                                        <th>'.$this->lang->line('tab_sto_ite_mea_price').'</th>
                                    </tr>';
                if(count($arr_measure_list) > 0){
                    $html_measure .= '';
                    foreach($arr_measure_list as $key => $value){
                        $html_measure .= '<tr>
                                            <td>'.$value['stoIteMeaName'].'</td>
                                            <td>'.$value['stoIteMeaCode'].'</td>
                                            <td>'.$value['stoIteMeaParentId'].'</td>
                                            <td>'.$value['stoIteMeaUnit'].'</td>
                                            <td>'.$value['stoIteMeaPrice'].'</td>
                                        </tr>';
                    }
                }else{
                    $html_measure .= '<tr><td colspan="5">'.$this->lang->line('lab_no_item_found').'</td></tr>';
                }
                $html_measure .= '</table>';
                $html = '<div class="item_info row">
                            <h4 class="title">'.$this->lang->line('lab_basic_information').'</h4>
                            <div class="col-md-4">
                                <div class="row">
                                    <label for="name">'.$this->lang->line('tab_sto_ite_name').' : </label> '.$arr_item_detail['stoIteName'].'
                                </div>
                                <div class="row">
                                    <label for="code">'.$this->lang->line('tab_sto_ite_code').' : </label> '.$arr_item_detail['stoIteCode'].'
                                </div>
                                <div class="row">
                                    <label for="code">'.$this->lang->line('lab_barcode').' : </label> <img alt="testing" src="' . base_url('/barcode/barcode.php?size=20&text='.$arr_item_detail['stoIteCode']. '&print=true') . '" />
                                </div>
                                <div class="row">
                                    <label for="type">'.$this->lang->line('tab_sto_ite_type').' : </label> '.(($arr_item_detail['stoIteType'] == '1')?$this->lang->line('lab_inventories'):$this->lang->line('lab_services')).'
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <label for="parent">'.$this->lang->line('tab_sto_ite_parent_id').' : </label> '.$arr_item_detail['stoIteParentId'].'
                                </div>
                                <div class="row">
                                    <label for="group">'.$this->lang->line('tab_sto_ite_group').' : </label> '.$arr_item_detail['stoIteGroup'].'
                                </div>
                                <div class="row">
                                    <label for="class">'.$this->lang->line('tab_sto_ite_class').' : </label> '.$arr_item_detail['stoIteClass'].'
                                </div>
                                <div class="row">
                                    <label for="status">'.$this->lang->line('tab_sto_ite_status').' : </label> '.(($arr_item_detail['stoIteStatus'] == '1')?$this->lang->line('lab_status_active'):$this->lang->line('lab_status_deactive')).'
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <label for="description">'.$this->lang->line('tab_sto_ite_description').' : </label><br/> 
                                    '.$arr_item_detail['stoIteDescription'].'
                                </div>
                            </div>
                        </div>
                        <div class="item_measure row">
                            <h4 class="title">'.$this->lang->line('lab_measure_information').'</h4>
                            <div class="col-md-6">
                                '.$html_measure.'
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label for="on hand">'.$this->lang->line('lab_stock_on_hand').' : </label> 100UN
                                </div>
                                <div class="row">
                                    <label for="on order">'.$this->lang->line('lab_stock_on_order').' : </label> 10UN
                                </div>
                                <div class="row">
                                    <label for="available">'.$this->lang->line('lab_stock_available').' : </label> 90UN
                                </div>
                                <div class="row">
                                    <label for="on purchase">'.$this->lang->line('lab_stock_on_purchase').' : </label> 100UN
                                </div>
                                <div class="row">
                                    <label for="minimum alert">'.$this->lang->line('tab_sto_ite_inv_min_stock_alert').' : </label> 100UN
                                </div>
                            </div>
                        </div>
                        <div class="item_detail row">
                            <h4 class="title">'.$this->lang->line('lab_detail_information').'</h4>
                            <div class="col-md-12">'.(($arr_item_detail['stoIteInvIcon']=='')?'':'<div class="row">
                                <label for="on hand">'.$this->lang->line('tab_sto_ite_inv_icon').' : </label> 
                                <img class="cursor" src="'.(($arr_item_detail['stoIteInvIcon']=='')?INVENTORY_ICON_PATH.'inventory_icon.jpg':INVENTORY_ICON_PATH.substr($arr_item_detail['stoIteInvIcon'],0,strpos($arr_item_detail['stoIteInvIcon'], '.')).'_thumb'.substr($arr_item_detail['stoIteInvIcon'],strpos($arr_item_detail['stoIteInvIcon'], '.'))).'" data-toggle="modal" data-target="#myModal" />
                                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <img src="'.(($arr_item_detail['stoIteInvIcon']=='')?INVENTORY_ICON_PATH.'inventory_icon.jpg':INVENTORY_ICON_PATH.$arr_item_detail['stoIteInvIcon']).'" class="img-responsive">
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>').'
                            <div class="row">
                                <label for="inventory type">'.$this->lang->line('tab_sto_ite_inv_type').' : </label> '.$arr_item_detail['stoIteInvType'].'
                            </div>
                            <div class="row">
                                <label for="sery">'.$this->lang->line('tab_sto_ite_inv_series').' : </label> '.$arr_item_detail['stoIteInvSeries'].'
                            </div>
                            <div class="row">
                                <label for="year">'.$this->lang->line('tab_sto_ite_inv_year').' : </label> '.$arr_item_detail['stoIteInvYear'].'
                            </div>
                            <div class="row">
                                <label for="batch">'.$this->lang->line('tab_sto_ite_inv_batch').' : </label> '.$arr_item_detail['stoIteInvBatch'].'
                            </div>
                            <div class="row">
                                <label for="serial">'.$this->lang->line('tab_sto_ite_inv_serial').' : </label> '.$arr_item_detail['stoIteInvSerial'].'
                            </div>
                        </div>
                    </div>';
            }elseif($type == '2'){
                $html = '<div class="item_info row">
                            <h4 class="title">'.$this->lang->line('lab_basic_information').'</h4>
                            <div class="col-md-4">
                                <div class="row">
                                    <label for="name">'.$this->lang->line('tab_sto_ite_name').' : </label> '.$arr_item_detail['stoIteName'].'
                                </div>
                                <div class="row">
                                    <label for="code">'.$this->lang->line('tab_sto_ite_code').' : </label> '.$arr_item_detail['stoIteCode'].'
                                </div>
                                <div class="row">
                                    <label for="code">'.$this->lang->line('lab_barcode').' : </label> <img alt="testing" src="' . base_url('/barcode/barcode.php?size=20&text='.$arr_item_detail['stoIteCode']. '&print=true') . '" />
                                </div>
                                <div class="row">
                                    <label for="type">'.$this->lang->line('tab_sto_ite_type').' : </label> '.(($arr_item_detail['stoIteType'] == '1')?$this->lang->line('lab_inventories'):$this->lang->line('lab_services')).'
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <label for="parent">'.$this->lang->line('tab_sto_ite_parent_id').' : </label> '.$arr_item_detail['stoIteParentId'].'
                                </div>
                                <div class="row">
                                    <label for="group">'.$this->lang->line('tab_sto_ite_group').' : </label> '.$arr_item_detail['stoIteGroup'].'
                                </div>
                                <div class="row">
                                    <label for="class">'.$this->lang->line('tab_sto_ite_class').' : </label> '.$arr_item_detail['stoIteClass'].'
                                </div>
                                <div class="row">
                                    <label for="status">'.$this->lang->line('tab_sto_ite_status').' : </label> '.(($arr_item_detail['stoIteStatus'] == '1')?$this->lang->line('lab_status_active'):$this->lang->line('lab_status_deactive')).'
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <label for="description">'.$this->lang->line('tab_sto_ite_description').' : </label><br/> 
                                    '.$arr_item_detail['stoIteDescription'].'
                                </div>
                            </div>
                        </div>
                        <div class="item_detail row">
                            <h4 class="title">'.$this->lang->line('lab_detail_information').'</h4>
                            <div class="col-md-12 row">
                                <label for="service chart account">'.$this->lang->line('tab_sto_ite_ser_cha_acc_id').' : </label> '.$arr_item_detail['stoIteSerChaAccId'].'
                            </div>
                        </div>';
            }
            echo $html;
        }
    }

}
