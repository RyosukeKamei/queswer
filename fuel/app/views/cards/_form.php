<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Card name', 'card_name', array('class'=>'control-label')); ?>

				<?php echo Form::input('card_name', Input::post('card_name', isset($card) ? $card->card_name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Card name')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Point distribution', 'point_distribution', array('class'=>'control-label')); ?>

				<?php echo Form::input('point_distribution', Input::post('point_distribution', isset($card) ? $card->point_distribution : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Point distribution')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Topcategory id', 'topcategory_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('topcategory_id', Input::post('topcategory_id', isset($card) ? $card->topcategory_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Topcategory id')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>