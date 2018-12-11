$(document).ready(function(){

  $(document).on('click','.submit_code', function(e){ 

  var group_id = e.currentTarget.id;
  e.preventDefault();
  var content = $('textarea[name=code]').val();
  $.ajax({
    url:'comment.php',
    type: 'post',
    data:{ 'code':{'group_id':group_id, 'content':content}},
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
      if(e['img_num'] != 1){
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
      str+= "<pre style='background-color:#ebebe0; border-left: 1px solid black;'><code>"+e['code_content']+"</code></pre>";

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


//upload image to posts

$(document).on('click', '.upload_image', function(e){ 

  var group_id = e.currentTarget.id;
  var property= document.getElementById("file").files[0];
  var image_name =property.name;
  var image_extension = image_name.split(".").pop().toLowerCase();
  if(jQuery.inArray(image_extension,['gif','png','jpg','jpeg','pdf','docx','xls','txt']) == -1)
  {
    alert("Invalid image File");
  }
  var image_size=property.size;
  if(image_size > 2000000){

    alert("Image file size is very big");
  }

  else{

    var form_data = new FormData();
    form_data.append("file",property);
    form_data.append("id",group_id);
  }
  e.preventDefault();
  
  $.ajax({
    url:'upload.php',
    type: 'post',
    data: form_data,
    contentType:false,
    cache:false,
    processData:false,

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
      if(e['img_num'] != 1){
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
      if(e['image_content'] !='')
      {
        // str+= "<img src='upload/"+e['image_content']+"' height='150' width='225' class='img-thmbnail' /><br>";
        str+= "<img width='100' height='100' src ='upload/"+e['image_content']+"' alt= 'ddp'><br>";
  
      }
      else if (e['file_content'] !='') {
        str+="<a href='upload/"+e['file_content']+"'>"+e['file_content']+"</a><br>";

      }
     

      var post_id= e['post_id'];

     //
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

//upload image url

$(document).on('click', '.upload_url', function(e){ 

  var group_id = e.currentTarget.id;
  var imgurl= $('input[name=imglink]').val();
  
  e.preventDefault();
  
  $.ajax({
    url:'comment.php',
    type: 'post',
     data:{ 'link':{'group_id':group_id, 'imgurl':imgurl}},
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
      if(e['img_num'] != 1){
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
      str+= "<img src='"+e['link_content']+"' height='150' width='225' class='img-thmbnail' /><br>";

      var post_id= e['post_id'];

     //
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


//preview-Image
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
     
         $('#blah').attr('src', e.target.result);
         $('#blahs').attr('href', e.target.result);

         
     
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$(document).on('change', '#file', function(e){

  readURL(this);
   $('.blah').show();
   $('.blahs').show();
});

$(document).on('click', '.dhide', function(e){

  $('.blah').hide();
  $('.blahs').hide();
});


  
	});