<h2>Viewing <span class='muted'>#<?php echo $top_category->id; ?></span></h2>

<p>
	<strong>Top category name:</strong>
	<?php echo $top_category->top_category_name; ?></p>
<p>
	<strong>Deleted at:</strong>
	<?php echo $top_category->deleted_at; ?></p>

<?php echo Html::anchor('top/category/edit/'.$top_category->id, 'Edit'); ?> |
<?php echo Html::anchor('top/category', 'Back'); ?>