<h2>Viewing <span class='muted'>#<?php echo $round->id; ?></span></h2>

<p>
	<strong>Round name:</strong>
	<?php echo $round->round_name; ?></p>
<p>
	<strong>Examination id:</strong>
	<?php echo $round->examination_id; ?></p>
<p>
	<strong>Deleted at:</strong>
	<?php echo $round->deleted_at; ?></p>

<?php echo Html::anchor('round/edit/'.$round->id, 'Edit'); ?> |
<?php echo Html::anchor('round', 'Back'); ?>