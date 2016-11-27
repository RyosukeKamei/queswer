<h2>Editing <span class='muted'>Card</span></h2>
<br>

<?php echo render('cards/_form'); ?>
<p>
	<?php echo Html::anchor('cards/view/'.$card->id, 'View'); ?> |
	<?php echo Html::anchor('cards', 'Back'); ?></p>
