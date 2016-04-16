<h2>Editing <span class='muted'>Question</span></h2>
<br>

<?php echo render('question/_form'); ?>
<p>
	<?php echo Html::anchor('question/view/'.$question->id, 'View'); ?> |
	<?php echo Html::anchor('question', 'Back'); ?></p>
