<h2>Viewing <span class='muted'>#<?php echo $keyword_category->id; ?></span></h2>

<p>
	<strong>First category id:</strong>
	<?php echo $keyword_category->first_category_id; ?></p>
<p>
	<strong>Keyword id:</strong>
	<?php echo $keyword_category->keyword_id; ?></p>
<p>
	<strong>Deleted at:</strong>
	<?php echo $keyword_category->deleted_at; ?></p>

<?php echo Html::anchor('keyword/category/edit/'.$keyword_category->id, 'Edit'); ?> |
<?php echo Html::anchor('keyword/category', 'Back'); ?>