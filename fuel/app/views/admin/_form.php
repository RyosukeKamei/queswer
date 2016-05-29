<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php 
                //-- 第一引数はラベルなので日本語
                echo Form::label('User id', 'user_id', array('class'=>'control-label')); ?>

			<?php 
			    /*
			     * 【プログラミング規約】
			     * 横幅は80文字、縦の線はまっすぐ
			     * 他の要素も直してね
			     */
			    echo Form::input(
                     'user_id'
	                 , Input::post('user_id', isset($admin) ? $admin->user_id : '')
                     , array('class' => 'col-md-4 form-control', 'placeholder'=>'User id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Password', 'password', array('class'=>'control-label')); ?>

				<?php echo Form::input('password', Input::post('password', isset($admin) ? $admin->password : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Password')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Examination id', 'examination_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('examination_id', Input::post('examination_id', isset($admin) ? $admin->examination_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Examination id')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>