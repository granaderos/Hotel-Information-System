$(document).ready(function(){

        
         $.fx.speeds._default=1000;
         $(function() {
        $( "#datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true
        });
    });
         $(function(){
                  $("#dialog2").dialog({
                  autoOpen:false,
                  height:340,
                  width:700,
                  show:"pulsate",
                  hide:"bounce"
                  }); 
                  var state=true;
         $("#opener").click(function(){
         if ( state ){
                  $("#dialog2").animate({
                    backgroundColor:"#aa0000",
                    color:"#fff",
                 },2000);   
        $.ajax({
        
                type:"POST",
                url:"view_words.php",
                success: function(data){
                $("#bdy").html(data);
                
             },
             error: function(data){
                alert(data);
             }
        });
         }else{
                  $("#dialog2").animate({
                  backgroundColor:"#fff",
                  color:"#000",
                },2000);
              }
              state = !state;
        $("#dialog2").dialog("open");
              return false;
              });
         });           
    
        $("#btn_add").click(function(){
        //create a JSON object
                var wordObj = {
                        "word":$("input[name='word']").val(),
                         "definition":$("input[name='definition']").val()
                        };
            
        $.ajax({
                type:"POST",
                url:"add_words.php",
                data:wordObj,
                success: function(data){ alert("Success");
                $("#bdy").html(data);
                
                
             },
             error: function(data){
                alert(data);
             }
        });
        });
        
        $("#btn_save").click(function(){

		var wordObj = {  "id": $("input[name='id']").val(),
			        "word":$("input[name='word']").val(),
			        "definition":$("input[name='definition']").val()};
		
		$.ajax({
			type:"POST",
			url: "save_words.php",
			data: wordObj,
			success: function(data){ 
								$(document.getElementById(wordObj.id)).html(data);                                                                                      
				
			},
			error: function(data){
				alert(data);
			}
		});
	});
	
	$("#id").click(function(){
	    $value = $("input[name = 'search']").val();
	    if($value != ""){
	    var datum = {"search" : $("input[name = 'search']").val()};
    		$.ajax({
    			type:"POST",
    			url: "search_words.php",
    			data: datum,
    			success: function(data){
    				$("#empty").html(data);
    				$("#empty").slideDown(5000);
    				$(".toggler").hide();
    			},
    			error: function(data){
    			}
    		});
    		
    	}else{
    	    $("#empty").html("Nothing to search!");
    		$("#empty").slideDown("not so fast");
    		$(".toggler").hide();
    	}
    
       });


});


        //DELETE (javascript)
        
        function deleteWords(id){
                var wordObj={"id":id};
             $(function() {
        $( "#dialog" ).dialog({
            resizable: false,
            height:190,
            modal: true,
            buttons: {
                "yes": function() {
                    $.ajax({
          
		type: "POST",
		data: wordObj,
		url: "delete_words.php",
		success: function(data){ 
			$(document.getElementById(wordObj.id)).remove(); 
		},
		error: function(data){}
	});
                    $( this ).dialog( "close" );
                },
                "JOKE": function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    });
               
          
               
}
  function editWords(id){
	var wordObj = {"id":id};

	$.ajax({
			type:"POST",
			data: wordObj,
			url: "edit_words.php",
                           success: function(data){ 
				var obj = JSON.parse(data);
				$("input[name='id']").val(obj.id);
				$("input[name='word']").val(obj.word);
				$("input[name='definition']").val(obj.definition);
			
			},
			error: function(data){
				
			}
	});
	
	
	
		
}


