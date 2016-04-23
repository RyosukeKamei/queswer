<h2>Viewing <span class='muted'>#<?php echo $divition->id; ?></span></h2>

<p>
	<strong>Divition name:</strong>
	<?php echo $divition->divition_name; ?></p>
<p>
	<strong>Deleted at:</strong>
	<?php echo $divition->deleted_at; ?></p>

<?php echo Html::anchor('divition/edit/'.$divition->id, 'Edit'); ?> |
<?php echo Html::anchor('divition', 'Back'); ?>