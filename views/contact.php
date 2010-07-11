<?php echo form::open() ?>
<fieldset>
<div class="legend"><h3><?php echo __('Contact Us');?></h3></div> 

<div class="form_row"> 
	<div class="form_property"><label><?php echo __('Name:'); ?></label></div> 
	<div class="form_value"><?php echo form::input('name') ?></div>
	<div class="clearer">&nbsp;</div> 
</div>

<div class="form_row"> 
	<div class="form_property"><label><?php echo __('Email:'); ?></label></div> 
	<div class="form_value"><?php echo form::input('email','',array('style'=>'width:200px')) ?></div> 
	<div class="clearer">&nbsp;</div> 
</div>

<div class="form_row">
	<div class="form_property"><label><?php echo __('Comments:'); ?></label></div>
	<div class="form_value"><?php echo form::textarea('comments','',array('style'=>'width:300px;height:100px;')) ?></div> 
	<div class="clearer">&nbsp;</div> 
</div>

<div class="form_row form_row_submit"> 
<div class="form_value"><?php echo form::submit('submit',__('Send Comments')) ?></div>
<div class="clearer">&nbsp;</div> 
</div> 
</fieldset>
<?php echo form::close() ?>