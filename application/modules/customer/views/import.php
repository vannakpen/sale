<div class="row">
    <?php
    echo form_open_multipart(base_url('customer/save-import'),array('id'=>'frm_new_customer'));
    ?>
    <div class="col-md-12">
        <label for="select file"><?php echo $this->lang->line('lab_select_file'); ?> : </label>
        <input type="file" name="file_upload" class="form-control" />
    </div>
    <div class="col-md-12">
        <button class="btn btn-primary" type="submit" name="btn_upload" id="btn_upload"><i class="fa fa-upload"></i> <?php echo $this->lang->line('lab_button_upload'); ?></button>
        <button class="btn btn-primary btn_cancel" type="button" name="btn_cancel" back-url="<?php echo ((isset($_SERVER['HTTP_REFERER']))?$_SERVER['HTTP_REFERER']:base_url('customer')); ?>"><i class="fa fa-close"></i> <?php echo $this->lang->line('lab_button_cancel'); ?></button>
    </div>
    <?php
    echo form_close();
    ?>
</div>
<script>
$(document).ready(function(){
    $('.btn_cancel').click(function(){
       var $back_url = $(this).attr('back-url');
       window.location.href = $back_url;
    });
});
</script>
