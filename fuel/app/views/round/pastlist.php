<?php // var_dump($questions[14]); ?>
<?php if ($rounds): /* if $rounds 開始 */ ?>
	<?php foreach ($rounds as $round): /* foreach $rounds 開始 */ ?>
		<section>
			<div class="panel panel-default">
				<div class="panel-heading">
					<a 
						class="" 
						data-toggle="collapse" 
						data-target="#round-id-<?php echo $round['round_id'] ?>"
					>
						<?php echo $round['round_name'].' '.$round['examination_name']; ?>
					</a>
				</div>
				<div id="round-id-<?php echo $round['round_id'] ?>" class="collapse">
					<table class="table">
				        <thead>
							<tr>
								<th>番号</th>
								<th>種別</th>
								<th>小項目</th>
								<th>中項目</th>
								<th>大項目</th>
								<th>カテゴリ</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($questions[$round['round_id']] as $question): ?>
								<tr>
					  				<td>
										<?php 
											echo Html::anchor(
												  "question/commentary/".$question->question_number."/".$question->round_id
												, $question->question_number
												, array(
													"class"  => "cell_link"
												  )
											);
										?>
				        			</td>
					  				<td>
					  					<?php echo $question->divition->divition_name ?>
				        			</td>
					  				<td>
					  					<?php echo $question->firstcategory->first_category_name ?>
				        			</td>
					  				<td>
					  					<?php echo $question->firstcategory->secondcategory->second_category_name ?>
				        			</td>
					  				<td>
					  					<?php echo $question->firstcategory->secondcategory->thirdcategory->third_category_name ?>
				        			</td>
					  				<td>
					  					<?php echo $question->firstcategory->secondcategory->thirdcategory->topcategory->top_category_name ?>
				        			</td>
				        		</tr>
					        <?php endforeach; ?>
					</table>
				</div>
			</div>
		</section>		
	<?php endforeach; /* foreach $rounds 終了 */ ?>
<?php else: /* if $rounds else  */ ?>
	<p>[FATAL ERROR] 過去問がありません。</p>
<?php endif; /* if $rounds 終了 */?>
