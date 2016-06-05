<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Firstcategory id', 'firstcategory_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('firstcategory_id', Input::post('firstcategory_id', isset($keywordcategory) ? $keywordcategory->firstcategory_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Firstcategory id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Keyword id', 'keyword_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('keyword_id', Input::post('keyword_id', isset($keywordcategory) ? $keywordcategory->keyword_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Keyword id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Deleted at', 'deleted_at', array('class'=>'control-label')); ?>

				<?php echo Form::input('deleted_at', Input::post('deleted_at', isset($keywordcategory) ? $keywordcategory->deleted_at : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Deleted at')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>