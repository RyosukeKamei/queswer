<h2>Viewing <span class='muted'>#<?php echo $card->id; ?></span></h2>

<p>
	<strong>Card name:</strong>
	<?php echo $card->card_name; ?></p>
<p>
	<strong>Point distribution:</strong>
	<?php echo $card->point_distribution; ?></p>
<p>
	<strong>Topcategory id:</strong>
	<?php echo $card->topcategory_id; ?></p>

<?php echo Html::anchor('cards/edit/'.$card->id, 'Edit'); ?> |
<?php echo Html::anchor('cards', 'Back'); ?>