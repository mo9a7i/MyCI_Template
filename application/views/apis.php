<ul class="media-list">


<?php

foreach($api as $value)
{
	if($value->gender != "male")
	{
	?>
	<li class="media" dir="ltr">
		<a class="pull-right" href="#">
		  <img class="media-object" src="<?=$value->photo->prefix . "32x32" .$value->photo->suffix; ?>" alt="<?//?>">
		</a>
		<div class="media-body">
		  <h4 class="media-heading"><?=$value->firstName . " " .$value->lastName;?></h4>
		  <?=$value->gender;?>
		</div>
	  </li>
	<?php
	}
}
//var_dump($api);

?>
</ul>