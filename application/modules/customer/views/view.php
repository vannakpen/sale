<div class="row">
    <div class="row col-md-12">
        <a class="btn btn-primary" href="<?php echo base_url($this->uri->segment(1) . '/add-new'); ?>"><i class="fa fa-plus-circle"></i> <?php echo $this->lang->line('lab_button_add_new'); ?></a>
        <a class="btn btn-primary" href="<?php echo base_url($this->uri->segment(1) . '/import'); ?>"><i class="fa fa-arrow-circle-up"></i> <?php echo $this->lang->line('lab_button_import'); ?></a>
        <a class="btn btn-primary" id="btn-export" href="#" data-backdrop="static" data-toggle="modal" data-target="#modal_export"><i class="fa fa-arrow-circle-down"></i> <?php echo $this->lang->line('lab_button_export'); ?></a>
    </div>
    <div>
        <?php echo form_open(base_url('customer/view')); ?>
        <label><?php echo $this->lang->line('lab_filter_status');?> : </label>
        <input type="checkbox" id="check_filter_status" name="check_filter_status" <?php echo (($filter != NULL)?(($filter['status'] != NULL)?'checked':''):'checked'); ?> />
        <input type="hidden" name="btn_filter" value="true" />
        <button type="submit" class="btn btn-primary" name="btn_submit"><i class="fa fa-filter"></i> <?php echo $this->lang->line('lab_button_apply'); ?></button>
        <?php echo form_close(); ?>
    </div>
    <table id="datatable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th><input type="checkbox" id="check-all" class=""></th>
                <th><?php echo $this->lang->line('tab_cus_id'); ?></th>
                <th><?php echo $this->lang->line('tab_cus_display_name'); ?></th>
                <th><?php echo $this->lang->line('tab_cus_sex'); ?></th>
                <th><?php echo $this->lang->line('tab_cus_mobile_1'); ?></th>               
                <th><?php echo $this->lang->line('tab_cus_email'); ?></th>
                <th><?php echo $this->lang->line('tab_cus_limit_order'); ?></th>
                <th><?php echo $this->lang->line('tab_cus_limit_owe_amount');?></th>
                <th><?php echo $this->lang->line('tab_status');?></th>
                <th><?php echo $this->lang->line('lab_action');?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            //var_dump($stock_item_data); die;
            if (count($customer_data) > 0) {
                foreach ($customer_data as $key => $value) {
                    ?>
                    <tr>
                        <td><input type="checkbox" class="record-check" name="customer_record[]" value="<?php echo $value['cusId'];?>"></td>
                        <td><?php echo $value['cusId']; ?></td>
                        <td><?php echo $value['cusDisplayName']; ?></td>
                        <td><?php echo (($value['cusSex']==1)?$this->lang->line('lab_male'):$this->lang->line('lab_female')); ?></td>
                        <td><?php echo $value['cusMobile1']; ?></td>
                        <td><?php echo $value['cusEmail']; ?></td>
                        <td><?php echo $value['cusLimitOrder']; ?></td>
                        <td><?php echo $value['cusLimitOweAmount']; ?></td>
                        <td><a href="<?php echo base_url('customer/update-status/'.$value['cusId']); ?>"><?php echo status_string($value['cusStatus']); ?></a></td>
                        <td>
                            <a href="<?php echo base_url('customer/edit/'.$value['cusId']); ?>"><span class="fa fa-pencil-square-o" title="<?php echo $this->lang->line('lab_button_edit'); ?>"></span></a> | 
                            <a href="#" link="<?php echo base_url('customer/delete/'.$value['cusId']); ?>" class="delete_customer"><span class="fa fa-trash" title="<?php echo $this->lang->line('lab_button_delete'); ?>"></span></a> | 
                            <a href="#" class="view_customer_detail" data-id="<?php echo $value['cusId']; ?>" data-backdrop="static" data-toggle="modal" data-target="#modal_view_detail"><span class="fa fa-eye" aria-hidden="true" title="<?php echo $this->lang->line('lab_button_view_detail'); ?>"></span></a>
                        </td>
                            
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="10" align="center">
                        <p><?php echo $this->lang->line('msg_no_record'); ?></p>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<!-- Modal detail -->
<div class="modal fade" id="modal_view_detail" tabindex="-1" role="dialog" aria-labelledby="modal_title" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title"><?php echo $this->lang->line('lab_view_detail'); ?></h5>
      </div>
        <div id="modal-body" class="modal-body">
<!--            Ajax replace here-->
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $this->lang->line('lab_button_close'); ?></button>
      </div>
    </div>
  </div>
</div>

<!-- Modal export -->
<div class="modal fade" id="modal_export" tabindex="-1" role="dialog" aria-labelledby="modal_title" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <?php echo form_open('customer/export', array('name'=>'frm_export')); ?>
      <input type="hidden" name="export_data" id="export_data" value="" />
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title_export"><?php echo $this->lang->line('lab_export'); ?></h5>
      </div>
        <div id="modal-body-export" class="modal-body_export col-md-12">
            <div class="col-md-6">
                <h4><?php echo $this->lang->line('lab_select_field'); ?></h4>
                <div>
                    <input type="checkbox" name="filter_column[]" value="cusId" checked />
                    <label><?php echo $this->lang->line('tab_cus_id');?></label>                    
                </div>
                <div>
                    <input type="checkbox" name="filter_column[]" value="cusFirstName" checked />
                    <label><?php echo $this->lang->line('tab_cus_first_name');?></label>
                    
                </div>
                <div>
                    <input type="checkbox" name="filter_column[]" value="cusLastName" checked />
                    <label><?php echo $this->lang->line('tab_cus_last_name');?></label>                    
                </div>
                <div>
                    <input type="checkbox" name="filter_column[]" value="cusDisplayName" checked />
                    <label><?php echo $this->lang->line('tab_cus_display_name');?></label>                    
                </div>
                <div>
                    <input type="checkbox" name="filter_column[]" value="cusEmail" checked />
                    <label><?php echo $this->lang->line('tab_cus_email');?></label>
                </div>
                <div>
                    <input type="checkbox" name="filter_column[]" value="cusMobile1" checked />
                    <label><?php echo $this->lang->line('tab_cus_mobile_1');?></label>
                </div>
                <div>
                    <input type="checkbox" name="filter_column[]" value="cusMobile2" checked />
                    <label><?php echo $this->lang->line('tab_cus_mobile_2');?></label>
                </div>
                <div>
                    <input type="checkbox" name="filter_column[]" value="cusAddress1" checked />
                    <label><?php echo $this->lang->line('tab_cus_address_1');?></label>
                </div>
                <div>
                    <input type="checkbox" name="filter_column[]" value="cusAddress2" checked />
                    <label><?php echo $this->lang->line('tab_cus_address_2');?></label>
                </div>
                <div>
                    <input type="checkbox" name="filter_column[]" value="cusLimitOrder" checked />
                    <label><?php echo $this->lang->line('tab_cus_limit_order');?></label>
                </div>
                <div>
                    <input type="checkbox" name="filter_column[]" value="cusLimitOweAmount" checked />
                    <label><?php echo $this->lang->line('tab_cus_limit_owe_amount');?></label>
                </div>
                <div>
                    <input type="checkbox" name="filter_column[]" value="cusDescription" checked />
                    <label><?php echo $this->lang->line('tab_cus_description');?></label>
                </div>
            </div>
            <div class="col-md-6">
                <h4><?php echo $this->lang->line('lab_export_file_type'); ?></h4>
                <div>
                    <input type="radio" name="file_type" value="excel" checked />
                    <label><i class="fa  fa-file-excel-o"></i> <?php echo $this->lang->line('lab_excel_file');?></label>
                </div>
                <div>
                    <input type="radio" name="file_type" value="text" />
                    <label><i class="fa  fa-file-text-o"></i> <?php echo $this->lang->line('lab_text_file');?></label>
                </div>
                <div>
                    <input type="radio" name="file_type" value="csv" />
                    <label><i class="fa  fa-file-o"></i> <?php echo $this->lang->line('lab_csv_file');?></label>
                </div>
            </div>
        </div>
      <div class="modal-footer">
          <button type="submit" name="btn_submit" class="btn btn-primary"><?php echo $this->lang->line('lab_button_export'); ?></button>
          <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $this->lang->line('lab_button_cancel'); ?></button>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
</div>
<script>
    $(document).ready(function(){
         $('.delete_customer').click(function(){
            var $url = $(this).attr('link');
            BootstrapDialog.show({
                closable: false,
                message: '<?php echo $this->lang->line('msg_confirm_remove'); ?>',
                buttons: [{
                    label: '<?php echo $this->lang->line('lab_button_ok');?>',
                    title: '<?php echo $this->lang->line('lab_button_ok');?>',
                    cssClass: 'btn-primary',
                    action: function($dialog){
                        window.location.href = $url;
                        $dialog.close();
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
        
        $('.view_customer_detail').click(function(){
            var $loading_content = '<div class="center"><span type="button" id="load" data-loading-text="<i class=\'fa fa-circle-o-notch fa-spin\'></i> <?php echo $this->lang->line('lab_loading'); ?>"></span></div>';
            $('#modal-body').empty().append($loading_content);
            $('#load').button('loading');
            var $cus_id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('customer/ajax_get_customer_detail'); ?>",
                data: {"cus_id": $cus_id}
            }).done(function($data){
                $('#modal-body').empty().append($data);
            }).fail(function(){
                alert('Failed');
            });
        });
        
        $("#check-all").click(function(){
            $('.record-check').prop('checked', this.checked);
        });
        
        $('#btn-export').click(function(){
           var $get_checkbox = $( ".record-check:checked" )
                .map(function() {
                  return this.value;
                })
                .get()
                .join();
           if($get_checkbox == ""){
                BootstrapDialog.show({
                    closable: false,
                    message: '<?php echo $this->lang->line('msg_confirm_select_item'); ?>',
                    buttons: [{
                        label: '<?php echo $this->lang->line('lab_button_ok'); ?>',
                        title: '<?php echo $this->lang->line('lab_button_ok');?>',
                        cssClass: 'btn-primary',
                        action: function(dialog){
                            dialog.close();
                        }
                    }]
                });
               return false;
           }
           $('#export_data').val($get_checkbox);
        });
    });
</script>