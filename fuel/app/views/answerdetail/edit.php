<h2>Editing <span class='muted'>Answerdetail</span></h2>
<br>

<?php echo render('answerdetail/_form'); ?>
<p>
	<?php echo Html::anchor('answerdetail/view/'.$answerdetail->id, 'View'); ?> |
	<?php echo Html::anchor('answerdetail', 'Back'); ?></p>
