<h2>Editing <span class='muted'>First_category</span></h2>
<br>

<?php echo render('first/category/_form'); ?>
<p>
	<?php echo Html::anchor('first/category/view/'.$first_category->id, 'View'); ?> |
	<?php echo Html::anchor('first/category', 'Back'); ?></p>
