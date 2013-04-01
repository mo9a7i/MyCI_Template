	<?php $count = 0; ?>
	<?php foreach($records as $record): ?>
	
	<tr id="row_<?=$record->id;?>" class="<?=($record->active == 4 ? "warning" : "");?> <?=($record->active == 3 ? "error" : "");?>">
		<td><?=$record->id;?></td>
		<td><?=anchor('admin/users/edit/'.$record->id,(!empty($record->username)? $record->username : "..."));?></td>
		<td><?=$record->email;?></td>
		<td><?=$record->created_on;?></td>
		<td><?=$record->group_name;?></td>
		<td>
			<ul class="user_controls inline unstyled">
				<li  id="activate_<?=$record->id;?>" data-original-title="Activate" rel="tooltip" class="icon edit_member_link ">
					<a href="<?=base_url().'admin/users/activate/'.$record->id;?>">
						تفعيل
					</a>
				</li>
				<li  id="update_<?=$record->id;?>" data-original-title="Edit" rel="tooltip" class="icon edit_member_link ">
					<a href="<?=base_url().'admin/users/edit/'.$record->id;?>">
						<i class="icon-pencil"></i><span style="display:none">تعديل</span>
					</a>
				</li>

				<li id="remove_<?=$record->id;?>" data-original-title="Delete" rel="tooltip" class="icon delete_member_link ">
					<a href="<?=base_url().'admin/users/delete/'.$record->id;?>">
						<i class="icon-remove"></i><span style="display:none">حذف</span>
					</a>
				</li>
			</ul>
		</td>
	</tr>
	<?php $count++; ?>
	<?php endforeach; ?>