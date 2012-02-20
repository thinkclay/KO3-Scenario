<style type="text/css">
#main { min-height: 800px; }

.question-node {
    background-image: -webkit-linear-gradient(top, #4293d6 0%, #001e96 100%);
    overflow: visible;
    width: 350px;
    height: 200px;
    border-radius: 5px;
    border-style: solid;
	border-color: #4293d6;
	box-shadow: 6px 6px 8px -4px #000000;
	position: relative;
	left: 100px;
}
.sunk-in {
    display: block;
    padding: 10px;
    color: black;
    font: bold 1.5em Arial, sans-serif;
    position: relative;
}
.sunk-in:before, .sunk-in:after {
    content: attr(title);
    padding: 10px;
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
.terminal-post {
	background-image: url('/resources/images/bryantest/terminal-post.png');
	width: 25px;
	height: 25px;
}

.terminal-post:hover {
	background-image: url('/resources/images/bryantest/terminal-post-hover.png');
	width: 25px;
	height: 25px;
	cursor: pointer;
}

.terminal-post-filled {
	background-image: url('/resources/images/bryantest/terminal-post-hover.png');
	width: 25px;
	height: 25px;
}

.post-left-middle {
	margin-top: -65px;
	margin-left: -30px;
	position: absolute;
}

.post-bottom-left-corner {
	margin-top: 73px;
	margin-left: -27px;
	position: absolute;
}

.post-bottom-middle {
	margin-top: 78px;
	margin-left: 160px;
	position: absolute;
}

.post-bottom-right-corner {
	margin-top: 73px;
	margin-left: 350px;
	position: absolute;
}

.post-right-middle {
	margin-top: -65px;
	margin-left: 355px;
	position: absolute;
}

.answer-post-top-middle {
	margin-top: -30px;
	margin-left: 135px;
	position: absolute;
}

.answer-post-bottom-middle {
	margin-top: 80px;
	margin-left: 135px;
	position: absolute;
}

.media-button {
	background-image: url('/resources/images/bryantest/media-arrow.png');
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

.answer-node {
	background-image: -webkit-linear-gradient(top, #ef9200 0%, #714501 100%);
    overflow: visible;
    width: 300px;
    height: 75px;
    border-radius: 5px;
    border-style: solid;
	border-color: #ef9200;
	box-shadow: 6px 6px 8px -4px #000000;
	position: relative;
	margin: 50px;
}

.answer-node input {
	margin-top: -13px;
	margin-left: 10%;
	width: 80%;
	border-radius: 5px;
    border-style: solid;
	border-color: #714501;
	background-color: #ef9200;
}

.answer-node input:focus {
	outline: none;
}

.answer-node p {
	margin-top: 4px;
	margin-left: 7%;
}

.control-panel {
	position: absolute;
	top: 100px;
	right: 2%;
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
}

.media-choices p{
	cursor: pointer;
}

.control-bottom {
	cursor: pointer;
	height: 40px;
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
	width: 100%;
	padding-left: 10%;
}


.scenario-form input{
	width: 80%;
	border-radius: 5px;
    border-style: solid;
	border-color: #001e96;
	background-color: #4293d6;
}

.scenario-form input:focus {
	outline: none;
}

.question-textarea {
	width: 83%;
	height: 68%;
	margin-left: 5%;
	background-color: #4293d6;
	border-radius: 5px;
    border-style: solid;
    border-width: 2px;
	border-color: #001e96;
	box-shadow: 0;
	color: #2C2C2C;
}

.question-textarea:focus {
	outline: none;
}

.question-label {
	margin-left: 3%;
}

.question-button {
	color: #4293d6;
	border: 1px solid #4293d6;
	background-color: #001e96;
	font-weight: bold;
	border-radius: 5px;
	position: relative;
	left: 83%;
	cursor: pointer;
	margin-top: 5px;
}

.question-submit {
	position: relative;
	margin-top: -17px;
	margin-left: 67%;
	cursor: pointer;
}	
</style>

<div class="canvas-container">
	<!--
	<div class="question-node">
		<form class="question-form">
			<label title="Create a New Question" class="sunk-in smaller question-label">Create a New Question</label><textarea class="question-textarea"></textarea>
			
		</form>
		<p class="sunk-in smaller question-submit" title="Save Question">Save Question</p>
	</div>
	<!--
	<div class="answer-node">
		<div class="terminal-post answer-post-top-middle"></div>
		<div class="terminal-post answer-post-bottom-middle"></div>
		<p class="sunk-in" title="I choose you!">I choose you!</p>
	</div>
	-->
</div>

<div class="control-panel">
	<div class="control-container">
		<div class="control-main">
			<form class="scenario-form">
				<label class="sunk-in smaller" title="New Scenario">New Scenario<input id="scenario-input" type="text" name="title"></input></label>
			</form>
			<ul id="scenario-list">
				<?php 
					foreach($data as $scenario)
					{
						echo '<li data-id="'.$scenario['_id'].'" class="sunk-in smaller scenario-li" title="'.$scenario['title'].'">'.$scenario['title'].'</li>';
					}
				 ?>
			</ul>
		</div>
		<div class="control-bottom"><p class="sunk-in smaller" title="Click for Application Controls">Click for Application Controls</p></div>
		
	</div>
	<div class="add-media-panel">
		<p title="Choose Media Type" class="sunk-in">Choose Media Type<p>
		<div class="media-choices"><p data-type="video" title="Add a VIDEO to this Question." class="sunk-in smaller">Add a VIDEO to this Question.</p><p data-type="document" title="Add an IMAGE to this Question." class="sunk-in smaller">Add an IMAGE to this Question.</p><p data-type="document" title="Add a DOCUMENT to this Question." class="sunk-in smaller">Add a DOCUMENT to this Question.</p></div>
	</div>
</div>
<script>
	$(document).ready(function () {
		$('.media-button').live("mouseover mouseout", function() {
			$('.media-message-div').fadeToggle('fast');
		});
		
		$('.media-button').live('click', function() {
			$('.add-media-panel').fadeToggle('slow');
		});
		
		mediaChoices = $('.media-choices').find('p');
		
		mediaChoices.click(function() {
			alert($(this).attr('data-type'));
		})
		
		$('.terminal-post').live('click', function() {
			nodeId = $(this).parent().attr('id');
			$('.canvas-container').append('<div class="answer-node"><div class="terminal-post answer-post-top-middle"></div><div class="terminal-post answer-post-bottom-middle"></div><p class="sunk-in smaller" title="Add a New Answer">Add a New Answer</p><form class="answer-form"><input class="answer-input" type="text" name="new_answer"></input><input class="answer-input-nodeid" type="hidden" name="node_id" value="'+nodeId+'"></input></form></div>');
		});
		
		$('.control-bottom').click(function() {
			$('.control-main').slideToggle('fast');
		});
		$('.scenario-form').submit(function(event) {
			event.preventDefault();
			$this = $(this);
			post = $(this).serialize();
			$.ajax({
		        url: "/scenario/ajax/newscenario",
		        type: "POST",
		        data: post,    
		        cache: false,
		        success: function(data){
		        	data = $.parseJSON(data);
					if (data['success'] === true)
					{
						console.log(data['data']);
						scenarioId = data['data']['_id'];
						$('#scenario-list').prepend(data['view']);
						$('#scenario-input').val('');
						$('.canvas-container').html('<div class="question-node"><form class="question-form"><label title="Create a New Question" class="sunk-in smaller question-label">Create a New Question</label><textarea name="question" class="question-textarea"></textarea><input type="hidden" name="scenario_id" value="'+scenarioId+'"></form><p class="sunk-in smaller question-submit" title="Save Question">Save Question</p></div>');
					}
					else
					{
						for (var key in data.errors)
						{
							var error = data.errors[key];
							$this.after('<span style="display:none" class="error">'+error+'</span>');
							$('.error').fadeIn('slow').delay(2000).fadeOut();
						}
					}
				}
		    });
		});
		$('.scenario-li').click(function() {
			scenarioId = $(this).attr('data-id');
			post = "all=false&scenarios[]="+scenarioId;
			$.ajax({
		        url: "/scenario/ajax/getscenarios",
		        type: "POST",
		        data: post,    
		        cache: false,
		        success: function(data){
		        	data = $.parseJSON(data);
					if (data['success'] === true)
					{
						starting_node = data['data'][0]['starting_node'];
						if (typeof starting_node != 'undefined')
						{
							post = "all=false&nodes[]="+starting_node;
							$.ajax({
						        url: "/scenario/ajax/getnodes",
						        type: "POST",
						        data: post,    
						        cache: false,
						        success: function(data){
						        	data = $.parseJSON(data);
									if (data['success'] === true)
									{
										$(".canvas-container").html(data['view']);
									}
									else
									{
										for (var key in data.errors)
										{
											console.log(data);
										}
									}
								}
						    });
						}
						else
						{
							$('.canvas-container').html('<div class="question-node"><form class="question-form"><label title="Create a New Question" class="sunk-in smaller question-label">Create a New Question</label><textarea name="question" class="question-textarea"></textarea><input type="hidden" name="scenario_id" value="'+scenarioId+'"></form><p class="sunk-in smaller question-submit" title="Save Question">Save Question</p></div>');
						}
					}
					else
					{
						console.log(data);
						/*
						for (var key in data.errors)
						{
							var error = data.errors[key];
							$this.after('<span style="display:none" class="error">'+error+'</span>');
							$('.error').fadeIn('slow').delay(2000).fadeOut();
						}*/
					}
				}
		    });
			//$('.canvas-container').html('');
		})
		
		$('.answer-form').live('submit', function(event) {
			event.preventDefault();
			post = $(this).serialize();
			console.log(post);
			$.ajax({
		        url: "/scenario/ajax/newanswer",
		        type: "POST",
		        data: post,    
		        cache: false,
		        success: function(data){
		        	data = $.parseJSON(data);
					if (data['success'] === true)
					{
						$('.canvas-container').append(data['view']);
						console.log(data['view']);
					}
					else
					{
						for (var key in data.errors)
						{
							console.log(data);
						}
					}
				}
		    });
		});
		$('.question-submit').live('click',function() {
			alert('here');
			$('.question-form').submit();
		});
		$('.question-form').live('submit', function(event) {
			event.preventDefault();
			post = $(this).serialize();
			$.ajax({
		        url: "/scenario/ajax/newnode",
		        type: "POST",
		        data: post,    
		        cache: false,
		        success: function(data){
		        	data = $.parseJSON(data);
					if (data['success'] === true)
					{
						console.log(data);
					}
					else
					{
						for (var key in data.errors)
						{
							console.log(data);
						}
					}
				}
		    });
		});
	});
</script>