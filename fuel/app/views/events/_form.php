<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('試験名', 'examination_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('examination_id', Input::post('examination_id', isset($event) ? $event->examination_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'3')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('対象過去問', 'round_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('round_id', Input::post('round_id', isset($event) ? $event->round_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'15')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('イベント開始日時', 'start_datetime', array('class'=>'control-label')); ?>

				<?php echo Form::input('start_datetime', Input::post('start_datetime', isset($event) ? $event->start_datetime : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Start datetime')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('イベント終了日時', 'finish_datetime', array('class'=>'control-label')); ?>

				<?php echo Form::input('finish_datetime', Input::post('finish_datetime', isset($event) ? $event->finish_datetime : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Finish datetime')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>