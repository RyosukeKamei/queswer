<h2>Editing <span class='muted'>Organization</span></h2>
<br>

<?php echo render('organization/_form'); ?>
<p>
	<?php echo Html::anchor('organization/view/'.$organization->id, 'View'); ?> |
	<?php echo Html::anchor('organization', 'Back'); ?></p>
