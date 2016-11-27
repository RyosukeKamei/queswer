<h2>Viewing <span class='muted'>#<?php echo $event->id; ?></span></h2>

<p>
	<strong>Examination id:</strong>
	<?php echo $event->examination_id; ?></p>
<p>
	<strong>Round id:</strong>
	<?php echo $event->round_id; ?></p>
<p>
	<strong>Start datetime:</strong>
	<?php echo $event->start_datetime; ?></p>
<p>
	<strong>Finish datetime:</strong>
	<?php echo $event->finish_datetime; ?></p>

<?php echo Html::anchor('events/edit/'.$event->id, 'Edit'); ?> |
<?php echo Html::anchor('events', 'Back'); ?>