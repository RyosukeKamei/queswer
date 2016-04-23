<h2>Viewing <span class='muted'>#<?php echo $prefix->id; ?></span></h2>

<p>
	<strong>Prefix name:</strong>
	<?php echo $prefix->prefix_name; ?></p>
<p>
	<strong>Deleted at:</strong>
	<?php echo $prefix->deleted_at; ?></p>

<?php echo Html::anchor('prefix/edit/'.$prefix->id, 'Edit'); ?> |
<?php echo Html::anchor('prefix', 'Back'); ?>