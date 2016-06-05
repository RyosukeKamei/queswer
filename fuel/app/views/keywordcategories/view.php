<h2>Viewing <span class='muted'>#<?php echo $keywordcategory->id; ?></span></h2>

<p>
	<strong>Firstcategory id:</strong>
	<?php echo $keywordcategory->firstcategory_id; ?></p>
<p>
	<strong>Keyword id:</strong>
	<?php echo $keywordcategory->keyword_id; ?></p>
<p>
	<strong>Deleted at:</strong>
	<?php echo $keywordcategory->deleted_at; ?></p>

<?php echo Html::anchor('keywordcategories/edit/'.$keywordcategory->id, 'Edit'); ?> |
<?php echo Html::anchor('keywordcategories', 'Back'); ?>