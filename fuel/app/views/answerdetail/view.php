<h2>Viewing <span class='muted'>#<?php echo $answerdetail->id; ?></span></h2>

<p>
	<strong>Question num:</strong>
	<?php echo $answerdetail->question_num; ?></p>
<p>
	<strong>Answer id:</strong>
	<?php echo $answerdetail->answer_id; ?></p>
<p>
	<strong>Answer:</strong>
	<?php echo $answerdetail->answer; ?></p>
<p>
	<strong>Deleted at:</strong>
	<?php echo $answerdetail->deleted_at; ?></p>

<?php echo Html::anchor('answerdetail/edit/'.$answerdetail->id, 'Edit'); ?> |
<?php echo Html::anchor('answerdetail', 'Back'); ?>