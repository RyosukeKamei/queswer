<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('ユーザー名', 'username', array('class'=>'control-label')); ?>

			<?php echo Form::input(
                    'username'
 	                , Input::post('username', isset($admin) ? $admin->username : '')
                    , array('class' => 'col-md-4 form-control', 'placeholder'=>'ユーザー名')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Eメールアドレス', 'email', array('class'=>'control-label')); ?>

			<?php echo Form::input(
					'email'
					, Input::post('email', isset($admin) ? $admin->email : '')
					, array('class' => 'col-md-4 form-control', 'placeholder'=>'Eメールアドレス')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('試験ID', 'examination_id', array('class'=>'control-label')); ?>

			<?php echo Form::input(
				    'examination_id'
					, Input::post('examination_id', isset($admin) ? $admin->examination_id : '')
					, array('class' => 'col-md-4 form-control', 'placeholder'=>'試験ID')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', '更新', array('class' => 'btn btn-primary')); ?>
		</div>
	</fieldset>
<?php echo Form::close(); ?>