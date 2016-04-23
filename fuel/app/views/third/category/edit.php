<h2>Editing <span class='muted'>Third_category</span></h2>
<br>

<?php echo render('third/category/_form'); ?>
<p>
	<?php echo Html::anchor('third/category/view/'.$third_category->id, 'View'); ?> |
	<?php echo Html::anchor('third/category', 'Back'); ?></p>
