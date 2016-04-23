<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Third category name', 'third_category_name', array('class'=>'control-label')); ?>

				<?php echo Form::input('third_category_name', Input::post('third_category_name', isset($third_category) ? $third_category->third_category_name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Third category name')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Top category id', 'top_category_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('top_category_id', Input::post('top_category_id', isset($third_category) ? $third_category->top_category_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Top category id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Deleted at', 'deleted_at', array('class'=>'control-label')); ?>

				<?php echo Form::input('deleted_at', Input::post('deleted_at', isset($third_category) ? $third_category->deleted_at : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Deleted at')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>