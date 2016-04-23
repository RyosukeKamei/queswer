<h2>Viewing <span class='muted'>#<?php echo $organization->id; ?></span></h2>

<p>
	<strong>Organization name:</strong>
	<?php echo $organization->organization_name; ?></p>
<p>
	<strong>Deleted at:</strong>
	<?php echo $organization->deleted_at; ?></p>

<?php echo Html::anchor('organization/edit/'.$organization->id, 'Edit'); ?> |
<?php echo Html::anchor('organization', 'Back'); ?>