<?php
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>';
echo html::style("resources/scenario/styles/test.css");
?>
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