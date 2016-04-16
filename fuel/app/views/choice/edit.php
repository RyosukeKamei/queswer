<h2>Editing <span class='muted'>Choice</span></h2>
<br>

<?php echo render('choice/_form'); ?>
<p>
	<?php echo Html::anchor('choice/view/'.$choice->id, 'View'); ?> |
	<?php echo Html::anchor('choice', 'Back'); ?></p>
