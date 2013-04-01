	<?php $count = 0; ?>
	<?php foreach($records as $record): ?>
	
	<tr id="row_<?=$record->id;?>">
		<td><?=$record->id;?></td>
		<td><?=anchor('admin/pages/edit/'.$record->id,$record->title);?></td>
		<td><?=$record->user_id;?></td>
		<td><?=$record->date_added;?></td>
		<td>
			<ul class="user_controls inline unstyled">
				<li  id="update_<?=$record->id;?>" data-original-title="Edit" rel="tooltip" class="icon edit_member_link ">
					<a href="<?=base_url().'admin/pages/edit/'.$record->id;?>">
						<i class="icon-pencil"></i><span style="display:none"> ⁄œÌ·</span>
					</a>
				</li>

				<li id="remove_<?=$record->id;?>" data-original-title="Delete" rel="tooltip" class="icon delete_member_link ">
					<a href="<?=base_url().'admin/pages/delete/'.$record->id;?>">
						<i class="icon-remove"></i><span style="display:none">Õ–›</span>
					</a>
				</li>
			</ul>
		</td>
	</tr>
	<?php $count++; ?>
	<?php endforeach; ?>