<h2>Editing <span class='muted'>Round</span></h2>
<br>

<?php echo render('round/_form'); ?>
<p>
	<?php echo Html::anchor('round/view/'.$round->id, 'View'); ?> |
	<?php echo Html::anchor('round', 'Back'); ?></p>
