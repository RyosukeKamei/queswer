<h2>Editing <span class='muted'>Admin</span></h2>
<br>

<?php echo render('admin/_form'); ?>
<p>
	<?php echo Html::anchor('admin/view/'.$admin->id, 'View'); ?> |
	<?php echo Html::anchor('admin', 'Back'); ?></p>
