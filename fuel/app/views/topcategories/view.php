<h2>Viewing <span class='muted'>#<?php echo $topcategory->id; ?></span></h2>

<p>
	<strong>Organization id:</strong>
	<?php echo $topcategory->organization_id; ?></p>
<p>
	<strong>Top category name:</strong>
	<?php echo $topcategory->top_category_name; ?></p>
<p>
	<strong>Deleted at:</strong>
	<?php echo $topcategory->deleted_at; ?></p>

<?php echo Html::anchor('topcategories/edit/'.$topcategory->id, 'Edit'); ?> |
<?php echo Html::anchor('topcategories', 'Back'); ?>