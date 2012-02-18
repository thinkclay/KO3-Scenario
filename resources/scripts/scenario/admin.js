
gridSize = [100,100]; // rows first then columns
nodeDefaultSize = [5,5]; // this is how many cells the default nodeDiv will occupy (ie. 5 x 5)

var buildGrid = function(){
	//var post = 'size='+size;
	var html = '<table cellspacing="0" cellpadding="0">';
	for (i=0;i<=gridSize[0];i=i+1)
	{
		html = html + '<tr>';
		for (b=0;b<=gridSize[1];b=b+1)
		{
			html = html + '<td width="20" height="20" data-row="'+i+'" data-col="'+b+'" class="empty-cell scenario-cell">&nbsp;</td>';
		}	
		html = html +'</tr>';
	}
	html = html + '</table>';
	$('.view-panel').html(html).css('top');
	cellWidth = parseInt($('.scenario-cell').css('width').replace(/\D/g,''));
	cellHeight = parseInt($('.scenario-cell').css('height').replace(/\D/g,''));
	
	// build out the constraining box
	/*
	$.ajax({
		url: "/scenario/ajax/buildgrid",
		type: "POST",
		data: post,
		cache: false,
		success: function(data){
			data = $.parseJSON(data);
			if (data.success === true)
			{
				$('.view-panel').html(data.view);
			}
			else
			{
				//return data.error;
			}
		}	
	});
	*/
}

var buildAnswer = function(){
	
}

var moveNode = function(){
	
}

var buildNode = function(row, col){
	if (typeof row === 'undefined')
	{
		row = 1;
	}
	if (typeof col === 'undefined')
	{
		col = 15;
	}
	var html = '<div class="node-div"></div>';
	$('.view-panel').prepend(html);
	// add the arrows
	var node = $('.view-panel div:first');
	node.append('<div class="node-left-arrow node-arrow"></div>');
	node.append('<div class="node-bottom-left-arrow node-arrow"></div>')
	node.append('<div class="node-bottom-arrow node-arrow"></div>');
	node.append('<div class="node-bottom-right-arrow node-arrow"></div>')
	node.append('<div class="node-right-arrow node-arrow"></div>');
	node.append('<form method="post" action="#" class="node-form"><textarea class="node-textarea" name="question"></textarea></form>');
	node.find('textarea').css('width', (cellWidth * nodeDefaultSize[0]) + (nodeDefaultSize[0] * 2)).css('height', (cellHeight * nodeDefaultSize[1]) + (nodeDefaultSize[1] * 2));
	node.css('width', (cellWidth * nodeDefaultSize[0]) + (nodeDefaultSize[0] * 2)).css('height', (cellHeight * nodeDefaultSize[1]) + (nodeDefaultSize[1] * 2));
	node.css('left', ((cellWidth + 2) * col));
	node.css('top', ((cellHeight + 2) * row));
	node.children('.node-left-arrow').css('top', (parseInt(node.height()) / 2) - 10).css('left', -20);
	node.children('.node-bottom-left-arrow').css('top', parseInt(node.height())).css('left', -20);
	node.children('.node-bottom-arrow').css('top', parseInt(node.height())).css('left', 40);
	node.children('.node-bottom-right-arrow').css('top', parseInt(node.height())).css('left', 100);
	node.children('.node-right-arrow').css('top', (parseInt(node.height()) / 2) - 10).css('left', 100);
	node.find('textarea').focus();
	$('.scenario-input').val("");
	
	/*
	node.find('textarea').draggable({
		containment:".view-panel", 
		snap: ".scenario-cell", 
		snapMode: "outer",
	});
	node.resizable({
		containment:".view-panel",
		grid: nodeWidth,
		snapMode: "outer",
		
	})
	 */
	
	
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
var searchNodes = function(needle){
	
}
var findArrowLocations = function(nodeObject){
	var data = [];
	//
	
}
$('.node-textarea').live('keydown', function(event){
	var post = $(this).serialize();
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
					
					//console.log(data['view']);
					//$('.search-results').html(data['view']);
					currentScenarioId = undefined;
				}
				else
				{
					/*
					for (var key in data.errors)
					{
						var error = data.errors[key];
						$('#scenario-input').after('<span style="display:none" class="error">'+error+'</span>');
						$('.error').fadeIn('slow').delay(2000).fadeOut();
					}
					*/
					currentScenarioId = undefined;
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
	return false;	
});

$('.node-arrow').live('click', function(event){
	$this = $(this);
	buildNode(10, 25);
});

$(document).ready(function () {
	buildGrid();
	//console.log($('#scenario-input'));
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
});

