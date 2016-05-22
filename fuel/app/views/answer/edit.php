<h2>Editing <span class='muted'>Answer</span></h2>
<br>

<?php echo render('answer/_form'); ?>
<p>
	<?php echo Html::anchor('answer/view/'.$answer->id, 'View'); ?> |
	<?php echo Html::anchor('answer', 'Back'); ?></p>
