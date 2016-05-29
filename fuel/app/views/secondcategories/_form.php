<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Thirdcategory id', 'thirdcategory_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('thirdcategory_id', Input::post('thirdcategory_id', isset($secondcategory) ? $secondcategory->thirdcategory_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Thirdcategory id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Second category name', 'second_category_name', array('class'=>'control-label')); ?>

				<?php echo Form::input('second_category_name', Input::post('second_category_name', isset($secondcategory) ? $secondcategory->second_category_name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Second category name')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Deleted at', 'deleted_at', array('class'=>'control-label')); ?>

				<?php echo Form::input('deleted_at', Input::post('deleted_at', isset($secondcategory) ? $secondcategory->deleted_at : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Deleted at')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>