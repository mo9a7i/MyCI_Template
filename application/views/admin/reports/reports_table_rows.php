	<?php $count = 0; ?>
	<?php foreach($records as $record): ?>
	
	<tr id="row_<?=$record->id;?>">
		<td><?=$record->id;?></td>
		<td><?=$record->report_category;?></td>
		<td><?=$record->content;?></td>
		<td><a href="<?=$record->pathname;?>" ><?=$record->resource_type;?> #<?=$record->resource_id;?></a></td>
		<td><?=anchor(base_url().'admin/users/edit/'.$record->user_id,(empty($record->username) ? $record->user_id:$record->username));?></td>
		<td><?=$record->date_added;?></td>
		<td>
			<ul class="user_controls inline unstyled">

				<li id="remove_<?=$record->id;?>" data-original-title="Delete" rel="tooltip" class="icon delete_member_link ">
					<a href="<?=base_url().'admin/reports/delete/'.$record->id;?>">
						<i class="icon-remove"></i><span style="display:none">ÍÐÝ</span>
					</a>
				</li>
			</ul>
		</td>
	</tr>
	<?php $count++; ?>
	<?php endforeach; ?>