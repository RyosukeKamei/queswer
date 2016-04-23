<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Question number', 'question_number', array('class'=>'control-label')); ?>

				<?php echo Form::input('question_number', Input::post('question_number', isset($beforequestion) ? $beforequestion->question_number : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Question number')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Question body', 'question_body', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('question_body', Input::post('question_body', isset($beforequestion) ? $beforequestion->question_body : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Question body')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Question commentary', 'question_commentary', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('question_commentary', Input::post('question_commentary', isset($beforequestion) ? $beforequestion->question_commentary : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Question commentary')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('First category id', 'first_category_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('first_category_id', Input::post('first_category_id', isset($beforequestion) ? $beforequestion->first_category_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'First category id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Divition id', 'divition_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('divition_id', Input::post('divition_id', isset($beforequestion) ? $beforequestion->divition_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Divition id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Round id', 'round_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('round_id', Input::post('round_id', isset($beforequestion) ? $beforequestion->round_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Round id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Prefix id', 'prefix_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('prefix_id', Input::post('prefix_id', isset($beforequestion) ? $beforequestion->prefix_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Prefix id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Deleted at', 'deleted_at', array('class'=>'control-label')); ?>

				<?php echo Form::input('deleted_at', Input::post('deleted_at', isset($beforequestion) ? $beforequestion->deleted_at : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Deleted at')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>