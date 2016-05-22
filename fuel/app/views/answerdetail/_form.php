<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Question num', 'question_num', array('class'=>'control-label')); ?>

				<?php echo Form::input('question_num', Input::post('question_num', isset($answerdetail) ? $answerdetail->question_num : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Question num')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Answer id', 'answer_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('answer_id', Input::post('answer_id', isset($answerdetail) ? $answerdetail->answer_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Answer id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Answer', 'answer', array('class'=>'control-label')); ?>

				<?php echo Form::input('answer', Input::post('answer', isset($answerdetail) ? $answerdetail->answer : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Answer')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Deleted at', 'deleted_at', array('class'=>'control-label')); ?>

				<?php echo Form::input('deleted_at', Input::post('deleted_at', isset($answerdetail) ? $answerdetail->deleted_at : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Deleted at')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>