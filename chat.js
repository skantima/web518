$(document).ready(function(){



$(document).on('click','.submit_chat', function(e){ 


var cuser_id = e.currentTarget.id;
e.preventDefault();
var content = $('textarea[name=content]').val();

 $.ajax({ 

    url:'chatform.php',
    type: 'post',
    data:{ 'chat':{'cuser_id':cuser_id, 'content':content}},
    dataType: 'text',

    success: function(data){


    	console.log(data);
    	$('textarea[name=content]').val('');
         location.reload();
    }

 });

});


$(document).on('click','.gravatar', function(e){ 
e.preventDefault();
 $.ajax({ 

    url:'chatform.php',
    type: 'post',
    data:{ 'gravatar':0},
    dataType: 'text',

    success: function(data){


    	console.log(data);
    	  location.reload();
    	
    }


 });

});

$(document).on('click','.default', function(e){ 
e.preventDefault();
 $.ajax({ 

    url:'chatform.php',
    type: 'post',
    data:{ 'default':0},
    dataType: 'text',

    success: function(data){


    	console.log(data);
    	  location.reload();
    	
    }


 });

});

//security

$(document).on('click','.secured', function(e){ 
e.preventDefault();

var user_id = e.currentTarget.id;
$clicked_btn = $(this);
  if ($clicked_btn.hasClass('fa-toggle-off')) {
    action = 'on';
  } else if($clicked_btn.hasClass('fa-toggle-on')){
    action = 'off';
  }
 $.ajax({ 

    url:'chatform.php',
    type: 'post',
    data: {
      'action': action,
      'user_id': user_id
    },
    dataType: 'text',

    success: function(data){
       if (action == "on") {
        $clicked_btn.removeClass('fa-toggle-off');
        $clicked_btn.addClass('fa-toggle-on');
      } else if(action == "off") {
        $clicked_btn.removeClass('fa-toggle-on');
        $clicked_btn.addClass('fa-toggle-off');
      }

        console.log(data);
        location.reload();
         
        
    }


 });

});


});