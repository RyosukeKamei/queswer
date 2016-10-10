<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('試験', 'round_id', array('class'=>'control-label')); ?>
			<?php 	
					/* SELECT文の中身はModel_Round::find('all')で取得すると楽？ */
					echo Form::select(
					  'round_id'
					, Input::post('round_id', isset($question) ? $question->round_id : 15)
					, Arr::pluck(Model_Round::find('all') , 'round_name', 'id')
					, array('class' => 'col-md-4 form-control')
					);
			?>
		</div>
		<div class="form-group">
			<?php echo Form::label('問題番号', 'question_number', array('class'=>'control-label')); ?>
			<?php echo Form::input(
					  'question_number'
					, Input::post('question_number', isset($question) ? $question->question_number : '')
					, array('class' => 'col-md-4 form-control', 'placeholder'=>'問題番号：1')
					);
			?>
		</div>
		<div class="form-group">
			<?php echo Form::label('問題文', 'question_body', array('class'=>'control-label')); ?>
			<?php echo Form::textarea(
					  'question_body'
					, Input::post('question_body', isset($question) ? $question->question_body : '')
					, array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'10進数123を、英字A〜Zを用いた26進数で表したものはどれか。ここで、A＝0、B＝1、...、Z＝25とする。')
					);
			?>
		</div>
		<div class="form-group">
			<?php echo Form::label('選択肢ア', 'choice_body_1', array('class'=>'control-label')); ?>
			<?php echo Form::input(
					  'choice_body_1'
					, Input::post('choice_body_1', isset($choices) ? $choices[1] : '')
					, array('class' => 'col-md-4 form-control', 'placeholder'=>'BCD 選択肢がテーブル形式などの時は空')
					);
			?>
		</div>
		<div class="form-group">
			<?php echo Form::label('選択肢イ', 'choice_body_2', array('class'=>'control-label')); ?>
			<?php echo Form::input(
					  'choice_body_2'
					, Input::post('choice_body_2', isset($choices) ? $choices[2] : '')
					, array('class' => 'col-md-4 form-control', 'placeholder'=>'DCB 選択肢がテーブル形式などの時は空')
					);
			?>
		</div>
		<div class="form-group">
			<?php echo Form::label('選択肢ウ', 'choice_body_3', array('class'=>'control-label')); ?>
			<?php echo Form::input(
					  'choice_body_3'
					, Input::post('choice_body_3', isset($choices) ? $choices[3] : '')
					, array('class' => 'col-md-4 form-control', 'placeholder'=>'ET 選択肢がテーブル形式などの時は空')
					);
			?>
		</div>
		<div class="form-group">
			<?php echo Form::label('選択肢エ', 'choice_body_4', array('class'=>'control-label')); ?>
			<?php echo Form::input(
					  'choice_body_4'
					, Input::post('choice_body_4', isset($choices) ? $choices[4] : '')
					, array('class' => 'col-md-4 form-control', 'placeholder'=>'ET 選択肢がテーブル形式などの時は空')
					);
			?>
		</div>
		<div class="form-group">
			<?php echo Form::label('正解', 'correct_flag', array('class'=>'control-label')); ?>
			<?php 	
					echo Form::select(
					  'correct_flag'
					, Input::post('correct_flag', isset($choices) ? $choices['correct_flag'] : 0)
					, array('1' => 'ア', '2' => 'イ', '3' => 'ウ', '4' => 'エ')
					, array('class' => 'col-md-4 form-control')
					);
			?>
		</div>
		<div class="form-group">
			<?php echo Form::label('解説', 'question_commentary', array('class'=>'control-label')); ?>
			<?php echo Form::textarea(
					  'question_commentary'
					, Input::post('question_commentary', isset($question) ? $question->question_commentary : '')
					, array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Question commentary')
					);
			?>
		</div>
		<div class="form-group">
			<?php echo Form::label('小項目', 'firstcategory_id', array('class'=>'control-label')); ?>
			<?php 	
					/* SELECT文の中身はModel_Firstcategory::find('all')で取得すると楽？ */
					echo Form::select(
					  'firstcategory_id'
					, Input::post('firstcategory_id', isset($question) ? $question->firstcategory_id : 0)
					, Arr::pluck(Model_Firstcategory::find('all') , 'first_category_name', 'id')
					, array('class' => 'col-md-4 form-control')
					);
			?>
		</div>
		<div class="form-group">
			<?php echo Form::label('問題種別', 'divition_id', array('class'=>'control-label')); ?>
			<?php 	
					/* SELECT文の中身はModel_Firstcategory::find('all')で取得すると楽？ */
					echo Form::select(
					  'divition_id'
					, Input::post('divition_id', isset($question) ? $question->divition_id : 0)
					, Arr::pluck(Model_Divition::find('all') , 'divition_name', 'id')
					, array('class' => 'col-md-4 form-control')
					);
			?>
			
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', '問題を保存', array('class' => 'btn btn-primary')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Html::anchor('question/delete/'.$question->id, '<i class="icon-trash icon-white"></i> 問題を削除', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('削除してもよろしいでしょうか?')")); ?>
		</div>
		</fieldset>
<?php echo Form::close(); ?>