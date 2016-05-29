<h2>Viewing <span class='muted'>#<?php echo $thirdcategory->id; ?></span></h2>

<p>
	<strong>Topcategory id:</strong>
	<?php echo $thirdcategory->topcategory_id; ?></p>
<p>
	<strong>Third category name:</strong>
	<?php echo $thirdcategory->third_category_name; ?></p>
<p>
	<strong>Deleted at:</strong>
	<?php echo $thirdcategory->deleted_at; ?></p>

<?php echo Html::anchor('thirdcategories/edit/'.$thirdcategory->id, 'Edit'); ?> |
<?php echo Html::anchor('thirdcategories', 'Back'); ?>