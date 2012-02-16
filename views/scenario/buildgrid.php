<?php 
	
	echo '<table id="scenario-grid">';
	for($i = 0; $i <= $data; $i++)
	{
		echo '<tr>';
		for ($b = 0; $b <= ($data + 1); $b++)
		{
			echo '<td data-row="' . $i . '" data-col="' . $b . '" class="empty-cell scenario-cell"></td>';
		}
		echo '</tr>'; 
	}
	echo '</table>'; 
?>