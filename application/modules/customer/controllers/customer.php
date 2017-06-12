<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata['user_info']){
            $this->session->set_flashdata('redirect_back_url',base_url(uri_string()));
            redirect(base_url());
        }
        $this->load->helper('download');
        $this->load->library('PHPExcel');
        $this->load->model('../mod_global');
        $this->load->model('mod_customer');
        $this->lang->load('label', $this->session->userdata('site_lang'));
        $this->lang->load('dashboard', $this->session->userdata('site_lang'));
        $this->lang->load('table', $this->session->userdata('site_lang'));
        $this->lang->load('message', $this->session->userdata('site_lang'));
    }
    
    public function index() {
        redirect(base_url('customer/view'));
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
            $data['customer_data'] = $this->mod_global->select_row_array('customers', array('cusIsDeleted'=>0, 'cusStatus'=>1));
        }else{
            $data['customer_data'] = $this->mod_global->select_row_array('customers', array('cusIsDeleted'=>0));
        }
        $data['user_info'] = json_decode($this->session->userdata['user_info']);
        $this->load->view('../../views/master/index', $data);
    }
    
    public function save() {
        if(!($this->input->post('submit_type')))redirect(base_url('stock/view'));
        $submit_type = $this->input->post('submit_type');
        //$cus_id = $this->input->post('cus_id');
        $cus_first_name = $this->input->post('cus_first_name');
        $cus_last_name = $this->input->post('cus_last_name');
        $cus_display_name = trim($this->input->post('cus_display_name'));
        $cus_sex = $this->input->post('cus_sex');
        $cus_mobile_1 = $this->input->post('cus_mobile_1');
        $cus_mobile_2 = $this->input->post('cus_mobile_2');
        $cus_email = $this->input->post('cus_email');
        $cus_address_1 = $this->input->post('cus_address_1');
        $cus_address_2 = $this->input->post('cus_address_2');
        $cus_limit_order = $this->input->post('cus_limit_order');
        $cus_limit_owe_amount = $this->input->post('cus_limit_owe_amount');
        $cus_description = $this->input->post('cus_description');
        if($this->input->post('cus_id')){
            $cus_id = $this->input->post('cus_id');
            //edit customer
            $arr_data = array(
                'cusFirstName' => $cus_first_name,
                'cusLastName' => $cus_last_name,
                'cusDisplayName' => $cus_display_name,
                'cusSex' => $cus_sex,
                'cusMobile1' => $cus_mobile_1,
                'cusMobile2' => $cus_mobile_2,
                'cusEmail' => $cus_email,
                'cusAddress1' => $cus_address_1,
                'cusAddress2' => $cus_address_2,
                'cusLimitOrder' => $cus_limit_order,
                'cusLimitOweAmount' => $cus_limit_owe_amount,
                'cusDescription' => $cus_description
            );
            if($this->mod_global->update_row('customers', array('cusId'=>$cus_id), $arr_data)){
                $this->session->set_flashdata('msg_success',$this->lang->line('msg_update_success'));
            }else{
                $this->session->set_flashdata('msg_danger',$this->lang->line('msg_update_fail'));
            }
        }else{            
            $cus_mer_bra_id = json_decode($this->session->userdata['user_info'])->merUseMerBraId;
            $cus_mer_use_id = json_decode($this->session->userdata['user_info'])->merUseId;
            //insert to customer
            $arr_data = array(
                'cusMerBraId' => $cus_mer_bra_id,
                'cusMerUseId' => $cus_mer_use_id,
                'cusFirstName' => $cus_first_name,
                'cusLastName' => $cus_last_name,
                'cusDisplayName' => $cus_display_name,
                'cusSex' => $cus_sex,
                'cusMobile1' => $cus_mobile_1,
                'cusMobile2' => $cus_mobile_2,
                'cusEmail' => $cus_email,
                'cusAddress1' => $cus_address_1,
                'cusAddress2' => $cus_address_2,
                'cusLimitOrder' => $cus_limit_order,
                'cusLimitOweAmount' => $cus_limit_owe_amount,
                'cusDescription' => $cus_description
            );
            if($this->mod_global->insert_rows('customers',$arr_data)){
               $this->session->set_flashdata('msg_success',$this->lang->line('msg_save_success'));
            }else{
               $this->session->set_flashdata('msg_danger',$this->lang->line('msg_save_fail')); 
            }
        }
        if($submit_type == 'save'){
            redirect(base_url('customer/view'));
        }else{
            redirect(base_url('customer/add-new'));
        }
    }
    
    public function update_status($id){
        if($this->session->flashdata('filter')){
            $this->session->keep_flashdata('filter');
        }
        if(!is_numeric($id)) redirect(base_url('customer/view'));
        $get_status = $this->mod_customer->get_status($id);
        $status = FALSE;
        if($get_status == NULL){
            $this->session->set_flashdata('msg_danger',$this->lang->line('msg_transaction_fail'));
            redirect(base_url('customer/view'));
        }else if($get_status == 1){
            $status = $this->mod_customer->update_status($id,0);
        }else{
            $status = $this->mod_customer->update_status($id,1);
        }
        if($status){
            $this->session->set_flashdata('msg_success',$this->lang->line('msg_transaction_success'));
        }else{
            $this->session->set_flashdata('msg_danger',$this->lang->line('msg_transaction_fail'));
        }
        redirect(base_url('customer/view'));
    }
    
    public function delete($id){
        if($this->session->flashdata('filter')){
            $this->session->keep_flashdata('filter');
        }
        if(!is_numeric($id)) redirect(base_url('customer/view'));
        if($this->mod_customer->delete($id)){
            $this->session->set_flashdata('msg_success',$this->lang->line('msg_transaction_success'));
        }else{
            $this->session->set_flashdata('msg_danger',$this->lang->line('msg_transaction_fail'));
        }
        redirect(base_url('customer/view'));
    }
    
    public function ajax_get_customer_detail(){
        if($this->input->post('cus_id')){
            $cus_id = $this->input->post('cus_id');
            $arr_customer_detail = $this->mod_customer->get_customer_detail($cus_id);
            $html = '';
            
            $html = '<div class="customer_info row">
                        <h4 class="title">'.$this->lang->line('lab_basic_information').'</h4>
                        <div class="col-md-6">
                            <div class="row">
                                <label for="first name">'.$this->lang->line('tab_cus_first_name').' : </label> '.$arr_customer_detail['cusFirstName'].'
                            </div>
                            <div class="row">
                                <label for="last name">'.$this->lang->line('tab_cus_last_name').' : </label> '.$arr_customer_detail['cusLastName'].'
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <label for="display name">'.$this->lang->line('tab_cus_display_name').' : </label> '.$arr_customer_detail['cusDisplayName'].'
                            </div>
                            <div class="row">
                                <label for="sex">'.$this->lang->line('tab_cus_sex').' : </label> '.(($arr_customer_detail['cusSex'] == 1)?$this->lang->line('lab_male'):$this->lang->line('lab_female')).'
                            </div>
                        </div>
                    </div>
                    <div class="customer_detail row">
                        <h4 class="title">'.$this->lang->line('lab_detail_information').'</h4>
                        <div class="col-md-6">
                            <div class="row">
                                <label for="mobile1">'.$this->lang->line('tab_cus_mobile_1').' : </label> '.$arr_customer_detail['cusMobile1'].'
                            </div>
                            <div class="row">
                                <label for="mobile2">'.$this->lang->line('tab_cus_mobile_2').' : </label> '.$arr_customer_detail['cusMobile2'].'
                            </div>
                            <div class="row">
                                <label for="address1">'.$this->lang->line('tab_cus_address_1').' : </label> '.$arr_customer_detail['cusAddress1'].'
                            </div>
                            <div class="row">
                                <label for="address2">'.$this->lang->line('tab_cus_address_2').' : </label> '.$arr_customer_detail['cusAddress2'].'
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <label for="email">'.$this->lang->line('tab_cus_email').' : </label> '.$arr_customer_detail['cusEmail'].'
                            </div>
                            <div class="row">
                                <label for="limit order">'.$this->lang->line('tab_cus_limit_order').' : </label> '.$arr_customer_detail['cusLimitOrder'].'
                            </div>
                            <div class="row">
                                <label for="limit owe amount">'.$this->lang->line('tab_cus_limit_owe_amount').' : </label> '.$arr_customer_detail['cusLimitOweAmount'].'
                            </div>
                            <div class="row">
                                <label for="description">'.$this->lang->line('tab_cus_description').' : </label> <br/>'.$arr_customer_detail['cusDescription'].'
                            </div>
                        </div>
                    </div>';
            echo $html;
        }
    }
    
    public function edit($id){
        if(!is_numeric($id) || $this->mod_global->check_item_exist('customers',array('cusId'=>$id)) == 0) redirect(base_url('customer/view'));
        $data['user_info'] = json_decode($this->session->userdata['user_info']);
        $data['customer_data'] = $this->mod_customer->get_customer_detail($id); 
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
                redirect(base_url('customer/import'));
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
                    redirect(base_url('customer/import'));
                }
                if(file_exists($upload_data['file_path'].$upload_data['file_name'])){
                    unlink($upload_data['file_path'].$upload_data['file_name']);
                }
                $compare_header = array_diff($header_format[1], $header[1]);
                if(count($compare_header) > 0){
                    $this->session->set_flashdata('msg_danger', $this->lang->line('msg_invalid_excel_format'));
                    redirect(base_url('customer/import'));
                }else{
                    $insert_data = array();
                    $cus_mer_bra_id = json_decode($this->session->userdata['user_info'])->merUseMerBraId;
                    $cus_mer_use_id = json_decode($this->session->userdata['user_info'])->merUseId;
                    foreach($arr_data as $value){
                        $arr_diff_key = array_diff_key($header_format[1], $value);
                        if(count($arr_diff_key) > 0){
                            foreach($arr_diff_key as $key=>$val){
                                $value[$key] = NULL;
                            }
                        }
                        array_push($insert_data, array(
                            'cusMerBraId' => $cus_mer_bra_id,
                            'cusMerUseId' => $cus_mer_use_id,
                            'cusFirstName' => $value['B'],
                            'cusLastName' => $value['C'],
                            'cusDisplayName' => $value['D'],
                            'cusSex' => (($value['E'] == 'M')?1:0),
                            'cusMobile1' => $value['F'],
                            'cusMobile2' => $value['G'],
                            'cusEmail' => $value['H'],
                            'cusAddress1' => $value['I'],
                            'cusAddress2' => $value['J'],
                            'cusLimitOrder' => $value['K'],
                            'cusLimitOweAmount' => $value['L'],
                            'cusDescription' => $value['M']
                        ));
                    }
                    if($this->mod_global->insert_batch('customers', $insert_data)){
                        $this->session->set_flashdata('msg_success',$this->lang->line('msg_save_success'));
                    }else{
                        $this->session->set_flashdata('msg_danger',$this->lang->line('msg_save_fail'));
                    }
                    redirect(base_url('customer/view'));
                }
            }
        }else{
            redirect(base_url('customer/import'));
        }
    }
    
    public function export(){
        if($this->input->post('export_data')){
            $export_data = explode(',', $this->input->post('export_data'));
            $get_data = $this->mod_global->select_where_in('customers', $export_data);
            $file_type = $this->input->post('file_type');
            $filter_column = $this->input->post('filter_column');
            if($file_type == 'csv'){
                
            }elseif($file_type == 'text'){
                
            }else{
                $header_format = array(
                    'cusId' => $this->lang->line('tab_cus_id'), 
                    'cusFirstName' => $this->lang->line('tab_cus_first_name'), 
                    'cusLastName' => $this->lang->line('tab_cus_last_name'), 
                    'cusDisplayName' => $this->lang->line('tab_cus_display_name'), 
                    'cusSex' => $this->lang->line('tab_cus_sex'),
                    'cusMobile1' => $this->lang->line('tab_cus_mobile_1'),
                    'cusMobile2' => $this->lang->line('tab_cus_mobile_2'),
                    'cusEmail' => $this->lang->line('tab_cus_email'),
                    'cusAddress1' => $this->lang->line('tab_cus_address_1'),
                    'cusAddress2' => $this->lang->line('tab_cus_address_2'),
                    'cusLimitOrder' => $this->lang->line('tab_cus_limit_order'),
                    'cusLimitOweAmount' => $this->lang->line('tab_cus_limit_owe_amount'),
                    'cusDescription' => $this->lang->line('tab_cus_description'));
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
            redirect(base_url('customer/view'));
        }
    }
    
    public function download(){
        if($this->input->post('temp_file')){
            $temp_file = $this->input->post('temp_file');
            force_download($temp_file, NULL);
            if(file_exists($temp_file)){
                unlink($temp_file);
            }
            redirect(base_url('customer/view'));
        }else{
            redirect(base_url('customer/view'));
        }
    }
    
}
