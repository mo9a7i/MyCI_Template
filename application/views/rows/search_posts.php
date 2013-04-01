	<?php $count = 0; ?>
	<?php foreach($news as $new): ?>
	
	<tr id="row_<?=$new->id;?>">
		<td><?=anchor('news/id/'.$new->id,$new->title);?></td>
		<td><?=$new->date_added;?></td>
	</tr>
	<?php $count++; ?>
	<?php endforeach; ?>