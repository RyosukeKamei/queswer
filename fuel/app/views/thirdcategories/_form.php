<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Topcategory id', 'topcategory_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('topcategory_id', Input::post('topcategory_id', isset($thirdcategory) ? $thirdcategory->topcategory_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Topcategory id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Third category name', 'third_category_name', array('class'=>'control-label')); ?>

				<?php echo Form::input('third_category_name', Input::post('third_category_name', isset($thirdcategory) ? $thirdcategory->third_category_name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Third category name')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Deleted at', 'deleted_at', array('class'=>'control-label')); ?>

				<?php echo Form::input('deleted_at', Input::post('deleted_at', isset($thirdcategory) ? $thirdcategory->deleted_at : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Deleted at')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>