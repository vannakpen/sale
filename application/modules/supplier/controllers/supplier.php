<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata['user_info']){
            $this->session->set_flashdata('redirect_back_url',base_url(uri_string()));
            redirect(base_url());
        }
        $this->load->helper('download');
        $this->load->library('PHPExcel');
        $this->load->model('../mod_global');
        $this->load->model('mod_supplier');
        $this->lang->load('label', $this->session->userdata('site_lang'));
        $this->lang->load('dashboard', $this->session->userdata('site_lang'));
        $this->lang->load('table', $this->session->userdata('site_lang'));
        $this->lang->load('message', $this->session->userdata('site_lang'));
    }
    
    public function index() {
        redirect(base_url('supplier/view'));
    }
    
    public function view(){
        $filter = NULL;
        if($this->input->post('btn_filter')){
            $filter['status'] = $this->input->post('check_filter_status');
            $this->session->set_flashdata('filter', $filter);
        }else{
            if($this->session->flashdata('filter')){
                $filter = $this->session->flashdata('filter');
                $this->session->keep_flashdata('filter');
            }
        }
        $data['filter'] = $filter;
        if(($filter != NULL && $filter['status'] == 'on') || $filter == NULL){
            $data['supplier_data'] = $this->mod_global->select_row_array('suppliers', array('supIsDeleted'=>0, 'supStatus'=>1));
        }else{
            $data['supplier_data'] = $this->mod_global->select_row_array('suppliers', array('supIsDeleted'=>0));
        }
        $data['user_info'] = json_decode($this->session->userdata['user_info']);
        $this->load->view('../../views/master/index', $data);
    }
    
    public function save() {
        if(!($this->input->post('submit_type')))redirect(base_url('stock/view'));
        $submit_type = $this->input->post('submit_type');
        $sup_name = $this->input->post('sup_name');
        $sup_mobile_1 = $this->input->post('sup_mobile_1');
        $sup_mobile_2 = $this->input->post('sup_mobile_2');
        $sup_email = $this->input->post('sup_email');
        $sup_address = $this->input->post('sup_address');
        $sup_contact_person_first_name = $this->input->post('sup_contact_person_first_name');
        $sup_contact_person_last_name = $this->input->post('sup_contact_person_last_name');
        $sup_contact_person_display_name = $this->input->post('sup_contact_person_display_name');
        $sup_contact_person_sex = $this->input->post('sup_contact_person_sex');
        $sup_contact_person_mobile_1 = $this->input->post('sup_contact_person_mobile_1');
        $sup_contact_person_mobile_2 = $this->input->post('sup_contact_person_mobile_2');
        $sup_contact_person_email = $this->input->post('sup_contact_person_email');
        $sup_contact_person_address = $this->input->post('sup_contact_person_address');
        $sup_description = $this->input->post('sup_description');
        if($this->input->post('sup_id')){
            $sup_id = $this->input->post('sup_id');
            $upload_data = NULL;
            if($_FILES['sup_logo']['name'] != ''){
                //check to remove old logo
                $check_company_logo = $this->mod_global->get_field_string('suppliers', 'supLogo', array('supId'=>$sup_id));
                //check to remove old icon
                if($check_company_logo != NULL && file_exists(UPLOAD_SUPPLIER_LOGO_PATH.$check_company_logo)){
                    unlink(UPLOAD_SUPPLIER_LOGO_PATH.$check_company_logo);
                    unlink(UPLOAD_SUPPLIER_LOGO_PATH.substr($check_company_logo,0,strpos($check_company_logo, '.')).'_thumb'.substr($check_company_logo,strpos($check_company_logo, '.')));
                }
                //setting upload
                $config['encrypt_name'] = TRUE;
                $config['upload_path']          = UPLOAD_SUPPLIER_LOGO_PATH;
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = ICON_MAX_SIZE;
                $config['max_width']            = ICON_MAX_WIDTH;
                $config['max_height']           = ICON_MAX_HEIGHT;
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('sup_logo'))
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
            }
            //edit supplier
            $supDateModified = date("Y-m-d H:i:s");
            $arr_data = array(
                'supName' => $sup_name,
                'supLogo' => (($upload_data == NULL)?NULL:$upload_data['file_name']),
                'supMobile1' => $sup_mobile_1,
                'supMobile2' => $sup_mobile_2,
                'supEmail' => $sup_email,
                'supAddress' => $sup_address,
                'supDescription' => $sup_description,
                'supContactPersonFirstName' => $sup_contact_person_first_name,
                'supContactPersonLastName' => $sup_contact_person_last_name,
                'supContactPersonDisplayName' => $sup_contact_person_display_name,
                'supContactPersonSex' => $sup_contact_person_sex,
                'supContactPersonMobile1' => $sup_contact_person_mobile_1,
                'supContactPersonMobile2' => $sup_contact_person_mobile_2,
                'supContactPersonEmail' => $sup_contact_person_email,
                'supContactPersonAddress' => $sup_contact_person_address,
                'supDescription' => $sup_description,
                'supDateModified' => $supDateModified
            );
            if($this->mod_global->update_row('suppliers', array('supId'=>$sup_id), $arr_data)){
                $this->session->set_flashdata('msg_success',$this->lang->line('msg_update_success'));
            }else{
                $this->session->set_flashdata('msg_danger',$this->lang->line('msg_update_fail'));
            }
        }else{
            $upload_data = NULL;
            if($_FILES['sup_logo']['name'] != ''){
                //setting upload
                $config['encrypt_name'] = TRUE;
                $config['upload_path']          = UPLOAD_SUPPLIER_LOGO_PATH;
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = ICON_MAX_SIZE;
                $config['max_width']            = ICON_MAX_WIDTH;
                $config['max_height']           = ICON_MAX_HEIGHT;
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('sup_logo'))
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
            }
            $sup_mer_bra_id = json_decode($this->session->userdata['user_info'])->merUseMerBraId;
            $sup_mer_use_id = json_decode($this->session->userdata['user_info'])->merUseId;
            //insert to supplier
            $arr_data = array(
                'supMerBraId' => $sup_mer_bra_id,
                'supMerUseId' => $sup_mer_use_id,
                'supName' => $sup_name,
                'supLogo' => (($upload_data == NULL)?NULL:$upload_data['file_name']),
                'supMobile1' => $sup_mobile_1,
                'supMobile2' => $sup_mobile_2,
                'supEmail' => $sup_email,
                'supAddress' => $sup_address,
                'supDescription' => $sup_description,
                'supContactPersonFirstName' => $sup_contact_person_first_name,
                'supContactPersonLastName' => $sup_contact_person_last_name,
                'supContactPersonDisplayName' => $sup_contact_person_display_name,
                'supContactPersonSex' => $sup_contact_person_sex,
                'supContactPersonMobile1' => $sup_contact_person_mobile_1,
                'supContactPersonMobile2' => $sup_contact_person_mobile_2,
                'supContactPersonEmail' => $sup_contact_person_email,
                'supContactPersonAddress' => $sup_contact_person_address,
                'supDescription' => $sup_description
            );
            if($this->mod_global->insert_rows('suppliers',$arr_data)){
               $this->session->set_flashdata('msg_success',$this->lang->line('msg_save_success'));
            }else{
               $this->session->set_flashdata('msg_danger',$this->lang->line('msg_save_fail')); 
            }
        }
        if($submit_type == 'save'){
            redirect(base_url('supplier/view'));
        }else{
            redirect(base_url('supplier/add-new'));
        }
    }
    
    public function update_status($id){
        if($this->session->flashdata('filter')){
            $this->session->keep_flashdata('filter');
        }
        if(!is_numeric($id)) redirect(base_url('supplier/view'));
        $get_status = $this->mod_supplier->get_status($id);
        $status = FALSE;
        if($get_status == NULL){
            $this->session->set_flashdata('msg_danger',$this->lang->line('msg_transaction_fail'));
            redirect(base_url('supplier/view'));
        }else if($get_status == 1){
            $status = $this->mod_supplier->update_status($id,0);
        }else{
            $status = $this->mod_supplier->update_status($id,1);
        }
        if($status){
            $this->session->set_flashdata('msg_success',$this->lang->line('msg_transaction_success'));
        }else{
            $this->session->set_flashdata('msg_danger',$this->lang->line('msg_transaction_fail'));
        }
        redirect(base_url('supplier/view'));
    }
    
    public function delete($id){
        if($this->session->flashdata('filter')){
            $this->session->keep_flashdata('filter');
        }
        if(!is_numeric($id)) redirect(base_url('supplier/view'));
        if($this->mod_supplier->delete($id)){
            $this->session->set_flashdata('msg_success',$this->lang->line('msg_transaction_success'));
        }else{
            $this->session->set_flashdata('msg_danger',$this->lang->line('msg_transaction_fail'));
        }
        redirect(base_url('supplier/view'));
    }
    
    public function ajax_get_supplier_detail(){
        if($this->input->post('sup_id')){
            $sup_id = $this->input->post('sup_id');
            $arr_supplier_detail = $this->mod_supplier->get_supplier_detail($sup_id);
            $html = '';
            
            $html = '<div class="supplier_info row">
                        <h4 class="title">'.$this->lang->line('lab_basic_information').'</h4>
                        <div class="col-md-6">
                            <div class="row">
                                <label for="first name">'.$this->lang->line('tab_sup_first_name').' : </label> '.$arr_supplier_detail['supFirstName'].'
                            </div>
                            <div class="row">
                                <label for="last name">'.$this->lang->line('tab_sup_last_name').' : </label> '.$arr_supplier_detail['supLastName'].'
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <label for="display name">'.$this->lang->line('tab_sup_display_name').' : </label> '.$arr_supplier_detail['supDisplayName'].'
                            </div>
                            <div class="row">
                                <label for="sex">'.$this->lang->line('tab_sup_sex').' : </label> '.(($arr_supplier_detail['supSex'] == 1)?$this->lang->line('lab_male'):$this->lang->line('lab_female')).'
                            </div>
                        </div>
                    </div>
                    <div class="supplier_detail row">
                        <h4 class="title">'.$this->lang->line('lab_detail_information').'</h4>
                        <div class="col-md-6">
                            <div class="row">
                                <label for="mobile1">'.$this->lang->line('tab_sup_mobile_1').' : </label> '.$arr_supplier_detail['supMobile1'].'
                            </div>
                            <div class="row">
                                <label for="mobile2">'.$this->lang->line('tab_sup_mobile_2').' : </label> '.$arr_supplier_detail['supMobile2'].'
                            </div>
                            <div class="row">
                                <label for="address1">'.$this->lang->line('tab_sup_address_1').' : </label> '.$arr_supplier_detail['supAddress1'].'
                            </div>
                            <div class="row">
                                <label for="address2">'.$this->lang->line('tab_sup_address_2').' : </label> '.$arr_supplier_detail['supAddress2'].'
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <label for="email">'.$this->lang->line('tab_sup_email').' : </label> '.$arr_supplier_detail['supEmail'].'
                            </div>
                            <div class="row">
                                <label for="limit order">'.$this->lang->line('tab_sup_limit_order').' : </label> '.$arr_supplier_detail['supLimitOrder'].'
                            </div>
                            <div class="row">
                                <label for="limit owe amount">'.$this->lang->line('tab_sup_limit_owe_amount').' : </label> '.$arr_supplier_detail['supLimitOweAmount'].'
                            </div>
                            <div class="row">
                                <label for="description">'.$this->lang->line('tab_sup_description').' : </label> <br/>'.$arr_supplier_detail['supDescription'].'
                            </div>
                        </div>
                    </div>';
            echo $html;
        }
    }
    
    public function edit($id){
        if(!is_numeric($id) || $this->mod_global->check_item_exist('suppliers',array('supId'=>$id)) == 0) redirect(base_url('supplier/view'));
        $data['user_info'] = json_decode($this->session->userdata['user_info']);
        $data['supplier_data'] = $this->mod_supplier->get_supplier_detail($id); 
        $this->load->view('../../views/master/index', $data);
    }
    
    public function add_new() {
        $data['user_info'] = json_decode($this->session->userdata['user_info']);
        $this->load->view('../../views/master/index', $data);
    }
    
    public function import(){
        $data['user_info'] = json_decode($this->session->userdata['user_info']);
        $this->load->view('../../views/master/index', $data);
    }
    
    public function save_import(){
        if($_FILES['file_upload']['name'] != ''){
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = UPLOAD_TEMP_PATH;
            $config['allowed_types'] = IMPORT_FILE_MINE_TYPE;
            $this->load->library('upload', $config);
            $upload_data = NULL;
            if ( ! $this->upload->do_upload('file_upload'))
            {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('msg_warning', $error);
                redirect(base_url('supplier/import'));
            }else{
                $upload_data = $this->upload->data();
                $header_format = array('1' => array(
                    'A' => 'No', 
                    'B' => 'FirstName', 
                    'C' => 'LastName', 
                    'D' => 'DisplayName', 
                    'E' => 'Sex',
                    'F' => 'Mobile1',
                    'G' => 'Mobile2',
                    'H' => 'Email',
                    'I' => 'Address1',
                    'J' => 'Address2',
                    'K' => 'LimitOrder',
                    'L' => 'LimitOweAmount',
                    'M' => 'Description'));
                $header = NULL;
                $arr_data = NULL;
                try{
                    $objPHPExcel = PHPExcel_IOFactory::load($upload_data['file_path'].$upload_data['file_name']);
                    $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
                    foreach ($cell_collection as $cell) {
                        $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                        $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                        $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
                        //get header
                        if ($row == 1) {
                            $header[$row][$column] = $data_value;
                        } else {
                        //get rows data
                            $arr_data[$row][$column] = $data_value;
                        }
                    }
                } catch (Exception $ex) {
                    if(file_exists($upload_data['file_path'].$upload_data['file_name'])){
                        unlink($upload_data['file_path'].$upload_data['file_name']);
                    }
                    $this->session->set_flashdata('msg_warning', $this->lang->line('msg_unable_load_file'));
                    redirect(base_url('supplier/import'));
                }
                if(file_exists($upload_data['file_path'].$upload_data['file_name'])){
                    unlink($upload_data['file_path'].$upload_data['file_name']);
                }
                $compare_header = array_diff($header_format[1], $header[1]);
                if(count($compare_header) > 0){
                    $this->session->set_flashdata('msg_danger', $this->lang->line('msg_invalid_excel_format'));
                    redirect(base_url('supplier/import'));
                }else{
                    $insert_data = array();
                    $sup_mer_bra_id = json_decode($this->session->userdata['user_info'])->merUseMerBraId;
                    $sup_mer_use_id = json_decode($this->session->userdata['user_info'])->merUseId;
                    foreach($arr_data as $value){
                        $arr_diff_key = array_diff_key($header_format[1], $value);
                        if(count($arr_diff_key) > 0){
                            foreach($arr_diff_key as $key=>$val){
                                $value[$key] = NULL;
                            }
                        }
                        array_push($insert_data, array(
                            'supMerBraId' => $sup_mer_bra_id,
                            'supMerUseId' => $sup_mer_use_id,
                            'supFirstName' => $value['B'],
                            'supLastName' => $value['C'],
                            'supDisplayName' => $value['D'],
                            'supSex' => (($value['E'] == 'M')?1:0),
                            'supMobile1' => $value['F'],
                            'supMobile2' => $value['G'],
                            'supEmail' => $value['H'],
                            'supAddress1' => $value['I'],
                            'supAddress2' => $value['J'],
                            'supLimitOrder' => $value['K'],
                            'supLimitOweAmount' => $value['L'],
                            'supDescription' => $value['M']
                        ));
                    }
                    if($this->mod_global->insert_batch('supplier', $insert_data)){
                        $this->session->set_flashdata('msg_success',$this->lang->line('msg_save_success'));
                    }else{
                        $this->session->set_flashdata('msg_danger',$this->lang->line('msg_save_fail'));
                    }
                    redirect(base_url('supplier/view'));
                }
            }
        }else{
            redirect(base_url('supplier/import'));
        }
    }
    
    public function export(){
        if($this->input->post('export_data')){
            $export_data = explode(',', $this->input->post('export_data'));
            $get_data = $this->mod_global->select_where_in('suppliers', $export_data);
            $file_type = $this->input->post('file_type');
            $filter_column = $this->input->post('filter_column');
            if($file_type == 'csv'){
                
            }elseif($file_type == 'text'){
                
            }else{
                $header_format = array(
                    'supId' => $this->lang->line('tab_sup_id'), 
                    'supFirstName' => $this->lang->line('tab_sup_first_name'), 
                    'supLastName' => $this->lang->line('tab_sup_last_name'), 
                    'supDisplayName' => $this->lang->line('tab_sup_display_name'), 
                    'supSex' => $this->lang->line('tab_sup_sex'),
                    'supMobile1' => $this->lang->line('tab_sup_mobile_1'),
                    'supMobile2' => $this->lang->line('tab_sup_mobile_2'),
                    'supEmail' => $this->lang->line('tab_sup_email'),
                    'supAddress1' => $this->lang->line('tab_sup_address_1'),
                    'supAddress2' => $this->lang->line('tab_sup_address_2'),
                    'supLimitOrder' => $this->lang->line('tab_sup_limit_order'),
                    'supLimitOweAmount' => $this->lang->line('tab_sup_limit_owe_amount'),
                    'supDescription' => $this->lang->line('tab_sup_description'));
                // Instantiate a new PHPExcel object
                $objPHPExcel = new PHPExcel(); 
                // Set the active Excel worksheet to sheet 0
                $objPHPExcel->setActiveSheetIndex(0); 
                // Initialise the Excel row number
                $rowCount = 1;
                $column_list = array(0=>'A', 1=>'B', 2=>'C', 3=>'D', 4=>'E', 5=>'F', 6=>'G', 7=>'H', 8=>'I', 9=>'J', 10=>'K', 11=>'L', 12=>'M', 13=>'N', 14=>'O', 15=>'P', 16=>'Q', 17=>'R', 18=>'S', 19=>'T', 20=>'U', 21=>'V', 22=>'W', 23=>'X', 24=>'Y', 25=>'Z');
                foreach ($filter_column as $key => $column){
                    $objPHPExcel->getActiveSheet()->SetCellValue($column_list[$key].$rowCount, $header_format[$column]); 
                }
                $rowCount++;
                if(count($get_data) > 0){
                    foreach($get_data as $rows){
                        foreach ($filter_column as $key => $column){
                            $objPHPExcel->getActiveSheet()->SetCellValue($column_list[$key].$rowCount, $rows->$column);
                        }
                        $rowCount++;
                    }
                }
                // Instantiate a Writer to create an OfficeOpenXML Excel .xlsx file
                $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
                // Write the Excel file to filename some_excel_file.xlsx in the current directory
                $temp_path = DOWNLOAD_TEMP_PATH.random_string('alnum', 20).'.xlsx';
                $objWriter->save($temp_path);
                $this->session->set_flashdata('msg_success', $this->lang->line('msg_ready_export'));
                $data['temp_file'] = $temp_path;
                $data['user_info'] = json_decode($this->session->userdata['user_info']);
                $this->load->view('../../views/master/index', $data);  
            }
        }else{
            $this->session->set_flashdata('msg_warning',$this->lang->line('msg_export_warning'));
            redirect(base_url('supplier/view'));
        }
    }
    
    public function download(){
        if($this->input->post('temp_file')){
            $temp_file = $this->input->post('temp_file');
            force_download($temp_file, NULL);
            if(file_exists($temp_file)){
                unlink($temp_file);
            }
            redirect(base_url('supplier/view'));
        }else{
            redirect(base_url('supplier/view'));
        }
    }
    
}
