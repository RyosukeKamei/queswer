<h2>Viewing <span class='muted'>#<?php echo $question->id; ?></span></h2>

<p>
	<strong>Question number:</strong>
	<?php echo $question->question_number; ?></p>
<p>
	<strong>Question body:</strong>
	<?php echo $question->question_body; ?></p>
<p>
	<strong>Question commentary:</strong>
	<?php echo $question->question_commentary; ?></p>
<p>
	<strong>First category id:</strong>
	<?php echo $question->first_category_id; ?></p>
<p>
	<strong>Divition id:</strong>
	<?php echo $question->divition_id; ?></p>
<p>
	<strong>Round id:</strong>
	<?php echo $question->round_id; ?></p>
<p>
	<strong>Deleted at:</strong>
	<?php echo $question->deleted_at; ?></p>

<?php echo Html::anchor('question/edit/'.$question->id, 'Edit'); ?> |
<?php echo Html::anchor('question', 'Back'); ?>