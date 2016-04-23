<h2>Viewing <span class='muted'>#<?php echo $first_category->id; ?></span></h2>

<p>
	<strong>First category name:</strong>
	<?php echo $first_category->first_category_name; ?></p>
<p>
	<strong>Second category id:</strong>
	<?php echo $first_category->second_category_id; ?></p>
<p>
	<strong>Deleted at:</strong>
	<?php echo $first_category->deleted_at; ?></p>

<?php echo Html::anchor('first/category/edit/'.$first_category->id, 'Edit'); ?> |
<?php echo Html::anchor('first/category', 'Back'); ?>