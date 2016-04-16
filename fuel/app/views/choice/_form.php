<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Question id', 'question_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('question_id', Input::post('question_id', isset($choice) ? $choice->question_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Question id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Choice num', 'choice_num', array('class'=>'control-label')); ?>

				<?php echo Form::input('choice_num', Input::post('choice_num', isset($choice) ? $choice->choice_num : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Choice num')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Choice body', 'choice_body', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('choice_body', Input::post('choice_body', isset($choice) ? $choice->choice_body : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Choice body')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Correct flag', 'correct_flag', array('class'=>'control-label')); ?>

				<?php echo Form::input('correct_flag', Input::post('correct_flag', isset($choice) ? $choice->correct_flag : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Correct flag')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Deleted at', 'deleted_at', array('class'=>'control-label')); ?>

				<?php echo Form::input('deleted_at', Input::post('deleted_at', isset($choice) ? $choice->deleted_at : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Deleted at')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>