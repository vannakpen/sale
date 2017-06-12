<script src="<?php echo base_url('vendors/validator/validator.js'); ?>"></script>
<!-- Switchery -->
<link href="<?php echo base_url('vendors/switchery/dist/switchery.min.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('vendors/switchery/dist/switchery.min.js'); ?>"></script>
<!--select tree-->
<link rel="stylesheet" href="<?php echo base_url('css/jqx.base.css'); ?>" type="text/css" />

<div class="row">    
    <?php
    echo form_open_multipart(base_url('customer/save'),array('id'=>'frm_new_customer'));
    ?>
    <input type="hidden" name="cus_id" id="cus_id" value="<?php echo $customer_data['cusId']; ?>" />
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
                                <label for="first name"> <?php echo $this->lang->line('tab_cus_first_name'); ?> <span class="required">*</span> :</label>
                                <input name="cus_first_name" type="text" value="<?php echo $customer_data['cusFirstName']; ?>" id="cus_id" required="required" class="form-control">
                            </div>
                            <div class="row">
                                <label for="last name"> <?php echo $this->lang->line('tab_cus_last_name'); ?> :</label>
                                <input name="cus_last_name" type="text" value="<?php echo $customer_data['cusLastName']; ?>" id="cus_id" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 panel panel-default box_margin">
                    <div class="panel-body">
                        <div class="box_margin">
                            <div class="row">
                                <label for="display name"> <?php echo $this->lang->line('tab_cus_display_name'); ?> :</label>
                                <input name="cus_display_name" type="text" value="<?php echo $customer_data['cusDisplayName']; ?>" id="cus_display_name" class="form-control">
                            </div>
                            <div class="row">
                                <label for="sex"> <?php echo $this->lang->line('tab_cus_sex'); ?> :</label>
                                <select name="cus_sex" id="cus_sex" class="form-control">
                                    <option value="1" <?php echo (($customer_data['cusSex']==1)?'selected':'');?>><?php echo $this->lang->line('lab_male'); ?></option>
                                    <option value="0" <?php echo (($customer_data['cusSex']==0)?'selected':'');?>><?php echo $this->lang->line('lab_female'); ?></option>
                                </select>
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
                                <label for="mobile 1"> <?php echo $this->lang->line('tab_cus_mobile_1'); ?> :</label>
                                <input name="cus_mobile_1" type="text" value="<?php echo $customer_data['cusMobile1']; ?>" id="cus_mobile_1" class="form-control">
                            </div>
                            <div class="row">
                                <label for="mobile 2"> <?php echo $this->lang->line('tab_cus_mobile_2'); ?> :</label>
                                <input name="cus_mobile_2" type="text" value="<?php echo $customer_data['cusMobile2']; ?>" id="cus_mobile_1" class="form-control">
                            </div>
                            <div class="row">
                                <label for="address 1"> <?php echo $this->lang->line('tab_cus_address_1'); ?> :</label>
                                <input name="cus_address_1" type="text" value="<?php echo $customer_data['cusAddress1']; ?>" id="cus_address_1" class="form-control">
                            </div>
                            <div class="row">
                                <label for="address 2"> <?php echo $this->lang->line('tab_cus_address_2'); ?> :</label>
                                <input name="cus_address_2" type="text" value="<?php echo $customer_data['cusAddress2']; ?>" id="cus_address_1" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 panel panel-default box_margin">
                    <div class="panel-body">
                        <div class="box_margin">
                            <div class="row">
                                <label for="email"> <?php echo $this->lang->line('tab_cus_email'); ?> :</label>
                                <input name="cus_email" type="text" value="<?php echo $customer_data['cusEmail']; ?>" id="cus_email" class="form-control">
                            </div>
                            <div class="row">
                                <label for="limit order"> <?php echo $this->lang->line('tab_cus_limit_order'); ?> :</label>
                                <input name="cus_limit_order" type="number" value="<?php echo $customer_data['cusLimitOrder']; ?>" id="cus_limit_order" class="form-control">
                            </div>
                            <div class="row">
                                <label for="limit owe amount"> <?php echo $this->lang->line('tab_cus_limit_owe_amount'); ?> :</label>
                                <input name="cus_limit_owe_amount" type="number" step="any" value="<?php echo $customer_data['cusLimitOweAmount']; ?>" id="cus_limit_owe_amount" class="form-control">
                            </div>
                            <div class="row">
                                <label for="description"> <?php echo $this->lang->line('tab_cus_description'); ?> :</label><br/>
                                <textarea name="cus_description" id="cus_description" class="form-control"><?php echo $customer_data['cusDescription']; ?></textarea>
                            </div>
                        </div>
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
        $('.btn_cancel').click(function(){
           var $back_url = $(this).attr('back-url');
           window.location.href = $back_url;
        });
    });
    
</script>