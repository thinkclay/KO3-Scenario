<?php 
/*
 * These should be included in your template file between <head> tags
 * Move the .css and .js files to the root resources directory.
 * Change names to match your specific naming conventions and adjust paths accordingly.
 */

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
<style type="text/css">
p {
	padding: 0;
	margin: 0;
}
#scenario-admin {
	width: 100%;
	height: 100%;
	padding: 5px;
	position: relative;
}
/*
 * left side view panel styles
 */
.panel-wrapper {
	height: 100%;
	width: 100%;
	background-color: #F0F0F0;
	overflow: scroll;
}
.view-panel { /*  this is the draggable panel which contains node and decision blocks */
	background-color:white; 
	background-image:url('/resources/scenario/plumb/img/dynamicAnchorBg.jpg'); 
	font-family:Helvetica;
	width: 5000px;
	height: 5000px;
	position: relative;
}
td.scenario-cell {
	min-width: 18px;
	min-height: 16px;
	height: 16px;
	width: 18px;
	margin: 0px;
	border: solid 1px #E0E2FF;
	padding: 0px;
	background-color: #FFF;
}

/*  Question/Answer Node Styles */

form.node-form {
	height: 100%;
}

/* Question Node */
div.question-div {
	background-color: #C49090;
	width: 100px;
	height: 100px;
	position: absolute;
}

textarea.question-textarea {
	background-color: #F0FCF0;
	resize: none;
	overflow: hidden;
	border: 0;
	width: 80%;
	height: 80%;
	margin: 0;
	margin-top: 10%;
	margin-left: 10%;
	margin-right: 10%;
	margin-bottom: 10%;
	padding: 0;
	
	box-shadow: none;
	color: #2C2C2C;
}

/* Answer Node */
div.answer-div {
	width: 50px;
	height: 50px;
	background-color: #346789;
	position: absolute;
}

textarea.answer-textarea {
	background-color: #F0FCF0;
	resize: none;
	overflow: hidden;
	border: 0;
	width: 80%;
	height: 80%;
	margin-top: 10%;
	margin-left: 10%;
	margin-right: 10%;
	margin-bottom: 10%;
	padding: 0;
	box-shadow: none;
	color: #2C2C2C;
}

/*
ul.control-bar {
	margin:0px;
	padding:0px;
	height: 10%;    
    width: 80%; 
}
ul.control-bar li {	
	list-style-type: none;
	display: inline;
	margin-left: 5px;
	background-color: #ccc;
	font-size: 1em;
	position: relative;
    top: -75%;
    cursor: pointer;
}

*/


/*
 * Control panel styles scenario list styles
 */

.control-panel {
	position: absolute;
	top: 0px;
	left: 75%;
	width: 24%;
}
.control-container {
	background-color: #ffffff;
	top: 0px;
	background-image: -webkit-linear-gradient(top, #4293d6 0%, #001e96 100%);
    overflow: visible;
    border-radius: 5px;
    border-style: solid;
	border-color: #4293d6;
	box-shadow: 6px 6px 8px -4px #000000;
	margin-top: -5px;
	padding: 5%;
}

.media-choices p {
	cursor: pointer;
}

.control-bottom {
	cursor: pointer;
	height: 20px;
	width: 80%;
}

.control-main {
	display: none;
	max-height: 600px;
}

.control-main li{
	width: 80%;
	cursor: pointer;
}

.control-main li:hover{
	color: #a0cd34;
}


.scenario-form {
	
}


.scenario-form input{
	width: 85%;
	border-radius: 5px;
    border-style: solid;
	border-color: #001e96;
	background-color: #4293d6;
}

.scenario-form input:focus {
	outline: none;
}

.media-button {
	background-image: url('/resources/scenario/images/media-arrow.png');
	width: 38px;
	height: 38px;
	cursor: pointer;
}

.media-message-div {
	font: bold .5em Arial, sans-serif;
	display: none;
	margin-top: -47px;
	margin-left: 22px;
}

.add-media-panel {
	background-image: -webkit-linear-gradient(top, #a0cd34 0%, #556f17 100%);
    overflow: visible;
    border-radius: 5px;
    border-style: solid;
	border-color: #a0cd34;
	box-shadow: 6px 6px 8px -4px #000000;
	display: none;
	margin-top: 10px;
}

.sunk-in {
    display: block;
    color: black;
    font: bold 1.5em Arial, sans-serif;
    position: relative;
}
.sunk-in:before, .sunk-in:after {
    content: attr(title);
    color: rgba(255,255,255,.1);
    position: absolute;
}
.sunk-in:before {
    top: 1px;
    left: 1px;
}
.sunk-in:after {
    top: 2px;
    left: 2px;
}
label.sunk-in {
	margin: 0;
	padding: 0;
}
ul.scenario-list {
	margin: 0px;
	padding: 0px;
	margin-bottom: 10px;
	margin-top: 10px;
}
/*

form#scenario-form {
	margin: 0px;
	padding: 0px;
}
span.error {
	color: #FF0000;
	font-size: .75em;
}

ul.scenario-list li {
	margin: 0px;
	padding: 0px;
	list-style-type: none;
	width: 100%;
	border-bottom:solid 1px #CCC; 
	cursor: pointer;
}
input.scenario-input {
	width: 100%;
}

*/

</style>

  
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
