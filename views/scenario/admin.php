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
	<div class="panel-wrapper">
		<div class="view-panel">
			
		</div>
	</div>
	<div class="control-panel">
		<div class="control-container">
			<div class="control-main">
				<form class="scenario-form">
					<label class="sunk-in smaller" title="New Scenario">New Scenario<input id="scenario-input" type="text" name="title"></input></label>
				</form>
				<ul class="scenario-list">
					<?php 
						foreach($data as $scenario)
						{
							echo '<li data-id="'.$scenario['_id'].'" class="sunk-in smaller scenario-li" title="'.$scenario['title'].'">'.$scenario['title'].'</li>';
						}
					 ?>
				</ul>
			</div>
			<div class="control-bottom"><p class="sunk-in smaller" title="Controls">Controls</p></div>
		</div>
		<div class="add-media-panel">
			<p title="Choose Media Type" class="sunk-in">Choose Media Type<p>
			<div class="media-choices"><p data-type="video" title="Add a VIDEO to this Question." class="sunk-in smaller">Add a VIDEO to this Question.</p><p data-type="document" title="Add an IMAGE to this Question." class="sunk-in smaller">Add an IMAGE to this Question.</p><p data-type="document" title="Add a DOCUMENT to this Question." class="sunk-in smaller">Add a DOCUMENT to this Question.</p></div>
		</div>
	</div>
</div>
