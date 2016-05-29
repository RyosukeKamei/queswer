<h2>Viewing <span class='muted'>#<?php echo $firstcategory->id; ?></span></h2>

<p>
	<strong>Secondcategory id:</strong>
	<?php echo $firstcategory->secondcategory_id; ?></p>
<p>
	<strong>First category name:</strong>
	<?php echo $firstcategory->first_category_name; ?></p>
<p>
	<strong>Deleted at:</strong>
	<?php echo $firstcategory->deleted_at; ?></p>

<?php echo Html::anchor('firstcategories/edit/'.$firstcategory->id, 'Edit'); ?> |
<?php echo Html::anchor('firstcategories', 'Back'); ?>