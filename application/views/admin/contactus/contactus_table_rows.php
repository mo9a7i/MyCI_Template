	<?php $count = 0; ?>
	<?php foreach($records as $record): ?>
	
	<tr id="row_<?=$record->id;?>">
		<td><?=$record->id;?></td>
		<td><?=anchor('admin/contactus/view/'.$record->id,$record->title);?></td>
		<td><?=$record->email_address;?></td>
		<td><?=$record->date_added;?></td>
		<td><?=$record->replies;?></td>
		<td>
			<ul class="user_controls inline unstyled">
				<li  id="update_<?=$record->id;?>" data-original-title="Edit" rel="tooltip" class="icon edit_member_link ">
					<a href="<?=base_url().'admin/contactus/view/'.$record->id;?>">
						<i class="icon-pencil"></i><span style="display:none">ÚÑÖ</span>
					</a>
				</li>

				<li id="remove_<?=$record->id;?>" data-original-title="Delete" rel="tooltip" class="icon delete_member_link ">
					<a href="<?=base_url().'admin/contactus/delete/'.$record->id;?>">
						<i class="icon-remove"></i><span style="display:none">ÍÐÝ</span>
					</a>
				</li>
			</ul>
		</td>
	</tr>
	<?php $count++; ?>
	<?php endforeach; ?>