<?php
$item = NULL;
if(isset($item_inventory)){
    $item = $item_inventory;
}else if(isset($item_service)){
    $item = $item_service;
}
?>
<script src="<?php echo base_url('vendors/validator/validator.js'); ?>"></script>
<!-- Switchery -->
<link href="<?php echo base_url('vendors/switchery/dist/switchery.min.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('vendors/switchery/dist/switchery.min.js'); ?>"></script>
<!--select tree-->
<link rel="stylesheet" href="<?php echo base_url('css/jqx.base.css'); ?>" type="text/css" />

<div class="row">    
    <?php
    echo form_open_multipart(base_url('stock/save'),array('id'=>'frm_new_item'));
    ?>
    <input type="hidden" name="measure_items" id="measure_item" value="" />
    <input type="hidden" name="sto_ite_id" id="sto_mea_id" value="<?php echo $item->stoIteId; ?>" />
    <div class="row col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo $this->lang->line('lab_basic_information'); ?></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content row">
                <div class="col-md-4 panel panel-default box_margin">
                    <div class="panel-body">
                        <div class="box_margin">
                            <div class="row">
                                <label for="code"> <?php echo $this->lang->line('lab_select_type'); ?> <span class="required">*</span> :</label>
                                <select readonly="readonly" name="sto_ite_type" id="sto_ite_type" class="form-control">
                                    <option value="inventory" <?php echo (($item->stoIteType == '1')?'selected':'') ?>><?php echo $this->lang->line('lab_inventories'); ?></option>
                                    <option value="service" <?php echo (($item->stoIteType == '2')?'selected':'') ?>><?php echo $this->lang->line('lab_services'); ?></option>
                                </select>
                            </div>
                            <div class="row">
                                <label for="code"> <?php echo $this->lang->line('tab_sto_ite_code'); ?> <span class="required">*</span> :</label>
                                <input name="sto_ite_code" type="text" value="<?php echo $item->stoIteCode; ?>" data-validate-length-range="6" data-validate-words="2" id="sto_ite_code" required="required" class="form-control">
                            </div>
                            <div class="row">
                                <label for="name"> <?php echo $this->lang->line('tab_sto_ite_name'); ?> <span class="required">*</span> :</label>
                                <input name="sto_ite_name" type="text" value="<?php echo $item->stoIteName; ?>" id="sto_ite_name" required="required" class="form-control">
                            </div>
                            <div class="row">
                                <label for="group"> <?php echo $this->lang->line('tab_sto_ite_group'); ?> :</label>
                                <input name="sto_ite_group" type="text" value="<?php echo $item->stoIteGroup; ?>" id="sto_ite_group" class="form-control">
                            </div>
                            <div class="row">
                                <label for="type"> <?php echo $this->lang->line('tab_sto_ite_inv_type'); ?> :</label>
                                <input name="sto_ite_inv_type" type="text" value="<?php echo $item->stoIteInvType; ?>" id="sto_ite_inv_type" class="form-control">
                            </div>
                            <div class="row">
                                <label for="class"> <?php echo $this->lang->line('tab_sto_ite_class'); ?> :</label>
                                <input name="sto_ite_class" type="text" value="<?php echo $item->stoIteClass; ?>" id="sto_ite_class" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 panel panel-default box_margin">
                    <div class="panel-body">
                        <div class="box_margin">
                            <div class="col-md-3">
                                <div class="row">
                                    <input type="hidden" id="sto_ite_mea_id" val="" name="sto_ite_mea_id" />
                                    <input type="hidden" id="sto_ite_mea_sto_ite_id" value="<?php echo $item->stoIteId; ?>" name="sto_ite_mea_sto_ite_id" />
                                    <label for="code"> <?php echo $this->lang->line('tab_sto_ite_mea_name'); ?> <span class="required">*</span> :</label>
                                    <input name="sto_ite_mea_name" type="text" id="sto_ite_mea_name" class="form-control">
                                </div>
                                <div class="row">
                                    <label for="code"> <?php echo $this->lang->line('tab_sto_ite_mea_code'); ?> <span class="required">*</span> :</label>
                                    <input name="sto_ite_mea_code" type="text" id="sto_ite_mea_code" class="form-control">
                                    <input name="sto_ite_mea_id_default" type="hidden" value="0" id="sto_ite_mea_is_default" class="form-control">
                                </div>
                                <div class="row">
                                    <label for="code"> <?php echo $this->lang->line('tab_sto_ite_mea_parent_id'); ?> <span class="required">*</span> :</label>
                                    <select name="sto_ite_mea_parent_id" id="sto_ite_mea_parent_id" class="form-control">
                                        <option value="<?php echo ((isset($item_measure) && $item_measure->num_rows() > 0)?$item_measure->result()[count($item_measure->result())-1]->stoIteMeaId:'0'); ?>"><?php echo ((isset($item_measure) && $item_measure->num_rows() > 0)?$item_measure->result()[count($item_measure->result())-1]->stoIteMeaName:$this->lang->line('lab_none')); ?></option>
                                    </select>
                                </div>
                                <div class="row">
                                    <label for="code"> <?php echo $this->lang->line('tab_sto_ite_mea_unit'); ?> <span class="required">*</span> :</label>
                                    <input type="text" id="sto_ite_mea_unit" value="1" class="form-control" name="sto_ite_mea_unit" />
                                </div>
                                <div class="row">
                                    <label for="sto_ite_mea_price"> <?php echo $this->lang->line('tab_sto_ite_mea_price'); ?> <span class="required">*</span> :</label>
                                    <input type="number" id="sto_ite_mea_price" step="any" class="form-control" name="sto_ite_mea_price" value="0" />
                                </div>
                                <div class="row">
                                    <br/>
                                    <input class="btn btn-primary" type="button" id="save_add_measure" action="add_new" value="<?php echo $this->lang->line('lab_button_add_new'); ?>" />
                                    <input class="btn btn-primary hidden" type="button" id="cancel_add_measure" value="<?php echo $this->lang->line('lab_button_cancel'); ?>" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <table class="table" id="measure_data">
                                    <tr>
                                        <th><?php echo $this->lang->line('tab_sto_ite_mea_name'); ?></th>
                                        <th><?php echo $this->lang->line('tab_sto_ite_mea_code'); ?></th>
                                        <th><?php echo $this->lang->line('tab_sto_ite_mea_is_default'); ?></th>
                                        <th><?php echo $this->lang->line('tab_sto_ite_mea_parent_id'); ?></th>
                                        <th><?php echo $this->lang->line('tab_sto_ite_mea_unit'); ?></th>
                                        <th><?php echo $this->lang->line('tab_sto_ite_mea_price'); ?></th>
                                        <th><?php echo $this->lang->line('lab_action'); ?></th>
                                    </tr>
                                    <?php
                                    if(isset($item_measure) && $item_measure->num_rows() > 0){
                                        $num_rows = $item_measure->num_rows();
                                        $index = 1;
                                        foreach($item_measure->result() as $row){
                                    ?>
                                    <tr class="measure_row">
                                        <td><?php echo $row->stoIteMeaName; ?></td>
                                        <td><?php echo $row->stoIteMeaCode; ?></td>
                                        <td><?php echo (($row->stoIteMeaIsDefault == 1)?$this->lang->line('lab_button_yes'):$this->lang->line('lab_button_no')); ?></td>
                                        <td><?php echo (($row->parentName == NULL)?$this->lang->line('lab_none'):$row->parentName); ?></td>
                                        <td><?php echo $row->stoIteMeaUnit; ?></td>
                                        <td><?php echo (($row->stoIteMeaPrice == NULL)?0:$row->stoIteMeaPrice); ?></td>
                                        <td>
                                            <span class="cursor measure_edit fa fa-pencil-square-o" data='{"stoIteMeaId":"<?php echo $row->stoIteMeaId; ?>","stoIteMeaStoIteId":"<?php echo $row->stoIteMeaStoIteId; ?>", "stoIteMeaName":"<?php echo $row->stoIteMeaName; ?>", "stoIteMeaCode":"<?php echo $row->stoIteMeaCode; ?>", "stoIteMeaIsDefault":"<?php echo $row->stoIteMeaIsDefault; ?>", "stoIteMeaParentId":"<?php echo $row->stoIteMeaParentId; ?>", "parentName":"<?php echo $row->parentName; ?>", "stoIteMeaUnit":"<?php echo $row->stoIteMeaUnit; ?>", "stoIteMeaPrice":"<?php echo $row->stoIteMeaPrice; ?>"}' data-id="<?php echo $row->stoIteMeaId; ?>" title="<?php echo $this->lang->line('lab_button_edit'); ?>"></span>
                                            <?php 
                                            if($num_rows == $index){
                                            ?>
                                             | <span class="cursor measure_delete fa fa-trash" data='{"stoIteMeaId":"<?php echo $row->stoIteMeaId; ?>","stoIteMeaStoIteId":"<?php echo $row->stoIteMeaStoIteId; ?>"}' title="<?php echo $this->lang->line('lab_button_delete'); ?>"></span>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                            $index++;
                                        }
                                    }else{
                                    ?>
                                    <tr class="measure_row">
                                        <td colspan="7" align="center"><?php echo $this->lang->line('lab_no_item_found'); ?></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                                
                            </div>
                        </div>		
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo $this->lang->line('lab_detail_information'); ?></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content" id="content_detail">
                <div class="row">
                    <label for="icon"> <?php echo $this->lang->line('tab_sto_ite_inv_icon'); ?> :</label>
                    <?php
                    if($item->stoIteInvIcon != NULL){
                    ?>
                    <br/><img src="<?php echo INVENTORY_ICON_PATH.substr($item->stoIteInvIcon,0,strpos($item->stoIteInvIcon, '.')).'_thumb'.substr($item->stoIteInvIcon,strpos($item->stoIteInvIcon, '.')); ?>" alt="" id="sto_ite_inv_icon_image" />
                    <?php
                    }
                    ?>
                    <input type="file" class="form-control" name="sto_ite_inv_icon" id="sto_ite_inv_icon" />
                </div>
                <div class="row">
                    <label for="year"> <?php echo $this->lang->line('tab_sto_ite_inv_year'); ?> :</label>
                    <select class="form-control" id="sto_ite_inv_year" name="sto_ite_inv_year">
                    <?php
                    $year = date('Y');
                    for($i = $year+5; $i >= ($year-15); $i--){
                        echo '<option value="'.$i.'" '.(($item->stoIteInvYear == $i)?'selected':'').'>'.$i.'</option>';
                    }
                    ?>
                    </select>
                </div>
                <div class="row">
                    <label for="expiration"> <?php echo $this->lang->line('tab_sto_ite_inv_expiration'); ?> :</label>
                    <div class="xdisplay_inputx form-group has-feedback">
                        <input name="sto_ite_inv_expiration" id="sto_ite_inv_expiration" type="text" value="<?php echo date('mm/dd/YY',strtotime($item->stoIteInvExpiration)); ?>" class="form-control has-feedback-left" id="single_cal3" placeholder="" aria-describedby="inputSuccess2Status3">
                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                        <input type="checkbox" checked value="1" name="check_empty" id="empty_expiration_date" />
                    </div>
                </div>
                <div class="row">
                    <label for="icon"> <?php echo $this->lang->line('tab_sto_ite_inv_series'); ?> :</label>
                    <input type="text" class="form-control" name="sto_ite_inv_series" value="<?php echo $item->stoIteInvSeries; ?>" id="sto_ite_inv_serial" />
                </div>
                <div class="row">
                    <label for="batch"> <?php echo $this->lang->line('tab_sto_ite_inv_batch'); ?> :</label>
                    <input type="text" class="form-control" name="sto_ite_inv_batch" value="<?php echo $item->stoIteInvBatch; ?>" id="sto_ite_inv_batch" />
                </div>
                <div class="row">
                    <label for="icon"> <?php echo $this->lang->line('tab_sto_ite_inv_serial'); ?> :</label>
                    <input type="text" class="form-control" name="sto_ite_inv_serial" value="<?php echo $item->stoIteInvSerial; ?>" id="sto_ite_inv_serial" />
                </div>
                <div class="row">
                    <label for="min_stock_alert"> <?php echo $this->lang->line('tab_sto_ite_inv_min_stock_alert'); ?> :</label>
                    <input type="number" class="form-control" name="sto_ite_inv_min_stock_alert" value="<?php echo $item->stoIteInvMinStockAlert; ?>" id="sto_ite_inv_min_stock_alert" />
                </div>
                <div class="row">
                    <label for="description"> <?php echo $this->lang->line('tab_sto_ite_description'); ?> :</label>
                    <textarea id="sto_ite_description" name="sto_ite_description" class="form-control" rows="3" placeholder="" style="margin: 0px -19.375px 0px 0px;"><?php echo $item->stoIteDescription; ?></textarea>
                </div>
                <div class="row">
                    <label for="status"> <?php echo $this->lang->line('tab_sto_ite_status'); ?> :</label>
                    <div>
                        <input id="sto_ite_status" name="sto_ite_status" type="checkbox" class="js-switch" <?php echo (($item->stoIteStatus == '1')?'checked':''); ?> />
                    </div>
                </div>		
            </div>
        </div>
    </div>
    <div class="row col-md-12 footer_button">
        <input id="submit_type" type="hidden" name="submit_type" value="save" />
        <button class="btn btn-primary" type="submit" name="btn_save" id="btn_save"><i class="fa fa-save"></i> <?php echo $this->lang->line('lab_button_update'); ?></button>
        <button class="btn btn-primary" type="submit" name="btn_save_and_new" id="btn_save_and_new"><i class="fa fa-save"></i> <?php echo $this->lang->line('lab_button_update_and_add_new'); ?></button>
        <button class="btn btn-primary btn_cancel" type="button" name="btn_cancel" back-url="<?php echo $_SERVER['HTTP_REFERER']; ?>"><i class="fa fa-close"></i> <?php echo $this->lang->line('lab_button_cancel'); ?></button>
    </div>
    <?php echo form_close(); ?>
</div>

<script type="text/javascript" src="<?php echo base_url('vendors/jqwidgets/jqxcore.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('vendors/jqwidgets/jqxdropdownbutton.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('vendors/jqwidgets/jqxscrollbar.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('vendors/jqwidgets/jqxbuttons.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('vendors/jqwidgets/jqxtree.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('vendors/jqwidgets/jqxpanel.js'); ?>"></script>
<script>
    $(document).ready(function(){
        $('#sto_ite_inv_expiration').daterangepicker({
            singleDatePicker: true,
            //autoUpdateInput: false,
            singleClasses: "picker_3"
        }, function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });
        $('#empty_expiration_date').click(function () {
            if (!$(this).is(':checked')) {
                $('#sto_ite_inv_expiration').val('');
            } else {
                $('#sto_ite_inv_expiration').daterangepicker({
                    singleDatePicker: true,
                    //autoUpdateInput: false,
                    singleClasses: "picker_3"
                }, function (start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                });
            }
        });
        $('#measure_data').on('click', ".measure_edit", function(){
            var data=$(this).attr('data');
            data = JSON.parse(data);
            $('#sto_ite_mea_id').val(data.stoIteMeaId);
            $('#sto_ite_mea_code').val(data.stoIteMeaCode);
            $('#sto_ite_mea_is_default').val(data.stoIteMeaIsDefault);
            $('#sto_ite_mea_sto_ite_id').val(data.stoIteMeaStoIteId);
            $('#sto_ite_mea_name').val(data.stoIteMeaName);
            $('#sto_ite_mea_unit').val(data.stoIteMeaUnit);
            $('#sto_ite_mea_price').val((data.stoIteMeaPrice=="")?0:data.stoIteMeaPrice);
            $('#save_add_measure').val("<?php echo $this->lang->line('lab_button_update'); ?>").attr("action","update");
            $('#sto_ite_mea_parent_id option').remove();
            $('#sto_ite_mea_parent_id').append('<option value="'+data.stoIteMeaParentId+'">'+((data.parentName=="")?"<?php echo $this->lang->line('lab_none'); ?>":data.parentName)+'</option>').attr("disabled", true);
            $('#cancel_add_measure').removeClass('hidden');
        });
        
        $('#save_add_measure').on("click",function(){
            var $sto_ite_mea_name = $('#sto_ite_mea_name').val();
            if ($sto_ite_mea_name == '') {
                alert("<?php echo $this->lang->line('msg_require_measure'); ?>");
                return FALSE;
            }
            var $data_list = '{"action":"'+$(this).attr('action')+'","stoIteMeaId":"'+$('#sto_ite_mea_id').val()+'","stoIteMeaStoIteId":"'+$('#sto_ite_mea_sto_ite_id').val()+'", "stoIteMeaName":"'+$('#sto_ite_mea_name').val()+'","stoIteMeaCode":"' + $('#sto_ite_mea_code').val() + '", "stoIteMeaIsDefault":"' + $('#sto_ite_mea_is_default').val() + '", "stoIteMeaUnit":"'+$('#sto_ite_mea_unit').val()+'","stoIteMeaPrice":"'+$('#sto_ite_mea_price').val()+'","stoIteMeaParentId":"' + $('#sto_ite_mea_parent_id').val() + '"}';
            //alert($data_list);
            $('body').css('cursor','wait');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('stock/ajax_update_measure'); ?>",
                data: {"data": $data_list}
            }).done(function ($data) {
                if($data != ''){
                    var $jsons = JSON.parse("["+$data+"]");
                    var $tr_data = '';
                    var $index = 1;
                    var $json_length = $jsons.length;
                    for(var $json in $jsons){
                        var $tr = '';
                        if($index == $json_length){
                            $tr = '<tr class="measure_row"><td>' + $jsons[$json]['sto_ite_mea_name'] + '</td><td>' + $jsons[$json]['sto_ite_mea_code'] + '</td><td>' + $jsons[$json]['sto_ite_mea_is_default'] + '</td><td>' + $jsons[$json]['sto_ite_mea_sub_measure_of'] + '</td><td>' + $jsons[$json]['sto_ite_mea_unit'] + '</td><td>' + $jsons[$json]['sto_ite_mea_price'] + '</td><td><span class="cursor measure_edit fa fa-pencil-square-o" data=\'{"stoIteMeaId":"' + $jsons[$json]['sto_ite_mea_id'] + '","stoIteMeaStoIteId":"' + $jsons[$json]['sto_ite_mea_sto_ite_id'] + '", "stoIteMeaName":"' + $jsons[$json]['sto_ite_mea_name'] + '", "stoIteMeaParentId":"' + $jsons[$json]['sto_ite_mea_parent_id'] + '", "parentName":"' + $jsons[$json]['sto_ite_mea_sub_measure_of'] + '", "stoIteMeaUnit":"' + $jsons[$json]['sto_ite_mea_unit'] + '", "stoIteMeaPrice":"' + $jsons[$json]['sto_ite_mea_price'] + '"}\' title="<?php echo $this->lang->line('lab_button_edit') ;?>"></span> | <span class="cursor measure_delete fa fa-trash" data=\'{"stoIteMeaId":"<?php echo ((isset($row->stoIteMeaId))?$row->stoIteMeaId:''); ?>","stoIteMeaStoIteId":"<?php echo ((isset($row->stoIteMeaStoIteId))?$row->stoIteMeaStoIteId:''); ?>"}\'></span></td></tr>';
                        }else{
                            $tr = '<tr class="measure_row"><td>' + $jsons[$json]['sto_ite_mea_name'] + '</td><td>' + $jsons[$json]['sto_ite_mea_code'] + '</td><td>' + $jsons[$json]['sto_ite_mea_is_default'] + '</td><td>' + $jsons[$json]['sto_ite_mea_sub_measure_of'] + '</td><td>' + $jsons[$json]['sto_ite_mea_unit'] + '</td><td>' + $jsons[$json]['sto_ite_mea_price'] + '</td><td><span class="cursor measure_edit fa fa-pencil-square-o" data=\'{"stoIteMeaId":"' + $jsons[$json]['sto_ite_mea_id'] + '","stoIteMeaStoIteId":"' + $jsons[$json]['sto_ite_mea_sto_ite_id'] + '", "stoIteMeaName":"' + $jsons[$json]['sto_ite_mea_name'] + '", "stoIteMeaParentId":"' + $jsons[$json]['sto_ite_mea_parent_id'] + '", "parentName":"' + $jsons[$json]['sto_ite_mea_sub_measure_of'] + '", "stoIteMeaUnit":"' + $jsons[$json]['sto_ite_mea_unit'] + '", "stoIteMeaPrice":"' + $jsons[$json]['sto_ite_mea_price'] + '"}\' title="<?php echo $this->lang->line('lab_button_edit') ;?>"></span></td></tr>';
                        }
                        $index = $index + 1;
                        $tr_data = $tr_data + $tr;
                    }
                    $('.measure_row').remove();
                    $('#measure_data').append($tr_data);
                    $('body').css('cursor','default');
                    $('#sto_ite_mea_parent_id option').remove();
                    var $option = '<option value="'+$jsons[$json_length-1]['sto_ite_mea_id']+'">'+$jsons[$json_length-1]['sto_ite_mea_name']+'</option>';
                    $('#sto_ite_mea_parent_id').append($option);
                    $('#sto_ite_mea_id').val('');
                    $('#sto_ite_mea_unit').val('1');
                    $('#sto_ite_mea_price').val('0');
                    $('#sto_ite_mea_name').val('');
                    $('#sto_ite_mea_code').val('');
                    $('#sto_ite_mea_is_default').val('0');
                    $('#cancel_add_measure').addClass('hidden');
                    $('#save_add_measure').val("<?php echo $this->lang->line('lab_button_add_new'); ?>").attr('action', 'add_new');
                }
            }).fail(function ($status) {
                alert($status.toString);
                $('body').css('cursor','default');
            });
        });

        $('#cancel_add_measure').on('click', function(){
            $('#sto_ite_mea_id').val('');
            $('#sto_ite_mea_unit').val('1');
            $('#sto_ite_mea_price').val('0');
            $('#sto_ite_mea_name').val('');
            $('#sto_ite_mea_code').val('');
            $('#sto_ite_mea_is_default').val('0');
            $('body').css('cursor', 'point');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('stock/ajax_get_last_measure'); ?>",
                data: {stoIteId: $('#sto_ite_mea_sto_ite_id').val()}
            }).done(function($data){
                var $json = JSON.parse("["+$data+"]");
                $('#sto_ite_mea_parent_id option').remove();
                var $option = '<option value="'+$json[0].stoIteMeaId+'">'+$json[0].stoIteMeaName+'</option>';
                $('#sto_ite_mea_parent_id').append($option);
                $('body').css('cursor', 'default');
                $('#cancel_add_measure').addClass('hidden');
                $('#save_add_measure').val("<?php echo $this->lang->line('lab_button_add_new'); ?>").attr('action', 'add_new');

            });
        });

        
    });
    
    $('#measure_data').on('click', ".measure_delete", function(){
        var $data = $(this).attr('data');
        BootstrapDialog.show({
            closable: false,
            message: '<?php echo $this->lang->line('msg_confirm_remove'); ?>',
            buttons: [{
                label: '<?php echo $this->lang->line('lab_button_ok');?>',
                title: '<?php echo $this->lang->line('lab_button_ok');?>',
                cssClass: 'btn-primary',
                action: function(dialog){
                    $('body').css('cursor', 'point');
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('stock/ajax_remove_measure'); ?>",
                        data: {data: $data}
                    }).done(function($data){
                        if($data != ""){
                            var $jsons = JSON.parse("["+$data+"]");
                            var $tr_data = '';
                            var $index = 1;
                            var $json_length = $jsons.length;
                            for(var $json in $jsons){
                                var $tr = '';
                                if($index == $json_length){
                                    $tr = '<tr class="measure_row"><td>' + $jsons[$json]['sto_ite_mea_name'] + '</td><td>' + $jsons[$json]['sto_ite_mea_code'] + '</td><td>' + $jsons[$json]['sto_ite_mea_is_default'] + '</td><td>' + $jsons[$json]['sto_ite_mea_sub_measure_of'] + '</td><td>' + $jsons[$json]['sto_ite_mea_unit'] + '</td><td>' + $jsons[$json]['sto_ite_mea_price'] + '</td><td><span class="cursor measure_edit fa fa-pencil-square-o" data=\'{"stoIteMeaId":"'+$jsons[$json]['sto_ite_mea_id']+'","stoIteMeaStoIteId":"'+$jsons[$json]['sto_ite_mea_sto_ite_id']+'", "stoIteMeaName":"'+$jsons[$json]['sto_ite_mea_name']+'", "stoIteMeaParentId":"'+$jsons[$json]['sto_ite_mea_parent_id']+'", "parentName":"'+$jsons[$json]['sto_ite_mea_sub_measure_of']+'", "stoIteMeaUnit":"'+$jsons[$json]['sto_ite_mea_unit']+'", "stoIteMeaPrice":"'+$jsons[$json]['sto_ite_mea_price']+'"}\' title="<?php echo $this->lang->line('lab_button_edit') ;?>"></span> | <span class="cursor measure_delete fa fa-trash" data=\'{"stoIteMeaId":"'+$jsons[$json]['sto_ite_mea_id']+'","stoIteMeaStoIteId":"'+$jsons[$json]['sto_ite_mea_sto_ite_id']+'"}\'></span></td></tr>';
                                }else{
                                    $tr = '<tr class="measure_row"><td>' + $jsons[$json]['sto_ite_mea_name'] + '</td><td>' + $jsons[$json]['sto_ite_mea_code'] + '</td><td>' + $jsons[$json]['sto_ite_mea_is_default'] + '</td><td>' + $jsons[$json]['sto_ite_mea_sub_measure_of'] + '</td><td>' + $jsons[$json]['sto_ite_mea_unit'] + '</td><td>' + $jsons[$json]['sto_ite_mea_price'] + '</td><td><span class="cursor measure_edit fa fa-pencil-square-o" data=\'{"stoIteMeaId":"'+$jsons[$json]['sto_ite_mea_id']+'","stoIteMeaStoIteId":"'+$jsons[$json]['sto_ite_mea_sto_ite_id']+'", "stoIteMeaName":"'+$jsons[$json]['sto_ite_mea_name']+'", "stoIteMeaParentId":"'+$jsons[$json]['sto_ite_mea_parent_id']+'", "parentName":"'+$jsons[$json]['sto_ite_mea_sub_measure_of']+'", "stoIteMeaUnit":"'+$jsons[$json]['sto_ite_mea_unit']+'", "stoIteMeaPrice":"'+$jsons[$json]['sto_ite_mea_price']+'"}\' title="<?php echo $this->lang->line('lab_button_edit') ;?>"></span></td></tr>';
                                }
                                $tr_data = $tr_data + $tr;
                                $index = $index + 1;
                            }
                            $('.measure_row').remove();
                            $('#measure_data').append($tr_data);
                            $('#sto_ite_mea_parent_id option').remove();
                            var $option = '<option value="'+$jsons[$json_length-1]['sto_ite_mea_id']+'">'+$jsons[$json_length-1]['sto_ite_mea_name']+'</option>';
                            $('#sto_ite_mea_parent_id').append($option);
                            $('body').css('cursor', 'default');
                        }else{
                            alert('Failed');
                        }

                    });
                    dialog.close();
                }
            },{
                label: '<?php echo $this->lang->line('lab_button_cancel'); ?>',
                title: '<?php echo $this->lang->line('lab_button_cancel');?>',
                cssClass: 'btn-warning',
                action: function(dialog){
                    dialog.close();
                }
            }]
        });
        
        $('.btn_cancel').click(function(){
           var $back_url = $(this).attr('back-url');
           window.location.href = $back_url;
        });
    });
    
</script>