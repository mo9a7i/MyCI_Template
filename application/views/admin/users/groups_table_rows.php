	<?php $count = 0; ?>
	<?php foreach($records as $record): ?>
	
	<tr id="row_<?=$record->id;?>">
		<td><?=$record->id;?></td>
		<td><?=($record->id == 1 || $record->id == 2 ? $record->name : anchor('admin/users_groups/edit/'.$record->id,$record->name));?></td>
		<td><?=$record->count;?></td>
		<td>
			<?	if($record->id == 1 || $record->id == 2)echo " ممنوع التعديل"; 
				else
				{
			?>
			<ul class="user_controls list-inline list-unstyled">
				<li  id="update_<?=$record->id;?>" data-original-title="Edit" rel="tooltip" class="icon edit_member_link ">
					<a href="<?=base_url().'admin/users_groups/edit/'.$record->id;?>">
						<i class="icon-pencil"></i><span style="display:none">تعديل</span>
					</a>
				</li>

				<li id="remove_<?=$record->id;?>" data-original-title="Delete" rel="tooltip" class="icon delete_member_link ">
					<a href="<?=base_url().'admin/users_groups/delete/'.$record->id;?>">
						<i class="icon-remove"></i><span style="display:none">حذف</span>
					</a>
				</li>
			</ul>
			
			<? }?>
		</td>
	</tr>
	<?php $count++; ?>
	<?php endforeach; ?>