	<?php $count = 0; ?>
	<?php foreach($records as $record): ?>
	
	<tr id="row_<?=$record->id;?>">
		<td><?=$record->id;?></td>
		<td><?=anchor('admin/news_categories/edit/'.$record->id,$record->name);?></td>
		<td>
			<ul class="user_controls list-inline list-unstyled">
				<li  id="update_<?=$record->id;?>" data-original-title="Edit" rel="tooltip" class="icon edit_member_link ">
					<a href="<?=base_url().'admin/news_categories/edit/'.$record->id;?>">
						<i class="icon-pencil"></i><span style="display:none">�����</span>
					</a>
				</li>

				<li id="remove_<?=$record->id;?>" data-original-title="Delete" rel="tooltip" class="icon delete_member_link ">
					<a href="<?=base_url().'admin/news_categories/delete/'.$record->id;?>">
						<i class="icon-remove"></i><span style="display:none">���</span>
					</a>
				</li>
			</ul>
		</td>
	</tr>
	<?php $count++; ?>
	<?php endforeach; ?>