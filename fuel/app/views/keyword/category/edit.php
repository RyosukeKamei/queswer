<h2>Editing <span class='muted'>Keyword_category</span></h2>
<br>

<?php echo render('keyword/category/_form'); ?>
<p>
	<?php echo Html::anchor('keyword/category/view/'.$keyword_category->id, 'View'); ?> |
	<?php echo Html::anchor('keyword/category', 'Back'); ?></p>
