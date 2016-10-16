<?php echo Form::open(array("class"=>"form-horizontal")); ?>
<h3>問題</h3>
<p><?php echo $questions->question_body; ?></p>
<h3>選択肢</h3>
<ul style="list-style-type: katakana">
	<?php 
		$choice_number = 1;
		foreach($choices AS $key => $choice) {
		echo '<li>';
			if((int)$choice_number === 1) {
				echo Form::radio('answer', $choice_number, true);
			} else {
				echo Form::radio('answer', $choice_number);
			}
			echo '&nbsp;';
			echo Form::label($choice->choice_body, 'answer');
			echo '</li>';
			$choice_number++;
	   }
	?>
</ul>
<p>
	<?php 
		echo Form::hidden('answer_id'      , $answer_id);
		echo Form::hidden('round_id'       , $questions->round_id);
		echo Form::hidden('question_number', $questions->question_number);
		echo Form::submit('submit', '解答し次の問題へ（解答は取り消しできません）', array('action'=>'question/solve' ,'method'=>'post', 'class' => 'btn btn-primary'));
	?>
</p>
<h3>
	大項目
	<?php echo $questions->firstcategory->secondcategory->thirdcategory->third_category_name; ?>
</h3>
<h3>
	問題種別
	<?php echo $questions->divition->divition_name; ?>
</h3>
<?php echo Form::close(); ?>