var answerCounter = 0;
var commonQuestionParams = {
	
}; 
var commonAnswerParams = {
	
}; 

var buildAnswer = function(){
	
}

var moveNode = function(){
	
}

var buildQuestion = function(top, left){
	var html = '<div class="question-div" id="testSource"></div>';
	$('.view-panel').prepend(html);
	currentNode = $('.view-panel div:first');
	currentNode.append('<form method="post" action="#" class="node-form"><textarea class="question-textarea" name="question"></textarea></form>');
	//node.find('textarea').css('width', '100%').css('height', '100%');
	//node.css('width', (cellWidth * nodeDefaultSize[0]) + (nodeDefaultSize[0] * 2)).css('height', (cellHeight * nodeDefaultSize[1]) + (nodeDefaultSize[1] * 2));
	if (typeof top == 'undefined')
	{
		var top = 50;
	}
	if (typeof left == 'undefined')
	{
		var left = 250;
	}
	currentNode.css('top', top);
	currentNode.css('left', left);
	currentNode.find('textarea').focus();
	$('.scenario-input').val("");
	jsPlumb.draggable(currentNode);
};


var buildScenario = function(scenarioId){
	buildGrid();
	data = "all=false&scenarios[]="+scenarioId;
	$.ajax({
        url: "/scenario/ajax/getscenarios",
        type: "POST",
        data: data,    
        cache: false,
        success: function(data){
        	data = $.parseJSON(data);
			if (data['success'] === true)
			{
				console.log(data['view']);
			}
			else
			{
				for (var key in data.errors)
				{
					var error = data.errors[key];
					$('#scenario-input').after('<span style="display:none" class="error">'+error+'</span>');
					$('.error').fadeIn('slow').delay(2000).fadeOut();
				}
			}
		}
	});
}


var searchScenarios = function(needle){
	data = "search_string="+needle;
	$('.errors').remove();
	$.ajax({
        url: "/scenario/ajax/searchscenarios",
        type: "POST",
        data: data,    
        cache: false,
        success: function(data){
        	data = $.parseJSON(data);
			if (data['success'] === true)
			{
				$('.search-results').html(data['view']);
			}
			else
			{
				for (var key in data.errors)
				{
					var error = data.errors[key];
					$('#scenario-input').after('<span style="display:none" class="error">'+error+'</span>');
					$('.error').fadeIn('slow').delay(2000).fadeOut();
				}
			}
		}
    });
}

var buildQuestionEndpoints = function(questionDiv){
	// now create the endpoints
	// here we can check for existing connections to other answers and quesitons
	jsPlumb.addEndpoint(
		currentNode,
		{
			anchor:'LeftMiddle',
			endpoint:['Dot', {radius:7}],
			connector:"Straight",
		}
	).bind('click', function(event){
			alert('clicked!');
	});
	
	jsPlumb.addEndpoint(
		currentNode,
		{
			anchor:'BottomLeft',
			endpoint:['Dot', {radius:7}],
			connector:"Straight",
		}
	).bind('click', function(event){
			alert('clicked!');
	});
	
	jsPlumb.addEndpoint(
		currentNode,
		{
			anchor:'LeftMiddle',
			endpoint:['Dot', {radius:7}],
			connector:"Straight",
		}
	).bind('click', function(event){
			alert('clicked!');
	});
	
	jsPlumb.addEndpoint(
		currentNode,
		{
			anchor:'BottomCenter',
			endpoint:['Dot', {radius:7}],
			connector:"Straight",
		}
	).bind('click', function(event){
			alert('clicked!');
	});
	
	jsPlumb.addEndpoint(
		currentNode,
		{
			anchor:'BottomRight',
			endpoint:['Dot', {radius:7}],
			connector:"Straight",
		}
	).bind('click', function(event){
			alert('clicked!');
	});
	
	jsPlumb.addEndpoint(
		currentNode,
		{
			anchor:'RightMiddle',
			endpoint:['Dot', {radius:7}],
			connector:"Straight",
		}
	).bind('click', function(event){
			alert('clicked!');
	});
	
	
	console.log(currentNode);
	/*
	jsPlumb.connect({
		source:'testSouce',
		target:'testTarget',
		endpoint:'Rectangle',
	});
	*/
}


