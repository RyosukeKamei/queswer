<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Round name', 'round_name', array('class'=>'control-label')); ?>

				<?php echo Form::input('round_name', Input::post('round_name', isset($round) ? $round->round_name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Round name')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Examination id', 'examination_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('examination_id', Input::post('examination_id', isset($round) ? $round->examination_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Examination id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Deleted at', 'deleted_at', array('class'=>'control-label')); ?>

				<?php echo Form::input('deleted_at', Input::post('deleted_at', isset($round) ? $round->deleted_at : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Deleted at')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>