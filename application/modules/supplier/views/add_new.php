<script src="<?php echo base_url('vendors/validator/validator.js'); ?>"></script>
<!-- Switchery -->
<link href="<?php echo base_url('vendors/switchery/dist/switchery.min.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('vendors/switchery/dist/switchery.min.js'); ?>"></script>
<!--select tree-->
<link rel="stylesheet" href="<?php echo base_url('css/jqx.base.css'); ?>" type="text/css" />

<div class="row">    
    <?php
    echo form_open_multipart(base_url('supplier/save'),array('id'=>'frm_new_supplier'));
    ?>
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
                <div class="col-md-6 panel panel-default box_margin">
                    <div class="panel-body">
                        <div class="box_margin">
                            <div class="row">
                                <label for="name"> <?php echo $this->lang->line('tab_sup_name'); ?> <span class="required">*</span> :</label>
                                <input name="sup_name" type="text" value="" id="sup_name" required="required" class="form-control">
                            </div>
                            <div class="row">
                                <label for="mobile 1"> <?php echo $this->lang->line('tab_sup_mobile_1'); ?> :</label>
                                <input name="sup_mobile_1" type="text" value="" id="sup_mobile_1" class="form-control">
                            </div>
                            <div class="row">
                                <label for="mobile 2"> <?php echo $this->lang->line('tab_sup_mobile_2'); ?> :</label>
                                <input name="sup_mobile_2" type="text" value="" id="sup_mobile_2" class="form-control">
                            </div>
                            <div class="row">
                                <label for="email"> <?php echo $this->lang->line('tab_sup_email'); ?> :</label>
                                <input name="sup_email" type="text" value="" id="sup_email" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 panel panel-default box_margin">
                    <div class="panel-body">
                        <div class="box_margin">
                            <div class="row">
                                <label for="address"> <?php echo $this->lang->line('tab_sup_address'); ?> :</label>
                                <input name="sup_address" type="text" value="" id="sup_address" class="form-control">
                            </div>
                            <div class="row">
                                <label for="logo"> <?php echo $this->lang->line('tab_sup_logo'); ?> :</label>
                                <input name="sup_logo" type="file" value="" id="sup_logo" class="form-control">
                            </div>
                            <div class="row">
                                <label for="description"> <?php echo $this->lang->line('tab_sup_description'); ?> :</label><br/>
                                <textarea name="sup_description" id="sup_description" class="form-control"></textarea>
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
            <div class="x_content row">
                <div class="col-md-6 panel panel-default box_margin">
                    <div class="panel-body">
                        <div class="box_margin">
                            <div class="row">
                                <label for="person first name"> <?php echo $this->lang->line('tab_sup_contact_person_first_name'); ?> :</label>
                                <input name="sup_contact_person_first_name" type="text" value="" id="sup_contact_person_first_name" class="form-control">
                            </div>
                            <div class="row">
                                <label for="person last name"> <?php echo $this->lang->line('tab_sup_contact_person_last_name'); ?> :</label>
                                <input name="sup_contact_person_last_mame" type="text" value="" id="sup_contact_person_last_mame" class="form-control">
                            </div>
                            <div class="row">
                                <label for="person display name"> <?php echo $this->lang->line('tab_sup_contact_person_display_name'); ?> :</label>
                                <input name="sup_contact_person_display_name" type="text" value="" id="sup_contact_person_display_name" class="form-control">
                            </div>
                            <div class="row">
                                <label for="sex"> <?php echo $this->lang->line('tab_sup_contact_person_sex'); ?> :</label>
                                <select name="sup_contact_person_sex" id="sup_contact_person_sex" class="form-control">
                                    <option value="1"><?php echo $this->lang->line('lab_male'); ?></option>
                                    <option value="0"><?php echo $this->lang->line('lab_female'); ?></option>
                                </select>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6 panel panel-default box_margin">
                    <div class="panel-body">
                        <div class="box_margin">
                            <div class="row">
                                <label for="person mobile 1"> <?php echo $this->lang->line('tab_sup_contact_person_mobile_1'); ?> :</label>
                                <input name="sup_contact_person_mobile_1" type="text" value="" id="sup_contact_person_mobile_1" class="form-control">
                            </div>
                            <div class="row">
                                <label for="person mobile 2"> <?php echo $this->lang->line('tab_sup_contact_person_mobile_2'); ?> :</label>
                                <input name="sup_contact_person_mobile_2" type="text" value="" id="sup_contact_person_mobile_2" class="form-control">
                            </div>
                            <div class="row">
                                <label for="person email"> <?php echo $this->lang->line('tab_sup_contact_person_email'); ?> :</label>
                                <input name="sup_contact_person_email" type="text" value="" id="sup_contact_person_email" class="form-control">
                            </div>
                            <div class="row">
                                <label for="person address"> <?php echo $this->lang->line('tab_sup_contact_person_address'); ?> :</label>
                                <input name="sup_contact_person_address" type="text" value="" id="sup_contact_person_address" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="row col-md-12 footer_button">
        <input id="submit_type" type="hidden" name="submit_type" value="save" />
        <button class="btn btn-primary" type="submit" name="btn_save" id="btn_save"><i class="fa fa-save"></i> <?php echo $this->lang->line('lab_button_add_new'); ?></button>
        <button class="btn btn-primary" type="submit" name="btn_update_and_new" id="btn_save_and_new"><i class="fa fa-save"></i> <?php echo $this->lang->line('lab_button_save_and_add_new'); ?></button>
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
        $('#sup_first_name, #sup_last_name').keyup(function(){
           var $first_name = $('#sup_first_name').val();
           var $last_name = $('#sup_last_name').val();
           $('#sup_display_name').val($first_name + ' ' + $last_name);
        });
        $('.btn_cancel').click(function(){
           var $back_url = $(this).attr('back-url');
           window.location.href = $back_url;
        });
    });
    
</script>