$('.question-textarea').live('keydown', function(event){
	$this = $(this);
	var post = $this.serialize();
	if (typeof currentScenarioId !== undefined)
	{
		var post = post + '&scenario_id=' + currentScenarioId;
	}
	if (event.keyCode == 13)
	{
		$.ajax({
	        url: "/scenario/ajax/newnode",
	        type: "POST",
	        data: post,    
	        cache: false,
	        success: function(data){
	        data = $.parseJSON(data);
				if (data['success'] === true)
				{
					currentNodeId = $.parseJSON(data['view'])._id;
					// set the id
					currentNode.attr('id', 'id-'+currentNodeId);
					// blur textfield and disable for now
					$this.blur().attr('disabled', 'disabled').css('background-color', 'transparent');
					buildQuestionEndpoints(currentNode);
				}
				else
				{
					alert('error');
					console.log(data);
					/*
					for (var key in data.errors)
					{
						var error = data.errors[key];
						$('#scenario-input').after('<span style="display:none" class="error">'+error+'</span>');
						$('.error').fadeIn('slow').delay(2000).fadeOut();
					}
					*/
					//currentScenarioId = undefined;
				}
			}
    	});	
	}
});

$('form#scenario-form').live('submit', function(event){
	$this = $(this);
	var data = $this.serialize();
	$('.error').remove();
	
	$.ajax({
        url: "/scenario/ajax/newscenario",
        type: "POST",
        data: data,    
        cache: false,
        success: function(data){
        	data = $.parseJSON(data);
			if (data['success'] === true)
			{
				// clear the view panel
				$('.view-panel').html("");
				$this.parent().before(data['view']);
				currentScenarioId = $this.parent().prev().attr('data-id');
				buildQuestion();
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
	return false;	
});

$('.node-arrow').live('click', function(event){
	answerCounter++;
	$this = $(this);
	console.log($this.parent().height());
	//var = nodeTerminalPosition = $this.position
	//console.log($this.position().top);
	var nodeTerminalPosition = $this.parent().position();
	nodeTerminalPosition.top = (nodeTerminalPosition.top + ($this.parent().height() * 1.5));
	
	nodeTerminalPosition.left = (nodeTerminalPosition.left - ($this.parent().width() * 1.75));
	$this.parent().after('<div class="answer-div" id="id-'+answerCounter+'"></div>');
	var answerDiv = $this.parent().next();
	console.log(YAHOO);
	answerDiv.css('top', nodeTerminalPosition.top);
	answerDiv.css('left', nodeTerminalPosition.left);
	var questionNode = YAHOO.util.Dom.get('id-'+currentNodeId);
	var answerNode = YAHOO.util.Dom.get('id-'+answerCounter);
	alert('made it here');
	/*
	var block7 = YAHOO.util.Dom.get('block7');
	var w1 = new WireIt.Wire(
		new WireIt.Terminal(block7, {offsetPosition:[30,30], editable: false }),
		new WireIt.Terminal(block7, {offsetPosition:[100,30], editable: false }), 
		document.body);
	w1.redraw();
	*/
	
	/*
	$.ajax({
        url: "/scenario/ajax/newanswer",
        type: "POST",
        data: data,    
        cache: false,
        success: function(data){
        	data = $.parseJSON(data);
			if (data['success'] === true)
			{
				buildGrid();
				$this.parent().before(data['view']);
				currentScenarioId = $this.parent().prev().attr('data-id');
				buildNode();
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
	buildNode(10, 25);
	*/
});
$('#scenario-input').live('keyup', function(){
	searchString = $(this).val();
	if (searchString != '')
	{
		searchScenarios(searchString);
	}
	else
	{
		$('.search-results').html('');
	}
});
	
$('.search-result-li').live('click', function() {
	buildScenario($(this).attr('id'));
});


$(document).ready(function () {
	// set default container
	jsPlumb.Defaults.Container = $(".view-panel");
	
	
	//buildGrid();
	
	//console.log($('#scenario-input'))
});

