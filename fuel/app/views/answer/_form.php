<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Round id', 'round_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('round_id', Input::post('round_id', isset($answer) ? $answer->round_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Round id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('User id', 'user_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('user_id', Input::post('user_id', isset($answer) ? $answer->user_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'User id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Finish flag', 'finish_flag', array('class'=>'control-label')); ?>

				<?php echo Form::input('finish_flag', Input::post('finish_flag', isset($answer) ? $answer->finish_flag : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Finish flag')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Frequency', 'frequency', array('class'=>'control-label')); ?>

				<?php echo Form::input('frequency', Input::post('frequency', isset($answer) ? $answer->frequency : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Frequency')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Deleted at', 'deleted_at', array('class'=>'control-label')); ?>

				<?php echo Form::input('deleted_at', Input::post('deleted_at', isset($answer) ? $answer->deleted_at : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Deleted at')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>