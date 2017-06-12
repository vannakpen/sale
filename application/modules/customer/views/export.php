<?php
echo form_open(base_url('customer/download'),array('name'=>'frm_download'));
?>
<input type="hidden" name="temp_file" value="<?php echo $temp_file; ?>" />
<button type="submit" name="btn-submit" class="btn btn-primary"><i class="fa fa-download"></i> <?php echo $this->lang->line('lab_button_download'); ?></button>
<a href="<?php echo base_url('customer/view'); ?>" class="btn btn-primary"><i class="fa fa-backward"></i> <?php echo $this->lang->line('lab_button_go_back'); ?></a>
<?php echo form_close(); ?>
