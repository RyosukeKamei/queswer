<p>
	<?php echo Html::anchor('question/create', '問題を登録', array('class' => 'btn btn-success')); ?>
</p>
<?php if ($questions): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>試験</th>
			<th>問題番号</th>
			<th>問題文</th>
			<th>小項目</th>
			<th>問題種別</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($questions as $item): ?>
		<tr>
			<td><?php echo $item->round->round_name; ?></td>
			<td><?php echo $item->question_number; ?></td>
			<td><?php echo $item->question_body; ?></td>
			<td><?php echo $item->firstcategory->first_category_name; ?></td>
			<td><?php echo $item->divition->divition_name; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('question/edit/'.$item->id, '<i class="icon-wrench"></i> 変更', array('class' => 'btn btn-default btn-sm')); ?>
						<?php echo Html::anchor('question/delete/'.$item->id, '<i class="icon-trash icon-white"></i> 削除', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('本当に削除してもよろしいでしょうか?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>
</tbody>
</table>

<?php else: ?>
<p>問題がありません。</p>
<?php endif; ?>