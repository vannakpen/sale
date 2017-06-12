<div class="row">
    <div class="row col-md-12">
        <a class="btn btn-primary" href="<?php echo base_url($this->uri->segment(1) . '/add-new'); ?>"><i class="fa fa-plus-circle"></i> <?php echo $this->lang->line('lab_button_add_new'); ?></a>
        <a class="btn btn-primary" href="<?php echo base_url($this->uri->segment(1) . '/import'); ?>"><i class="fa fa-arrow-circle-up"></i> <?php echo $this->lang->line('lab_button_import'); ?></a>
        <a class="btn btn-primary" id="btn-export" href="#" data-backdrop="static" data-toggle="modal" data-target="#modal_export"><i class="fa fa-arrow-circle-down"></i> <?php echo $this->lang->line('lab_button_export'); ?></a>
    </div>
    <div>
        <?php echo form_open(base_url('supplier/view')); ?>
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
                <th><?php echo $this->lang->line('tab_sup_id'); ?></th>
                <th><?php echo $this->lang->line('tab_sup_name'); ?></th>
                <th><?php echo $this->lang->line('tab_sup_mobile_1'); ?></th>
                <th><?php echo $this->lang->line('tab_sup_email'); ?></th>               
                <th><?php echo $this->lang->line('tab_sup_contact_person_display_name'); ?></th>
                <th><?php echo $this->lang->line('tab_sup_contact_person_sex'); ?></th>
                <th><?php echo $this->lang->line('tab_sup_contact_person_mobile_1');?></th>
                <th><?php echo $this->lang->line('tab_sup_contact_person_email');?></th>
                <th><?php echo $this->lang->line('tab_status');?></th>
                <th><?php echo $this->lang->line('lab_action');?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            //var_dump($stock_item_data); die;
            if (count($supplier_data) > 0) {
                foreach ($supplier_data as $key => $value) {
                    ?>
                    <tr>
                        <td><input type="checkbox" class="record-check" name="supplier_record[]" value="<?php echo $value['supId'];?>"></td>
                        <td><?php echo $value['supId']; ?></td>
                        <td><?php echo $value['supName']; ?></td>
                        <td><?php echo $value['supMobile1']; ?></td>
                        <td><?php echo $value['supEmail']; ?></td>
                        <td><?php echo $value['supContactPersonDisplayName']; ?></td>
                        <td><?php echo (($value['supContactPersonSex']==1)?$this->lang->line('lab_male'):$this->lang->line('lab_female')); ?></td>
                        <td><?php echo $value['supContactPersonMobile1']; ?></td>
                        <td><?php echo $value['supContactPersonEmail']; ?></td>
                        <td><a href="<?php echo base_url('supplier/update-status/'.$value['supId']); ?>"><?php echo status_string($value['supStatus']); ?></a></td>
                        <td>
                            <a href="<?php echo base_url('supplier/edit/'.$value['supId']); ?>"><span class="fa fa-pencil-square-o" title="<?php echo $this->lang->line('lab_button_edit'); ?>"></span></a> | 
                            <a href="#" link="<?php echo base_url('supplier/delete/'.$value['supId']); ?>" class="delete_supplier"><span class="fa fa-trash" title="<?php echo $this->lang->line('lab_button_delete'); ?>"></span></a> | 
                            <a href="#" class="view_supplier_detail" data-id="<?php echo $value['supId']; ?>" data-backdrop="static" data-toggle="modal" data-target="#modal_view_detail"><span class="fa fa-eye" aria-hidden="true" title="<?php echo $this->lang->line('lab_button_view_detail'); ?>"></span></a>
                        </td>
                            
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="11" align="center">
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
    <?php echo form_open('supplier/export', array('name'=>'frm_export')); ?>
      <input type="hidden" name="export_data" id="export_data" value="" />
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title_export"><?php echo $this->lang->line('lab_export'); ?></h5>
      </div>
        <div id="modal-body-export" class="modal-body_export col-md-12">
            <div class="col-md-6">
                <h4><?php echo $this->lang->line('lab_select_field'); ?></h4>
                <div>
                    <input type="checkbox" name="filter_column[]" value="supId" checked />
                    <label><?php echo $this->lang->line('tab_sup_id');?></label>                    
                </div>
                <div>
                    <input type="checkbox" name="filter_column[]" value="supName" checked />
                    <label><?php echo $this->lang->line('tab_sup_name');?></label>
                    
                </div>
                <div>
                    <input type="checkbox" name="filter_column[]" value="supMobile1" checked />
                    <label><?php echo $this->lang->line('tab_sup_mobile_1');?></label>                    
                </div>
                <div>
                    <input type="checkbox" name="filter_column[]" value="supMobile2" checked />
                    <label><?php echo $this->lang->line('tab_sup_mobile_2');?></label>                    
                </div>
                <div>
                    <input type="checkbox" name="filter_column[]" value="supEmail" checked />
                    <label><?php echo $this->lang->line('tab_sup_email');?></label>
                </div>
                <div>
                    <input type="checkbox" name="filter_column[]" value="supAddress" checked />
                    <label><?php echo $this->lang->line('tab_sup_address');?></label>
                </div>
                <div>
                    <input type="checkbox" name="filter_column[]" value="supContactPersonFirstName" checked />
                    <label><?php echo $this->lang->line('tab_sup_contact_person_first_name');?></label>
                </div>
                <div>
                    <input type="checkbox" name="filter_column[]" value="supContactPersonLastName" checked />
                    <label><?php echo $this->lang->line('tab_sup_contact_person_last_name');?></label>
                </div>
                <div>
                    <input type="checkbox" name="filter_column[]" value="supContactPersonSex" checked />
                    <label><?php echo $this->lang->line('tab_sup_contact_person_sex');?></label>
                </div>
                <div>
                    <input type="checkbox" name="filter_column[]" value="supContactPersonMobile1" checked />
                    <label><?php echo $this->lang->line('tab_sup_contact_person_mobile_1');?></label>
                </div>
                <div>
                    <input type="checkbox" name="filter_column[]" value="supContactPersonMobile2" checked />
                    <label><?php echo $this->lang->line('tab_sup_contact_person_mobile_2');?></label>
                </div>
                <div>
                    <input type="checkbox" name="filter_column[]" value="supContactPersonAddress" checked />
                    <label><?php echo $this->lang->line('tab_sup_contact_person_address');?></label>
                </div>
                <div>
                    <input type="checkbox" name="filter_column[]" value="supDescription" checked />
                    <label><?php echo $this->lang->line('tab_sup_description');?></label>
                </div>
                <div>
                    <input type="checkbox" name="filter_column[]" value="supStatus" checked />
                    <label><?php echo $this->lang->line('tab_sup_status');?></label>
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
         $('.delete_supplier').click(function(){
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
        
        $('.view_supplier_detail').click(function(){
            var $loading_content = '<div class="center"><span type="button" id="load" data-loading-text="<i class=\'fa fa-circle-o-notch fa-spin\'></i> <?php echo $this->lang->line('lab_loading'); ?>"></span></div>';
            $('#modal-body').empty().append($loading_content);
            $('#load').button('loading');
            var $sup_id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('supplier/ajax_get_supplier_detail'); ?>",
                data: {"sup_id": $sup_id}
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