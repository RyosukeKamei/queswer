<h2>Viewing <span class='muted'>#<?php echo $gotcard->id; ?></span></h2>

<p>
	<strong>User id:</strong>
	<?php echo $gotcard->user_id; ?></p>
<p>
	<strong>Card id:</strong>
	<?php echo $gotcard->card_id; ?></p>

<?php echo Html::anchor('gotcards/edit/'.$gotcard->id, 'Edit'); ?> |
<?php echo Html::anchor('gotcards', 'Back'); ?>