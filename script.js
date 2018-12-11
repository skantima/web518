$(document).ready(function(){


$("#mainform").hide();

$(document).on('keyup','#search', function(){
  
    var name =$(this).val();

    if(name != '')
    {
      
         $.ajax({ 

    async:false,
    url:'comment.php',
    type: 'get',
    data: {'getnames':name},
    dataType: 'text',
    success: function(data){
   
   

       $("#searchbar").html(data);

   

    }
    });

    }

    else{

    $("#searchbar").html('');


    }
    // else{
    //   $("#searchbar").html(str);
   

    // }


});
//loading button click

  


//closing

$(document).on('click','.group_details', function(e){ 
  var group_id = e.currentTarget.id;
  $("#index").hide();
  window.page = 1;
  
 e.preventDefault();

 loads_data();
 function loads_data(page){

   //start
    $.ajax({
    async:false,
    url:'pagination.php',
    type: 'get',
    data:{ 'group_messages':{'g_msg':group_id, 'page':page}},
    dataType: 'text',
    success: function(data){
  
          var str="";
          console.log(data);
          var obj = JSON.parse(data);
      if(obj['messages'] == "noposts")
      {
          
      str+= "<form method='POST' id = 'post-form"+ group_id+"'>";
      str+= "<fieldset style='margin-top:75px;'>";
      str+= "<label for='exampleTextarea' style='margin-left: 10px;'> It's time to post</label><br><br>";
      str+= "<textarea style='width:80%;'  id='content'name='content' placeholder='Type something.... :)'  rows='2' cols='100' required></textarea>";
      str+= "<input type='submit' style='margin-top:-30px;'class='btn btn-primary submit_post' id="+ group_id+"  name='pos' value='Post' />";
      
    
      str+= "</fieldset>";
      str+= "</form></div>";
              str+="<i class='fas fa-code' data-toggle='modal' data-target='#myModal'></i>";
    str+="<div class='modal' id='myModal' style='margin-top:-20px;'>";
    str+= "<div class='modal-dialog' > ";
    str+= "<div class='modal-content'>";
    str+= "<div class='modal-header'>";
    str+= "<h5 class='modal-title'>code snippet</h5>";
    str+= "<button class='close' data-dismiss='modal'>&times;</button>";
    str+="</div>";
    str+= "<div class='modal-body'>";
    str+= "<textarea style='width:80%;'  id='content' name='code'  placeholder='Enter your code Geek...!'  rows='7' cols='100'  required></textarea>";
    str+= "</div>";
    str+= "<div class='modal-footer'>";
    str+= "<input type='submit' style='margin-top:0px;'class='btn btn-primary submit_code' id="+ group_id+"  name='pos' value='Post' />";
    str+= "<button class='btn btn-secondary' data-dismiss='modal'>close</button>"; 
    str+= "</div>"; 
    str+= "</div>";
    str+= "</div>"; 
    str+= "</div>";
    // image upload to posts
    str+= "<i class='far fa-file dhide' data-toggle='modal' data-target='#myModal2'></i>";
    str+="<div class='modal' id='myModal2' >";
    str+= "<div class='modal-dialog'> ";
    str+= "<div class='modal-content'>";
    str+= "<div class='modal-header'>";
    str+= "<h5 class='modal-title'>Upload File</h5>";
    str+= "<button class='close' data-dismiss='modal'>&times;</button>";
    str+="</div>";
    str+= "<div class='modal-body'>";
    str+="<form class='form' action = 'upload.php' method='post' enctype='multipart/form-data'>";
    str+="<input type='file' class='btn btn-light' name='img' id='file' value='choose'/>";
   
    str+= "</div>";
    str+= "<img width='100' height='100' id='blah' class='blah' src='#' alt='your file' />";
     str+="<a href='#' id='blah' class='blah' ></a><br>";
    str+= "<div class='modal-footer'>";
    str+= "<input type='submit' id="+ group_id+" style='margin-top:0px;'class='btn btn-primary upload_image' name='submit' value='Upload' />";
    str+="</form>";
    str+= "<button class='btn btn-secondary' data-dismiss='modal'>close</button>"; 
    str+= "</div>"; 
    str+= "</div>";
    str+= "</div>"; 
    str+= "</div>";
    
    //image upload from url
    str+="<i class='fas fa-link' data-toggle='modal' data-target='#myModal3'></i>";
    str+="<div class='modal' id='myModal3' >";
    str+= "<div class='modal-dialog'> ";
    str+= "<div class='modal-content'>";
    str+= "<div class='modal-header'>";
    str+= "<h5 class='modal-title'>Image URL</h5>";
    str+= "<button class='close' data-dismiss='modal'>&times;</button>";
    str+="</div>";
    str+= "<div class='modal-body'>";
    str+="<form class='form' action = 'upload.php' method='post' enctype='multipart/form-data'>";
    str+="<input type='text' size='58'  id='imglink' name='imglink'/>";
    str+= "</div>";
    str+= "<div class='modal-footer'>";
    str+= "<input type='submit' id="+ group_id+" style='margin-top:0px;'class='btn btn-primary upload_url' name='submit' value='Upload' />";
    str+="</form>";
    str+= "<button class='btn btn-secondary' data-dismiss='modal'>close</button>"; 
    str+= "</div>"; 
    str+= "</div>";
    str+= "</div>"; 
    str+= "</div>";
     
      str+= "<div id='posts'>";

      str+="</div>";
      $('#dpost').html(str);
      }
      else{


           var obj = JSON.parse(data);
      

          console.log(obj);


    
      str+= "<form method='POST' id = 'post-form"+ group_id+"'>";
      str+= "<fieldset style='margin-top:75px;'>";
   
      str+= "<label for='exampleTextarea' style='margin-left: 10px;'> It's time to post</label><br><br>";
      str+= "<textarea style='width:80%;'  id='content'name='content' placeholder='Type something.... :)'  rows='2' cols='100' required></textarea>";
         if(obj["messages"][0]["archive_action"] != "archive")
    {
      str+= "<input type='submit' style='margin-top:-30px;'class='btn btn-primary submit_post' id="+ group_id+"  name='pos' value='Post' />";

    }
     str+= "</fieldset>";
   

      str+= "</form></div>";
      str+= "<br>";
       //str+="<button class='btn btn-primary' data-toggle='modal' data-target='#myModal'>code</button>";

        if(obj["messages"][0]["archive_action"] != "archive")
        {
          str+="<i class='fas fa-code' data-toggle='modal' data-target='#myModal'></i>";
    str+="<div class='modal' id='myModal' style='margin-top:-20px;'>";
    str+= "<div class='modal-dialog' > ";
    str+= "<div class='modal-content'>";
    str+= "<div class='modal-header'>";
    str+= "<h5 class='modal-title'>code snippet</h5>";
    str+= "<button class='close' data-dismiss='modal'>&times;</button>";
    str+="</div>";
    str+= "<div class='modal-body'>";
    str+= "<textarea style='width:80%;'  id='content' name='code'  placeholder='Enter your code Geek...!'  rows='7' cols='100'  required></textarea>";
    str+= "</div>";
    str+= "<div class='modal-footer'>";
    str+= "<input type='submit' style='margin-top:0px;'class='btn btn-primary submit_code' id="+ group_id+"  name='pos' value='Post' />";
    str+= "<button class='btn btn-secondary' data-dismiss='modal'>close</button>"; 
    str+= "</div>"; 
    str+= "</div>";
    str+= "</div>"; 
    str+= "</div>";
    // image upload to posts
    str+= "<i class='far fa-file dhide' data-toggle='modal' data-target='#myModal2'></i>";
    str+="<div class='modal' id='myModal2' >";
    str+= "<div class='modal-dialog'> ";
    str+= "<div class='modal-content'>";
    str+= "<div class='modal-header'>";
    str+= "<h5 class='modal-title'>Upload File</h5>";
    str+= "<button class='close' data-dismiss='modal'>&times;</button>";
    str+="</div>";
    str+= "<div class='modal-body'>";
    str+="<form class='form' action = 'upload.php' method='post' enctype='multipart/form-data'>";
    str+="<input type='file' class='btn btn-light' name='img' id='file' value='choose'/>";
        
    str+= "</div>";
   
       str+= "<img width='100' height='100' id='blah' class='blah' src='#' alt='your file' />";
     str+="<a href='#' id='blahs' class='blahs' ></a><br>";
    str+= "<div class='modal-footer'>";
    str+= "<input type='submit' id="+ group_id+" style='margin-top:0px;'class='btn btn-primary upload_image' name='submit' value='Upload' />";
    str+="</form>";
    str+= "<button class='btn btn-secondary' data-dismiss='modal'>close</button>"; 

    str+= "</div>"; 
    str+= "</div>";
    str+= "</div>"; 
    str+= "</div>";
    
    //image upload from url
    str+="<i class='fas fa-link' data-toggle='modal' data-target='#myModal3'></i>";
    str+="<div class='modal' id='myModal3' >";
    str+= "<div class='modal-dialog'> ";
    str+= "<div class='modal-content'>";
    str+= "<div class='modal-header'>";
    str+= "<h5 class='modal-title'>Image URL</h5>";
    str+= "<button class='close' data-dismiss='modal'>&times;</button>";
    str+="</div>";
    str+= "<div class='modal-body'>";
    str+="<form class='form' action = 'upload.php' method='post' enctype='multipart/form-data'>";
    str+="<input type='text' size='58'  id='imglink' name='imglink'/>";
    str+= "</div>";
    str+= "<div class='modal-footer'>";
    str+= "<input type='submit' id="+ group_id+" style='margin-top:0px;'class='btn btn-primary upload_url' name='submit' value='Upload' />";
    str+="</form>";
    str+= "<button class='btn btn-secondary' data-dismiss='modal'>close</button>"; 
    str+= "</div>"; 
    str+= "</div>";
    str+= "</div>"; 
    str+= "</div>";

        }
    

      
      obj['messages'].forEach(function(e){
           if(e['user_image']==""){
                
                $dp ="default.jpg";
                 }
                  else{
                       $dp =e['user_image'];
                       }

     
    
      str+= "<br>";
      
      str+= "<div id='posts'>";
      str+= "<div id='dis"+e['post_id']+"' class='dis'>";
      str+= "<div>";
      if(e['img_num'] != '1'){
      str+= "<img width='40' height='40' src ='img/"+$dp+"' alt= 'ddp'>";
      }

      else{

        str+= "<img width='40' height='40' src ='"+$dp+"' alt= 'ddp'>";
      }
      str+= "</div><br>";
      str+= "<div id= 'posts' style='float:left;' >";
      str+= "<H6><a href='allprofile.php?id="+e['user_id']+"'>"+ e['user_name']+"</a></H6>";
      str+= "</div>";
      str+= "<p id='tstamp' style='margin-left:100px;'>"+e['post_timestamp']+"</p>";
      if(e['post_content']!='')
      {
          str+= "<p>"+e['post_content']+"</p>";
      }

      else if( e['code_content']!='')
      {

        str+= "<pre style='background-color:#ebebe0; border-left: 1px solid black; margin-left: 5px;'><code >"+e['code_content']+"</code></pre>";

      }

      else if(e['image_content']!='')
    {

      str+= "<img width='100' height='100' src ='upload/"+e['image_content']+"' alt= 'ddp'><br>";
    }

    else if(e['link_content']!='')
    {
      str+="<a href='"+e['link_content']+"'>"+e['link_content']+"</a><br>";
      str+= "<img width='100' height='100' src ='"+e['link_content']+"' alt= 'ddp'><br>";
    }

    else if(e['file_content']!='')
    {
      str+="<a href='upload/"+e['file_content']+"'>"+e['file_content']+"</a><br>";
      
    }

      var post_id= e['post_id'];

      //userlike
       $.ajax({ 

        async:false,
        url:'comment.php',
        type: 'post',
        data:{ 'userLiked':post_id},
        dataType: 'text',
        success: function(data){ 
         
          var userLiked =  parseInt(data);

            if(e['archive_action'] != "archive")
            {
              if(userLiked == 1){ 
              str+=  "<i class='fa fa-thumbs-up like-btn' data-id="+ post_id + "></i>  ";
                  }
               else {
              str+= "<i class='fa fa-thumbs-o-up like-btn' data-id="+ post_id + "></i>";
        
                }
              
            }

            else {

                if(userLiked == 1){ 
                  str+=  "<i class='fa fa-thumbs-up'></i>  ";
                  }
               else {
                 str+= "<i class='fa fa-thumbs-o-up'></i>";
        
                }
            }
        

           }

            });
            str +="<span class='likes'>";
             $.ajax({ 

        async:false,
        url:'comment.php',
        type: 'post',
        data:{ 'getLikes':post_id},
        dataType: 'text',
        success: function(data){ 
            console.log(data);
                   
                   str += data;
           }

            });
            str +="</span>"
            str +="&nbsp;&nbsp;&nbsp;&nbsp;";
        //userdislike
        $.ajax({ 

        async:false,
        url:'comment.php',
        type: 'post',
        data:{ 'userDisliked':post_id},
        dataType: 'text',
        success: function(data){ 
           
          var userDisliked =  parseInt(data);

          if(e['archive_action'] != "archive"){
                if(userDisliked == 1){

                str+=  "<i class='fa fa-thumbs-down dislike-btn' data-id="+ post_id + "></i>  ";
              }

                    else{
           
                str+= "<i class='fa fa-thumbs-o-down dislike-btn' data-id="+ post_id + "></i>";
            
                 }

          }

          else{
                  if(userDisliked == 1){

                str+=  "<i class='fa fa-thumbs-down'></i>  ";
              }

                    else{
           
                str+= "<i class='fa fa-thumbs-o-down'></i>";
            
                 }

          }
         
          

           }

            });


            str +="<span class='dislikes'>";
    $.ajax({ 

        async:false,
        url:'comment.php',
        type: 'post',
        data:{ 'getDislikes':post_id},
        dataType: 'text',
        success: function(data){ 
            console.log(data);
                   
                   str += data;
           }

            });
            str +="</span>"
            str +="&nbsp;&nbsp;&nbsp;&nbsp;";
           
            str +="<a data-toggle='collapse' href='#"+post_id+"' aria-expanded='false' aria-controls='collapseExample' <i style='margin-left:8px;'class='far fa-comment get-cmt' data-id="+ post_id + " ></i></a>";

            str += "<div class='collapse' id='"+post_id+"'>";
            str += "<div class='card card-body' >";
         
              $.ajax({ 

              async:false,
              url:'comment.php',
              type: 'post',
              data:{ 'getcomment':post_id},
              dataType: 'text',
              success: function(data){ 
                  
                  var object = JSON.parse(data);
                  console.log(obj);
                  object['messages'].forEach(function(e){ 
                      if(e['user_image']==""){
                
                        $dp ="default.jpg";
                      }
                  else{
                       $dp =e['user_image'];
                       }

                   str+="<div style='float:left; width:25%' >";
                   if(e['img_num'] != '1'){
                   str+="<img width='20' height='20' src ='img/"+$dp+"' alt= 'dcdp'></img>";
                    }

                   else{

                  str+= "<img width='20' height='20' src ='"+$dp+"' alt= 'dcdp'>";
                      }
                  
                   str+="</div>";
                   str+="<div id='readcomment'>";
                   str+="<p><font color='blue'>"+ e['user_name']+"</font> says:&nbsp;&nbsp;";
                   str+=""+ e['comment']+" </p>";
                   str+="</div><br>";
                   });
                         
                   
                    


           }

            });
  
      str+="<div id='cmt-ap"+post_id+"'></div>";
      str+="<form  method='POST' id = 'comment-form"+ post_id+"' >";
      str+="<input type='hidden' name ='username'>";
      str+="<textarea style='width:60%;'   name='content' placeholder='Leave a comment'  rows='1' cols='100' required></textarea>";
       if(e['archive_action'] != "archive"){
      str+= "<input type='submit' style='width:15%;height:34px;margin-top:-20px;'id =" +post_id +" class='btn btn-success submit_cmt'  name='reply'  value='reply' / ><i style='margin-left:8px;'class='fas fa-pencil-alt'></i></form>";
      }
      str+="</div>";  
      str+="</div>"; 
      str +="&nbsp;&nbsp;&nbsp;&nbsp;";

          $.ajax({ 

                  async:false,
                  url:'comment.php',
                  type: 'post',
                  data: {'admin':0},
                  dataType: 'text',
                  success: function(data){ 
                      console.log(data);

                      if(data == 20){

                        str+= "<i class='far fa-trash-alt delete-cmt' data-id="+ post_id + "></i>";
                      }

                      
                             
                                       }

            });

      str+= "</div>";

       str+= "</div>";



      $('#dpost').html(str);




      });
        
   

      }
        var st='';
       st+=" <input type='submit' class='btn btn-primary pag_link'  id="+group_id+"  name='submit' value='load more' />";
       
       $('#loadmore').html(st);

    }

 });


   //close

 }
  





});
// if the user clicks on the like button ...
$(document).on('click','.like-btn', function(){
  var post_id = $(this).data('id');
  $clicked_btn = $(this);
  if ($clicked_btn.hasClass('fa-thumbs-o-up')) {
    action = 'like';
  } else if($clicked_btn.hasClass('fa-thumbs-up')){
    action = 'unlike';
  }
  $.ajax({
    url: 'reactions.php',
    type: 'post',
    data: {
      'action': action,
      'post_id': post_id
    },
    success: function(data){
      res = JSON.parse(data);
      if (action == "like") {
        $clicked_btn.removeClass('fa-thumbs-o-up');
        $clicked_btn.addClass('fa-thumbs-up');
      } else if(action == "unlike") {
        $clicked_btn.removeClass('fa-thumbs-up');
        $clicked_btn.addClass('fa-thumbs-o-up');
      }
      // display the number of likes and dislikes
      $clicked_btn.siblings('span.likes').text(res.likes);
      $clicked_btn.siblings('span.dislikes').text(res.dislikes);

      // change button styling of the other button if user is reacting the second time to post
      $clicked_btn.siblings('i.fa-thumbs-down').removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');
    }
  });   

});

// if the user clicks on the dislike button ...
$(document).on('click','.dislike-btn', function(){
  var post_id = $(this).data('id');
  $clicked_btn = $(this);
  if ($clicked_btn.hasClass('fa-thumbs-o-down')) {
    action = 'dislike';
  } else if($clicked_btn.hasClass('fa-thumbs-down')){
    action = 'undislike';
  }
  $.ajax({
    url: 'reactions.php',
    type: 'post',
    data: {
      'action': action,
      'post_id': post_id
    },
    success: function(data){
      res = JSON.parse(data);
      if (action == "dislike") {
        $clicked_btn.removeClass('fa-thumbs-o-down');
        $clicked_btn.addClass('fa-thumbs-down');
      } else if(action == "undislike") {
        $clicked_btn.removeClass('fa-thumbs-down');
        $clicked_btn.addClass('fa-thumbs-o-down');
      }
      // display the number of likes and dislikes
      $clicked_btn.siblings('span.likes').text(res.likes);
      $clicked_btn.siblings('span.dislikes').text(res.dislikes);
      
      // change button styling of the other button if user is reacting the second time to post
      $clicked_btn.siblings('i.fa-thumbs-up').removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
    }
  }); 

});


$(document).on('click','.submit_cmt', function(e){ 
  e.preventDefault();
  var post_id = e.currentTarget.id;
  
  var comment = $('#comment-form'+post_id+ ' textarea[name=content]').val();
  $.ajax({
    url:'comment.php',
    type: 'post',
    data:{ 'reply':{'post_id':post_id, 'comment':comment}},
    dataType: 'text',
    success: function(data){
      console.log(data);
      $('#comment-form'+post_id+ ' textarea[name=content]').val("");
    $('#cmt-ap'+post_id).append(data);


    }

  });

  
});
       

$(document).on('click','.submit_post', function(e){ 

  var group_id = e.currentTarget.id;
  e.preventDefault();
  var content = $('textarea[name=content]').val();
  $.ajax({
    url:'comment.php',
    type: 'post',
    data:{ 'pos':{'group_id':group_id, 'content':content}},
    dataType: 'text',
    success: function(data){
      var obj = JSON.parse(data);
      str="";
      console.log(data);
     obj['messages'].forEach(function(e){
           if(e['user_image']==""){
                
                $dp ="default.jpg";
                 }
                  else{
                       $dp =e['user_image'];
                       }

     
     
      str+= "<br>";
      
    
      str+= "<div id='dis"+e['post_id']+"' class='dis'>";
      str+= "<div>";
      if(e['img_num'] != '1'){
      str+= "<img width='40' height='40' src ='img/"+$dp+"' alt= 'ddp'>";
      }

      else{

        str+= "<img width='40' height='40' src ='"+$dp+"' alt= 'ddp'>";
      }
      str+= "</div><br>";
      str+= "<div id= 'posts' style='float:left;' >";
      str+= "<H6><a href='userprofile.php?'>"+ e['user_name']+"</a></H6>";
      str+= "</div>";
      str+= "<p id='tstamp' style='margin-left:100px;'>"+e['post_timestamp']+"</p>";
      str+= "<p>"+e['post_content']+"</p>";
      var post_id= e['post_id'];

      //userlike
       $.ajax({ 

        async:false,
        url:'comment.php',
        type: 'post',
        data:{ 'userLiked':post_id},
        dataType: 'text',
        success: function(data){ 
         
          var userLiked =  parseInt(data);

            if(e['archive_action'] != "archive")
            {
              if(userLiked == 1){ 
              str+=  "<i class='fa fa-thumbs-up like-btn' data-id="+ post_id + "></i>  ";
                  }
               else {
              str+= "<i class='fa fa-thumbs-o-up like-btn' data-id="+ post_id + "></i>";
        
                }
              
            }

            else {

                if(userLiked == 1){ 
                  str+=  "<i class='fa fa-thumbs-up'></i>  ";
                  }
               else {
                 str+= "<i class='fa fa-thumbs-o-up'></i>";
        
                }
            }
        

           }

            });
            str +="<span class='likes'>";
             $.ajax({ 

        async:false,
        url:'comment.php',
        type: 'post',
        data:{ 'getLikes':post_id},
        dataType: 'text',
        success: function(data){ 
            console.log(data);
                   
                   str += data;
           }

            });
            str +="</span>"
            str +="&nbsp;&nbsp;&nbsp;&nbsp;";
        //userdislike
        $.ajax({ 

        async:false,
        url:'comment.php',
        type: 'post',
        data:{ 'userDisliked':post_id},
        dataType: 'text',
        success: function(data){ 
           
          var userDisliked =  parseInt(data);

          if(e['archive_action'] != "archive"){
                if(userDisliked == 1){

                str+=  "<i class='fa fa-thumbs-down dislike-btn' data-id="+ post_id + "></i>  ";
              }

                    else{
           
                str+= "<i class='fa fa-thumbs-o-down dislike-btn' data-id="+ post_id + "></i>";
            
                 }

          }

          else{
                  if(userDisliked == 1){

                str+=  "<i class='fa fa-thumbs-down'></i>  ";
              }

                    else{
           
                str+= "<i class='fa fa-thumbs-o-down'></i>";
            
                 }

          }
         
          

           }

            });


            str +="<span class='dislikes'>";
             $.ajax({ 

        async:false,
        url:'comment.php',
        type: 'post',
        data:{ 'getDislikes':post_id},
        dataType: 'text',
        success: function(data){ 
            console.log(data);
                   
                   str += data;
           }

            });
            str +="</span>"
            str +="&nbsp;&nbsp;&nbsp;&nbsp;";

      //before closing
      str+="</div>";
      str+= "<br>";
      

    });
      
      $('#posts').prepend(str);
      $('textarea[name=content]').val('');







    }

  });
     
    
});

$(document).on('click','.delete-cmt', function(e){ 
  var post_id = $(this).data('id');
  
  
  $.ajax({
    url:'comment.php',
    type: 'post',
    data:{ 'del':post_id},
    dataType: 'text',
    success: function(data){
      console.log(data);
      $("#dis"+post_id).remove();


    }

  });

      
});


$(document).on('click','.arch', function(e){ 

  var group_id = $(this).data('id');
  $clicked_btn = $(this);

   if ($clicked_btn.hasClass('fa-archive')) {
    action = 'archive';
    $(".submit_post").attr('disabled', 'disabled');
    $(".submit_code").attr('disabled', 'disabled');
    $(".upload_image").attr('disabled', 'disabled');
     $(".invite-users").attr('disabled', 'disabled');
     $(".upload_url").attr('disabled', 'disabled');
    
    $('.like-btn').prop('disabled', true);
    $('.dislike-btn').prop('disabled', true);
    $(".submit_cmt").attr('disabled', 'disabled');
     
  } 
  else if($clicked_btn.hasClass('fa-unlock')){
    action = 'unarchive';
    $(".submit_post").removeAttr("disabled");
    $(".submit_code").removeAttr("disabled");
    $(".upload_image").removeAttr("disabled");
    $(".upload_url").removeAttr("disabled");

    $('.like-btn').prop('disabled', false);
    $('.dislike-btn').prop('disabled', false);
    $(".submit_cmt").removeAttr('disabled');

   
  }

   $.ajax({
    url: 'reactions.php',
    type: 'get',
    data: {
      'action': action,
      'group_id': group_id
    },
    success: function(data){
     console.log(data);
      if (action == "archive") {
        $clicked_btn.removeClass('fa-archive');
        $clicked_btn.addClass('fa-unlock');
        
        
        // $(".dislike-btn").prop('disabled', true);
        


      } else if(action == "unarchive") {
        $clicked_btn.removeClass('fa-unlock');
        $clicked_btn.addClass('fa-archive');
         
         // $('.like-btn').prop('disabled', false);
         

      }
     
   }
  });
});






});


