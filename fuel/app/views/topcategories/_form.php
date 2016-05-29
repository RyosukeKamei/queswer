<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Organization id', 'organization_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('organization_id', Input::post('organization_id', isset($topcategory) ? $topcategory->organization_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Organization id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Top category name', 'top_category_name', array('class'=>'control-label')); ?>

				<?php echo Form::input('top_category_name', Input::post('top_category_name', isset($topcategory) ? $topcategory->top_category_name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Top category name')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Deleted at', 'deleted_at', array('class'=>'control-label')); ?>

				<?php echo Form::input('deleted_at', Input::post('deleted_at', isset($topcategory) ? $topcategory->deleted_at : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Deleted at')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>