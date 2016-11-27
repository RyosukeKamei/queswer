<?php if ($gotcards): ?>
		<?php foreach ($gotcards as $gotcard): ?>
				<?php 
					/*
					 * card_idが画像名と関連付け
					 */
					echo Asset::img(
								  '/card/'.$gotcard['card_id'].'.jpg'
								, array('width' => '300', 'alt'=>'カード'));
				?>
		<?php endforeach; ?>
<?php else: ?>
<p>カードがありません。</p>
<?php endif; ?>