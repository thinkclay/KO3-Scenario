<?php 
/*
 * These should be included in your template file between <head> tags
 * Move the .css and .js files to the root resources directory.
 * Change names to match your specific naming conventions and adjust paths accordingly.
 */

/* jQuery & jQuery UI*/
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>';
echo '<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js" type="text/javascript"></script>';
 
// support lib for bezier stuff 
echo '<script type="text/javascript" src="/resources/scenario/plumb/js/lib/jsBezier-0.3-min.js"></script>' . "\r\n";
// main jsplumb engine
echo '<script type="text/javascript" src="/resources/scenario/plumb/js/jsPlumb-1.3.6-RC1.js"></script>' . "\r\n";
// connectors, endpoint and overlays
echo '<script type="text/javascript" src="/resources/scenario/plumb/js/jsPlumb-defaults-1.3.6-RC1.js"></script>' . "\r\n";
// state machine connectors
echo '<script type="text/javascript" src="/resources/scenario/plumb/js/jsPlumb-connectors-statemachine-1.3.6-RC1.js"></script>' . "\r\n";
// SVG renderer
echo '<script type="text/javascript" src="/resources/scenario/plumb/js/jsPlumb-renderers-svg-1.3.6-RC1.js"></script>' . "\r\n";
// canvas renderer
echo '<script type="text/javascript" src="/resources/scenario/plumb/js/jsPlumb-renderers-canvas-1.3.6-RC1.js"></script>' . "\r\n";
// vml renderer
echo '<script type="text/javascript" src="/resources/scenario/plumb/js/jsPlumb-renderers-vml-1.3.6-RC1.js"></script>' . "\r\n";
// jquery jsPlumb adapter
echo '<script type="text/javascript" src="/resources/scenario/plumb/js/jquery.jsPlumb-1.3.6-RC1.js"></script>' . "\r\n";

echo html::style("resources/scenario/styles/default.css"); 
echo html::style("resources/scenario/styles/admin.css");
echo html::script("resources/scenario/scripts/default.js"); 
echo html::script("resources/scenario/scripts/admin.js");



?>  
<div id="scenario-admin">
	<div class="left-panel">
		<div class="view-panel">
			
		</div>
	</div>
	
	<div class="right-panel">
		<ul class="scenario-list">
			
				<?php 
					foreach ($data as $scenario)
					{
						echo '<li data-id="'.(string) $scenario['_id'].'">'.$scenario['title'].'</li>';
					} 
				?>
				<li>
					<form action="#" method="post" id="scenario-form">
						<input id="scenario-input" type="text" name="title" class="scenario-input" />
					</form>
					<div class="search-results"></div>
				</li>
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