//invite

$('.invite-users').on('click', function(e){

var group_name = document.getElementById('myselect').value;
 var user_id = [];
 $(':checkbox:checked').each(function(i){

  user_id[i]= $(this).val();
if(!user_id.length){
user_id[0]='0';
//Printing some value in <div>
}
 });


$.ajax({ 

   url:'comment.php',
   type: 'post',
   data:{'join':{'group_name':group_name,'user_id':user_id}},
   
   dataType:'text',
   success:function(data){

       console.log(data);
   }
    });
});

//remove
$('.remove-users').on('click', function(e){

var group_name = document.getElementById('myselect').value;
 var user_id = [];
 $(':checkbox:checked').each(function(i){

  user_id[i]= $(this).val();
if(!user_id.length){
user_id[0]='0';
//Printing some value in <div>
}
 });


$.ajax({ 

   url:'comment.php',
   type: 'post',
   data:{'remove':{'group_name':group_name,'user_id':user_id}},
   
   dataType:'text',
   success:function(data){

       console.log(data);
   }
    });
});


$(document).ready(function(){

    load_data();
function load_data(page,group_id){

   //start
    $.ajax({
    async:false,
    url:'pagination.php',
    type: 'get',
    data:{ 'group_messages':{'g_msg':group_id, 'page':page}},
    dataType: 'text',
    success: function(data){
  
          var str="";
          console.log(data);
          var obj = JSON.parse(data);
      if(obj['messages'] == "noposts")
      {
          
          str+= "<p style='font-size:30px; weight:bold; margin-left:264px;'>THE END!! </p>"
          $(".pag_link").attr('disabled', 'disabled');
      }
      else{


           var obj = JSON.parse(data);
      

          console.log(obj);


    
    //   str+= "<form method='POST' id = 'post-form"+ group_id+"'>";
    //   str+= "<fieldset style='margin-top:75px;'>";
   
    //   str+= "<label for='exampleTextarea' style='margin-left: 10px;'> It's time to post</label><br><br>";
    //   str+= "<textarea style='width:80%;'  id='content'name='content' placeholder='Type something.... :)'  rows='2' cols='100' required></textarea>";
    //      if(obj["messages"][0]["archive_action"] != "archive")
    // {
    //   str+= "<input type='submit' style='margin-top:-30px;'class='btn btn-primary submit_post' id="+ group_id+"  name='pos' value='Post' />";

    // }
    // // else{

    // //   str+= "<input type='submit' style='margin-top:-30px;'class='btn btn-primary disable-post' name='pos' value='Post' />";

    // // }
    //   str+= "</fieldset>";
    //   str+= "</form></div>";
      // str+= "<input type='button' class='pag_link' id="+group_id+" value='load more'>";


      
      obj['messages'].forEach(function(e){
           if(e['user_image']==""){
                
                $dp ="default.jpg";
                 }
                  else{
                       $dp =e['user_image'];
                       }

     
    
      str+= "<br>";
      
      str+= "<div id='posts'>";
      str+= "<div id='dis"+e['post_id']+"' class='dis'>";
      str+= "<div>";
      str+= "<img width='40' height='40' src ='img/"+$dp+"' alt= 'ddp'>";
      str+= "</div><br>";
      str+= "<div id= 'posts' style='float:left;' >";
      str+= "<H6><a href='allprofile.php?id="+e['user_id']+"'>"+ e['user_name']+"</a></H6>";
      str+= "</div>";
      str+= "<p id='tstamp' style='margin-left:100px;'>"+e['post_timestamp']+"</p>";
      str+= "<p>"+e['post_content']+"</p>";
      var post_id= e['post_id'];

      //userlike
       $.ajax({ 

        async:false,
        url:'comment.php',
        type: 'post',
        data:{ 'userLiked':post_id},
        dataType: 'text',
        success: function(data){ 
         
          var userLiked =  parseInt(data);

            if(e['archive_action'] != "archive")
            {
              if(userLiked == 1){ 
              str+=  "<i class='fa fa-thumbs-up like-btn' data-id="+ post_id + "></i>  ";
                  }
               else {
              str+= "<i class='fa fa-thumbs-o-up like-btn' data-id="+ post_id + "></i>";
        
                }
              
            }

            else {

                if(userLiked == 1){ 
                  str+=  "<i class='fa fa-thumbs-up'></i>  ";
                  }
               else {
                 str+= "<i class='fa fa-thumbs-o-up'></i>";
        
                }
            }
        

           }

            });
            str +="<span class='likes'>";
             $.ajax({ 

        async:false,
        url:'comment.php',
        type: 'post',
        data:{ 'getLikes':post_id},
        dataType: 'text',
        success: function(data){ 
            console.log(data);
                   
                   str += data;
           }

            });
            str +="</span>"
            str +="&nbsp;&nbsp;&nbsp;&nbsp;";
        //userdislike
        $.ajax({ 

        async:false,
        url:'comment.php',
        type: 'post',
        data:{ 'userDisliked':post_id},
        dataType: 'text',
        success: function(data){ 
           
          var userDisliked =  parseInt(data);

          if(e['archive_action'] != "archive"){
                if(userDisliked == 1){

                str+=  "<i class='fa fa-thumbs-down dislike-btn' data-id="+ post_id + "></i>  ";
              }

                    else{
           
                str+= "<i class='fa fa-thumbs-o-down dislike-btn' data-id="+ post_id + "></i>";
            
                 }

          }

          else{
                  if(userDisliked == 1){

                str+=  "<i class='fa fa-thumbs-down'></i>  ";
              }

                    else{
           
                str+= "<i class='fa fa-thumbs-o-down'></i>";
            
                 }

          }
         
          

           }

            });


            str +="<span class='dislikes'>";
    $.ajax({ 

        async:false,
        url:'comment.php',
        type: 'post',
        data:{ 'getDislikes':post_id},
        dataType: 'text',
        success: function(data){ 
            console.log(data);
                   
                   str += data;
           }

            });
            str +="</span>"
            str +="&nbsp;&nbsp;&nbsp;&nbsp;";
           
            str +="<a data-toggle='collapse' href='#"+post_id+"' aria-expanded='false' aria-controls='collapseExample' <i style='margin-left:8px;'class='far fa-comment get-cmt' data-id="+ post_id + " ></i></a>";
            str += "<div class='collapse' id='"+post_id+"'>";
            str += "<div class='card card-body' id='cmt-ap'>";
         
              $.ajax({ 

              async:false,
              url:'comment.php',
              type: 'post',
              data:{ 'getcomment':post_id},
              dataType: 'text',
              success: function(data){ 
                  
                  var object = JSON.parse(data);
                  console.log(obj);
                  object['messages'].forEach(function(e){ 
                      if(e['user_image']==""){
                
                        $dp ="default.jpg";
                      }
                  else{
                       $dp =e['user_image'];
                       }

                   str+="<div style='float:left; width:25%' >";
                   str+="<img width='20' height='20' src ='img/"+$dp+"' alt= 'dcdp'></img>";
                   str+="</div>";
                   str+="<div id='readcomment'>";
                   str+="<p><font color='blue'>"+ e['user_name']+"</font> says:&nbsp;&nbsp;";
                   str+=""+ e['comment']+" </p>";
                   str+="</div><br>";
                   });
                         
                   
                    


           }

            });
  
        
      str+="<form  method='POST' id = 'comment-form"+ post_id+"' >";
      str+="<input type='hidden' name ='username'>";
      str+="<textarea style='width:60%;'   name='content' placeholder='Leave a comment'  rows='1' cols='100' required></textarea>";
       if(e['archive_action'] != "archive"){
      str+= "<input type='submit' style='width:15%;height:34px;margin-top:-20px;'id =" +post_id +" class='btn btn-success submit_cmt'  name='reply'  value='reply' / ><i style='margin-left:8px;'class='fas fa-pencil-alt'></i></form>";
      }
      str+="</div>";  
      str+="</div>"; 
      str +="&nbsp;&nbsp;&nbsp;&nbsp;";

          $.ajax({ 

                  async:false,
                  url:'comment.php',
                  type: 'post',
                  data: 'admin',
                  dataType: 'text',
                  success: function(data){ 
                      console.log(data);

                      if(data == 20)

                             str+= "<i class='far fa-trash-alt delete-cmt' data-id="+ post_id + "></i>";
                             
                                       }

            });

      str+= "</div>";
       str+= "</div>";
      
  });

      }

      $('#dpost').append(str);
   
     
     

    }

 });


   //close

 }

    window.page = 1;
    $(document).on('click', '.pag_link', function(){
     
     
     page++;
     var group_id = $(this).attr("id");
     load_data(page,group_id);

    });
     

  });