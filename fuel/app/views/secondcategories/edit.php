<h2>Editing <span class='muted'>Secondcategory</span></h2>
<br>

<?php echo render('secondcategories/_form'); ?>
<p>
	<?php echo Html::anchor('secondcategories/view/'.$secondcategory->id, 'View'); ?> |
	<?php echo Html::anchor('secondcategories', 'Back'); ?></p>
