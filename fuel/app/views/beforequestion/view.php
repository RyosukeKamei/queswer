<h2>Viewing <span class='muted'>#<?php echo $beforequestion->id; ?></span></h2>

<p>
	<strong>Question number:</strong>
	<?php echo $beforequestion->question_number; ?></p>
<p>
	<strong>Question body:</strong>
	<?php echo $beforequestion->question_body; ?></p>
<p>
	<strong>Question commentary:</strong>
	<?php echo $beforequestion->question_commentary; ?></p>
<p>
	<strong>First category id:</strong>
	<?php echo $beforequestion->first_category_id; ?></p>
<p>
	<strong>Divition id:</strong>
	<?php echo $beforequestion->divition_id; ?></p>
<p>
	<strong>Round id:</strong>
	<?php echo $beforequestion->round_id; ?></p>
<p>
	<strong>Prefix id:</strong>
	<?php echo $beforequestion->prefix_id; ?></p>
<p>
	<strong>Deleted at:</strong>
	<?php echo $beforequestion->deleted_at; ?></p>

<?php echo Html::anchor('beforequestion/edit/'.$beforequestion->id, 'Edit'); ?> |
<?php echo Html::anchor('beforequestion', 'Back'); ?>