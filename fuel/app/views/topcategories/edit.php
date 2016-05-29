<h2>Editing <span class='muted'>Topcategory</span></h2>
<br>

<?php echo render('topcategories/_form'); ?>
<p>
	<?php echo Html::anchor('topcategories/view/'.$topcategory->id, 'View'); ?> |
	<?php echo Html::anchor('topcategories', 'Back'); ?></p>
