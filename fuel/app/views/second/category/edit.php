<h2>Editing <span class='muted'>Second_category</span></h2>
<br>

<?php echo render('second/category/_form'); ?>
<p>
	<?php echo Html::anchor('second/category/view/'.$second_category->id, 'View'); ?> |
	<?php echo Html::anchor('second/category', 'Back'); ?></p>
