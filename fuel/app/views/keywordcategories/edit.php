<h2>Editing <span class='muted'>Keywordcategory</span></h2>
<br>

<?php echo render('keywordcategories/_form'); ?>
<p>
	<?php echo Html::anchor('keywordcategories/view/'.$keywordcategory->id, 'View'); ?> |
	<?php echo Html::anchor('keywordcategories', 'Back'); ?></p>
