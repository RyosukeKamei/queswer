<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('First category id', 'first_category_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('first_category_id', Input::post('first_category_id', isset($keyword_category) ? $keyword_category->first_category_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'First category id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Keyword id', 'keyword_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('keyword_id', Input::post('keyword_id', isset($keyword_category) ? $keyword_category->keyword_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Keyword id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Deleted at', 'deleted_at', array('class'=>'control-label')); ?>

				<?php echo Form::input('deleted_at', Input::post('deleted_at', isset($keyword_category) ? $keyword_category->deleted_at : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Deleted at')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>