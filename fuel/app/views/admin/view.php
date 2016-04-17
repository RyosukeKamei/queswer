<h2>Viewing <span class='muted'>#<?php echo $admin->id; ?></span></h2>

<p>
	<strong>User id:</strong>
	<?php echo $admin->user_id; ?></p>
<p>
	<strong>Password:</strong>
	<?php echo $admin->password; ?></p>
<p>
	<strong>Examination id:</strong>
	<?php echo $admin->examination_id; ?></p>
<p>
	<strong>Deleted at:</strong>
	<?php echo $admin->deleted_at; ?></p>

<?php echo Html::anchor('admin/edit/'.$admin->id, 'Edit'); ?> |
<?php echo Html::anchor('admin', 'Back'); ?>