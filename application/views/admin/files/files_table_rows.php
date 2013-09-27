	<?php $count = 0; ?>
	<?php foreach($records as $record): ?>
	
	<tr id="row_<?=$record->id;?>">
		<td><?=$record->id;?></td>
		<td><?=anchor('admin/files/get/'.$record->id,$record->file_name);?></td>
		<td><?=$record->user_id;?></td>
		<td><?=$record->file_size;?></td>
		<td><?=$record->date_added;?></td>
		<td>
			<ul class="user_controls list-inline list-unstyled">

				<li id="remove_<?=$record->id;?>" data-original-title="Delete" rel="tooltip" class="icon delete_member_link ">
					<a href="<?=base_url().'admin/files/delete/'.$record->id;?>">
						<i class="icon-remove"></i><span style="display:none">ÍÐÝ</span>
					</a>
				</li>
			</ul>
		</td>
	</tr>
	<?php $count++; ?>
	<?php endforeach; ?>