<div class="row">
    <div class="row col-md-12">
        <a class="btn btn-primary" href="<?php echo base_url($this->uri->segment(1) . '/add-new'); ?>"><?php echo $this->lang->line('lab_button_add_new'); ?></a>
    </div>
    <div>
        <?php echo form_open(base_url('stock/view')); ?>
        <label for="type"><?php echo $this->lang->line('lab_select_type'); ?> : </label>
        <select name="filter_type">
            <option value="1" <?php echo (($filter != NULL && $filter['type'] == '1')?'selected':''); ?>><?php echo $this->lang->line('lab_filter_inventory');?></option>
            <option value="2" <?php echo (($filter != NULL && $filter['type'] == '2')?'selected':''); ?>><?php echo $this->lang->line('lab_filter_service');?></option>
        </select>
        <label><?php echo $this->lang->line('lab_filter_status');?> : </label>
        <input type="checkbox" id="check_filter_status" name="check_filter_status" <?php echo (($filter != NULL)?(($filter['status'] != NULL)?'checked':''):'checked'); ?> />
        <input type="submit" class="btn btn-primary" name="btn_filter" value="<?php echo $this->lang->line('lab_button_apply'); ?>" />
        <?php echo form_close(); ?>
    </div>
    <table id="datatable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th><input type="checkbox" id="check-all" class="flat"></th>
                <th><?php echo $this->lang->line('tab_sto_ite_id'); ?></th>
                <?php
                if($filter == NULL || $filter['type'] == '1'){
                ?>    
                    <th><?php echo $this->lang->line('tab_sto_ite_inv_icon'); ?></th>
                <?php
                }
                ?>
                <th><?php echo $this->lang->line('tab_sto_ite_code'); ?></th>
                <th><?php echo $this->lang->line('tab_sto_ite_name'); ?></th>
                <th><?php echo $this->lang->line('tab_sto_ite_group'); ?></th>
                <th><?php echo $this->lang->line('tab_sto_ite_type'); ?></th>
                <th><?php echo $this->lang->line('tab_sto_ite_class'); ?></th>
                <?php
                if($filter == NULL || $filter['type'] == '1'){
                ?>    
                    <th><?php echo $this->lang->line('tab_sto_ite_inv_type'); ?></th>
                <?php
                }
                ?>                
                <th><?php echo $this->lang->line('tab_sto_ite_description'); ?></th>
                <th><?php echo $this->lang->line('tab_sto_ite_status'); ?></th>
                <th><?php echo $this->lang->line('lab_action');?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            //var_dump($stock_item_data); die;
            if (count($stock_item_data) > 0) {
                foreach ($stock_item_data as $key => $value) {
                    ?>
                    <tr>
                        <td><input type="checkbox" class="flat" name="table_records"></td>
                        <td><?php echo $value['stoIteId']; ?></td>
                        <?php
                        if($filter == NULL || $filter['type'] == '1'){
                        ?>    
                            <td><img src="<?php echo (($value['stoIteInvIcon']=='')?INVENTORY_ICON_PATH.'inventory_icon.jpg':INVENTORY_ICON_PATH.substr($value['stoIteInvIcon'],0,strpos($value['stoIteInvIcon'], '.')).'_thumb'.substr($value['stoIteInvIcon'],strpos($value['stoIteInvIcon'], '.'))); ?>" /></td>
                        <?php
                        }
                        ?>                        
                        <td><?php echo '<img alt="testing" src="' . base_url('/barcode/barcode.php?size=20&text=' . $value['stoIteCode']. '&print=true') . '" />'; ?></td>
                        <td><?php echo $value['stoIteName']; ?></td>
                        <td><?php echo $value['stoIteGroup']; ?></td>
                        <td><?php echo item_type_string($value['stoIteType']); ?></td>
                        <td><?php echo $value['stoIteClass']; ?></td>
                        <?php
                        if($filter == NULL || $filter['type'] == '1'){
                        ?>    
                            <td><?php echo $value['stoIteInvType']; ?></td>
                        <?php
                        }
                        ?>
                        <td><?php echo $value['stoIteDescription']; ?></td>
                        <td><a href="<?php echo base_url('stock/update-status/'.$value['stoIteId']); ?>"><?php echo status_string($value['stoIteStatus']); ?></a></td>
                        <td>
                            <a href="<?php echo base_url('stock/edit/'.$value['stoIteId']); ?>"><span class="fa fa-pencil-square-o" title="<?php echo $this->lang->line('lab_button_edit'); ?>"></span></a> | 
                            <a href="#" link="<?php echo base_url('stock/delete/'.$value['stoIteId'].'/'.$value['stoIteType']); ?>" class="delete_item"><span class="fa fa-trash" title="<?php echo $this->lang->line('lab_button_delete'); ?>"></span></a> | 
                            <a href="#" class="view_item_detail" data-id="<?php echo $value['stoIteId']; ?>" data-backdrop="static" data-toggle="modal" data-target="#modal_view_detail"><span class="fa fa-eye" aria-hidden="true" title="<?php echo $this->lang->line('lab_button_view_detail'); ?>"></span></a>
                        </td>
                            
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="6">
                        <p><?php echo $this->lang->line('msg_no_record'); ?></p>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<!-- Modal -->
<div class="modal fade" id="modal_view_detail" tabindex="-1" role="dialog" aria-labelledby="modal_title" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title"><?php echo $this->lang->line('lab_button_view_detail'); ?></h5>
      </div>
        <div id="modal-body" class="modal-body">
            <div class="item_info row">
                <h4 class="title"><?php echo $this->lang->line('lab_basic_information'); ?></h4>
                <div class="col-md-4">
                    <div class="row">
                        <label for="name"><?php echo $this->lang->line('tab_sto_ite_name');?> : </label> CocaCola
                    </div>
                    <div class="row">
                        <label for="code"><?php echo $this->lang->line('tab_sto_ite_code');?> : </label> AACC0001
                    </div>
                    <div class="row">
                        <label for="code"><?php echo $this->lang->line('lab_barcode');?> : </label> <?php echo '<img alt="testing" src="' . base_url('/barcode/barcode.php?size=20&text=AACC0001'. '&print=true') . '" />'; ?>
                    </div>
                    <div class="row">
                        <label for="type"><?php echo $this->lang->line('tab_sto_ite_type');?> : </label> Inventory
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <label for="parent"><?php echo $this->lang->line('tab_sto_ite_parent_id');?> : </label> N/A
                    </div>
                    <div class="row">
                        <label for="merchant"><?php echo $this->lang->line('lab_merchant_name');?> : </label> The Lady Shop
                    </div>
                    <div class="row">
                        <label for="group"><?php echo $this->lang->line('tab_sto_ite_group');?> : </label> N/A
                    </div>
                    <div class="row">
                        <label for="class"><?php echo $this->lang->line('tab_sto_ite_class');?> : </label> N/A
                    </div>
                    <div class="row">
                        <label for="status"><?php echo $this->lang->line('tab_sto_ite_status');?> : </label> Active
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <label for="description"><?php echo $this->lang->line('tab_sto_ite_description');?> : </label><br/> 
                        My Description here!!!!
                    </div>
                </div>
            </div>
            <div class="item_measure row">
                <h4 class="title"><?php echo $this->lang->line('lab_measure_information'); ?></h4>
                <div class="col-md-6">
                    <table class="table" id="measure_data">
                        <tr>
                            <th><?php echo $this->lang->line('tab_sto_ite_mea_name'); ?></th>
                            <th><?php echo $this->lang->line('tab_sto_ite_mea_code'); ?></th>
                            <th><?php echo $this->lang->line('tab_sto_ite_mea_parent_id'); ?></th>
                            <th><?php echo $this->lang->line('tab_sto_ite_mea_unit'); ?></th>
                            <th><?php echo $this->lang->line('tab_sto_ite_mea_price'); ?></th>
                        </tr>
                        <tr>
                            <td>Unit</td>
                            <td>UN</td>
                            <td>None</td>
                            <td>1</td>
                            <td>100USD</td>
                        </tr>
                        <tr>
                            <td>Box</td>
                            <td>BO</td>
                            <td>Unit</td>
                            <td>12</td>
                            <td>1000USD</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <label for="on hand"><?php echo $this->lang->line('lab_stock_on_hand');?> : </label> 100UN
                    </div>
                    <div class="row">
                        <label for="on order"><?php echo $this->lang->line('lab_stock_on_order');?> : </label> 10UN
                    </div>
                    <div class="row">
                        <label for="available"><?php echo $this->lang->line('lab_stock_available');?> : </label> 90UN
                    </div>
                    <div class="row">
                        <label for="on purchase"><?php echo $this->lang->line('lab_stock_on_purchase');?> : </label> 100UN
                    </div>
                    <div class="row">
                        <label for="minimum alert"><?php echo $this->lang->line('tab_sto_ite_inv_min_stock_alert');?> : </label> 100UN
                    </div>
                </div>
            </div>
            <div class="item_detail row">
                <h4 class="title"><?php echo $this->lang->line('lab_detail_information'); ?></h4>
                <div class="col-md-12">
                    <div class="row">
                        <label for="on hand"><?php echo $this->lang->line('tab_sto_ite_inv_icon');?> : </label> 
                        <img class="cursor" src="<?php echo INVENTORY_ICON_PATH.'20bc9ea683d261fb5ef0d2eb2018c927_thumb.jpg'; ?>" data-toggle="modal" data-target="#myModal" />
                        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <img src="<?php echo INVENTORY_ICON_PATH.'20bc9ea683d261fb5ef0d2eb2018c927.jpg'; ?>" class="img-responsive">
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <label for="inventory type"><?php echo $this->lang->line('tab_sto_ite_inv_type');?> : </label> N/A
                    </div>
                    <div class="row">
                        <label for="sery"><?php echo $this->lang->line('tab_sto_ite_inv_series');?> : </label> N/A
                    </div>
                    <div class="row">
                        <label for="year"><?php echo $this->lang->line('tab_sto_ite_inv_year');?> : </label> N/A
                    </div>
                    <div class="row">
                        <label for="batch"><?php echo $this->lang->line('tab_sto_ite_inv_batch');?> : </label> N/A
                    </div>
                    <div class="row">
                        <label for="serial"><?php echo $this->lang->line('tab_sto_ite_inv_serial');?> : </label> N/A
                    </div>
                </div>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $this->lang->line('lab_button_close'); ?></button>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function(){
        $('.delete_item').click(function(){
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
        $('.view_item_detail').click(function(){
            var $loading_content = '<div class="center"><span type="button" id="load" data-loading-text="<i class=\'fa fa-circle-o-notch fa-spin\'></i> <?php echo $this->lang->line('lab_loading'); ?>"></span></div>';
            $('#modal-body').empty().append($loading_content);
            $('#load').button('loading');
            var $sto_ite_id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('stock/ajax_get_stock_item_detail'); ?>",
                data: {"type":"<?php echo (($filter['type'] != NULL)?$filter['type']:'1'); ?>", "sto_ite_id": $sto_ite_id}
            }).done(function($data){
                $('#modal-body').empty().append($data);
            }).fail(function(){
                alert('Failed');
            });
        });
    });
</script>