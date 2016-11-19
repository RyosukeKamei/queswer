<h2><span class='muted'>問題にチャレンジする！</span></h2>
<p>初めて問題にチャレンジする場合は、「試験を開始」ボタンをクリックしてください！</p>
<p>続きから解答をする場合は、「試験の続き」ボタンをクリックしてください！</p>
<p>「試験解答の履歴」をクリックすると、試験ごとの結果を見ることができます！</p>
<?php if ($rounds): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>試験名</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
    <?php foreach ($rounds as $item): ?>
        <tr>
            <td>
                <?php echo $item['round_name']; ?>&nbsp;
                <?php echo $item['examination_name']; ?>
            </td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<!-- 試験を開始 -->
						<?php 
						  if(!$item['answer_id']) 
						  {
						  	echo 
								Html::anchor('question/solve/'.$item['round_id'],
						    	'<i class="icon-eye-open"></i> 試験を開始', 
						    	array('class' => 'btn btn-warning btn-sm'));
						  }
						  elseif($item['answer_id'])
						  {
							echo
						    	Html::anchor('question/solve/'.$item['round_id'].'/'.$item['answer_id'],
						    	'<i class="icon-wrench"></i> 試験の続き',
						    	array('class' => 'btn btn-info btn-sm'));
						  }
						?>
						<!-- 履歴 -->
						<?php 
						  echo
						      Html::anchor('answerdetail/history/'.$item['round_id'],
						      '<i class="icon-trash icon-white"></i> 試験解答の履歴',
						      array('class' => 'btn btn-sm btn-primary')); ?>
					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>
<?php else: ?>
<p>試験がありません（ありえないエラー）</p>
<?php endif; ?>
<?php 
	echo Form::open('round/list/'); 
	echo Form::hidden('examnation_id', $examnations['examnation_id']);
?>

<!-- 個人の解答サマリー -->
<h2><span class='muted'>あなたの得意分野・不得意分野はこれだ！</span></h2>
<p>あなたの得意分野・不得意分野がわかります！弱点を克服したり、強い分野を知って自信をつけましょう！</p>
<p>今まで解答したデータを基に、シラバスにあるカテゴリ・大項目・中項目・小項目・問題種別ごとに解析した結果です！</p>
<?php 	
	/*
	 * 集計単位
	 */
	echo Form::select(
			  'user_summary_category'
			, Input::post('user_summary_category')
			, array(
				  'divitions'	     => '問題種別'
				, 'topcategories'    => 'テクノロジ・マネジメント・ストラテジ'
				, 'thirdcategories'  => '大項目'
				, 'secondcategories' => '中項目'
				, 'firstcategories'  => '小項目'
			)
			, array('class' => 'col-md-4 form-control')
	);
	/*
	 * フィルタ
	 */
	echo Form::select(
			'user_summary_round_id'
			, Input::post('user_summary_round_id', 0)
			, $rounds_for_summary
			, array('class' => 'col-md-4 form-control')
	);
	echo Form::submit('submit', '切り替える', array('class' => 'btn btn-primary'));
?>

<?php if ($user_summaries): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th class="text-center">項目名</th>
			<th class="text-center">問題数</th>
			<th class="text-center">出題率</th>
			<th class="text-center">正解数</th>
			<th class="text-center">正答率</th>
			<th class="text-center">評価</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($user_summaries as $user_summary): ?>
		<tr>
			<td><?php echo $user_summary['name']; ?></td>
			<td class="text-right"><?php echo $user_summary['question_count']; ?></td>
			<td class="text-right"><?php echo round($user_summary['question_count'] / (int)$user_summary_count * 100, 0) ?>%</td>
			<td class="text-right"><?php echo $user_summary['correct_count']; ?></td>
			<td class="text-right">
				<?php $correct_rate = round((int)$user_summary['correct_count'] / (int)$user_summary['question_count'] * 100, 0);
					echo $correct_rate; 
				?>%
			</td>
			<td>
				<?php
						/*
						 * 正解率により表示を切り替え
						 */
						
						if((int)$correct_rate >= 70)
						{
					?>
							<span class="text-success">得意</span>
					<?php 
						}
						elseif((int)$correct_rate >= 40 && (int)$correct_rate < 70)
						{
					?>
							並み
					<?php 
						}
						elseif((int)$correct_rate > 0 && (int)$correct_rate < 40)
						{
					?>
							<span class="text-warning">不得意</span>
					<?php 
						}
						else
						{
							
						} 
					?>
			
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>
<?php else: ?>
<p>解答がありません。</p>
<?php endif; ?>
<!-- 全体の解答サマリー -->
<h2><span class='muted'>全ユーザの統計データ</span></h2>
<p>このウェブサイトで解答したすべてのユーザの統計データです。</p>
<p>今まで解答したデータを基に、シラバスにあるカテゴリ・大項目・中項目・小項目・問題種別ごとに解析した結果です！</p>
<?php 	
	/*
	 * 集計単位
	 */
	echo Form::select(
			  'all_summary_category'
			, Input::post('all_summary_category')
			, array(
				  'divitions'	     => '問題種別'
				, 'topcategories'    => 'テクノロジ・マネジメント・ストラテジ'
				, 'thirdcategories'  => '大項目'
				, 'secondcategories' => '中項目'
				, 'firstcategories'  => '小項目'
			)
			, array('class' => 'col-md-4 form-control')
	);
	/*
	 * フィルタ
	 */
	echo Form::select(
			'all_summary_round_id'
			, Input::post('all_summary_round_id', 0)
			, $rounds_for_summary
			, array('class' => 'col-md-4 form-control')
	);
		
	echo Form::submit('submit', '切り替える', array('class' => 'btn btn-primary'));
?>

<?php if ($all_summaries): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>項目名</th>
			<th>問題数</th>
			<th>出題率</th>
			<th>正解数</th>
			<th>正答率</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($all_summaries as $all_summary): ?>
		<tr>
			<td><?php echo $all_summary['name']; ?></td>
			<td><?php echo $all_summary['question_count']; ?></td>
			<td><?php echo round($all_summary['question_count'] / (int)$all_summary_count * 100, 0) ?>%</td>
			<td><?php echo $all_summary['correct_count']; ?></td>
			<td>
				<?php $correct_rate = round((int)$all_summary['correct_count'] / (int)$all_summary['question_count'] * 100, 2);
					echo $correct_rate; 
				?>%
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>
<?php else: ?>
<p>解答がありません。</p>
<?php endif; ?>
<?php Form::close(); ?>