<h2>Viewing <span class='muted'>#<?php echo $keyword->id; ?></span></h2>

<p>
	<strong>Keyword:</strong>
	<?php echo $keyword->keyword; ?></p>
<p>
	<strong>Desctiption:</strong>
	<?php echo $keyword->desctiption; ?></p>
<p>
	<strong>Deleted at:</strong>
	<?php echo $keyword->deleted_at; ?></p>

<?php echo Html::anchor('keyword/edit/'.$keyword->id, 'Edit'); ?> |
<?php echo Html::anchor('keyword', 'Back'); ?>