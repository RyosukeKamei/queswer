<h2>Editing <span class='muted'>Gotcard</span></h2>
<br>

<?php echo render('gotcards/_form'); ?>
<p>
	<?php echo Html::anchor('gotcards/view/'.$gotcard->id, 'View'); ?> |
	<?php echo Html::anchor('gotcards', 'Back'); ?></p>
