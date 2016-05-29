<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Secondcategory id', 'secondcategory_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('secondcategory_id', Input::post('secondcategory_id', isset($firstcategory) ? $firstcategory->secondcategory_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Secondcategory id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('First category name', 'first_category_name', array('class'=>'control-label')); ?>

				<?php echo Form::input('first_category_name', Input::post('first_category_name', isset($firstcategory) ? $firstcategory->first_category_name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'First category name')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Deleted at', 'deleted_at', array('class'=>'control-label')); ?>

				<?php echo Form::input('deleted_at', Input::post('deleted_at', isset($firstcategory) ? $firstcategory->deleted_at : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Deleted at')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>