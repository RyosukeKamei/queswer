<h2>Viewing <span class='muted'>#<?php echo $second_category->id; ?></span></h2>

<p>
	<strong>Second category name:</strong>
	<?php echo $second_category->second_category_name; ?></p>
<p>
	<strong>Third category id:</strong>
	<?php echo $second_category->third_category_id; ?></p>
<p>
	<strong>Deleted at:</strong>
	<?php echo $second_category->deleted_at; ?></p>

<?php echo Html::anchor('second/category/edit/'.$second_category->id, 'Edit'); ?> |
<?php echo Html::anchor('second/category', 'Back'); ?>