<h2>Viewing <span class='muted'>#<?php echo $choice->id; ?></span></h2>

<p>
	<strong>Question id:</strong>
	<?php echo $choice->question_id; ?></p>
<p>
	<strong>Choice num:</strong>
	<?php echo $choice->choice_num; ?></p>
<p>
	<strong>Choice body:</strong>
	<?php echo $choice->choice_body; ?></p>
<p>
	<strong>Correct flag:</strong>
	<?php echo $choice->correct_flag; ?></p>
<p>
	<strong>Deleted at:</strong>
	<?php echo $choice->deleted_at; ?></p>

<?php echo Html::anchor('choice/edit/'.$choice->id, 'Edit'); ?> |
<?php echo Html::anchor('choice', 'Back'); ?>