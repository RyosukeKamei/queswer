<h2>Viewing <span class='muted'>#<?php echo $secondcategory->id; ?></span></h2>

<p>
	<strong>Thirdcategory id:</strong>
	<?php echo $secondcategory->thirdcategory_id; ?></p>
<p>
	<strong>Second category name:</strong>
	<?php echo $secondcategory->second_category_name; ?></p>
<p>
	<strong>Deleted at:</strong>
	<?php echo $secondcategory->deleted_at; ?></p>

<?php echo Html::anchor('secondcategories/edit/'.$secondcategory->id, 'Edit'); ?> |
<?php echo Html::anchor('secondcategories', 'Back'); ?>