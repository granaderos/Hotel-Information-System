<?php
	session_start();
	include 'DAO/DictionaryDAO.php';
	$logIn = new DictionaryDAO();
		if(isset($_REQUEST['username']) && isset($_REQUEST['password'])){
			
			$verrify = $logIn->logIn($_REQUEST['username'],$_REQUEST['password']);	
			if($verrify){
				$_SESSION['username'] = $_REQUEST['username'];
				header('Location: index2.php');	
			}else{
					$errMsg = "UserName add Password Didn't Match";
			}
		}

?>
<html>
	<!DOCTYPE HTML>
	
	<head>
		<link rel='stylesheet' href='./css/jquery-ui.css' style='text/css' />
         <script src="js/jquery-1.8.2.min.js"></script>
          <script src="js/homepage.js"></script>
          <script src="js/jquery-ui.js"></script>
          <link rel="stylesheet" href="CSS/jquery-ui.css" type="text/css"/>
	</head>
	<body>
	<div id="wrapper">
    <style>
        body, html>body{
            margin:0;
            padding:0;
            background-color:#000000;
        }
        #wrapper{
            margin:0 auto;
            padding:0;
            width:960px;
            min-height:300px;
            color:blue;
        }
        #topmost{
            height:30px;
            width:100%;
            clear:both;
            background-color:blue;
        }
        form{
            margin:0;
            padding:0;
        }
        input{
            width:100%;
        }
        .padding10{
            padding:10px;
        }
        .login{
            width:100px;
            float:right;
            position:relative;
        }
        .control{
            width:100px;
            float:right;
            padding:5px 0;
            clear:both;
            text-align:center;
            cursor:pointer;
           background-color:yellow;
        }
        .box{
            width:200px;
            background-color:#FF9900;
            display:none;
            z-index:1;
            position:absolute;
            top:30px;
            right:0;
        }
        .set{
         background-color: green;
         width:200px;
         border:solid yellow;
         border-radius: 30px;
        }
    </style>
	<script type="text/javascript">
        
         $(function(){
                  $(".box").dialog({
                  autoOpen:false,
                  width:"200px",
                  show:"pulsate",
                  hide:"bounce"
                  }); 
                  var state=true;
         $(".control").click(function(){
         if ( state ){
                  $(".box").animate({
                    backgroundColor:"#000000",
                    color:"#fff",
                 },2000); 

         }else{
                  $(".box").animate({
                  backgroundColor:"black",
                  color:"#000",
                },2000);
              }
              state = !state;
        $("#dialog2").dialog("open");
              return false;
              });
         });  
	</script>
	
	<div id="topmost">
	<div class="login">
		<div class="control" title='LOG-IN'>Log-In
		<div class="box">
		 <div id="dialog2" title="click right side to close">
		          <center><fieldset class="set"/>
			<form action='log-in.php' method='POST'>
			   <div class="padding10">
				<p>
				<label for='username'>UserName</label>
				<input type='text' id='username' name='username' placeholder='username'/>
				<p>
				<label for='password'>Password</label>
				<input type='password' id='password' name='password' placeholder='password'/>
				<p align="right"><input type='submit' value='Log-In' id='logIn_btn'/></p>
				</div>
			</form></fieldset>
			<?php
				if(isset($errMsg)){
					echo $errMsg;
				}
			?>
			</div>
			</div>
			</div>
			</div>
			<p align="center"></p>
		</div>
	
</html>


