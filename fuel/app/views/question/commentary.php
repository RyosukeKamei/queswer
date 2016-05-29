<p><?php echo $question->question_body; ?></p>
<ul style="list-style-type: katakana">
	<?php 
	   foreach($choice AS $key => $value) {
	       echo '<li>'.$value->choice_body.'</li>';
	   }
	?>
</ul>

<h2>解説</h2>
<hr>
<p>
	<?php echo $question->question_commentary; ?></p>
<p>
	<strong>First category id:</strong>
	<?php echo $question->firstcategory_id; ?></p>
<p>
	<strong>問題種別</strong>
	<?php echo $question->divition->divition_name; ?></p>

<?php echo Html::anchor('question', 'Back'); ?>