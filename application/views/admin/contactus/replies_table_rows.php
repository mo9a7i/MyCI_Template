	<?php $count = 0; ?>
	<?php foreach($replies as $reply): ?>
	
	<tr id="row_<?=$reply->id;?>">
		<td><?=$reply->id;?></td>
		<td><?=$reply->title;?></td>
		<td><?=$reply->content;?></td>
		<td><?=$reply->date_added;?></td>
		<td><?=$reply->user_id;?></td>
		<td><?=$reply->status_id;?></td>

	</tr>
	<?php $count++; ?>
	<?php endforeach; ?>