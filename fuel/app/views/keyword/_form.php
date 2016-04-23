<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Keyword', 'keyword', array('class'=>'control-label')); ?>

				<?php echo Form::input('keyword', Input::post('keyword', isset($keyword) ? $keyword->keyword : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Keyword')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Desctiption', 'desctiption', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('desctiption', Input::post('desctiption', isset($keyword) ? $keyword->desctiption : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Desctiption')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Deleted at', 'deleted_at', array('class'=>'control-label')); ?>

				<?php echo Form::input('deleted_at', Input::post('deleted_at', isset($keyword) ? $keyword->deleted_at : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Deleted at')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>