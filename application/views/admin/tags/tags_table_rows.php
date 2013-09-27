	<?php $count = 0; ?>
	<?php foreach($records as $record): ?>
	
	<tr id="row_<?=$record->id;?>">
		<td><?=$record->id;?></td>
		<td><?=anchor(base_url().'admin/tags/edit/'.$record->id,$record->title);?><br />
			<small><?=$record->description;?></small>
		</td>
		<td><?=$record->slug;?></td>
		<td><?=$record->count;?></td>
		<td>
			<ul class="user_controls list-inline list-unstyled">
				<li  id="update_<?=$record->id;?>" data-original-title="Edit" rel="tooltip" class="icon edit_member_link ">
					<a href="<?=base_url().'admin/tags/edit/'.$record->id;?>">
						<i class="icon-pencil"></i><span style="display:none">�����</span>
					</a>
				</li>

				<li id="remove_<?=$record->id;?>" data-original-title="Delete" rel="tooltip" class="icon delete_member_link ">
					<a href="<?=base_url().'admin/tags/delete/'.$record->id;?>">
						<i class="icon-remove"></i><span style="display:none">���</span>
					</a>
				</li>
			</ul>
		</td>
	</tr>
	<?php $count++; ?>
	<?php endforeach; ?>