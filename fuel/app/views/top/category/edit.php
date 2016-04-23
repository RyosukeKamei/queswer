<h2>Editing <span class='muted'>Top_category</span></h2>
<br>

<?php echo render('top/category/_form'); ?>
<p>
	<?php echo Html::anchor('top/category/view/'.$top_category->id, 'View'); ?> |
	<?php echo Html::anchor('top/category', 'Back'); ?></p>
