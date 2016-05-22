<h2>Viewing <span class='muted'>#<?php echo $answer->id; ?></span></h2>

<p>
	<strong>Round id:</strong>
	<?php echo $answer->round_id; ?></p>
<p>
	<strong>User id:</strong>
	<?php echo $answer->user_id; ?></p>
<p>
	<strong>Finish flag:</strong>
	<?php echo $answer->finish_flag; ?></p>
<p>
	<strong>Frequency:</strong>
	<?php echo $answer->frequency; ?></p>
<p>
	<strong>Deleted at:</strong>
	<?php echo $answer->deleted_at; ?></p>

<?php echo Html::anchor('answer/edit/'.$answer->id, 'Edit'); ?> |
<?php echo Html::anchor('answer', 'Back'); ?>