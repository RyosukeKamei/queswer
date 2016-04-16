<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Examination name', 'examination_name', array('class'=>'control-label')); ?>

				<?php echo Form::input('examination_name', Input::post('examination_name', isset($examination) ? $examination->examination_name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Examination name')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Deleted at', 'deleted_at', array('class'=>'control-label')); ?>

				<?php echo Form::input('deleted_at', Input::post('deleted_at', isset($examination) ? $examination->deleted_at : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Deleted at')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>