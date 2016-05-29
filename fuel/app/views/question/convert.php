<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('問題番号', 'question_number', array('class'=>'control-label')); ?>
			<?php echo Form::input('question_number'
			                       , $before_questions->question_number // DBから取得した値はオブジェクト
			                       , array('class' => 'col-md-4 form-control', 'placeholder'=>'問題番号', "readonly"=>"readonly")); 
            ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('元の問題文', 'question_body', array('class'=>'control-label')); ?>
			<?php echo Form::textarea('question_body'
			                          , $before_questions->question_body // DBから取得した値はオブジェクト
			                          , array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'元の問題文', "readonly"=>"readonly")); 
            ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('コンバートした問題文', 'conveted_question_body', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('conveted_question_body'
				                          , $questions['conveted_question_body'] // 元の問題文から生成した値は配列
				                          , array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'コンバートした問題文')); 
                ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('コンバートした選択肢ア', 'choice_body_a', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('choice_body_1'
				                          , $choices[1] // 元の問題文から生成した値は配列
				                          , array('class' => 'col-md-8 form-control', 'rows' => 3, 'placeholder'=>'コンバートした選択肢ア')); 
                ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('コンバートした選択肢イ', 'choice_body_i', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('choice_body_2'
				                          , $choices[2] // 元の問題文から生成した値は配列
				                          , array('class' => 'col-md-8 form-control', 'rows' => 3, 'placeholder'=>'コンバートした選択肢イ')); 
                ?>
		</div>
				<div class="form-group">
			<?php echo Form::label('コンバートした選択肢ウ', 'choice_body_u', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('choice_body_3'
				                          , $choices[3] // 元の問題文から生成した値は配列
				                          , array('class' => 'col-md-8 form-control', 'rows' => 3, 'placeholder'=>'コンバートした選択肢ウ')); 
                ?>
		</div>
				<div class="form-group">
			<?php echo Form::label('コンバートした選択肢エ', 'choice_body_e', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('choice_body_4'
				                          , $choices[4] // 元の問題文から生成した値は配列
				                          , array('class' => 'col-md-8 form-control', 'rows' => 3, 'placeholder'=>'コンバートした選択肢エ')); 
                ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('解答', 'correct_flag', array('class'=>'control-label')); ?>
			<?php echo Form::label('ア', 'correct_flag_a'); ?>
			<?php echo Form::radio('correct_flag'
				                   , 1
                                   , $correct_flag === 1 ? true : false
				                   );
            ?>
            <?php echo Form::label('イ', 'correct_flag_i'); ?>
			<?php echo Form::radio('correct_flag'
				                   , 2
                                   , $correct_flag === 2 ? true : false
				                   );
            ?>
            <?php echo Form::label('ウ', 'correct_flag_u'); ?>
			<?php echo Form::radio('correct_flag'
				                   , 3
                                   , $correct_flag === 3 ? true : false
				                   );
            ?>
            <?php echo Form::label('エ', 'correct_flag_e'); ?>
			<?php echo Form::radio('correct_flag'
				                   , 4
                                   , $correct_flag === 4 ? true : false
				                   );
            ?>	
		</div>		
		<div class="form-group">
			<?php echo Form::label('元の解説', 'question_commentary', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('question_commentary'
				                          , $before_questions->question_commentary
				                          , array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'元の解説', "readonly"=>"readonly")); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('小項目ID', 'firstcategory_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('firstcategory_id'
				                       , $before_questions->firstcategory_id
				                       , array('class' => 'col-md-4 form-control', 'placeholder'=>'小項目ID', "readonly"=>"readonly")); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('問題区分', 'divition_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('divition_id'
				                       , $before_questions->divition_id
				                       , array('class' => 'col-md-4 form-control', 'placeholder'=>'問題区分ID', "readonly"=>"readonly")); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('試験実施回', 'round_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('round_id'
				                       , $before_questions->round_id
				                       , array('class' => 'col-md-4 form-control', 'placeholder'=>'試験実施回', "readonly"=>"readonly")); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('選択肢のコード', 'prefix_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('prefix_id'
				                       , $before_questions->prefix_id
				                       , array('class' => 'col-md-4 form-control', 'placeholder'=>'選択肢のコード', "readonly"=>"readonly")); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', '保存', array('class' => 'btn btn-primary')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>
<p>
	<?php // echo Html::anchor('question/view/'.$before_question->id, 'View'); ?>
	<?php // echo Html::anchor('question', 'Back'); ?></p>
