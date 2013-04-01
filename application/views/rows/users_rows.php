	<?php $count = 0; ?>
	<?php foreach($users as $user): ?>
	
	<tr id="row_<?=$user->id;?>">
		<td><?=anchor('/members/'.$user->username,(!empty($user->username)? $user->username : "..."));?></td>
		<td><?=$user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name;?></td>
	</tr>
	<?php $count++; ?>
	<?php endforeach; ?>