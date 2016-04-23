<h2>Viewing <span class='muted'>#<?php echo $third_category->id; ?></span></h2>

<p>
	<strong>Third category name:</strong>
	<?php echo $third_category->third_category_name; ?></p>
<p>
	<strong>Top category id:</strong>
	<?php echo $third_category->top_category_id; ?></p>
<p>
	<strong>Deleted at:</strong>
	<?php echo $third_category->deleted_at; ?></p>

<?php echo Html::anchor('third/category/edit/'.$third_category->id, 'Edit'); ?> |
<?php echo Html::anchor('third/category', 'Back'); ?>