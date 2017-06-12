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
                                    <option value="inventory"><?php echo $this->lang->line('lab_inventories'); ?></option>
                                    <option value="service"><?php echo $this->lang->line('lab_services'); ?></option>
                                </select>
                            </div>
                            <div class="row">
                                <label for="code"> <?php echo $this->lang->line('tab_sto_ite_code'); ?> <span class="required">*</span> :</label>
                                <input name="sto_ite_code" type="text" data-validate-length-range="6" data-validate-words="2" id="sto_ite_code" required="required" class="form-control">
                            </div>
                            <div class="row">
                                <label for="name"> <?php echo $this->lang->line('tab_sto_ite_name'); ?> <span class="required">*</span> :</label>
                                <input name="sto_ite_name" type="text" id="sto_ite_name" required="required" class="form-control">
                            </div>
                            <div class="row">
                                <label for="group"> <?php echo $this->lang->line('tab_sto_ite_group'); ?> :</label>
                                <input name="sto_ite_group" type="text" id="sto_ite_group" class="form-control">
                            </div>
                            <div class="row">
                                <label for="type"> <?php echo $this->lang->line('tab_sto_ite_inv_type'); ?> :</label>
                                <input name="sto_ite_inv_type" type="text" id="sto_ite_inv_type" class="form-control">
                            </div>
                            <div class="row">
                                <label for="class"> <?php echo $this->lang->line('tab_sto_ite_class'); ?> :</label>
                                <input name="sto_ite_class" type="text" id="sto_ite_class" class="form-control">
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
                                        <option value="0">None</option>
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
                                    <input class="btn btn-primary" type="button" action="add_new" id="save_add_measure" value="<?php echo $this->lang->line('lab_button_add_new'); ?>" />
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
                                    <tr class="measure_row">
                                        <td colspan="7" align="center"><?php echo $this->lang->line('lab_no_item_found'); ?></td>
                                    </tr>
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
                    <input type="file" class="form-control" name="sto_ite_inv_icon" id="sto_ite_inv_icon" />
                </div>
                <div class="row">
                    <label for="year"> <?php echo $this->lang->line('tab_sto_ite_inv_year'); ?> :</label>
                    <select class="form-control" id="sto_ite_inv_year" name="sto_ite_inv_year"></select>
                </div>
                <div class="row">
                    <label for="expiration"> <?php echo $this->lang->line('tab_sto_ite_inv_expiration'); ?> :</label>
                    <div class="xdisplay_inputx form-group has-feedback">
                        <input name="sto_ite_inv_expiration" id="sto_ite_inv_expiration" type="text" class="form-control has-feedback-left" id="single_cal3" placeholder="" aria-describedby="inputSuccess2Status3">
                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                        <input type="checkbox" checked value="1" name="check_empty" id="empty_expiration_date" />
                    </div>
                </div>
                <div class="row">
                    <label for="icon"> <?php echo $this->lang->line('tab_sto_ite_inv_series'); ?> :</label>
                    <input type="text" class="form-control" name="sto_ite_inv_series" id="sto_ite_inv_serial" />
                </div>
                <div class="row">
                    <label for="batch"> <?php echo $this->lang->line('tab_sto_ite_inv_batch'); ?> :</label>
                    <input type="text" class="form-control" name="sto_ite_inv_batch" id="sto_ite_inv_batch" />
                </div>
                <div class="row">
                    <label for="icon"> <?php echo $this->lang->line('tab_sto_ite_inv_serial'); ?> :</label>
                    <input type="text" class="form-control" name="sto_ite_inv_serial" id="sto_ite_inv_serial" />
                </div>
                <div class="row">
                    <label for="min_stock_alert"> <?php echo $this->lang->line('tab_sto_ite_inv_min_stock_alert'); ?> :</label>
                    <input type="number" class="form-control" name="sto_ite_inv_min_stock_alert" id="sto_ite_inv_min_stock_alert" />
                </div>
                <div class="row">
                    <label for="description"> <?php echo $this->lang->line('tab_sto_ite_description'); ?> :</label>
                    <textarea id="sto_ite_description" name="sto_ite_description" class="form-control" rows="3" placeholder="" style="margin: 0px -19.375px 0px 0px;"></textarea>
                </div>
                <div class="row">
                    <label for="status"> <?php echo $this->lang->line('tab_sto_ite_status'); ?> :</label>
                    <div>
                        <input id="sto_ite_status" name="sto_ite_status" type="checkbox" class="js-switch" checked />
                    </div>
                </div>		
            </div>
        </div>
    </div>
    <div class="row col-md-12 footer_button">
        <input id="submit_type" type="hidden" name="submit_type" value="save" />
        <button class="btn btn-primary" type="submit" name="btn_save" id="btn_save"><i class="fa fa-save"></i> <?php echo $this->lang->line('lab_button_save'); ?></button>
        <button class="btn btn-primary" type="submit" name="btn_save_and_new" id="btn_save_and_new"><i class="fa fa-save"></i> <?php echo $this->lang->line('lab_button_save_and_add_new'); ?></button>
        <button class="btn btn-primary btn_cancel" type="button" name="btn_cancel" back-url="<?php echo $_SERVER['HTTP_REFERER']; ?>"><i class="fa fa-close"></i> <?php echo $this->lang->line('lab_button_cancel'); ?></button>
        <button class="btn btn-primary btn_reset" type="reset" name="btn_reset"><i class="fa fa-refresh"></i> <?php echo $this->lang->line('lab_button_reset'); ?></button>
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
    $(document).ready(function () {
        var $measure_lists = '';
        var $measure_id = 1;
        var $tab_sto_ite_inv_year = '<option value="0">None</option>';
        var $today = new Date();
        var $year = $today.getFullYear();
        for (var $i = 0; $i < 10; $i++) {
            $tab_sto_ite_inv_year = $tab_sto_ite_inv_year + '<option value="' + $year + '">' + $year + '</option>';
            $year = $year - 1;
        }
        $('#sto_ite_inv_year').empty().append($tab_sto_ite_inv_year);
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
        
        $('#btn_save_and_new, #btn_save').click(function () {
            if (this.id === 'btn_save_and_new') {
                $('#submit_type').val('save_and_new');
            }
            else if (this.id === 'submit1') {
                $('#submit_type').val('save');
            }
            $('#frm_new_item').submit();
        });
        
        $('#save_add_measure').click(function () {
            var $sto_ite_mea_name = $('#sto_ite_mea_name').val();
            var $sto_ite_mea_code = $('#sto_ite_mea_code').val();
            var $sto_ite_mea_is_default = $('#sto_ite_mea_is_default').val();
            var $sto_ite_mea_parent_id = $('#sto_ite_mea_parent_id').val();
            var $sto_ite_mea_unit = $('#sto_ite_mea_unit').val();
            var $sto_ite_mea_price = $('#sto_ite_mea_price').val();
            var $sto_ite_mea_sub_measure_of = '';
            if ($sto_ite_mea_name == '') {
                BootstrapDialog.alert('<?php echo $this->lang->line('msg_require_measure'); ?>');
                //alert('<?php echo $this->lang->line('msg_require_measure'); ?>');
                return false;
            }
            if($(this).attr('action') == 'add_new'){
                if ($measure_lists == '') {
                    $sto_ite_mea_sub_measure_of = '<?php echo $this->lang->line('lab_none'); ?>';
                    $measure_lists += '{\"sto_ite_mea_id\":\"' + $measure_id + '\",\"sto_ite_mea_sub_measure_of\":\"' + $sto_ite_mea_sub_measure_of + '\", \"sto_ite_mea_name\":\"' + $sto_ite_mea_name + '\",\"sto_ite_mea_code\":\"' + $sto_ite_mea_code + '\",\"sto_ite_mea_is_default\":\"' + $sto_ite_mea_is_default + '\",\"sto_ite_mea_parent_id\":\"' + $sto_ite_mea_parent_id + '\",\"sto_ite_mea_unit\":\"' + $sto_ite_mea_unit + '\",\"sto_ite_mea_price\":\"' + $sto_ite_mea_price + '\"}';
                    $measure_id++;
                } else {
                    if ($sto_ite_mea_parent_id != '0') {
                        var $jsons = JSON.parse('[' + $measure_lists + ']');
                        if ($jsons.length > 0) {
                            for (var $json in $jsons) {
                                if ($jsons[$json]['sto_ite_mea_id'] == $sto_ite_mea_parent_id) {
                                    $sto_ite_mea_sub_measure_of = $jsons[$json]['sto_ite_mea_name'];
                                    break;
                                }
                            }
                        }
                    }
                    $measure_lists += ' ,{"sto_ite_mea_id":\"' + $measure_id + '\", \"sto_ite_mea_sub_measure_of\":\"' + $sto_ite_mea_sub_measure_of + '\", \"sto_ite_mea_name\":\"' + $sto_ite_mea_name + '\",\"sto_ite_mea_code\":\"' + $sto_ite_mea_code + '\",\"sto_ite_mea_is_default\":\"' + $sto_ite_mea_is_default + '\",\"sto_ite_mea_parent_id\":\"' + $sto_ite_mea_parent_id + '\",\"sto_ite_mea_unit\":\"' + $sto_ite_mea_unit + '\",\"sto_ite_mea_price\":\"' + $sto_ite_mea_price + '\"}';
                    $measure_id++;
                }
                var $jsons = JSON.parse('[' + $measure_lists + ']');
                var $tr_data = '';
                var $option_data = '';
                var $jsons_length = $jsons.length;
                if ($jsons_length > 0) {
                    var $index = 1;
                    for (var $json in $jsons) {
                        var $tr = '';
                        if($index == $jsons_length){
                            $tr = '<tr class="measure_row"><td>' + $jsons[$json]['sto_ite_mea_name'] + '</td><td>' + $jsons[$json]['sto_ite_mea_code'] + '</td><td>' + (($jsons[$json]['sto_ite_mea_is_default']=='1')?'<?php echo $this->lang->line('lab_button_yes'); ?>':'<?php echo $this->lang->line('lab_button_no'); ?>') + '</td><td>' + $jsons[$json]['sto_ite_mea_sub_measure_of'] + '</td><td>' + $jsons[$json]['sto_ite_mea_unit'] + '</td><td>' + $jsons[$json]['sto_ite_mea_price'] + '</td><td><span class="cursor measure_edit fa fa-pencil-square-o" data=\'{"stoIteMeaId":"' + $jsons[$json]['sto_ite_mea_id'] + '", "stoIteMeaName":"' + $jsons[$json]['sto_ite_mea_name'] + '", "stoIteMeaCode":"' + $jsons[$json]['sto_ite_mea_code'] + '", "stoIteMeaIsDefault":"' + $jsons[$json]['sto_ite_mea_is_default'] + '", "stoIteMeaParentId":"' + $jsons[$json]['sto_ite_mea_parent_id'] + '", "parentName":"' + $jsons[$json]['sto_ite_mea_sub_measure_of'] + '", "stoIteMeaUnit":"' + $jsons[$json]['sto_ite_mea_unit'] + '", "stoIteMeaPrice":"' + $jsons[$json]['sto_ite_mea_price'] + '"}\' title="<?php echo $this->lang->line('lab_button_edit') ;?>"></span> | <span class="cursor measure_delete fa fa-trash" data="' + $jsons[$json]['sto_ite_mea_id'] + '"></span></td></tr>';
                            $option_data = '<option value="' + $jsons[$json]['sto_ite_mea_id'] + '">' + $jsons[$json]['sto_ite_mea_name'] + '</option>';
                        }else{
                            $tr = '<tr class="measure_row"><td>' + $jsons[$json]['sto_ite_mea_name'] + '</td><td>' + $jsons[$json]['sto_ite_mea_code'] + '</td><td>' + (($jsons[$json]['sto_ite_mea_is_default']=='1')?'<?php echo $this->lang->line('lab_button_yes'); ?>':'<?php echo $this->lang->line('lab_button_no'); ?>') + '</td><td>' + $jsons[$json]['sto_ite_mea_sub_measure_of'] + '</td><td>' + $jsons[$json]['sto_ite_mea_unit'] + '</td><td>' + $jsons[$json]['sto_ite_mea_price'] + '</td><td><span class="cursor measure_edit fa fa-pencil-square-o" data=\'{"stoIteMeaId":"' + $jsons[$json]['sto_ite_mea_id'] + '", "stoIteMeaName":"' + $jsons[$json]['sto_ite_mea_name'] + '", "stoIteMeaCode":"' + $jsons[$json]['sto_ite_mea_code'] + '", "stoIteMeaIsDefault":"' + $jsons[$json]['sto_ite_mea_is_default'] + '", "stoIteMeaParentId":"' + $jsons[$json]['sto_ite_mea_parent_id'] + '", "parentName":"' + $jsons[$json]['sto_ite_mea_sub_measure_of'] + '", "stoIteMeaUnit":"' + $jsons[$json]['sto_ite_mea_unit'] + '", "stoIteMeaPrice":"' + $jsons[$json]['sto_ite_mea_price'] + '"}\' title="<?php echo $this->lang->line('lab_button_edit') ;?>"></span></td></tr>';
                        }
                        $index = $index + 1;
                        $tr_data = $tr_data + $tr;

                    }
                }
                $('#sto_ite_mea_parent_id').empty().append($option_data);
                $('.measure_row').remove();
                $('#measure_data').append($tr_data);
                $('#measure_item').val('[' + $measure_lists + ']');
            }else{
                var $sto_mea_id = $('#sto_ite_mea_id').val();
                var $jsons = JSON.parse('[' + $measure_lists + ']');
                for(var $json in $jsons){
                    if($jsons[$json]['sto_ite_mea_id'] == $sto_mea_id){
                        $jsons[$json]['sto_ite_mea_name'] = $sto_ite_mea_name;
                        $jsons[$json]['sto_ite_mea_code'] = $sto_ite_mea_code;
                        $jsons[$json]['sto_ite_mea_is_default'] = $sto_ite_mea_is_default;
                        $jsons[$json]['sto_ite_mea_unit'] = $sto_ite_mea_unit;
                        $jsons[$json]['sto_ite_mea_price'] = $sto_ite_mea_price;
                        $sto_ite_mea_sub_measure_of = $sto_ite_mea_name;
                    }
                    if($jsons[$json]['sto_ite_mea_parent_id'] == $sto_mea_id){
                        $jsons[$json]['sto_ite_mea_sub_measure_of'] = $sto_ite_mea_sub_measure_of;
                    }
                }
                var $str_json = JSON.stringify($jsons);
                $measure_lists = $str_json.substring(1, $str_json.length-1);
                var $jsons_length = $jsons.length;
                var $index = 1;
                for (var $json in $jsons) {
                    var $tr = '';
                    if($index == $jsons_length){
                        $tr = '<tr class="measure_row"><td>' + $jsons[$json]['sto_ite_mea_name'] + '</td><td>' + $jsons[$json]['sto_ite_mea_code'] + '</td><td>' + (($jsons[$json]['sto_ite_mea_is_default']=='1')?'<?php echo $this->lang->line('lab_button_yes'); ?>':'<?php echo $this->lang->line('lab_button_no'); ?>') + '</td><td>' + $jsons[$json]['sto_ite_mea_sub_measure_of'] + '</td><td>' + $jsons[$json]['sto_ite_mea_unit'] + '</td><td>' + $jsons[$json]['sto_ite_mea_price'] + '</td><td><span class="cursor measure_edit fa fa-pencil-square-o" data=\'{"stoIteMeaId":"' + $jsons[$json]['sto_ite_mea_id'] + '", "stoIteMeaName":"' + $jsons[$json]['sto_ite_mea_name'] + '", "stoIteMeaCode":"' + $jsons[$json]['sto_ite_mea_code'] + '", "stoIteMeaIsDefault":"' + $jsons[$json]['sto_ite_mea_is_default'] + '", "stoIteMeaParentId":"' + $jsons[$json]['sto_ite_mea_parent_id'] + '", "parentName":"' + $jsons[$json]['sto_ite_mea_sub_measure_of'] + '", "stoIteMeaUnit":"' + $jsons[$json]['sto_ite_mea_unit'] + '", "stoIteMeaPrice":"' + $jsons[$json]['sto_ite_mea_price'] + '"}\' title="<?php echo $this->lang->line('lab_button_edit') ;?>"></span> | <span class="cursor measure_delete fa fa-trash" data="' + $jsons[$json]['sto_ite_mea_id'] + '"></span></td></tr>';
                        $option_data = '<option value="' + $jsons[$json]['sto_ite_mea_id'] + '">' + $jsons[$json]['sto_ite_mea_name'] + '</option>';
                    }else{
                        $tr = '<tr class="measure_row"><td>' + $jsons[$json]['sto_ite_mea_name'] + '</td><td>' + $jsons[$json]['sto_ite_mea_code'] + '</td><td>' + (($jsons[$json]['sto_ite_mea_is_default']=='1')?'<?php echo $this->lang->line('lab_button_yes'); ?>':'<?php echo $this->lang->line('lab_button_no'); ?>') + '</td><td>' + $jsons[$json]['sto_ite_mea_sub_measure_of'] + '</td><td>' + $jsons[$json]['sto_ite_mea_unit'] + '</td><td>' + $jsons[$json]['sto_ite_mea_price'] + '</td><td><span class="cursor measure_edit fa fa-pencil-square-o" data=\'{"stoIteMeaId":"' + $jsons[$json]['sto_ite_mea_id'] + '", "stoIteMeaName":"' + $jsons[$json]['sto_ite_mea_name'] + '", "stoIteMeaCode":"' + $jsons[$json]['sto_ite_mea_code'] + '", "stoIteMeaIsDefault":"' + $jsons[$json]['sto_ite_mea_is_default'] + '", "stoIteMeaParentId":"' + $jsons[$json]['sto_ite_mea_parent_id'] + '", "parentName":"' + $jsons[$json]['sto_ite_mea_sub_measure_of'] + '", "stoIteMeaUnit":"' + $jsons[$json]['sto_ite_mea_unit'] + '", "stoIteMeaPrice":"' + $jsons[$json]['sto_ite_mea_price'] + '"}\' title="<?php echo $this->lang->line('lab_button_edit') ;?>"></span></td></tr>';
                    }
                    $index = $index + 1;
                    $tr_data = $tr_data + $tr;
                }
                $('#sto_ite_mea_parent_id').empty().append($option_data);
                $('.measure_row').remove();
                $('#measure_data').append($tr_data);
                $('#save_add_measure').val("<?php echo $this->lang->line('lab_button_add_new'); ?>").attr("action","add_new");
                $('#cancel_add_measure').addClass('hidden');
                $('#measure_item').val('[' + $measure_lists + ']');
            }
            $('#sto_ite_mea_id').val('');
            $('#sto_ite_mea_unit').val('1');
            $('#sto_ite_mea_price').val('0');
            $('#sto_ite_mea_name').val('');
            $('#sto_ite_mea_code').val('');
            $('#sto_ite_mea_is_default').val('0');
        });
        
        $('#measure_data').on('click', ".measure_edit", function(){
            var $data=$(this).attr('data');
            $data = JSON.parse($data);
            $('#sto_ite_mea_id').val($data.stoIteMeaId);
            $('#sto_ite_mea_name').val($data.stoIteMeaName);
            $('#sto_ite_mea_code').val($data.stoIteMeaCode);
            $('#sto_ite_mea_is_default').val($data.stoIteMeaIsDefault);
            $('#sto_ite_mea_unit').val($data.stoIteMeaUnit);
            $('#sto_ite_mea_price').val(($data.stoIteMeaPrice=="")?0:$data.stoIteMeaPrice);
            
            $('#sto_ite_mea_parent_id option').remove();
            $('#sto_ite_mea_parent_id').append('<option value="'+$data.stoIteMeaParentId+'">'+(($data.parentName=="")?"<?php echo $this->lang->line('lab_none'); ?>":$data.parentName)+'</option>').attr("disabled", true);
            $('#save_add_measure').val("<?php echo $this->lang->line('lab_button_update'); ?>").attr("action","update");
            $('#cancel_add_measure').removeClass('hidden');
        });
        
        $('#measure_data').on('click', ".measure_delete", function(){
            //var $data = $(this).attr('data');
            BootstrapDialog.show({
                closable: false,
                message: '<?php echo $this->lang->line('msg_confirm_remove'); ?>',
                buttons: [{
                    label: '<?php echo $this->lang->line('lab_button_ok');?>',
                    title: '<?php echo $this->lang->line('lab_button_ok');?>',
                    cssClass: 'btn-primary',
                    action: function(dialog){
                        var $jsons = JSON.parse('[' + $measure_lists + ']');
                        if($jsons.length > 0) $jsons.pop();
                        var $tr_data = '';
                        var $option_data = '';
                        var $str_json = JSON.stringify($jsons);
                        $measure_lists = $str_json.substring(1, $str_json.length-1);
                        var $jsons_length = $jsons.length;
                        var $index = 1;
                        for (var $json in $jsons) {
                            var $tr = '';
                            if($index == $jsons_length){
                                $tr = '<tr class="measure_row"><td>' + $jsons[$json]['sto_ite_mea_name'] + '</td><td>' + $jsons[$json]['sto_ite_mea_code'] + '</td><td>' + (($jsons[$json]['sto_ite_mea_is_default']=='1')?'<?php echo $this->lang->line('lab_button_yes'); ?>':'<?php echo $this->lang->line('lab_button_no'); ?>') + '</td><td>' + $jsons[$json]['sto_ite_mea_sub_measure_of'] + '</td><td>' + $jsons[$json]['sto_ite_mea_unit'] + '</td><td>' + $jsons[$json]['sto_ite_mea_price'] + '</td><td><span class="cursor measure_edit fa fa-pencil-square-o" data=\'{"stoIteMeaId":"' + $jsons[$json]['sto_ite_mea_id'] + '", "stoIteMeaName":"' + $jsons[$json]['sto_ite_mea_name'] + '", "stoIteMeaCode":"' + $jsons[$json]['sto_ite_mea_code'] + '", "stoIteMeaIsDefault":"' + $jsons[$json]['sto_ite_mea_is_default'] + '", "stoIteMeaParentId":"' + $jsons[$json]['sto_ite_mea_parent_id'] + '", "parentName":"' + $jsons[$json]['sto_ite_mea_sub_measure_of'] + '", "stoIteMeaUnit":"' + $jsons[$json]['sto_ite_mea_unit'] + '", "stoIteMeaPrice":"' + $jsons[$json]['sto_ite_mea_price'] + '"}\' title="<?php echo $this->lang->line('lab_button_edit') ;?>"></span> | <span class="cursor measure_delete fa fa-trash" data="' + $jsons[$json]['sto_ite_mea_id'] + '"></span></td></tr>';
                                $option_data = '<option value="' + $jsons[$json]['sto_ite_mea_id'] + '">' + $jsons[$json]['sto_ite_mea_name'] + '</option>';
                            }else{
                                $tr = '<tr class="measure_row"><td>' + $jsons[$json]['sto_ite_mea_name'] + '</td><td>' + $jsons[$json]['sto_ite_mea_code'] + '</td><td>' + (($jsons[$json]['sto_ite_mea_is_default']=='1')?'<?php echo $this->lang->line('lab_button_yes'); ?>':'<?php echo $this->lang->line('lab_button_no'); ?>') + '</td><td>' + $jsons[$json]['sto_ite_mea_sub_measure_of'] + '</td><td>' + $jsons[$json]['sto_ite_mea_unit'] + '</td><td>' + $jsons[$json]['sto_ite_mea_price'] + '</td><td><span class="cursor measure_edit fa fa-pencil-square-o" data=\'{"stoIteMeaId":"' + $jsons[$json]['sto_ite_mea_id'] + '", "stoIteMeaName":"' + $jsons[$json]['sto_ite_mea_name'] + '", "stoIteMeaCode":"' + $jsons[$json]['sto_ite_mea_code'] + '", "stoIteMeaIsDefault":"' + $jsons[$json]['sto_ite_mea_is_default'] + '", "stoIteMeaParentId":"' + $jsons[$json]['sto_ite_mea_parent_id'] + '", "parentName":"' + $jsons[$json]['sto_ite_mea_sub_measure_of'] + '", "stoIteMeaUnit":"' + $jsons[$json]['sto_ite_mea_unit'] + '", "stoIteMeaPrice":"' + $jsons[$json]['sto_ite_mea_price'] + '"}\' title="<?php echo $this->lang->line('lab_button_edit') ;?>"></span></td></tr>';
                            }
                            $index = $index + 1;
                            $tr_data = $tr_data + $tr;
                        }
                        if($option_data == '')$option_data = '<option value="0"><?php echo $this->lang->line('lab_none');?></option>';
                        $('#sto_ite_mea_parent_id').empty().append($option_data);
                        if($tr_data == ''){
                            $tr_data = '<tr class="measure_row"><td colspan="7" align="center"><?php echo $this->lang->line('lab_no_item_found'); ?></td></tr>';
                        }
                        $('.measure_row').remove();
                        $('#measure_data').append($tr_data);
                        $('#save_add_measure').val("<?php echo $this->lang->line('lab_button_add_new'); ?>").attr("action","add_new");
                        $('#cancel_add_measure').addClass('hidden');
                        $('#measure_item').val('[' + $measure_lists + ']');
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

        });
        
        $('.btn_cancel').click(function(){
           var $back_url = $(this).attr('back-url');
           window.location.href = $back_url;
        });
    });    
</script>