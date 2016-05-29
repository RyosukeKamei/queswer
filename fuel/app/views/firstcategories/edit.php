<h2>Editing <span class='muted'>Firstcategory</span></h2>
<br>

<?php echo render('firstcategories/_form'); ?>
<p>
	<?php echo Html::anchor('firstcategories/view/'.$firstcategory->id, 'View'); ?> |
	<?php echo Html::anchor('firstcategories', 'Back'); ?></p>
