<ul id="search-list">
	<?php 
		foreach ($data as $scenario) 
		{
			echo '<li id="' . $scenario['_id'] . '" class="search-result-li">'.$scenario['title'].'</li>';
		}
	?>
</ul>
