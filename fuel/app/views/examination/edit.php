<h2>Editing <span class='muted'>Examination</span></h2>
<br>

<?php echo render('examination/_form'); ?>
<p>
	<?php echo Html::anchor('examination/view/'.$examination->id, 'View'); ?> |
	<?php echo Html::anchor('examination', 'Back'); ?></p>
