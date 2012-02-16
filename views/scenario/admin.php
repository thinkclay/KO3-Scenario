<?php 
/*
 * These should be included in your template file between <head> tags
 * Move the .css and .js files to the root resources directory.
 * Change names to match your specific naming conventions and adjust paths accordingly.
 */
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>';
echo '<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js" type="text/javascript"></script>';
echo html::style("resources/styles/scenario/default.css"); 
echo html::style("resources/styles/scenario/admin.css");
echo html::script("resources/scripts/scenario/default.js"); 
echo html::script("resources/scripts/scenario/admin.js");
?> 
<div id="scenario-admin">
	<div class="left-panel">
		<div class="view-panel">
			
		</div>
	</div>
	
	<div class="right-panel">
		<ul class="scenario-list">
			<form action="#" method="post" id="scenario-form">
				<li><input type="text" name="title" class="scenario-input" /></li>
				<?php // foreach($data): ?>	
			</form>
		</ul>
	</div>
	<!--
	<ul class="control-bar">
		<li class="new-scenario">New Scenario</li>
		<li>Button 2</li>
		<li>Button 3</li>
		<li>Button 4</li>
	</ul>
	-->
</div>
