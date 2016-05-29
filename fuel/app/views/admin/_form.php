<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php 
                //-- 第一引数はラベルなので日本語
                echo Form::label('ユーザー名', 'username', array('class'=>'control-label')); ?>

			<?php 
			    /*
			     * 【プログラミング規約】
			     * 横幅は80文字、縦の線はまっすぐ
			     * 他の要素も直してね
			     */
 			    echo Form::input(
                      'username'
 	                  , Input::post('username', isset($admin) ? $admin->username : '')
                      , array('class' => 'col-md-4 form-control', 'placeholder'=>'ユーザー名')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('パスワード', 'password', array('class'=>'control-label')); ?>

				<?php echo Form::input(
						'password'
						, Input::post('password', isset($admin) ? $admin->password : '')
						, array('class' => 'col-md-4 form-control', 'placeholder'=>'パスワード')); ?>

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
			<?php echo Form::submit('submit', '保存', array('class' => 'btn btn-primary')); ?>
		</div>
	</fieldset>
<?php echo Form::close(); ?>