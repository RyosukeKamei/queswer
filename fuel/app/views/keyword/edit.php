<h2>Editing <span class='muted'>Keyword</span></h2>
<br>

<?php echo render('keyword/_form'); ?>
<p>
	<?php echo Html::anchor('keyword/view/'.$keyword->id, 'View'); ?> |
	<?php echo Html::anchor('keyword', 'Back'); ?></p>
