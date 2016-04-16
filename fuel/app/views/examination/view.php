<h2>Viewing <span class='muted'>#<?php echo $examination->id; ?></span></h2>

<p>
	<strong>Examination name:</strong>
	<?php echo $examination->examination_name; ?></p>
<p>
	<strong>Deleted at:</strong>
	<?php echo $examination->deleted_at; ?></p>

<?php echo Html::anchor('examination/edit/'.$examination->id, 'Edit'); ?> |
<?php echo Html::anchor('examination', 'Back'); ?>