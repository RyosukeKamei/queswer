<h2>Admin Login</h2>
<br>
<?php echo Form::open(array("class"=>"form-horizontal")); ?>
<fieldset>
	<div class="form-group">
		<?php echo Form::label('ユーザ名', 'username', array('class'=>'control-label')); ?>
		<?php echo Form::input('username', Input::post('username', isset($admin) ? $admin->username : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'ユーザー名')); ?>
		<?php //echo Form::label('ユーザID', 'user_id', array('class'=>'control-label')); ?>
		<?php //echo Form::input('user_id', Input::post('user_id', isset($admin) ? $admin->user_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'ユーザーID')); ?>
		</div>
	<div class="form-group">
		<?php echo Form::label('パスワード', 'password', array('class'=>'control-label')); ?>
		<?php echo Form::password('password', Input::post('password', isset($admin) ? $admin->password : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'パスワード')); ?>
		</div>
	<?php echo Form::submit('submit', 'Login', array('class' => 'btn btn-primary')); ?>
</fieldset>
<?php echo Form::close(); ?>
